<?php

namespace App\Console\Commands;

use App\Services\BackupService;
use Illuminate\Console\Command;

class CreateBackup extends Command
{
    protected $signature = 'backup:create 
                           {--type=auto : Tipo de backup (auto, manual, scheduled)}
                           {--description= : Descripción del backup}
                           {--no-database : No incluir base de datos}
                           {--no-files : No incluir archivos del sistema}
                           {--no-media : No incluir archivos de medios}';

    protected $description = 'Crear un backup del sistema';

    protected BackupService $backupService;

    public function __construct(BackupService $backupService)
    {
        parent::__construct();
        $this->backupService = $backupService;
    }

    public function handle(): int
    {
        $this->info('🔄 Iniciando proceso de backup...');

        try {
            $options = [
                'type' => $this->option('type'),
                'description' => $this->option('description') ?? 'Backup automático desde consola',
                'options' => [
                    'include_database' => !$this->option('no-database'),
                    'include_files' => !$this->option('no-files'),
                    'include_media' => !$this->option('no-media'),
                ]
            ];

            $this->info('📋 Configuración del backup:');
            $this->table(['Opción', 'Valor'], [
                ['Tipo', $options['type']],
                ['Descripción', $options['description']],
                ['Incluir BD', $options['options']['include_database'] ? '✅' : '❌'],
                ['Incluir archivos', $options['options']['include_files'] ? '✅' : '❌'],
                ['Incluir medios', $options['options']['include_media'] ? '✅' : '❌'],
            ]);

            if (!$this->confirm('¿Continuar con el backup?')) {
                $this->warn('❌ Backup cancelado por el usuario');
                return self::FAILURE;
            }

            $backup = $this->backupService->createBackup($options);

            $this->info("✅ Backup creado exitosamente");
            $this->table(['Campo', 'Valor'], [
                ['ID', $backup->id],
                ['Nombre', $backup->name],
                ['Archivo', $backup->filename],
                ['Estado', $backup->status],
                ['Creado', $backup->created_at->format('Y-m-d H:i:s')],
            ]);

            // Mostrar progreso si el backup está en curso
            if ($backup->status === 'in_progress') {
                $this->info('⏳ El backup está siendo procesado en segundo plano...');
                $this->info('💡 Usa el comando backup:status para verificar el progreso');
            }

            return self::SUCCESS;

        } catch (\Exception $e) {
            $this->error('❌ Error al crear el backup: ' . $e->getMessage());
            return self::FAILURE;
        }
    }
}