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
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Check if the user has the required role
        if ($user->role !== $role) {
            // Redirect to appropriate dashboard instead of logging out
            if ($user->isFreelancer()) {
                return redirect()->route('freelancer.dashboard');
            }

            if ($user->isAdmin()) {
                return redirect('/admin');
            }

            return redirect()->route('user.dashboard');
        }

        // If the user has the correct role, proceed to the next request
        return $next($request);
    }
}
