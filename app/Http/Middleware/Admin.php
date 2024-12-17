<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next, $guard = null): Response
    {
        if(!Auth::guard('admin')->check()){
            return redirect()->route('admin.login');
        }
//        dd(Auth::guard('admin')->user());
        $request->merge(['user' => Auth::guard('admin')->user()]);
        return $next($request);
    }
}
