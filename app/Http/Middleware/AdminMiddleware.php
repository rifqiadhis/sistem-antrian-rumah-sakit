<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (session('auth_user_role') !== 'admin') {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai Admin.');
        }
        return $next($request);
    }
}