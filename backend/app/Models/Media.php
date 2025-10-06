<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file_name',
        'mime_type',
        'extension',
        'size',
        'path',
        'url',
        'type',
        'metadata',
        'uploaded_by',
        'alt_text',
        'description'
    ];

    protected $casts = [
        'metadata' => 'array',
        'size' => 'integer'
    ];

    /**
     * Relación con el usuario que subió el archivo
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Determinar el tipo de medio basado en el MIME type
     */
    public static function determineType($mimeType)
    {
        if (str_starts_with($mimeType, 'image/')) {
            return 'image';
        }
        
        if (str_starts_with($mimeType, 'video/')) {
            return 'video';
        }
        
        $documentTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'text/plain',
            'text/csv',
            'application/rtf'
        ];
        
        if (in_array($mimeType, $documentTypes)) {
            return 'document';
        }
        
        return 'other';
    }

    /**
     * Obtener la URL completa del archivo
     */
    public function getFullUrlAttribute()
    {
        if (filter_var($this->url, FILTER_VALIDATE_URL)) {
            return $this->url;
        }
        
        return url($this->url);
    }

    /**
     * Obtener el tamaño formateado
     */
    public function getFormattedSizeAttribute()
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Verificar si el archivo existe físicamente
     */
    public function fileExists()
    {
        if (is_null($this->path) || empty($this->path)) {
            return false;
        }
        
        return Storage::disk('public')->exists($this->path);
    }

    /**
     * Eliminar el archivo físico del servidor
     */
    public function deleteFile()
    {
        // Si no hay ruta definida, no intentar eliminar archivo físico
        if (is_null($this->path) || empty($this->path)) {
            return true; // Consideramos exitoso si no hay archivo que eliminar
        }
        
        if ($this->fileExists()) {
            return Storage::disk('public')->delete($this->path);
        }
        
        // El archivo no existe físicamente, pero eso no es un error
        return true;
    }

    /**
     * Scope para filtrar por tipo
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope para buscar por nombre
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('alt_text', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    /**
     * Obtener metadatos de imagen si es una imagen
     */
    public function getImageDimensions()
    {
        if ($this->type === 'image' && isset($this->metadata['width']) && isset($this->metadata['height'])) {
            return [
                'width' => $this->metadata['width'],
                'height' => $this->metadata['height']
            ];
        }
        
        return null;
    }
}