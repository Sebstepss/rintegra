<?php

use App\Http\Controllers\SitemapController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Sitemap para SEO
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

// Páginas públicas SSR (catch-all al final)
Route::get('/{slug?}', [PageController::class, 'showPublic'])
    ->where('slug', '.*')
    ->name('page.show');
