<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

class PageController extends Controller
{
    /**
     * Limpiar caché cuando se modifican páginas públicas
     */
    private function clearPublicCache()
    {
        // Limpiar caché de Laravel
        Cache::flush();

        // Limpiar caché de rutas y config para refrescar middleware
        Artisan::call('route:clear');
        Artisan::call('config:clear');
    }
    public function index()
    {
        return Page::with(['contents', 'parent', 'children'])
                   ->ordered()
                   ->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:pages',
            'meta_description' => 'nullable|string',
            'status' => 'in:draft,published',
            'featured' => 'boolean',
            'is_main_page' => 'boolean',
            'sort_order' => 'integer',
            'parent_id' => 'nullable|exists:pages,id'
        ]);

        // Auto-assign sort order if not provided
        $data = $request->all();
        if (!isset($data['sort_order'])) {
            $lastOrder = Page::where('parent_id', $data['parent_id'] ?? null)->max('sort_order');
            $data['sort_order'] = ($lastOrder ?? -1) + 1;
        }

        $page = Page::create($data);

        // Limpiar caché si es página publicada
        if ($page->status === 'published') {
            $this->clearPublicCache();
        }

        return response()->json($page->load(['parent', 'children']), 201);
    }

    public function show($slug)
    {
        $page = Page::with(['contents', 'parent', 'publishedChildren'])
                   ->where('slug', $slug)
                   ->firstOrFail();
        return $page;
    }

    public function getById($id)
    {
        $page = Page::with(['contents', 'parent', 'children'])->findOrFail($id);
        return $page;
    }

    public function update(Request $request, Page $page)
    {
        $rules = [
            'meta_description' => 'nullable|string',
            'status' => 'in:draft,published',
            'featured' => 'boolean',
            'is_main_page' => 'boolean',
            'sort_order' => 'integer',
            'parent_id' => 'nullable|exists:pages,id'
        ];

        // Validar solo si se están enviando estos campos
        if ($request->has('title')) {
            $rules['title'] = 'required|string|max:255';
        }
        
        if ($request->has('slug')) {
            $rules['slug'] = 'required|string|unique:pages,slug,' . $page->id;
        }

        // Validar pagecontent si se envía
        if ($request->has('pagecontent')) {
            $rules['pagecontent'] = 'nullable|array';
        }

        // Validar que no se pueda ser padre de sí mismo
        if ($request->has('parent_id') && $request->parent_id == $page->id) {
            return response()->json(['error' => 'Una página no puede ser su propio padre'], 422);
        }

        $request->validate($rules);

        // Guardar estado anterior para saber si cambió a publicado
        $wasPublished = $page->status === 'published';

        $page->update($request->all());

        // Limpiar caché si:
        // - La página ahora está publicada (nueva o actualizada)
        // - O antes estaba publicada (para refrescar cambios)
        if ($page->status === 'published' || $wasPublished) {
            $this->clearPublicCache();
        }

        return $page->load(['parent', 'children']);
    }

    public function destroy(Page $page)
    {
        $wasPublished = $page->status === 'published';

        $page->delete();

        // Limpiar caché si la página eliminada estaba publicada
        if ($wasPublished) {
            $this->clearPublicCache();
        }

        return response()->json(null, 204);
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'pages' => 'required|array',
            'pages.*.id' => 'required|exists:pages,id',
            'pages.*.sort_order' => 'required|integer'
        ]);

        foreach ($request->pages as $pageData) {
            Page::where('id', $pageData['id'])
                ->update(['sort_order' => $pageData['sort_order']]);
        }

        return response()->json(['message' => 'Orden actualizado correctamente']);
    }

    // Get pages for navigation (published main pages with children)
    public function getNavigation()
    {
        return Page::published()
                   ->mainPages()
                   ->with('publishedChildren')
                   ->ordered()
                   ->get();
    }

    // Get all main pages for parent selection
    public function getMainPages()
    {
        return Page::mainPages()
                   ->ordered()
                   ->get(['id', 'title']);
    }

    // Get homepage (first main page marked as homepage or first published main page)
    public function getHomepage()
    {
        // Primero buscar páginas marcadas como página principal
        $homepage = Page::published()
                       ->where('is_main_page', true)
                       ->with(['contents', 'publishedChildren'])
                       ->ordered()
                       ->first();

        // Si no hay páginas marcadas como principales, tomar la primera página publicada sin padre
        if (!$homepage) {
            $homepage = Page::published()
                           ->mainPages()
                           ->with(['contents', 'publishedChildren'])
                           ->ordered()
                           ->first();
        }

        return $homepage;
    }
    /**
     * Mostrar página pública (SSR con Blade)
     */
    public function showPublic($slug = 'inicio')
    {
        $page = Page::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('pages.show', compact('page'));
    }
}
