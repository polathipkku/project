<?php

// app/Http/Middleware/OwnerMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class OwnerMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->userType === '0') {
            return $next($request);
        }

        return redirect('/');

    }
    public function check(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->user_type !== '0') {
            return redirect()->route('home')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้');
        }
        return $next($request);
    }
}

