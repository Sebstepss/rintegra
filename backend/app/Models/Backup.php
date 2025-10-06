<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Backup extends Model
{
    protected $fillable = [
        'name',
        'filename',
        'type',
        'status',
        'size',
        'description',
        'contents',
        'metadata',
        'checksum',
        'compression',
        'user_id',
        'started_at',
        'completed_at',
        'error_message'
    ];

    protected $casts = [
        'contents' => 'array',
        'metadata' => 'array',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'size' => 'integer'
    ];

    // Relaciones
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    // Mutadores y Accesores
    public function getFileSizeFormattedAttribute(): string
    {
        if (!$this->size) return '0 B';
        
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getFilePathAttribute(): string
    {
        return 'backups/' . $this->filename;
    }

    public function getIsValidAttribute(): bool
    {
        if (!$this->filename) {
            return false;
        }

        // Verificar si el archivo existe usando file_exists directamente
        $absolutePath = storage_path('app/' . $this->file_path);
        if (!file_exists($absolutePath)) {
            return false;
        }

        // Verificar checksum si existe
        if ($this->checksum) {
            try {
                $fileHash = hash_file('sha256', Storage::path($this->file_path));
                return $fileHash === $this->checksum;
            } catch (\Exception $e) {
                // Si no se puede calcular el hash, se considera válido
                return true;
            }
        }

        return true;
    }

    public function getDurationAttribute(): ?int
    {
        if (!$this->started_at || !$this->completed_at) {
            return null;
        }

        return $this->completed_at->diffInSeconds($this->started_at);
    }

    // Métodos auxiliares
    public function markAsStarted(): void
    {
        $this->update([
            'status' => 'in_progress',
            'started_at' => now()
        ]);
    }

    public function markAsCompleted(int $size, string $checksum): void
    {
        $this->update([
            'status' => 'completed',
            'size' => $size,
            'checksum' => $checksum,
            'completed_at' => now()
        ]);
    }

    public function markAsFailed(string $error): void
    {
        $this->update([
            'status' => 'failed',
            'error_message' => $error,
            'completed_at' => now()
        ]);
    }

    public function deleteFile(): bool
    {
        $absolutePath = storage_path('app/' . $this->file_path);
        if (file_exists($absolutePath)) {
            return unlink($absolutePath);
        }
        return true;
    }

    // Boot method para eventos del modelo
    protected static function boot()
    {
        parent::boot();

        // Eliminar archivo físico cuando se elimina el registro
        static::deleting(function ($backup) {
            $backup->deleteFile();
        });
    }

    // Constantes para tipos y estados
    const TYPES = [
        'manual' => 'Manual',
        'auto' => 'Automático', 
        'scheduled' => 'Programado'
    ];

    const STATUSES = [
        'pending' => 'Pendiente',
        'in_progress' => 'En progreso',
        'completed' => 'Completado',
        'failed' => 'Fallido',
        'cancelled' => 'Cancelado'
    ];
}