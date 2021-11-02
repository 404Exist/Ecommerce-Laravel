<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LangMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        app()->setlocale(lang());
        return $next($request);
    }
}
