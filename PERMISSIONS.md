# Sistema de Permisos y Roles - Documentación

## Resumen
Se ha implementado un sistema granular de permisos y roles para la clínica odontológica "Sonrisa Feliz". El sistema permite asignar permisos específicos a cada rol (admin, dentist, patient, etc.) y validar acceso a recursos.

## Tablas de Base de Datos

### `permissions`
- `id`: Clave primaria
- `name`: Nombre único del permiso (ej: `dentist.view_appointments`)
- `description`: Descripción del permiso
- `created_at`, `updated_at`: Timestamps

### `role_permissions`
- `id`: Clave primaria
- `role`: Rol (admin, dentist, patient, etc.)
- `permission_id`: FK a tabla permissions
- `created_at`, `updated_at`: Timestamps
- **Restricción**: Combinación única (role, permission_id)

## Permisos Implementados

### Para Odontólogo (dentist)
- `dentist.view_appointments` - Ver citas
- `dentist.create_appointments` - Crear citas
- `dentist.edit_appointments` - Editar citas
- `dentist.view_patients` - Ver pacientes
- `dentist.view_diagnostics` - Ver diagnósticos
- `dentist.create_diagnostics` - Crear diagnósticos
- `dentist.view_treatments` - Ver tratamientos
- `dentist.create_treatments` - Crear tratamientos
- `dentist.view_recipes` - Ver recetas
- `dentist.create_recipes` - Crear recetas
- `dentist.view_checkups` - Ver controles
- `dentist.create_checkups` - Crear controles
- `dentist.view_payments` - Ver pagos

### Para Admin
- `admin.view_users` - Ver usuarios
- `admin.manage_users` - Gestionar usuarios
- `admin.view_appointments` - Ver todas las citas
- `admin.view_payments` - Ver todos los pagos

### Para Paciente (patient)
- `patient.view_own_appointments` - Ver propias citas
- `patient.book_appointment` - Reservar cita

## Componentes Creados

### 1. Modelo `Permission` (`app/Models/Permission.php`)
```php
class Permission extends Model {
    protected $fillable = ['name', 'description'];
}
```

### 2. Middleware `EnsurePermission` (`app/Http/Middleware/EnsurePermission.php`)
Valida que el usuario tenga un permiso específico antes de acceder a una ruta.

**Uso en rutas:**
```php
Route::get('/diagnosticos', [...])
    ->middleware('EnsurePermission:dentist.view_diagnostics');
```

### 3. Helper `PermissionHelper` (`app/Support/PermissionHelper.php`)
Proporciona métodos útiles para verificar permisos:
- `roleHasPermission(string $role, string $permissionName): bool`
- `userHasPermission(string $permissionName): bool`
- `getRolePermissions(string $role): array`
- `getUserPermissions(): array`

### 4. Blade Directives (en `AppServiceProvider.php`)
Se registraron dos directives para usar en vistas:
- `@permission('permission.name')` - Ejecutar bloque si usuario tiene permiso
- `@roleHasPermission('role', 'permission.name')` - Ejecutar bloque si rol tiene permiso

## Rutas Protegidas del Odontólogo

Todas las siguientes rutas están protegidas por:
1. Middleware `auth` - Verificar autenticación
2. Middleware `EnsureUserRole:dentist` - Verificar que es odontólogo
3. Middleware `EnsurePermission:permission_name` - Verificar permiso específico

```
GET /odontologo/dashboard                    → Ver dashboard
GET /odontologo/historial                    → Ver citas (requiere: dentist.view_appointments)
GET /odontologo/diagnosticos                 → Ver diagnósticos (requiere: dentist.view_diagnostics)
GET /odontologo/tratamientos                 → Ver tratamientos (requiere: dentist.view_treatments)
GET /odontologo/recetas                      → Ver recetas (requiere: dentist.view_recipes)
GET /odontologo/controles                    → Ver controles (requiere: dentist.view_checkups)
```

## Ejemplo de Uso en Vistas

### Mostrar contenido solo si usuario tiene permiso
```blade
@permission('dentist.create_appointments')
    <a href="{{ route('appointments.create') }}" class="btn btn-primary">
        Nueva Cita
    </a>
@endpermission
```

### Mostrar contenido solo si rol tiene permiso
```blade
@roleHasPermission('dentist', 'dentist.view_payments')
    <section class="payments">
        {{-- Contenido de pagos --}}
    </section>
@endroleHasPermission
```

## Ejemplo de Uso en Controladores

```php
use App\Support\PermissionHelper;

class OdontologoController extends Controller {
    public function diagnosticos() {
        if (!PermissionHelper::userHasPermission('dentist.view_diagnostics')) {
            abort(403, 'No tienes permiso');
        }
        
        // Proceder...
    }
}
```

## Archivos Modificados/Creados

| Archivo | Tipo | Descripción |
|---------|------|-------------|
| `database/migrations/2025_11_11_150000_create_permissions_table.php` | Migración | Crea tablas permissions y role_permissions |
| `database/seeders/PermissionSeeder.php` | Seeder | Puebla permisos y asignaciones de roles |
| `app/Models/Permission.php` | Modelo | Modelo para la tabla permissions |
| `app/Http/Middleware/EnsurePermission.php` | Middleware | Valida permisos en rutas |
| `app/Support/PermissionHelper.php` | Helper | Funciones auxiliares para permisos |
| `app/Providers/AppServiceProvider.php` | Provider | Registra Blade directives |
| `bootstrap/app.php` | Config | Registra middlewares |
| `routes/web.php` | Rutas | Aplica middleware de permisos a rutas |

## Comandos Ejecutados

```bash
# Migrar la base de datos
php artisan migrate --step

# Poblar permisos
php artisan db:seed --class=PermissionSeeder

# Limpiar caches
php artisan config:clear
php artisan view:clear
php artisan cache:clear
```

## Cómo Agregar un Nuevo Permiso

1. Editar `PermissionSeeder.php`
2. Agregar entrada en el array `$permissions`
3. Asignar a los roles correspondientes
4. Ejecutar:
   ```bash
   php artisan db:seed --class=PermissionSeeder --fresh
   ```

## Cómo Revocar un Permiso a un Rol

```php
use Illuminate\Support\Facades\DB;

DB::table('role_permissions')
    ->where('role', 'dentist')
    ->where('permission_id', function($query) {
        $query->select('id')->from('permissions')->where('name', 'dentist.view_payments');
    })
    ->delete();
```

## Seguridad

- Los permisos se validan en **cada solicitud** a través del middleware
- Los usuarios no pueden bypassear permisos accediendo directamente a URLs
- El sistema es extensible para agregar permisos dinámicos
- Las transacciones de base de datos garantizan integridad referencial

## Estado Actual

✅ Sistema de permisos implementado
✅ Middleware de validación activo
✅ Rutas del odontólogo protegidas
✅ Blade directives registradas
✅ Helper class disponible
✅ Base de datos migrada y poblada con datos de prueba
