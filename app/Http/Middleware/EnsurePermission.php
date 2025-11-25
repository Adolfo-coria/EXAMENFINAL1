<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class EnsurePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        // Verificar que el usuario está autenticado
        if (!$request->user()) {
            return response('Unauthorized', 401);
        }

        // Obtener el rol del usuario
        $userRole = $request->user()->role;

        // Verificar si el rol tiene el permiso
        $hasPermission = DB::table('role_permissions')
            ->join('permissions', 'role_permissions.permission_id', '=', 'permissions.id')
            ->where('role_permissions.role', $userRole)
            ->where('permissions.name', $permission)
            ->exists();

        if (!$hasPermission) {
            abort(403, 'No tienes permiso para acceder a este recurso.');
        }

        return $next($request);
    }
}
