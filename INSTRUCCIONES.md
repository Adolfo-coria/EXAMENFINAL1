# 🦷 Sonrisa Feliz - Sistema de Autenticación y Gestión Dental

## ✅ Configuración completada

El sistema ha sido actualizado con un nuevo sistema de autenticación unificado y protección de rutas por rol.

---

## 🚀 Cómo ejecutar la aplicación

### 1. **Asegurate que XAMPP esté corriendo**
   - Apache: ✓ Iniciado
   - MySQL: ✓ Iniciado en puerto 3307

### 2. **Inicia el servidor Laravel**
```powershell
& 'C:\xampp\php\php.exe' artisan serve --host=127.0.0.1 --port=8000
```

### 3. **Abre en tu navegador**
```
http://127.0.0.1:8000
```

---

## 👤 Usuarios de prueba creados

Después de ejecutar `artisan migrate:fresh --seed`, tienes 3 usuarios de prueba:

### Admin
- **Nombre completo**: Admin Prueba
- **Identificador**: `00000000` (CI) o `70000000` (Celular)
- **Contraseña**: `admin1234`
- **Acceso**: Dashboard (/admin/dashboard), todas las funciones

### Paciente
- **Nombre completo**: Juan Perez
- **Identificador**: `12345678` (CI) o `71234567` (Celular)
- **Contraseña**: `patient1234`
- **Acceso**: Panel de pacientes

### Odontólogo
- **Nombre completo**: Dr. Carlos Lopez
- **Identificador**: `87654321` (CI) o `79876543` (Celular)
- **Contraseña**: `dentist1234`
- **Acceso**: Gestión de citas

---

## 🔐 Sistema de Autenticación

### ¿Cómo iniciar sesión?
1. Haz clic en **"Ingresar"** en la página principal
2. Completa el formulario de login con:
   - **Identificador**: Nombre completo, CI o Celular
   - **Contraseña**: Tu contraseña

### ¿Cómo registrarse?
1. Haz clic en **"Registrar"** en la página de login
2. Completa los campos:
   - Nombre completo (obligatorio)
   - C.I. (obligatorio, único)
   - Celular (obligatorio, único)
   - Email (opcional)
   - Tipo de cuenta: Paciente / Odontólogo / Administrador
   - Contraseña y confirmación
3. Haz clic en **"Registrar"**

### Acceso a secciones
- **Sin autenticación**: Solo puedes ver la página principal
- **Con autenticación**: Tienes acceso a todas las secciones según tu rol
- **Admin**: Acceso completo a dashboard y gestión
- **Paciente/Odontólogo**: Acceso limitado a funciones específicas

---

## 📊 Características implementadas

✅ **Autenticación unificada** (nombre/CI/celular + contraseña)
✅ **Registro de nuevos usuarios** (3 tipos: paciente, admin, odontólogo)
✅ **Protección de rutas** por autenticación
✅ **Control de acceso** por rol (admin/patient/dentist)
✅ **Middleware EnsureUserRole** para restricción por rol
✅ **Dashboard** (solo admin)
✅ **Gestión de pacientes** CRUD
✅ **Gestión de odontólogos** CRUD
✅ **Gestión de citas** CRUD
✅ **Gestión de pagos** CRUD
✅ **PhpMyAdmin** configurado en puerto 3307

---

## 🛠️ Comandos útiles

### Limpiar cache
```powershell
& 'C:\xampp\php\php.exe' artisan config:clear
& 'C:\xampp\php\php.exe' artisan cache:clear
```

### Recrear base de datos con datos de prueba
```powershell
& 'C:\xampp\php\php.exe' artisan migrate:fresh --seed
```

### Ver usuarios en la base de datos (Tinker)
```powershell
& 'C:\xampp\php\php.exe' artisan tinker
# Dentro de tinker:
\App\Models\User::all(['id','name','ci','phone','role','email']);
exit
```

### Crear un usuario manual desde Tinker
```powershell
& 'C:\xampp\php\php.exe' artisan tinker
# Dentro de tinker:
\App\Models\User::create([
  'name' => 'Mi Usuario',
  'ci' => 'MICARNET',
  'phone' => '76543210',
  'email' => 'miusuario@example.com',
  'role' => 'patient',
  'password' => \Illuminate\Support\Facades\Hash::make('micontraseña')
]);
exit
```

---

## 📁 Archivos clave modificados/creados

```
app/
  Http/
    Controllers/
      AuthController.php              (Nuevo: control de auth)
      AdminController.php             (Actualizado: dashboard)
    Middleware/
      EnsureUserRole.php              (Nuevo: restricción por rol)
  Models/
    User.php                          (Actualizado: ci, phone, role)
    
database/
  migrations/
    2025_11_11_000003_add_ci_phone_role_to_users.php  (Nuevo)
  seeders/
    DatabaseSeeder.php                (Actualizado)

resources/views/
  auth/
    login.blade.php                   (Nuevo: login/registro combinado)
    register.blade.php                (Obsoleto, login.blade.php lo reemplaza)
    general.blade.php                 (Nuevo: formulario combinado)
  layouts/
    app.blade.php                     (Actualizado: mostrar usuario)
  home.blade.php                      (Actualizado: botón Ingresar)

routes/
  web.php                             (Actualizado: protección de rutas)
```

---

## 🐛 Solución de problemas

### PhpMyAdmin no conecta
1. Verifica que MySQL esté en puerto 3307: `mysql -u root -P 3307 -e "SHOW DATABASES;"`
2. Abre `C:\xampp\phpmyadmin\config.inc.php`
3. Busca y asegúrate que tenga:
   ```php
   $cfg['Servers'][$i]['host'] = '127.0.0.1';
   $cfg['Servers'][$i]['port'] = '3307';
   $cfg['Servers'][$i]['user'] = 'root';
   $cfg['Servers'][$i]['password'] = '';
   ```

### Login no funciona
1. Verifica que la BD esté sincronizada: `artisan migrate:fresh --seed`
2. Comprueba que el usuario existe: `artisan tinker` → `\App\Models\User::all();`
3. Limpia cache: `artisan config:clear`

### Middleware error
1. Asegúrate que `app/Http/Middleware/EnsureUserRole.php` existe
2. Verifica que `routes/web.php` use el middleware correctamente

---

## 📝 Notas finales

- El sistema usa **archivos de sesión** (no DB) para la sesión actual
- Las contraseñas se hashean automáticamente con `Hash::make()`
- El rol determina qué secciones pueden acceder los usuarios
- Los datos persisten en MySQL (puerto 3307)

---

**¡Tu aplicación Sonrisa Feliz está lista para usar! 🎉**
