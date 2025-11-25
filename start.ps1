# Script para ejecutar Sonrisa Feliz en tu máquina local
# Autor: Sistema Automatizado
# Fecha: 10 de noviembre de 2025

param(
    [switch]$Force,
    [switch]$Fresh
)

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Sonrisa Feliz - Servidor Local" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Verificar ubicacion
if (-not (Test-Path "artisan")) {
    Write-Host "ERROR: No se encontro artisan." -ForegroundColor Red
    Write-Host "Ejecuta este script desde la raiz del proyecto." -ForegroundColor Yellow
    Exit 1
}

# Verificar MySQL
Write-Host "[1] Verificando MySQL en puerto 3307..." -ForegroundColor Cyan
$mysql_check = netstat -ano | Select-String ":3307"
if (-not $mysql_check) {
    Write-Host "ERROR: MySQL no esta respondiendo en puerto 3307" -ForegroundColor Red
    Write-Host "" -ForegroundColor Red
    Write-Host "Acciones:" -ForegroundColor Yellow
    Write-Host "  1. Abre XAMPP Control Panel" -ForegroundColor Yellow
    Write-Host "  2. Haz clic en START para MySQL" -ForegroundColor Yellow
    Write-Host "  3. Espera 5 segundos y vuelve a ejecutar este script" -ForegroundColor Yellow
    Write-Host "" -ForegroundColor Red
    Exit 1
}
Write-Host "OK - MySQL esta corriendo" -ForegroundColor Green
Write-Host ""

# Resetear base si se especifica --Fresh
if ($Fresh) {
    Write-Host "[2] Reseteando base de datos..." -ForegroundColor Cyan
    & php artisan migrate:fresh --force
    if ($LASTEXITCODE -ne 0) {
        Write-Host "ERROR: No se pudo resetear la base de datos" -ForegroundColor Red
        Exit 1
    }
    Write-Host "OK - Base de datos reseteada" -ForegroundColor Green
    Write-Host ""
}

# Limpiar cache
Write-Host "[2/3] Limpiando cache y configuracion..." -ForegroundColor Cyan
& php artisan config:clear 2> $null
& php artisan cache:clear 2> $null
Write-Host "OK - Cache limpiado" -ForegroundColor Green
Write-Host ""

# Información final
Write-Host "[3/3] Iniciando servidor Laravel..." -ForegroundColor Cyan
Write-Host ""
Write-Host "========================================" -ForegroundColor Green
Write-Host "  APLICACION LISTA" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Green
Write-Host ""
Write-Host "URL:       http://localhost:8000" -ForegroundColor Green
Write-Host "Base BD:   sonrisa_feliz (MySQL:3307)" -ForegroundColor Green
Write-Host "Usuario:   root (sin contrasena)" -ForegroundColor Green
Write-Host ""
Write-Host "Para detener: presiona Ctrl + C" -ForegroundColor Yellow
Write-Host ""

# Ejecutar servidor
& php artisan serve
