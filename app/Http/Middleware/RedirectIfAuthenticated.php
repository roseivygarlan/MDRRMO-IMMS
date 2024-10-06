<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                
                switch (auth()->user()->role) {
                    case "1001": // user
                    return redirect(route('user.home'));
                    break;
                    case "1111": // admin
                    return redirect()->route('admin.home');
                    break;
                    case "1010": // barangay
                    return redirect()->route('barangay.home');
                    break;
                }
            }
        }

        return $next($request);
    }
}
