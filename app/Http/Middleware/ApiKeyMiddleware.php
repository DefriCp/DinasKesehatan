<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $providedKey = $request->header('X-API-KEY');

        if (! $providedKey) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Missing API key.',
            ], 401);
        }

        $apiKey = ApiKey::where('key', $providedKey)
            ->where('is_active', true)
            ->first();

        if (! $apiKey) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Unauthorized. Invalid API key.',
            ], 401);
        }

        return $next($request);
    }
}
