<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GzipMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        // Only compress text-based responses
        if (!$response instanceof Response || 
            !$this->shouldCompress($request, $response)) {
            return $response;
        }
        
        // Set Vary header
        $response->setVary('Accept-Encoding');
        
        // Check if client accepts gzip
        if (strpos($request->header('Accept-Encoding'), 'gzip') !== false) {
            $content = $response->getContent();
            $compressed = gzencode($content, 9);
            
            return response($compressed)
                ->withHeaders([
                    'Content-Encoding' => 'gzip',
                    'Content-Length' => strlen($compressed),
                    'Content-Type' => $response->headers->get('Content-Type'),
                ]);
        }
        
        return $response;
    }

    protected function shouldCompress($request, $response): bool
    {
        $contentType = $response->headers->get('Content-Type');
        
        return $response->getStatusCode() === 200
            && is_string($response->getContent())
            && strpos($contentType, 'text/html') !== false
            && !$response->headers->has('Content-Encoding')
            && !$request->isXmlHttpRequest();
    }
}
