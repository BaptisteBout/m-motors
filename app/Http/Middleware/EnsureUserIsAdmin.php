<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Utilisation de Auth::check() recommandé plutôt que l'helper global
        // 2. Vérification du rôle 'admin'
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            
            // Si c'est une requête AJAX ou API, on renvoie du JSON plutôt qu'un abort HTML
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Accès réservé aux administrateurs.'], 403);
            }

            abort(403, 'Accès réservé aux administrateurs.');
        }

        return $next($request);
    }
}