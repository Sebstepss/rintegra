<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  int  $ttl  Cache time in seconds (default 3600 = 1 hour)
     */
    public function handle(Request $request, Closure $next, int $ttl = 3600): Response
    {
        $response = $next($request);

        // Solo cachear respuestas exitosas GET
        if ($request->isMethod('GET') && $response->isSuccessful()) {
            $response->header('Cache-Control', "public, max-age={$ttl}");
            $response->header('Expires', now()->addSeconds($ttl)->toRfc7231String());
        }

        return $response;
    }
}
