<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;

class PermissionHelper
{
    /**
     * Verificar si un rol tiene un permiso específico
     */
    public static function roleHasPermission(string $role, string $permissionName): bool
    {
        return DB::table('role_permissions')
            ->join('permissions', 'role_permissions.permission_id', '=', 'permissions.id')
            ->where('role_permissions.role', $role)
            ->where('permissions.name', $permissionName)
            ->exists();
    }

    /**
     * Verificar si el usuario actual tiene un permiso específico
     */
    public static function userHasPermission(string $permissionName): bool
    {
        $user = auth()->user();
        
        if (!$user) {
            return false;
        }

        return self::roleHasPermission($user->role, $permissionName);
    }

    /**
     * Obtener todos los permisos de un rol
     */
    public static function getRolePermissions(string $role): array
    {
        return DB::table('role_permissions')
            ->join('permissions', 'role_permissions.permission_id', '=', 'permissions.id')
            ->where('role_permissions.role', $role)
            ->pluck('permissions.name')
            ->toArray();
    }

    /**
     * Obtener todos los permisos del usuario actual
     */
    public static function getUserPermissions(): array
    {
        $user = auth()->user();
        
        if (!$user) {
            return [];
        }

        return self::getRolePermissions($user->role);
    }
}
