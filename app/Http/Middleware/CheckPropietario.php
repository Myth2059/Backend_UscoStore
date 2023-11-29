<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPropietario
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
        //   return response($user);
      
            # code...
            
        if (!$user || $user->rol != "Administrador" ) {
           //return response("estoy aca");
            if (!$user||$user->rol != "Propietario") {
                //return response("estoy aca 2");
                return response("Acceso denegado",403);
            }
           
        }
    
        return $next($request);
    
    }
}
