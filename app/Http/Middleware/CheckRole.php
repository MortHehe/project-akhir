<?php

namespace App\Http\Middleware;

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
            // Log the user out and clear the session
            Auth::logout(); // Logs the user out
            session()->flush(); // Clears all session data
            
            // Redirect with a 403 error
            abort(403, 'Access denied. You do not have the required permissions.');
        }

        // If the user has the correct role, proceed to the next request
        return $next($request);
    }
}
