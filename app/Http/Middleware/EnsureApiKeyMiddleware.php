<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->query('api_key');
        if (!$apiKey) {
            return response()->json(['message' => 'You need to provide `api_key` query'], Response::HTTP_UNAUTHORIZED);
        }

        $dbKey = ApiKey::where('key', $apiKey)->first();
        if (!$dbKey) {
            return response()->json(['message' => 'Invalid `api_key` query'], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
