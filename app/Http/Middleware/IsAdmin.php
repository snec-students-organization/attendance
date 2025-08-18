<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle($request, Closure $next)
{
    if (auth()->check()) {
        $user = auth()->user();
        // Check email and is_admin flag
        if ($user->is_admin && $user->email === 'admin@example.com') {
            return $next($request);
        }
    }
    abort(403, 'Unauthorized');
}

}
