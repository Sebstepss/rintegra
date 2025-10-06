<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiteConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        'config_type',
        'config_data',
        'version',
        'is_active',
        'description'
    ];

    protected $casts = [
        'config_data' => 'array',
        'is_active' => 'boolean'
    ];

    /**
     * Obtener la configuración activa por tipo
     */
    public static function getActiveConfig($type)
    {
        return static::where('config_type', $type)
                    ->where('is_active', true)
                    ->first();
    }

    /**
     * Crear nueva configuración y desactivar las anteriores
     */
    public static function createNewConfig($type, $data, $description = null)
    {
        // Desactivar configuraciones anteriores del mismo tipo
        static::where('config_type', $type)
              ->where('is_active', true)
              ->update(['is_active' => false]);

        // Obtener siguiente número de versión
        $latestVersion = static::where('config_type', $type)
                              ->max('version') ?? 0;

        // Crear nueva configuración
        return static::create([
            'config_type' => $type,
            'config_data' => $data,
            'version' => $latestVersion + 1,
            'is_active' => true,
            'description' => $description
        ]);
    }

    /**
     * Obtener todas las versiones de un tipo
     */
    public static function getVersions($type)
    {
        return static::where('config_type', $type)
                    ->orderBy('version', 'desc')
                    ->get();
    }

    /**
     * Activar una versión específica
     */
    public static function activateVersion($type, $version)
    {
        // Desactivar todas las versiones del tipo
        static::where('config_type', $type)
              ->update(['is_active' => false]);

        // Activar la versión específica
        return static::where('config_type', $type)
                    ->where('version', $version)
                    ->update(['is_active' => true]);
    }

    /**
     * Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('config_type', $type);
    }
}
