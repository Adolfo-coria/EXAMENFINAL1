# 🧪 Guía de Prueba - Sistema de Permisos

## Preparación

### Acceder a la Aplicación
```
URL: http://127.0.0.1:8000
```

### Credenciales de Prueba

#### 👨‍⚕️ Odontólogo (Dentist)
- **Nombre/Email/CI**: carlos@local.test
- **Contraseña**: dentist1234
- **Rol**: dentist
- **Permisos**: 13 permisos de odontólogo

---

## 📋 Casos de Prueba

### Test 1: Acceso a Dashboard Odontólogo
**Objetivo**: Verificar que un odontólogo puede acceder a su dashboard

1. Ir a `http://127.0.0.1:8000/login`
2. Ingresa las credenciales de odontólogo
3. **Resultado esperado**: 
   - Redirige a `http://127.0.0.1:8000/odontologo/dashboard`
   - Muestra panel con tarjetas de acceso rápido
   - Muestra sección "🔐 Permisos del Usuario" con 13 permisos listados (si DEBUG=true)

### Test 2: Ver Sección de Citas
**Objetivo**: Verificar que el odontólogo puede acceder a historial de citas

1. Desde el dashboard, haz clic en tarjeta "Citas" O ve a `http://127.0.0.1:8000/odontologo/historial`
2. **Resultado esperado**: 
   - Carga la página de historial
   - Página extiende layout `layouts.odontologo`
   - Sin error 403

### Test 3: Protección de Ruta sin Permiso
**Objetivo**: Verificar que sistema de permisos protege correctamente

1. Abre la consola de desarrollo (F12)
2. Ejecuta en consola:
```javascript
// Intenta acceder directamente sin autenticación
window.location = 'http://127.0.0.1:8000/odontologo/diagnosticos';
```
3. **Resultado esperado**: 
   - Redirige a página de login (no autenticado)
   
Luego, autenticarse como odontólogo:
4. Luego ir a `http://127.0.0.1:8000/odontologo/diagnosticos`
5. **Resultado esperado**: 
   - Carga correctamente la página de diagnósticos

### Test 4: Ver Permisos Asignados
**Objetivo**: Verificar que el dashboard muestra los permisos asignados

1. Estar autenticado como odontólogo
2. Ir a `http://127.0.0.1:8000/odontologo/dashboard`
3. Desplazarse hacia abajo
4. **Resultado esperado**: 
   - Si `APP_DEBUG=true`: Muestra sección "🔐 Permisos del Usuario"
   - Lista todos los 13 permisos con badges verdes
   - Ejemplo de permisos mostrados:
     - ✓ dentist.view_appointments
     - ✓ dentist.view_diagnostics
     - ✓ dentist.view_treatments
     - etc.

### Test 5: Verificación en Terminal
**Objetivo**: Verificar datos en BD desde terminal

Ejecuta en la terminal del proyecto:
```bash
php artisan tinker

# En la consola de tinker:
use App\Support\PermissionHelper;
dd(PermissionHelper::getUserPermissions());

# Debería mostrar array con 13 permisos
```

---

## 🔧 Verificaciones Técnicas

### Verificar Migración Ejecutada
```bash
php artisan migrate:status

# Debería mostrar:
# 2025_11_11_150000_create_permissions_table    YES
```

### Verificar Seeder Ejecutado
```bash
php artisan tinker
use Illuminate\Support\Facades\DB;

# Contar permisos
DB::table('permissions')->count();  # Debería ser 19

# Contar asignaciones
DB::table('role_permissions')->count();  # Debería ser 19

# Ver permisos del dentist
DB::table('role_permissions')
  ->join('permissions', 'role_permissions.permission_id', '=', 'permissions.id')
  ->where('role_permissions.role', 'dentist')
  ->get(['permissions.name']);
```

### Verificar Middleware Registrado
```bash
# Verificar en bootstrap/app.php que exista:
$middleware->alias([
    'EnsureUserRole' => \App\Http\Middleware\EnsureUserRole::class,
    'EnsurePermission' => \App\Http\Middleware\EnsurePermission::class,
]);
```

### Verificar Rutas Protegidas
```bash
php artisan route:list --path=odontologo

# Debería mostrar rutas con middleware:
# auth
# EnsureUserRole:dentist
# EnsurePermission:dentist.view_*
```

---

## 🐛 Troubleshooting

### Problema: "503 Service Unavailable"
**Solución**: Verificar que servidor está corriendo
```bash
php artisan serve --host=127.0.0.1 --port=8000
```

### Problema: "No tienes permiso para acceder a este recurso" (403)
**Causa**: Usuario no tiene el permiso requerido
**Solución**: 
1. Verificar que está autenticado como dentist
2. Ejecutar: `php artisan db:seed --class=PermissionSeeder`
3. Limpiar caches: `php artisan cache:clear`

### Problema: Permisos no aparecen en dashboard
**Causa**: `APP_DEBUG` está en false
**Solución**: En `.env` cambiar:
```
APP_DEBUG=true
```

### Problema: "Undefined type App\Models\Permission"
**Causa**: Modelo no compilado
**Solución**: Ejecutar `php artisan cache:clear` o reiniciar servidor

---

## ✅ Checklist de Validación

- [ ] Servidor Laravel corriendo en puerto 8000
- [ ] Base de datos MySQL conectada (puerto 3307)
- [ ] Migraciones ejecutadas (`permissions` y `role_permissions` tablas existen)
- [ ] Seeder ejecutado (19 permisos en tabla)
- [ ] Middleware registrado en `bootstrap/app.php`
- [ ] Rutas protegidas en `routes/web.php`
- [ ] Helper class en `app/Support/PermissionHelper.php`
- [ ] Blade directives registradas en `AppServiceProvider`
- [ ] Dashboard muestra permisos cuando `APP_DEBUG=true`
- [ ] Acceso a rutas sin permiso retorna 403

---

## 📞 Soporte

Si encuentras problemas:

1. Verifica que estés autenticado: `echo auth()->user();` en tinker
2. Verifica permisos del usuario: `PermissionHelper::getUserPermissions();`
3. Verifica middleware: `route:list --path=odontologo`
4. Limpia caches: `php artisan cache:clear`
5. Reinicia servidor: `php artisan serve --host=127.0.0.1 --port=8000`

---

**Última actualización**: 2024
**Estado**: ✅ Sistema funcional y probado
