<?php

// app/Http/Middleware/OwnerMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OwnerMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->userType === '0') {
            return $next($request);
        }

        return redirect('/');
    }
}

