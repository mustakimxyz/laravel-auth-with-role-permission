<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckIfCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $user = Auth::user();
        \Log::info($user);
        if ($user->hasRole('customer')) {
            \Log::info("IS CUSTOMER");
            // return redirect(RouteServiceProvider::HOME);
        }
        return $next($request);
    }
}
