<?php

use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Sitemap para SEO
Route::get('/sitemap.xml', [SitemapController::class, 'index']);
