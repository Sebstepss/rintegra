<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MediaController extends Controller
{
    /**
     * Mostrar lista de medios
     */
    public function index(Request $request)
    {
        $query = Media::with('uploader');

        // Filtrar por tipo
        if ($request->has('type') && $request->type) {
            $query->ofType($request->type);
        }

        // Búsqueda
        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        // Ordenar
        $sortBy = $request->get('sort_by', 'created_at');
        $sortDir = $request->get('sort_dir', 'desc');
        $query->orderBy($sortBy, $sortDir);

        $media = $query->paginate($request->get('per_page', 20));

        return response()->json($media);
    }

    /**
     * Subir nuevo medio
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240|mimes:jpeg,png,gif,webp,jpg,mp4,webm,mov,avi,mkv,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv,rtf', // Máximo 10MB
            'alt_text' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000'
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $mimeType = $file->getMimeType();
        $extension = $file->getClientOriginalExtension();
        $size = $file->getSize();

        // Generar nombre único para el archivo
        $fileName = Str::uuid() . '.' . $extension;

        // Determinar tipo de medio
        $type = Media::determineType($mimeType);

        // Crear carpeta basada en el tipo y fecha
        $folder = $type . '/' . date('Y/m');
        $path = $folder . '/' . $fileName;

        // Subir archivo
        $uploadedPath = $file->storeAs($folder, $fileName, 'public');

        if (!$uploadedPath) {
            return response()->json(['error' => 'Error al subir el archivo'], 500);
        }

        // Obtener metadatos adicionales
        $metadata = $this->extractMetadata($file, $type);

        // Crear registro en base de datos
        $media = Media::create([
            'name' => $originalName,
            'file_name' => $fileName,
            'mime_type' => $mimeType,
            'extension' => $extension,
            'size' => $size,
            'path' => $uploadedPath,
            'url' => Storage::url($uploadedPath),
            'type' => $type,
            'metadata' => $metadata,
            'uploaded_by' => auth()->id(),
            'alt_text' => $request->alt_text,
            'description' => $request->description
        ]);

        return response()->json($media->load('uploader'), 201);
    }

    /**
     * Mostrar medio específico
     */
    public function show(Media $media)
    {
        return response()->json($media->load('uploader'));
    }

    /**
     * Actualizar medio
     */
    public function update(Request $request, Media $media)
    {
        $request->validate([
            'alt_text' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000'
        ]);

        $media->update($request->only(['alt_text', 'description']));

        return response()->json($media->load('uploader'));
    }

    /**
     * Eliminar medio
     */
    public function destroy($id)
    {
        try {
            \Log::info("MediaController: Intentando eliminar media con ID: {$id}");
            
            $media = Media::find($id);
            
            if (!$media) {
                \Log::error("MediaController: Media con ID {$id} no encontrado");
                return response()->json(['error' => 'Medio no encontrado'], 404);
            }
            
            \Log::info("MediaController: Media encontrado", ['id' => $media->id, 'name' => $media->name]);
            
            // Eliminar archivo físico
            $deleteFileResult = $media->deleteFile();
            \Log::info("MediaController: deleteFile result: " . ($deleteFileResult ? 'SUCCESS' : 'FAILED'));

            // Eliminar registro de base de datos
            $deleteResult = $media->delete();
            \Log::info("MediaController: delete result: " . ($deleteResult ? 'SUCCESS' : 'FAILED'));
            
            // Verificar si realmente se eliminó
            $stillExists = Media::find($id);
            \Log::info("MediaController: Media still exists: " . ($stillExists ? 'YES' : 'NO'));

            return response()->json(['message' => 'Medio eliminado correctamente']);
        } catch (\Exception $e) {
            \Log::error("MediaController: Error eliminando media: " . $e->getMessage());
            return response()->json(['error' => 'Error al eliminar medio: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Subida múltiple de archivos
     */
    public function bulkUpload(Request $request)
    {
        $request->validate([
            'files' => 'required|array|max:10',
            'files.*' => 'required|file|max:10240|mimes:jpeg,png,gif,webp,jpg,mp4,webm,mov,avi,mkv,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv,rtf'
        ]);

        $uploadedMedia = [];
        $errors = [];

        foreach ($request->file('files') as $index => $file) {
            try {
                $originalName = $file->getClientOriginalName();
                $mimeType = $file->getMimeType();
                $extension = $file->getClientOriginalExtension();
                $size = $file->getSize();

                $fileName = Str::uuid() . '.' . $extension;
                $type = Media::determineType($mimeType);
                $folder = $type . '/' . date('Y/m');
                $path = $folder . '/' . $fileName;

                $uploadedPath = $file->storeAs($folder, $fileName, 'public');

                if ($uploadedPath) {
                    $metadata = $this->extractMetadata($file, $type);

                    $media = Media::create([
                        'name' => $originalName,
                        'file_name' => $fileName,
                        'mime_type' => $mimeType,
                        'extension' => $extension,
                        'size' => $size,
                        'path' => $uploadedPath,
                        'url' => Storage::url($uploadedPath),
                        'type' => $type,
                        'metadata' => $metadata,
                        'uploaded_by' => auth()->id()
                    ]);

                    $uploadedMedia[] = $media;
                } else {
                    $errors[] = "Error subiendo {$originalName}";
                }
            } catch (\Exception $e) {
                $errors[] = "Error procesando {$file->getClientOriginalName()}: " . $e->getMessage();
            }
        }

        return response()->json([
            'uploaded' => $uploadedMedia,
            'errors' => $errors,
            'total_uploaded' => count($uploadedMedia),
            'total_errors' => count($errors)
        ]);
    }

    /**
     * Extraer metadatos del archivo
     */
    private function extractMetadata($file, $type)
    {
        $metadata = [];

        if ($type === 'image') {
            try {
                $imagePath = $file->getPathname();
                $imageInfo = getimagesize($imagePath);
                
                if ($imageInfo) {
                    $metadata['width'] = $imageInfo[0];
                    $metadata['height'] = $imageInfo[1];
                    $metadata['channels'] = $imageInfo['channels'] ?? null;
                    $metadata['bits'] = $imageInfo['bits'] ?? null;
                }
            } catch (\Exception $e) {
                // Ignorar errores de extracción de metadatos
            }
        }

        return $metadata;
    }

    /**
     * Obtener estadísticas de medios
     */
    public function stats()
    {
        $stats = [
            'total' => Media::count(),
            'by_type' => [
                'image' => Media::ofType('image')->count(),
                'video' => Media::ofType('video')->count(),
                'document' => Media::ofType('document')->count(),
                'other' => Media::ofType('other')->count()
            ],
            'total_size' => Media::sum('size'),
            'recent_uploads' => Media::where('created_at', '>=', now()->subDays(7))->count()
        ];

        return response()->json($stats);
    }
} 