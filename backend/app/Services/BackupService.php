<?php

namespace App\Services;

use App\Models\Backup;
use App\Models\User;
use App\Models\Page;
use App\Models\Form;
use App\Models\Media;
use App\Models\SiteConfiguration;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use ZipArchive;

class BackupService
{
    protected string $backupPath;
    protected string $tempPath;

    public function __construct()
    {
        $this->backupPath = storage_path('app/backups');
        $this->tempPath = storage_path('app/temp');
        
        // Crear directorios si no existen
        if (!File::exists($this->backupPath)) {
            File::makeDirectory($this->backupPath, 0755, true);
        }
        
        if (!File::exists($this->tempPath)) {
            File::makeDirectory($this->tempPath, 0755, true);
        }
    }

    /**
     * Crear un nuevo backup
     */
    public function createBackup(array $options = []): Backup
    {
        $name = $this->generateBackupName($options['type'] ?? 'manual');
        $filename = $name . '.zip';
        
        $backup = Backup::create([
            'name' => $name,
            'filename' => $filename,
            'type' => $options['type'] ?? 'manual',
            'description' => $options['description'] ?? null,
            'user_id' => $options['user_id'] ?? null,
            'status' => 'pending',
            'metadata' => [
                'version' => config('app.version', '1.0.0'),
                'php_version' => PHP_VERSION,
                'created_by' => $options['user_id'] ?? 'system',
                'options' => $options['options'] ?? []
            ]
        ]);

        // Ejecutar backup en segundo plano
        $this->processBackup($backup, $options['options'] ?? []);

        return $backup;
    }

    /**
     * Procesar la creación del backup
     */
    protected function processBackup(Backup $backup, array $options = []): void
    {
        \Log::info("BackupService: Iniciando processBackup", ['backup_id' => $backup->id, 'backup_name' => $backup->name]);
        
        try {
            $backup->markAsStarted();
            \Log::info("BackupService: Backup marcado como iniciado", ['backup_id' => $backup->id]);

            $tempDir = $this->tempPath . '/' . $backup->name;
            File::makeDirectory($tempDir, 0755, true);

            $contents = [];

            // 1. Backup de base de datos
            if ($options['include_database'] ?? true) {
                $dbBackup = $this->createDatabaseBackup($tempDir);
                $contents[] = [
                    'type' => 'Database',
                    'count' => $dbBackup['tables_count'],
                    'size' => $dbBackup['size']
                ];
            }

            // 2. Backup de archivos del sistema
            if ($options['include_files'] ?? true) {
                $filesBackup = $this->createFilesBackup($tempDir);
                $contents[] = [
                    'type' => 'System Files',
                    'count' => $filesBackup['files_count'],
                    'size' => $filesBackup['size']
                ];
            }

            // 3. Backup de medios
            if ($options['include_media'] ?? true) {
                $mediaBackup = $this->createMediaBackup($tempDir);
                $contents[] = [
                    'type' => 'Media Files',
                    'count' => $mediaBackup['files_count'],
                    'size' => $mediaBackup['size']
                ];
            }

            // 4. Crear archivo ZIP
            $zipPath = $this->backupPath . '/' . $backup->filename;
            $this->createZipArchive($tempDir, $zipPath);

            // 5. Calcular checksum
            $fileSize = File::size($zipPath);
            $checksum = hash_file('sha256', $zipPath);

            // 6. Actualizar backup con información final
            $backup->update([
                'contents' => $contents,
                'metadata' => array_merge($backup->metadata ?? [], [
                    'temp_directory' => $tempDir,
                    'total_files' => array_sum(array_column($contents, 'count')),
                    'compression_ratio' => $this->calculateCompressionRatio($tempDir, $fileSize)
                ])
            ]);

            $backup->markAsCompleted($fileSize, $checksum);
            \Log::info("BackupService: Backup marcado como completado", ['backup_id' => $backup->id, 'size' => $fileSize]);

            // Limpiar directorio temporal
            File::deleteDirectory($tempDir);

        } catch (\Exception $e) {
            \Log::error("BackupService: Error en processBackup", ['backup_id' => $backup->id, 'error' => $e->getMessage()]);
            $backup->markAsFailed($e->getMessage());
            
            // Limpiar archivos temporales en caso de error
            if (isset($tempDir) && File::exists($tempDir)) {
                File::deleteDirectory($tempDir);
            }
            
            throw $e;
        }
    }

    /**
     * Crear backup de la base de datos
     */
    protected function createDatabaseBackup(string $tempDir): array
    {
        $dbConnection = config('database.default');
        $dbConfig = config("database.connections.{$dbConnection}");
        
        if ($dbConnection === 'sqlite') {
            return $this->createSqliteBackup($tempDir);
        } elseif ($dbConnection === 'mysql') {
            return $this->createMysqlBackup($tempDir, $dbConfig);
        }
        
        throw new \Exception("Tipo de base de datos no soportado: {$dbConnection}");
    }

    /**
     * Crear backup SQLite
     */
    private function createSqliteBackup(string $tempDir): array
    {
        $dbPath = $tempDir . '/database.sqlite';
        $databasePath = database_path('database.sqlite');
        
        if (File::exists($databasePath)) {
            File::copy($databasePath, $dbPath);
            $tables = DB::select("SELECT name FROM sqlite_master WHERE type='table'");
            
            return [
                'tables_count' => count($tables),
                'size' => File::size($dbPath)
            ];
        }
        
        return ['tables_count' => 0, 'size' => 0];
    }

    /**
     * Crear backup MySQL
     */
    private function createMysqlBackup(string $tempDir, array $config): array
    {
        $sqlFile = $tempDir . '/database.sql';
        
        // Obtener lista de tablas
        $tables = DB::select('SHOW TABLES');
        $tableKey = 'Tables_in_' . $config['database'];
        $tableNames = array_map(function($table) use ($tableKey) {
            return $table->$tableKey;
        }, $tables);
        
        // Excluir la tabla backups para evitar problemas durante la restauración
        $tableNames = array_filter($tableNames, function($tableName) {
            return $tableName !== 'backups';
        });
        
        // Crear backup usando PHP (sin depender de mysqldump)
        $sqlContent = "-- Backup de base de datos MySQL generado el " . date('Y-m-d H:i:s') . "\n";
        $sqlContent .= "-- Base de datos: " . $config['database'] . "\n\n";
        $sqlContent .= "SET NAMES utf8;\n";
        $sqlContent .= "SET time_zone = '+00:00';\n";
        $sqlContent .= "SET foreign_key_checks = 0;\n";
        $sqlContent .= "SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';\n\n";
        
        foreach ($tableNames as $tableName) {
            // Obtener estructura de la tabla
            $createTableResult = DB::select("SHOW CREATE TABLE `{$tableName}`");
            $createTable = $createTableResult[0]->{'Create Table'};
            
            $sqlContent .= "-- Estructura de tabla para `{$tableName}`\n";
            $sqlContent .= "DROP TABLE IF EXISTS `{$tableName}`;\n";
            $sqlContent .= $createTable . ";\n\n";
            
            // Obtener datos de la tabla
            $rows = DB::select("SELECT * FROM `{$tableName}`");
            
            if (!empty($rows)) {
                $sqlContent .= "-- Datos de la tabla `{$tableName}`\n";
                
                foreach ($rows as $row) {
                    $values = array_map(function($value) {
                        return $value === null ? 'NULL' : "'" . addslashes($value) . "'";
                    }, (array) $row);
                    
                    $columns = array_keys((array) $row);
                    $sqlContent .= "INSERT INTO `{$tableName}` (`" . implode('`, `', $columns) . "`) VALUES (" . implode(', ', $values) . ");\n";
                }
                $sqlContent .= "\n";
            }
        }
        
        $sqlContent .= "SET foreign_key_checks = 1;\n";
        
        // Escribir archivo SQL
        File::put($sqlFile, $sqlContent);
        
        return [
            'tables_count' => count($tableNames),
            'size' => File::size($sqlFile)
        ];
    }

    /**
     * Crear backup de archivos del sistema
     */
    protected function createFilesBackup(string $tempDir): array
    {
        $systemDir = $tempDir . '/system';
        File::makeDirectory($systemDir, 0755, true);

        $filesCount = 0;
        $totalSize = 0;

        // Archivos de configuración importantes
        $configFiles = [
            '.env' => base_path('.env'),
            'composer.json' => base_path('composer.json'),
        ];

        foreach ($configFiles as $name => $path) {
            if (File::exists($path)) {
                $destPath = $systemDir . '/' . $name;
                File::copy($path, $destPath);
                $filesCount++;
                $totalSize += File::size($destPath);
            }
        }

        return [
            'files_count' => $filesCount,
            'size' => $totalSize
        ];
    }

    /**
     * Crear backup de archivos de medios
     */
    protected function createMediaBackup(string $tempDir): array
    {
        $mediaDir = $tempDir . '/media';
        $storageMediaPath = storage_path('app/public');
        
        if (File::exists($storageMediaPath)) {
            File::copyDirectory($storageMediaPath, $mediaDir);
            
            $filesCount = $this->countFiles($mediaDir);
            $totalSize = $this->calculateDirectorySize($mediaDir);
            
            return [
                'files_count' => $filesCount,
                'size' => $totalSize
            ];
        }

        return ['files_count' => 0, 'size' => 0];
    }

    /**
     * Crear archivo ZIP
     */
    protected function createZipArchive(string $sourceDir, string $zipPath): void
    {
        $zip = new ZipArchive();
        
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            throw new \Exception('No se pudo crear el archivo ZIP');
        }

        $this->addDirectoryToZip($zip, $sourceDir, '');
        $zip->close();
    }

    /**
     * Añadir directorio al ZIP recursivamente
     */
    protected function addDirectoryToZip(ZipArchive $zip, string $sourceDir, string $zipPath): void
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($sourceDir),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $file) {
            $filename = $file->getFilename();
            
            // Saltar directorios problemáticos
            if ($filename === '.' || $filename === '..' || strpos($filename, '..') !== false) {
                continue;
            }
            
            if ($file->isDir()) {
                $zip->addEmptyDir($zipPath . $filename . '/');
            } elseif ($file->isFile()) {
                $zip->addFile($file->getRealPath(), $zipPath . $filename);
            }
        }
    }

    /**
     * Restaurar un backup
     */
    public function restoreBackup(Backup $backup, array $options = []): array
    {
        \Log::info("BackupService: Iniciando restauración del backup", ['backup_id' => $backup->id, 'backup_name' => $backup->name]);
        
        if (!$backup->is_valid) {
            \Log::error("BackupService: El archivo de backup no es válido", ['backup_id' => $backup->id]);
            throw new \Exception('El archivo de backup no es válido');
        }

        // Crear backup antes de restaurar si se solicita
        $preRestoreBackup = null;
        if ($options['create_backup_before'] ?? true) {
            \Log::info("BackupService: Creando backup previo antes de restaurar");
            try {
                $preRestoreBackup = $this->createBackup([
                    'type' => 'auto',
                    'description' => 'Backup automático antes de restaurar: ' . $backup->name,
                    'user_id' => $options['user_id'] ?? null,
                    'options' => [
                        'include_database' => true,
                        'include_files' => true,
                        'include_media' => true
                    ]
                ]);
                \Log::info("BackupService: Backup previo creado", ['backup_id' => $preRestoreBackup->id]);
            } catch (\Exception $e) {
                \Log::error("BackupService: Error creando backup previo: " . $e->getMessage());
                // Continuar con la restauración aunque falle el backup previo
            }
        }

        try {
            \Log::info("BackupService: Iniciando proceso de restauración");
            $this->processRestore($backup);
            \Log::info("BackupService: Restauración completada exitosamente");
            
            return [
                'backup_restored' => $backup->name,
                'pre_restore_backup' => $preRestoreBackup?->name,
                'restored_at' => now()->toISOString()
            ];
            
        } catch (\Exception $e) {
            \Log::error("BackupService: Error en la restauración: " . $e->getMessage());
            // Si falla la restauración y se creó un backup previo, se puede usar para recuperar
            throw new \Exception('Error en la restauración: ' . $e->getMessage() . 
                ($preRestoreBackup ? ' (Se creó backup de seguridad: ' . $preRestoreBackup->name . ')' : ''));
        }
    }

    /**
     * Procesar la restauración del backup
     */
    protected function processRestore(Backup $backup): void
    {
        $tempDir = $this->tempPath . '/restore_' . $backup->id;
        $zipPath = storage_path('app/' . $backup->file_path);

        try {
            // Extraer ZIP
            $zip = new ZipArchive();
            if ($zip->open($zipPath) !== TRUE) {
                throw new \Exception('No se pudo abrir el archivo de backup');
            }

            // Limpiar directorio anterior si existe
            if (File::exists($tempDir)) {
                File::deleteDirectory($tempDir);
            }
            
            // Crear directorio con mkdir nativo para mayor compatibilidad en Windows
            if (!mkdir($tempDir, 0755, true)) {
                throw new \Exception("No se pudo crear el directorio temporal: {$tempDir}");
            }
            
            if (!is_dir($tempDir)) {
                throw new \Exception("El directorio temporal no existe después de crearlo: {$tempDir}");
            }
            
            // Extraer archivos uno por uno para evitar problemas con entradas inválidas como "../"
            $extractedCount = 0;
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $filename = $zip->getNameIndex($i);
                
                // Saltar entradas problemáticas
                if ($filename === '../' || strpos($filename, '..') !== false) {
                    continue;
                }
                
                if ($zip->extractTo($tempDir, $filename)) {
                    $extractedCount++;
                }
            }
            
            if ($extractedCount === 0) {
                throw new \Exception("No se pudo extraer ningún archivo del ZIP");
            }
            $zip->close();

            // Restaurar base de datos
            $dbConnection = config('database.default');
            if ($dbConnection === 'mysql' && File::exists($tempDir . '/database.sql')) {
                $this->restoreDatabase($tempDir . '/database.sql');
            } elseif ($dbConnection === 'sqlite' && File::exists($tempDir . '/database.sqlite')) {
                $this->restoreDatabase($tempDir . '/database.sqlite');
            }

            // Restaurar archivos del sistema
            if (File::exists($tempDir . '/system')) {
                $this->restoreSystemFiles($tempDir . '/system');
            }

            // Restaurar medios
            if (File::exists($tempDir . '/media')) {
                $this->restoreMediaFiles($tempDir . '/media');
            }

        } finally {
            // Limpiar directorio temporal
            if (File::exists($tempDir)) {
                File::deleteDirectory($tempDir);
            }
        }
    }

    /**
     * Restaurar base de datos
     */
    protected function restoreDatabase(string $dbFile): void
    {
        $dbConnection = config('database.default');
        $dbConfig = config("database.connections.{$dbConnection}");
        
        if ($dbConnection === 'sqlite') {
            $this->restoreSqliteDatabase($dbFile);
        } elseif ($dbConnection === 'mysql') {
            $this->restoreMysqlDatabase($dbFile, $dbConfig);
        } else {
            throw new \Exception("Tipo de base de datos no soportado para restauración: {$dbConnection}");
        }
    }

    /**
     * Restaurar base de datos SQLite
     */
    private function restoreSqliteDatabase(string $dbFile): void
    {
        $databasePath = database_path('database.sqlite');
        
        // Hacer backup de la DB actual antes de reemplazar
        if (File::exists($databasePath)) {
            $backupDbPath = $databasePath . '.backup.' . time();
            File::copy($databasePath, $backupDbPath);
        }

        File::copy($dbFile, $databasePath);
    }

    /**
     * Restaurar base de datos MySQL
     */
    private function restoreMysqlDatabase(string $sqlFile, array $config): void
    {
        if (!File::exists($sqlFile)) {
            throw new \Exception("El archivo SQL no existe: {$sqlFile}");
        }
        
        $sqlContent = File::get($sqlFile);
        
        // Método más robusto para dividir statements SQL
        $statements = [];
        $currentStatement = '';
        $lines = explode("\n", $sqlContent);
        
        foreach ($lines as $line) {
            $line = trim($line);
            
            // Ignorar líneas vacías y comentarios
            if (empty($line) || preg_match('/^--/', $line)) {
                continue;
            }
            
            $currentStatement .= $line . "\n";
            
            // Si la línea termina en ; (y no está dentro de comillas), es el final del statement
            if (preg_match('/;$/', $line)) {
                $statements[] = trim($currentStatement);
                $currentStatement = '';
            }
        }
        
        // Agregar último statement si no termina en ;
        if (!empty(trim($currentStatement))) {
            $statements[] = trim($currentStatement);
        }
        
        // Preparar la base de datos para la restauración
        DB::unprepared('SET NAMES utf8');
        DB::unprepared('SET foreign_key_checks = 0');
        DB::unprepared('SET sql_mode = ""');
        
        $executedCount = 0;
        $failedCount = 0;
        
        foreach ($statements as $statement) {
            if (!empty($statement)) {
                try {
                    DB::unprepared($statement);
                    $executedCount++;
                } catch (\Exception $e) {
                    $failedCount++;
                    \Log::error("Error ejecutando statement SQL durante restauración: " . $e->getMessage());
                    \Log::error("Statement que falló: " . substr($statement, 0, 500) . "...");
                    
                    // Si es un error crítico, lanzar excepción
                    if (strpos(strtolower($statement), 'insert into') === 0 || 
                        strpos(strtolower($statement), 'create table') === 0) {
                        throw $e;
                    }
                }
            }
        }
        
        DB::unprepared('SET foreign_key_checks = 1');
        
        \Log::info("Restauración MySQL completada: {$executedCount} statements ejecutados, {$failedCount} fallaron");
    }

    /**
     * Restaurar archivos del sistema
     */
    protected function restoreSystemFiles(string $systemDir): void
    {
        // Solo restaurar archivos seguros específicos
        $safeFiles = ['.env' => base_path('.env')];
        
        foreach ($safeFiles as $name => $destPath) {
            $sourcePath = $systemDir . '/' . $name;
            if (File::exists($sourcePath)) {
                File::copy($sourcePath, $destPath);
            }
        }
    }

    /**
     * Restaurar archivos de medios
     */
    protected function restoreMediaFiles(string $mediaDir): void
    {
        $storageMediaPath = storage_path('app/public');
        
        // Limpiar directorio de medios actual
        if (File::exists($storageMediaPath)) {
            File::deleteDirectory($storageMediaPath);
        }
        
        File::copyDirectory($mediaDir, $storageMediaPath);
    }

    /**
     * Cancelar un backup en progreso
     */
    public function cancelBackup(Backup $backup): void
    {
        $backup->update([
            'status' => 'cancelled',
            'completed_at' => now(),
            'error_message' => 'Cancelado por el usuario'
        ]);

        // Limpiar archivos temporales si existen
        $tempDir = $this->tempPath . '/' . $backup->name;
        if (File::exists($tempDir)) {
            File::deleteDirectory($tempDir);
        }
    }

    /**
     * Utilidades auxiliares
     */
    protected function generateBackupName(string $type): string
    {
        return 'backup_' . $type . '_' . now()->format('Y-m-d_H-i-s');
    }

    protected function countFiles(string $directory): int
    {
        if (!File::exists($directory)) {
            return 0;
        }

        $count = 0;
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory)
        );

        foreach ($iterator as $file) {
            if ($file->isFile()) {
                $count++;
            }
        }

        return $count;
    }

    protected function calculateDirectorySize(string $directory): int
    {
        if (!File::exists($directory)) {
            return 0;
        }

        $size = 0;
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory)
        );

        foreach ($iterator as $file) {
            if ($file->isFile()) {
                $size += $file->getSize();
            }
        }

        return $size;
    }

    protected function calculateCompressionRatio(string $sourceDir, int $compressedSize): float
    {
        $originalSize = $this->calculateDirectorySize($sourceDir);
        
        if ($originalSize === 0) {
            return 0;
        }

        return round((1 - ($compressedSize / $originalSize)) * 100, 2);
    }
}