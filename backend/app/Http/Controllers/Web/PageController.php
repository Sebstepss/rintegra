<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\SiteConfiguration;

class PageController extends Controller
{
    public function home()
    {
        $page = Page::where('is_main_page', true)
            ->with('contents')
            ->first();
            
        if (!$page) {
            abort(404, 'Página principal no configurada');
        }
        
        $siteConfig = SiteConfiguration::first();
        
        return view('pages.show', compact('page', 'siteConfig'));
    }
    
    public function show($slug)
    {
        $page = Page::where('slug', $slug)
            ->with('contents')
            ->firstOrFail();
            
        $siteConfig = SiteConfiguration::first();
        
        return view('pages.show', compact('page', 'siteConfig'));
    }
}