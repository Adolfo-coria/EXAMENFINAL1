# Script para cambiar puerto MySQL en XAMPP de 3306 a 3307
# Ejecutar como Administrador

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "XAMPP MySQL Port Change Script" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Verificar si se ejecuta como Administrador
$isAdmin = ([Security.Principal.WindowsPrincipal] [Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole] "Administrator")
if (-not $isAdmin) {
    Write-Host "ERROR: Este script debe ejecutarse como Administrador." -ForegroundColor Red
    Write-Host "Haz clic derecho en PowerShell y selecciona Ejecutar como administrador." -ForegroundColor Yellow
    Exit 1
}

Write-Host "OK - Ejecutandose como Administrador" -ForegroundColor Green
Write-Host ""

# Rutas
$myiniPath = "C:\xampp\mysql\bin\my.ini"
$backupPath = "C:\xampp\mysql\bin\my.ini.bak"

# 1. Verificar que my.ini existe
Write-Host "[1] Verificando archivo my.ini..." -ForegroundColor Cyan
if (-not (Test-Path $myiniPath)) {
    Write-Host "ERROR: No se encontro $myiniPath" -ForegroundColor Red
    Exit 1
}
Write-Host "OK - Archivo encontrado: $myiniPath" -ForegroundColor Green
Write-Host ""

# 2. Crear backup
Write-Host "[2] Creando copia de seguridad..." -ForegroundColor Cyan
if (Test-Path $backupPath) {
    Write-Host "WARN - Ya existe backup en $backupPath" -ForegroundColor Yellow
    $backup_new = "C:\xampp\mysql\bin\my.ini.bak.$(Get-Date -Format 'yyyyMMdd_HHmmss')"
    Copy-Item $myiniPath $backup_new
    Write-Host "OK - Nuevo backup creado: $backup_new" -ForegroundColor Green
} else {
    Copy-Item $myiniPath $backupPath
    Write-Host "OK - Backup creado: $backupPath" -ForegroundColor Green
}
Write-Host ""

# 3. Cambiar puerto en my.ini
Write-Host "[3] Cambiando puerto de 3306 a 3307 en my.ini..." -ForegroundColor Cyan
$content = Get-Content $myiniPath
$newContent = $content -replace 'port=3306', 'port=3307'
Set-Content $myiniPath $newContent
Write-Host "OK - Puerto actualizado en my.ini" -ForegroundColor Green
Write-Host ""

# 4. Mostrar cambios realizados
Write-Host "[4] Verificando cambios..." -ForegroundColor Cyan
$changes = Select-String -Path $myiniPath -Pattern "port=3307"
Write-Host "OK - Encontradas $($changes.Count) linea(s) con port=3307:" -ForegroundColor Green
$changes | ForEach-Object { Write-Host "   -> $_" -ForegroundColor Gray }
Write-Host ""

# 5. Detener servicios MySQL/Apache (si estan corriendo)
Write-Host "[5] Deteniendo servicios XAMPP (si estan corriendo)..." -ForegroundColor Cyan
$mysqlService = Get-Service -Name "MySQL80" -ErrorAction SilentlyContinue
if ($mysqlService) {
    Write-Host "STOP - Parando servicio MySQL80..." -ForegroundColor Yellow
    Stop-Service -Name "MySQL80" -Force -ErrorAction SilentlyContinue
    Start-Sleep -Seconds 2
    Write-Host "OK - Servicio MySQL80 detenido" -ForegroundColor Green
} else {
    Write-Host "INFO - No se encontro servicio MySQL80 instalado" -ForegroundColor Gray
}
Write-Host ""

# 6. Instrucciones finales
Write-Host "[6] Proximos pasos:" -ForegroundColor Cyan
Write-Host "   1. Abre el XAMPP Control Panel (ejecutar como Administrador)" -ForegroundColor Gray
Write-Host "   2. Haz clic en Start para MySQL" -ForegroundColor Gray
Write-Host "   3. Verifica que el puerto 3307 esta en uso:" -ForegroundColor Gray
Write-Host "      netstat -ano | findstr :3307" -ForegroundColor DarkGray
Write-Host ""

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "OK - Script completado exitosamente" -ForegroundColor Green
Write-Host "======================================== " -ForegroundColor Cyan
