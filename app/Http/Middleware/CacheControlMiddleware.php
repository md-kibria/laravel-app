<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheControlMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next) : Response
    // {
    //     // Check if the request is for a static asset
    //     if ($this->isStaticAsset($request->path())) {
    //         // Set Cache-Control header for static assets
    //         return response()->file(public_path($request->path()), [
    //             'Cache-Control' => 'public, max-age=31536000, immutable',
    //         ]);
    //     }

        // Proceed with the request
    {
        $response = $next($request);    

        // Check if this is a static asset
        if ($this->isStaticAsset($request->path())) {
            $response->header('Cache-Control', 'public, max-age=31536000, immutable');
        }

        return $response;
    }

    private function isStaticAsset($path)
    {
        // First check if it's a Livewire asset - these need different caching rules
    if (preg_match('/livewire\/.*\.(js|css)$/', $path)) {
        return false;
    }
    
    // Then check if it's a normal static asset
    return preg_match('/\.(css|js|jpg|jpeg|png|gif|ico|svg|woff|woff2|ttf|otf|pdf)$/', $path);
    }
}
