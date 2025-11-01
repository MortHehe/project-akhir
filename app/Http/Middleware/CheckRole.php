<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        if ($user->role !== $role) {
            if ($user->isAdmin()) {
                return redirect('/admin')->with('error', 'Access denied.');
            }
            return redirect()->route('user.dashboard')->with('error', 'Access denied.');
        }

        return $next($request);
    }
}