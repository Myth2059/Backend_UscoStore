<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = $request->header('X-User-Id');
        $user = User::find($userId);

        if (!$user || $user->rol !== "Administrador") {
            return response("Acceso denegado",403);
        }

        return $next($request);
    
    }

    // public function handleAdmin(Request $request, Closure $next)
    // {
    //     $userId = $request->header('X-User-Id');
    //     $user = User::find($userId);

    //     if (!$user || $user->rol !== "Administrador") {
    //         return response("Acceso denegado",403);
    //     }

    //     return $next($request);
    // }

    // public function handleUpdate(Request $request, Closure $next)
    // {
    //     $userId = $request->header('X-User-Id');
    //     $user = User::find($userId);

    //     if (!$user || $user->rol !== "Administrador" || $user->rol !== "Propietario") {
    //         return response("Acceso denegado",403);
    //     }

    //     return $next($request);
    // }
}
