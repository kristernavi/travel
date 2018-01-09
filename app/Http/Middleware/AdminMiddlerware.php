<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminMiddlerware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ('admin' != Auth::id()) {
            Auth::logout();
            abort(403);

            return;
        }

        return $next($request);
    }
}
