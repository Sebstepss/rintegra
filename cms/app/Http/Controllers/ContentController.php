<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

class ContentController extends Controller
{
    /**
     * Limpiar caché cuando se modifican contenidos de páginas publicadas
     */
    private function clearPublicCache($pageId)
    {
        // Verificar si la página está publicada
        $page = Page::find($pageId);

        if ($page && $page->status === 'published') {
            Cache::flush();
            Artisan::call('route:clear');
            Artisan::call('config:clear');
        }
    }
    public function index()
    {
        return Content::with('page')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'page_id' => 'required|exists:pages,id',
            'content_type' => 'required|string',
            'content_data' => 'required|array',
            'order' => 'integer'
        ]);

        $content = Content::create($request->all());

        // Limpiar caché si la página está publicada
        $this->clearPublicCache($content->page_id);

        return response()->json($content, 201);
    }

    public function show(Content $content)
    {
        return $content->load('page');
    }

    public function update(Request $request, Content $content)
    {
        $request->validate([
            'page_id' => 'required|exists:pages,id',
            'content_type' => 'required|string',
            'content_data' => 'required|array',
            'order' => 'integer'
        ]);

        $content->update($request->all());

        // Limpiar caché si la página está publicada
        $this->clearPublicCache($content->page_id);

        return $content;
    }

    public function destroy(Content $content)
    {
        $pageId = $content->page_id;

        $content->delete();

        // Limpiar caché si la página está publicada
        $this->clearPublicCache($pageId);

        return response()->json(null, 204);
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'contents' => 'required|array',
            'contents.*.id' => 'required|exists:contents,id',
            'contents.*.order' => 'required|integer'
        ]);

        $pageIds = [];

        foreach ($request->contents as $contentData) {
            $content = Content::find($contentData['id']);
            if ($content) {
                $pageIds[] = $content->page_id;
                $content->update(['order' => $contentData['order']]);
            }
        }

        // Limpiar caché de todas las páginas afectadas
        foreach (array_unique($pageIds) as $pageId) {
            $this->clearPublicCache($pageId);
        }

        return response()->json(['message' => 'Order updated successfully']);
    }
}