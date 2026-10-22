<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (session('user_logged_in')) {
            return $next($request);
        }

        return redirect('/login')->with('error', 'Войдите в свой профиль!');
    }
}