# Como Ejecutar Sonrisa Feliz Localmente

## Opción 1: Ejecutar con script BAT (Windows - Más fácil)

1. Abre el **XAMPP Control Panel** (ejecutar como Administrador)
2. Haz clic en **START** para MySQL
3. Espera a que el estado muestre "Running"
4. **Abre una terminal/CMD en la carpeta del proyecto** y ejecuta:

```cmd
start.bat
```

O simplemente **haz doble clic en `start.bat`** desde el explorador de archivos.

**Resultado:** El servidor se iniciará en `http://localhost:8000`

---

## Opción 2: Ejecutar con script PowerShell (Más funcionalidades)

1. Abre XAMPP Control Panel → **START MySQL**
2. Abre **PowerShell** como Administrador
3. Navega a la carpeta del proyecto:

```powershell
cd C:\xampp\htdocs\sonrisa-feliz
```

4. Ejecuta el script:

```powershell
.\start.ps1
```

**Parámetros opcionales:**

```powershell
# Resetear base de datos y ejecutar (borrar todos los datos)
.\start.ps1 -Fresh

# Forzar ejecución sin verificaciones
.\start.ps1 -Force
```

---

## Opción 3: Ejecutar manualmente (Terminal)

1. Abre **PowerShell** o **CMD** como Administrador
2. Navega a la carpeta del proyecto:

```powershell
cd C:\xampp\htdocs\sonrisa-feliz
```

3. Inicia el servidor Laravel:

```powershell
php artisan serve
```

O si usas el PHP de XAMPP:

```powershell
& "C:\xampp\php\php.exe" artisan serve
```

---

## Verificar que Todo Funciona

Una vez que el servidor esté corriendo, deberías ver:

```
INFO  Server running on [http://127.0.0.1:8000].

  Press Ctrl+C to quit
```

Abre tu navegador en: **http://localhost:8000**

---

## Primeros Pasos Después de Ejecutar

### Acceder a phpMyAdmin (Administrar BD)
```
http://localhost/phpmyadmin
```
- Usuario: `root`
- Contraseña: (vacía)
- Base de datos: `sonrisa_feliz`

### Ver logs en tiempo real
```powershell
# En otra terminal, en la carpeta del proyecto:
Get-Content -Path storage\logs\laravel.log -Tail 50 -Wait
```

### Ejecutar migraciones (si es necesario)
```powershell
php artisan migrate
```

### Resetear base de datos (Borrar todo y empezar)
```powershell
php artisan migrate:fresh --seed
```

---

## Problemas Comunes

### Error: "MySQL no está respondiendo en puerto 3307"

**Solución:**
1. Abre XAMPP Control Panel como Administrador
2. Haz clic en **START** para MySQL
3. Espera 5 segundos
4. Vuelve a ejecutar el script

### Error: "php command not found"

**Solución 1:** Usa la ruta completa de XAMPP:
```powershell
& "C:\xampp\php\php.exe" artisan serve
```

**Solución 2:** Agrega PHP al PATH del sistema (requiere reiniciar la terminal después):
```powershell
$env:PATH += ";C:\xampp\php"
php artisan serve
```

### Error: "Port 8000 is already in use"

**Solución:** Especifica otro puerto:
```powershell
php artisan serve --port=8001
```

O encuentra qué está usando el puerto 8000:
```powershell
netstat -ano | findstr ":8000"
tasklist /fi "PID eq <PID>"
```

---

## Detener el Servidor

Presiona **Ctrl + C** en la terminal donde está corriendo el servidor.

---

## Rutas Útiles

| Ruta | Descripción |
|------|-------------|
| `/` | Página de inicio |
| `/phpmyadmin` | Gestor de base de datos |
| `/artisan` | Comandos de Laravel (solo línea de comandos) |

---

## Configuración de Base de Datos

**Archivo:** `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=sonrisa_feliz
DB_USERNAME=root
DB_PASSWORD=
```

Para más información, ver `SETUP_BD.md`

---

## Comandos Útiles

```powershell
# Generar nueva clave APP
php artisan key:generate

# Ejecutar migraciones
php artisan migrate

# Crear tabla específica
php artisan make:migration create_<nombre>_table

# Hacer factory y seeders
php artisan make:seeder <NombreSeeder>

# Limpiar cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Ver rutas registradas
php artisan route:list

# Ejecutar tinker (shell de Laravel)
php artisan tinker
```

---

## Soporte

Si tienes problemas, consulta:
- `SETUP_BD.md` - Configuración detallada de BD
- `README.md` - Información general del proyecto
- Logs: `storage/logs/laravel.log`

---

**Última actualización:** 10 de noviembre de 2025
