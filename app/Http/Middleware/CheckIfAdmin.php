<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // \Log::info(json_encode(get_class_methods(auth()->user())));
        if (auth()->check() &&  auth()->user()->hasAnyRole(['admin'])) {
            return $next($request);
        }
        return redirect('/dashboard');

    }
}
