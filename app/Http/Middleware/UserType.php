<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userType): Response
    {
        if(auth()->user()->type == $userType){
            return $next($request);
        }
        switch (auth()->user()->type) {
            case "1001": // user
            return redirect()->route('user.home');
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
