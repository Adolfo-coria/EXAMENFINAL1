@echo off
REM Script para ejecutar el servidor Laravel localmente
REM Requiere: XAMPP con MySQL corriendo en puerto 3307

echo.
echo ========================================
echo Sonrisa Feliz - Servidor Local
echo ========================================
echo.

REM Verificar que estamos en la carpeta correcta
if not exist "artisan" (
    echo ERROR: No se encontro artisan. Ejecuta este script desde la raiz del proyecto.
    pause
    exit /b 1
)

echo [1] Verificando MySQL en puerto 3307...
netstat -ano | findstr ":3307" > nul
if %errorlevel% neq 0 (
    echo.
    echo ADVERTENCIA: MySQL no esta respondiendo en puerto 3307
    echo Abre XAMPP Control Panel y haz clic en Start para MySQL
    echo.
    pause
    exit /b 1
)
echo OK - MySQL esta corriendo

echo.
echo [2] Limpiando cache...
php artisan config:clear > nul 2>&1
php artisan cache:clear > nul 2>&1
echo OK - Cache limpiado

echo.
echo [3] Iniciando servidor Laravel (puerto 8000)...
echo.
echo URL: http://localhost:8000
echo.
echo Para detener: presiona Ctrl + C
echo.

php artisan serve

pause
