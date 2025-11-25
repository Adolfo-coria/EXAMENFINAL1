<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * Obtener los roles que tienen este permiso
     */
    public function getRolesThatHaveThisPermission()
    {
        return \Illuminate\Support\Facades\DB::table('role_permissions')
            ->where('permission_id', $this->id)
            ->pluck('role')
            ->toArray();
    }
}
