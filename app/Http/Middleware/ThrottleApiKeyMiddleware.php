<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\RateLimiter;
class ThrottleApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, int $maxAttempts, int $perMinutes): Response
    {
        $apiKey = $request->query('api_key');
        if (RateLimiter::tooManyAttempts($apiKey, $maxAttempts)) {
            return response()->json(['message' => 'Too many requests'], Response::HTTP_TOO_MANY_REQUESTS);
        }

        RateLimiter::hit($apiKey, $perMinutes * 60);

        return $next($request);
    }
}
