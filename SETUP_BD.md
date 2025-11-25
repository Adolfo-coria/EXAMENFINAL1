# Configuración de Base de Datos - Sonrisa Feliz

## Resumen

Este documento detalla los pasos realizados para configurar la base de datos MySQL en XAMPP para el proyecto **Sonrisa Feliz**.

**Fecha:** 10 de noviembre de 2025  
**Entorno:** XAMPP en Windows con MariaDB 10.4.32  
**Puerto:** 3307 (cambiado de 3306 para evitar conflicto de puertos)  
**Base de datos:** `sonrisa_feliz`

---

## Problemas Resueltos

### 1. Conflicto de Puerto 3306

**Problema:** Al intentar iniciar MySQL desde XAMPP, el servicio fallaba con el error:
```
ERROR] Can't start server: Bind on TCP/IP port. Got error: 10048: 
Only one usage of each socket address (protocol/network address/port) 
is normally permitted.
```

**Causa:** Otro proceso (posiblemente otro servicio MySQL/MariaDB o Docker) estaba usando el puerto 3306.

**Solución:**
1. Cambiar el puerto de XAMPP MySQL a `3307` en el archivo `C:\xampp\mysql\bin\my.ini`:
   - Reemplazar todas las ocurrencias de `port=3306` por `port=3307`
2. Reiniciar XAMPP Control Panel (ejecutar como Administrador)

---

## Pasos de Configuración

### Paso 1: Cambiar Puerto en XAMPP

**Archivo:** `C:\xampp\mysql\bin\my.ini`

```ini
# Buscar estas líneas y cambiar:
[client]
port=3307  # Cambio de 3306 a 3307

[mysqld]
port=3307  # Cambio de 3306 a 3307
```

### Paso 2: Reiniciar XAMPP

1. Abre XAMPP Control Panel como Administrador
2. Detén MySQL (si estaba corriendo)
3. Haz clic en **Start** para MySQL
4. Verifica que estés en el puerto 3307:

```powershell
# Verificar puerto en uso
netstat -ano | findstr ":3307"

# Probar conexión
& "C:\xampp\mysql\bin\mysql.exe" -u root -P 3307 -e "SHOW DATABASES;"
```

### Paso 3: Crear la Base de Datos

```powershell
& "C:\xampp\mysql\bin\mysql.exe" -u root -P 3307 -e "CREATE DATABASE IF NOT EXISTS sonrisa_feliz CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

**Verificar:**
```powershell
& "C:\xampp\mysql\bin\mysql.exe" -u root -P 3307 -e "SHOW DATABASES;"
# Deberá aparecer: sonrisa_feliz
```

### Paso 4: Configurar el Archivo `.env`

**Archivo:** `c:\xampp\htdocs\sonrisa-feliz\.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=sonrisa_feliz
DB_USERNAME=root
DB_PASSWORD=

# Drivers de sesión y caché (usando file para desarrollo local)
SESSION_DRIVER=file
CACHE_STORE=file
```

**Notas:**
- `DB_PASSWORD` está vacío porque es la configuración por defecto de XAMPP
- `SESSION_DRIVER=file` y `CACHE_STORE=file` usan almacenamiento en archivos (no requieren tablas en BD)
- Estas configuraciones son ideales para desarrollo local

### Paso 5: Generar APP_KEY

```powershell
cd c:\xampp\htdocs\sonrisa-feliz
& "C:\xampp\php\php.exe" artisan key:generate
```

### Paso 6: Ejecutar Migraciones

```powershell
cd c:\xampp\htdocs\sonrisa-feliz
& "C:\xampp\php\php.exe" artisan migrate:fresh --force
```

**Salida esperada:**
```
Creating migration table ..................... DONE

Running migrations.

0001_01_01_000000_create_users_table ........ DONE
0001_01_01_000001_create_cache_table ........ DONE
0001_01_01_000002_create_jobs_table ......... DONE
```

### Paso 7: Verificar Tablas Creadas

```powershell
& "C:\xampp\mysql\bin\mysql.exe" -u root -P 3307 sonrisa_feliz -e "SHOW TABLES;"
```

**Tablas que deberán existir:**
- `cache` - Almacenamiento de caché
- `cache_locks` - Locks para caché
- `failed_jobs` - Jobs fallidos
- `job_batches` - Lotes de jobs
- `jobs` - Queue de trabajos
- `migrations` - Control de migraciones
- `password_reset_tokens` - Tokens de reseteo de contraseña
- `sessions` - Sesiones de usuario (si se usa driver database)
- `users` - Tabla de usuarios

---

## Limpieza de Cache

Si en algún momento necesitas limpiar el cache:

```powershell
cd c:\xampp\htdocs\sonrisa-feliz
& "C:\xampp\php\php.exe" artisan cache:clear
& "C:\xampp\php\php.exe" artisan config:clear
```

---

## Resetear Base de Datos (Development Only)

Para eliminar todas las tablas y volver a ejecutar las migraciones:

```powershell
cd c:\xampp\htdocs\sonrisa-feliz
& "C:\xampp\php\php.exe" artisan migrate:fresh --force
```

⚠️ **ADVERTENCIA:** Este comando borra TODOS los datos de la base de datos.

---

## Troubleshooting

### Error: "MySQL shutdown unexpectedly"
- Verifica que el puerto 3307 esté disponible: `netstat -ano | findstr ":3307"`
- Revisa los logs en `C:\xampp\mysql\data\mysql_error.log`
- Si hay conflicto de puerto, identifica el proceso: `tasklist /fi "PID eq <PID>"`

### Error: "Connection refused"
- Asegúrate de que MySQL está corriendo en XAMPP
- Verifica que el puerto en `.env` coincida con el configurado en `my.ini` (3307)

### Error: "SQLSTATE[HY000]: General error"
- Limpia el cache: `php artisan config:clear && php artisan cache:clear`
- Ejecuta migraciones nuevamente: `php artisan migrate:fresh --force`

---

## Referencias

- [Laravel Documentation - Database](https://laravel.com/docs/migrations)
- [XAMPP Documentation](https://www.apachefriends.org/docs/index.html)
- [MariaDB Configuration](https://mariadb.com/kb/en/library/configuring-mariadb/)

---

## Próximos Pasos

1. Crear seeders para poblar datos de prueba
2. Configurar autenticación de usuarios
3. Implementar roles y permisos (según sea necesario para el proyecto)
4. Realizar backup regular de la base de datos

---

**Configurado por:** Sistema Automatizado  
**Fecha de última actualización:** 10 de noviembre de 2025
