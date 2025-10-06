<?php

namespace App\Http\Controllers;

use App\Models\SiteConfiguration;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class ConfigurationController extends Controller
{
    /**
     * Obtener configuración activa por tipo
     */
    public function getActiveConfig($type): JsonResponse
    {
        try {
            $validTypes = ['globals', 'header', 'footer', 'site', 'seo'];
            
            if (!in_array($type, $validTypes)) {
                return response()->json([
                    'error' => 'Tipo de configuración no válido'
                ], 400);
            }

            $config = SiteConfiguration::getActiveConfig($type);

            if (!$config) {
                return response()->json([
                    'data' => null,
                    'message' => 'No hay configuración activa para este tipo'
                ], 200);
            }

            return response()->json([
                'data' => [
                    'id' => $config->id,
                    'config_type' => $config->config_type,
                    'config_data' => $config->config_data,
                    'version' => $config->version,
                    'description' => $config->description,
                    'updated_at' => $config->updated_at
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener configuración',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Guardar nueva configuración
     */
    public function saveConfig(Request $request, $type): JsonResponse
    {
        try {
            $validTypes = ['globals', 'header', 'footer', 'site', 'seo'];
            
            if (!in_array($type, $validTypes)) {
                return response()->json([
                    'error' => 'Tipo de configuración no válido'
                ], 400);
            }

            $request->validate([
                'config_data' => 'required|array',
                'description' => 'nullable|string|max:500'
            ]);

            $config = SiteConfiguration::createNewConfig(
                $type,
                $request->config_data,
                $request->description
            );

            return response()->json([
                'data' => [
                    'id' => $config->id,
                    'config_type' => $config->config_type,
                    'config_data' => $config->config_data,
                    'version' => $config->version,
                    'description' => $config->description,
                    'created_at' => $config->created_at
                ],
                'message' => 'Configuración guardada exitosamente'
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al guardar configuración',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener todas las versiones de un tipo
     */
    public function getVersions($type): JsonResponse
    {
        try {
            $validTypes = ['globals', 'header', 'footer', 'site', 'seo'];
            
            if (!in_array($type, $validTypes)) {
                return response()->json([
                    'error' => 'Tipo de configuración no válido'
                ], 400);
            }

            $versions = SiteConfiguration::getVersions($type);

            return response()->json([
                'data' => $versions->map(function ($config) {
                    return [
                        'id' => $config->id,
                        'version' => $config->version,
                        'description' => $config->description,
                        'is_active' => $config->is_active,
                        'created_at' => $config->created_at,
                        'updated_at' => $config->updated_at
                    ];
                })
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener versiones',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Activar una versión específica
     */
    public function activateVersion(Request $request, $type): JsonResponse
    {
        try {
            $validTypes = ['globals', 'header', 'footer', 'site', 'seo'];
            
            if (!in_array($type, $validTypes)) {
                return response()->json([
                    'error' => 'Tipo de configuración no válido'
                ], 400);
            }

            $request->validate([
                'version' => 'required|integer|min:1'
            ]);

            $activated = SiteConfiguration::activateVersion($type, $request->version);

            if (!$activated) {
                return response()->json([
                    'error' => 'No se pudo activar la versión especificada'
                ], 404);
            }

            return response()->json([
                'message' => "Versión {$request->version} activada exitosamente"
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al activar versión',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener configuración específica por ID
     */
    public function getConfigById($id): JsonResponse
    {
        try {
            $config = SiteConfiguration::find($id);

            if (!$config) {
                return response()->json([
                    'error' => 'Configuración no encontrada'
                ], 404);
            }

            return response()->json([
                'data' => [
                    'id' => $config->id,
                    'config_type' => $config->config_type,
                    'config_data' => $config->config_data,
                    'version' => $config->version,
                    'is_active' => $config->is_active,
                    'description' => $config->description,
                    'created_at' => $config->created_at,
                    'updated_at' => $config->updated_at
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener configuración',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar una configuración específica
     */
    public function deleteConfig($id): JsonResponse
    {
        try {
            $config = SiteConfiguration::find($id);

            if (!$config) {
                return response()->json([
                    'error' => 'Configuración no encontrada'
                ], 404);
            }

            // No permitir eliminar la configuración activa
            if ($config->is_active) {
                return response()->json([
                    'error' => 'No se puede eliminar la configuración activa'
                ], 400);
            }

            $config->delete();

            return response()->json([
                'message' => 'Configuración eliminada exitosamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al eliminar configuración',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}