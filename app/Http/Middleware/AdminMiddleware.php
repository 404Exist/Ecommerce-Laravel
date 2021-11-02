<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{

    public function handle(Request $request, Closure $next = null, $guard = null)
    {

        if (!Auth::guard($guard)->check()) {
            return redirect(admin_url('login'))->with(['url.intended' => $request->url()]);
        }
        return $next($request);
    }
}
