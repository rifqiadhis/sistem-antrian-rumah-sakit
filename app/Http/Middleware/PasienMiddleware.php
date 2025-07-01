<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PasienMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (session('auth_user_role') !== 'pasien') {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai Pasien.');
        }
        return $next($request);
    }
}