<?php

namespace App\Http\Controllers;

use App\Models\Backup;
use App\Services\BackupService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BackupController extends Controller
{
    protected BackupService $backupService;

    public function __construct(BackupService $backupService)
    {
        $this->backupService = $backupService;
    }

    /**
     * Listar todos los backups
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Backup::with('user');

            // Filtros
            if ($request->has('type') && $request->type !== 'all') {
                $query->byType($request->type);
            }

            if ($request->has('status') && $request->status !== 'all') {
                $query->where('status', $request->status);
            }

            if ($request->has('search') && $request->search) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('description', 'like', '%' . $request->search . '%');
                });
            }

            $backups = $query->latest()->paginate(10);

            $backups->getCollection()->transform(function ($backup) {
                return [
                    'id' => $backup->id,
                    'name' => $backup->name,
                    'filename' => $backup->filename,
                    'type' => $backup->type,
                    'status' => $backup->status,
                    'size' => $backup->size,
                    'size_formatted' => $backup->file_size_formatted,
                    'description' => $backup->description,
                    'contents' => $backup->contents,
                    'metadata' => $backup->metadata,
                    'checksum' => $backup->checksum,
                    'compression' => $backup->compression,
                    'user' => $backup->user ? [
                        'id' => $backup->user->id,
                        'name' => $backup->user->name
                    ] : null,
                    'started_at' => $backup->started_at?->toISOString(),
                    'completed_at' => $backup->completed_at?->toISOString(),
                    'duration' => $backup->duration,
                    'error_message' => $backup->error_message,
                    'is_valid' => $backup->is_valid,
                    'created_at' => $backup->created_at->toISOString(),
                    'updated_at' => $backup->updated_at->toISOString(),
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $backups->items(),
                'pagination' => [
                    'current_page' => $backups->currentPage(),
                    'last_page' => $backups->lastPage(),
                    'per_page' => $backups->perPage(),
                    'total' => $backups->total()
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener backups',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Crear un nuevo backup
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'description' => 'nullable|string|max:500',
            'include_database' => 'boolean',
            'include_files' => 'boolean',
            'include_media' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Datos inválidos',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $backup = $this->backupService->createBackup([
                'type' => 'manual',
                'description' => $request->description,
                'user_id' => Auth::id(),
                'options' => [
                    'include_database' => $request->boolean('include_database', true),
                    'include_files' => $request->boolean('include_files', true),
                    'include_media' => $request->boolean('include_media', true),
                ]
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Backup iniciado exitosamente',
                'data' => [
                    'id' => $backup->id,
                    'name' => $backup->name,
                    'status' => $backup->status,
                    'type' => $backup->type,
                    'created_at' => $backup->created_at->toISOString()
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear backup',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mostrar detalles de un backup específico
     */
    public function show(string $id): JsonResponse
    {
        try {
            $backup = Backup::with('user')->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $backup->id,
                    'name' => $backup->name,
                    'filename' => $backup->filename,
                    'type' => $backup->type,
                    'status' => $backup->status,
                    'size' => $backup->size,
                    'size_formatted' => $backup->file_size_formatted,
                    'description' => $backup->description,
                    'contents' => $backup->contents,
                    'metadata' => $backup->metadata,
                    'checksum' => $backup->checksum,
                    'compression' => $backup->compression,
                    'user' => $backup->user ? [
                        'id' => $backup->user->id,
                        'name' => $backup->user->name,
                        'email' => $backup->user->email
                    ] : null,
                    'started_at' => $backup->started_at?->toISOString(),
                    'completed_at' => $backup->completed_at?->toISOString(),
                    'duration' => $backup->duration,
                    'error_message' => $backup->error_message,
                    'is_valid' => $backup->is_valid,
                    'created_at' => $backup->created_at->toISOString(),
                    'updated_at' => $backup->updated_at->toISOString(),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Backup no encontrado'
            ], 404);
        }
    }

    /**
     * Actualizar un backup (nombre, descripción)
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Datos inválidos',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $backup = Backup::findOrFail($id);
            
            if ($request->has('name')) {
                $backup->name = $request->input('name');
            }
            
            if ($request->has('description')) {
                $backup->description = $request->input('description');
            }
            
            $backup->save();

            return response()->json([
                'success' => true,
                'message' => 'Backup actualizado correctamente',
                'data' => [
                    'id' => $backup->id,
                    'name' => $backup->name,
                    'description' => $backup->description
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar backup',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Descargar un backup
     */
    public function download(string $id): BinaryFileResponse|JsonResponse
    {
        try {
            $backup = Backup::findOrFail($id);

            if ($backup->status !== 'completed') {
                return response()->json([
                    'success' => false,
                    'message' => 'El backup no está completado'
                ], 400);
            }

            if (!$backup->is_valid) {
                return response()->json([
                    'success' => false,
                    'message' => 'El archivo de backup no es válido o no existe'
                ], 404);
            }

            $filePath = $backup->file_path;
            $absolutePath = storage_path('app/' . $filePath);
            
            if (!file_exists($absolutePath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'El archivo de backup no existe en el almacenamiento'
                ], 404);
            }

            return response()->download($absolutePath, $backup->filename);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al descargar backup',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Restaurar un backup
     */
    public function restore(Request $request, string $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'create_backup_before' => 'boolean',
            'notify_users' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Datos inválidos',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $backup = Backup::findOrFail($id);

            if ($backup->status !== 'completed') {
                return response()->json([
                    'success' => false,
                    'message' => 'El backup no está completado'
                ], 400);
            }

            if (!$backup->is_valid) {
                return response()->json([
                    'success' => false,
                    'message' => 'El archivo de backup no es válido'
                ], 400);
            }

            $result = $this->backupService->restoreBackup($backup, [
                'create_backup_before' => $request->boolean('create_backup_before', true),
                'notify_users' => $request->boolean('notify_users', false),
                'user_id' => Auth::id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Restauración iniciada exitosamente',
                'data' => $result
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al restaurar backup',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar un backup
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $backup = Backup::findOrFail($id);
            
            // Si está en progreso, permitir cancelación y eliminación
            if ($backup->status === 'in_progress') {
                $backup->update([
                    'status' => 'cancelled',
                    'error_message' => 'Cancelado manualmente por el usuario',
                    'completed_at' => now()
                ]);
            }

            $backup->delete(); // El modelo se encarga de eliminar el archivo

            return response()->json([
                'success' => true,
                'message' => 'Backup eliminado exitosamente'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar backup',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Forzar completar un backup que está stuck en progreso
     */
    public function forceComplete(string $id): JsonResponse
    {
        try {
            $backup = Backup::findOrFail($id);
            
            if ($backup->status !== 'in_progress') {
                return response()->json([
                    'success' => false,
                    'message' => 'El backup no está en progreso'
                ], 400);
            }

            // Verificar si el archivo existe y obtener su información
            if ($backup->is_valid) {
                $filePath = storage_path('app/' . $backup->file_path);
                $fileSize = file_exists($filePath) ? filesize($filePath) : 0;
                $checksum = file_exists($filePath) ? hash_file('sha256', $filePath) : '';
                
                $backup->markAsCompleted($fileSize, $checksum);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Backup marcado como completado exitosamente'
                ]);
            } else {
                $backup->markAsFailed('Archivo de backup no válido o no encontrado');
                
                return response()->json([
                    'success' => true,
                    'message' => 'Backup marcado como fallido'
                ]);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al forzar completar backup',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener estadísticas de backups
     */
    public function stats(): JsonResponse
    {
        try {
            $stats = [
                'total_backups' => Backup::count(),
                'completed_backups' => Backup::where('status', 'completed')->count(),
                'failed_backups' => Backup::where('status', 'failed')->count(),
                'total_size' => Backup::completed()->sum('size'),
                'last_backup' => Backup::completed()->latest()->first(),
                'oldest_backup' => Backup::completed()->oldest()->first(),
                'backups_this_month' => Backup::whereMonth('created_at', now()->month)->count(),
                'average_size' => Backup::completed()->avg('size'),
            ];

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener estadísticas'
            ], 500);
        }
    }

    /**
     * Cancelar un backup en progreso
     */
    public function cancel(string $id): JsonResponse
    {
        try {
            $backup = Backup::findOrFail($id);

            if ($backup->status !== 'in_progress') {
                return response()->json([
                    'success' => false,
                    'message' => 'Solo se pueden cancelar backups en progreso'
                ], 400);
            }

            $this->backupService->cancelBackup($backup);

            return response()->json([
                'success' => true,
                'message' => 'Backup cancelado exitosamente'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cancelar backup'
            ], 500);
        }
    }

    /**
     * Importar un backup desde archivo
     */
    public function import(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'backup_file' => 'required|file|mimes:zip|max:512000', // 500MB max
            'description' => 'nullable|string|max:500'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Archivo inválido',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $file = $request->file('backup_file');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            
            // Generar nombre único para el backup importado
            $backupName = 'backup_imported_' . date('Y-m-d_H-i-s') . '_' . Str::random(8);
            $filename = $backupName . '.zip';
            
            // Guardar archivo en el directorio de backups
            $backupPath = storage_path('app/backups/' . $filename);
            $file->move(dirname($backupPath), $filename);
            
            // Calcular checksum
            $checksum = hash_file('sha256', $backupPath);
            $fileSize = filesize($backupPath);
            
            // Crear registro en la base de datos
            $backup = Backup::create([
                'name' => $backupName,
                'filename' => $filename,
                'type' => 'imported',
                'status' => 'completed',
                'size' => $fileSize,
                'description' => $request->input('description', "Backup importado: {$originalName}"),
                'contents' => [
                    ['type' => 'Imported File', 'count' => 1, 'size' => $fileSize]
                ],
                'metadata' => [
                    'version' => '1.0.0',
                    'imported_from' => $originalName,
                    'imported_at' => now()->toISOString(),
                    'created_by' => 'user'
                ],
                'checksum' => $checksum,
                'compression' => 'zip',
                'user_id' => auth()->id(),
                'started_at' => now(),
                'completed_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Backup importado exitosamente',
                'data' => [
                    'id' => $backup->id,
                    'name' => $backup->name,
                    'filename' => $backup->filename,
                    'size' => $backup->size,
                    'description' => $backup->description,
                    'created_at' => $backup->created_at->toISOString()
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al importar backup',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}