<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UnderConstructionMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            return $next($request);
        }

        $underConstruction = (bool) Setting::get('under_construction', false);

        if (!$underConstruction) {
            return $next($request);
        }

        if ($request->routeIs('login') || $request->routeIs('login.store')) {
            return $next($request);
        }

        return response()->view('under-construction');
    }
}
