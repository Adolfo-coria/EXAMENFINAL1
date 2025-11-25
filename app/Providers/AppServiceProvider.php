<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Support\PermissionHelper;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Registrar directives de Blade para permisos
        Blade::if('permission', function ($permission) {
            return PermissionHelper::userHasPermission($permission);
        });

        Blade::if('roleHasPermission', function ($role, $permission) {
            return PermissionHelper::roleHasPermission($role, $permission);
        });
    }
}
