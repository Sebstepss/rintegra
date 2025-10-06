<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class NotesController extends Controller
{
    /**
     * Obtener todas las notas
     */
    public function index(): JsonResponse
    {
        try {
            $notes = Note::orderBy('updated_at', 'desc')->get();
            
            return response()->json([
                'success' => true,
                'data' => $notes
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las notas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Crear nueva nota
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100',
            'is_favorite' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Datos de validación incorrectos',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $note = Note::create([
                'title' => $request->title,
                'content' => $request->content,
                'category' => $request->category,
                'is_favorite' => $request->is_favorite ?? false,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Nota creada exitosamente',
                'data' => $note
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la nota',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener nota específica
     */
    public function show($id): JsonResponse
    {
        try {
            $note = Note::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $note
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Nota no encontrada',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Actualizar nota
     */
    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100',
            'is_favorite' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Datos de validación incorrectos',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $note = Note::findOrFail($id);
            
            $note->update([
                'title' => $request->title,
                'content' => $request->content,
                'category' => $request->category,
                'is_favorite' => $request->is_favorite ?? false,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Nota actualizada exitosamente',
                'data' => $note->fresh()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la nota',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar nota
     */
    public function destroy($id): JsonResponse
    {
        try {
            $note = Note::findOrFail($id);
            $note->delete();

            return response()->json([
                'success' => true,
                'message' => 'Nota eliminada exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la nota',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Buscar notas
     */
    public function search(Request $request): JsonResponse
    {
        try {
            $query = $request->get('q', '');
            $category = $request->get('category');
            $is_favorite = $request->get('is_favorite');
            $sort_by = $request->get('sort_by', 'updated_at');
            $sort_order = $request->get('sort_order', 'desc');

            $notesQuery = Note::query();

            // Buscar en título y contenido
            if (!empty($query)) {
                $notesQuery->where(function ($q) use ($query) {
                    $q->where('title', 'LIKE', "%{$query}%")
                      ->orWhere('content', 'LIKE', "%{$query}%")
                      ->orWhere('category', 'LIKE', "%{$query}%");
                });
            }

            // Filtrar por categoría
            if (!empty($category)) {
                $notesQuery->where('category', $category);
            }

            // Filtrar por favoritas
            if ($is_favorite !== null) {
                $notesQuery->where('is_favorite', (bool) $is_favorite);
            }

            // Ordenar
            $validSortFields = ['title', 'created_at', 'updated_at', 'category'];
            if (in_array($sort_by, $validSortFields)) {
                $notesQuery->orderBy($sort_by, $sort_order);
            } else {
                $notesQuery->orderBy('updated_at', 'desc');
            }

            $notes = $notesQuery->get();

            return response()->json([
                'success' => true,
                'data' => $notes
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al buscar notas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener todas las categorías
     */
    public function getCategories(): JsonResponse
    {
        try {
            $categories = Note::whereNotNull('category')
                            ->where('category', '!=', '')
                            ->distinct()
                            ->pluck('category')
                            ->sort()
                            ->values();

            return response()->json([
                'success' => true,
                'data' => $categories
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener categorías',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}