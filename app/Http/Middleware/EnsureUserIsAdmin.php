<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Bersihkan format kata dari database
        $role = strtolower(trim(Auth::user()->role));
        
        if ($role !== 'admin') {
            return redirect('/'); 
        }

        return $next($request);
    }
}