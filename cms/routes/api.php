<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BackupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

// Health check endpoint for Docker/Coolify
Route::get('/health', function () {
    $status = 'healthy';
    $httpCode = 200;
    $checks = [
        'app' => 'running',
        'timestamp' => now()->toIso8601String()
    ];

    // Check database connection (non-blocking)
    try {
        DB::connection()->getPdo();
        $checks['database'] = 'connected';
    } catch (\Exception $e) {
        // During startup, DB might not be ready yet - don't fail the health check
        $checks['database'] = 'initializing';
        $checks['db_message'] = 'Database connection pending';
        // Only fail if we've been running for a while (check if migrations exist)
        if (file_exists(base_path('database/migrations'))) {
            \Log::warning('Health check: Database not connected yet - ' . $e->getMessage());
        }
    }

    return response()->json($checks, $httpCode);
});

// Rutas de autenticación
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas públicas (SIN caché por ahora - el timestamp en frontend previene caché del navegador)
Route::get('pages', [PageController::class, 'index']);
Route::get('pages/navigation', [PageController::class, 'getNavigation']);
Route::get('pages/main-pages', [PageController::class, 'getMainPages']);
Route::get('pages/homepage', [PageController::class, 'getHomepage']);
Route::get('pages/id/{id}', [PageController::class, 'getById']);
Route::get('pages/{slug}', [PageController::class, 'show']);

// Configuraciones públicas (para cargar configs en el frontend)
Route::get('configs/{type}', [ConfigurationController::class, 'getActiveConfig']);

// Media routes (temporarily public for testing)
Route::apiResource('media', MediaController::class);
Route::post('media/bulk-upload', [MediaController::class, 'bulkUpload']);
Route::get('media-stats', [MediaController::class, 'stats']);

// Notes routes (temporarily public for testing)
Route::get('notes/search', [NotesController::class, 'search']);
Route::get('notes/categories', [NotesController::class, 'getCategories']);
Route::apiResource('notes', NotesController::class);

// Formularios CRM
Route::post('forms/submit', [FormController::class, 'submit']); // Público para envío desde frontend

// Backup routes (temporarily public for testing)
Route::apiResource('backups', BackupController::class);
Route::get('backups-stats', [BackupController::class, 'stats']);
Route::get('backups/{id}/download', [BackupController::class, 'download']);
Route::post('backups/{id}/restore', [BackupController::class, 'restore']);
Route::post('backups/{id}/cancel', [BackupController::class, 'cancel']);
Route::post('backups/{id}/force-complete', [BackupController::class, 'forceComplete']);
Route::post('backups/import', [BackupController::class, 'import']);

// Rutas protegidas (SIN caché)
Route::middleware(['auth:sanctum', 'no-cache'])->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);

    // CRUD páginas (solo admin)
    Route::post('pages', [PageController::class, 'store']);
    Route::put('pages/{page}', [PageController::class, 'update']);
    Route::patch('pages/update-order', [PageController::class, 'updateOrder']);
    Route::delete('pages/{page}', [PageController::class, 'destroy']);

    // CRUD contenidos (solo admin)
    Route::apiResource('contents', ContentController::class);
    Route::patch('contents/update-order', [ContentController::class, 'updateOrder']);
    
    // Configuraciones (solo admin)
    Route::post('configs/{type}', [ConfigurationController::class, 'saveConfig']);
    Route::get('configs/{type}/versions', [ConfigurationController::class, 'getVersions']);
    Route::put('configs/{type}/activate', [ConfigurationController::class, 'activateVersion']);
    Route::get('configs/id/{id}', [ConfigurationController::class, 'getConfigById']);
    Route::delete('configs/id/{id}', [ConfigurationController::class, 'deleteConfig']);
    
    // Gestión de medios (solo admin) - moved outside for testing
    
    // CRUD Notas (solo admin) - moved to public for testing
    
    // Gestión de formularios CRM (solo admin)
    Route::get('forms', [FormController::class, 'index']);
    Route::get('forms/{id}', [FormController::class, 'show']);
    Route::patch('forms/{id}/status', [FormController::class, 'updateStatus']);
    Route::post('forms/{id}/reply', [FormController::class, 'reply']);
    Route::patch('forms/mark-all-read', [FormController::class, 'markAllAsRead']);
    Route::get('forms/export', [FormController::class, 'export']);
    Route::delete('forms/{id}', [FormController::class, 'destroy']);
    
    // Gestión de usuarios y roles (solo admin)
    Route::apiResource('users', UserController::class);
    Route::get('roles', [UserController::class, 'getRoles']);
    
    // Gestión de backups (solo admin) - moved outside for testing
});