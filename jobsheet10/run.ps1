$ErrorActionPreference = 'Stop'

$phpPath = (Get-Command php -ErrorAction Stop).Source
$phpDir = Split-Path $phpPath
$pgsqlExtension = Join-Path $phpDir 'ext\php_pdo_pgsql.dll'

if (-not (Test-Path $pgsqlExtension)) {
    throw "Driver PostgreSQL PHP tidak ditemukan: $pgsqlExtension"
}

Write-Host 'Klinik Hewan Winadivet berjalan di http://localhost:8000' -ForegroundColor Green
Write-Host 'Tekan Ctrl+C untuk menghentikan server.' -ForegroundColor Yellow

& $phpPath -d "extension_dir=$phpDir\ext" `
    -d extension=php_pdo_pgsql.dll `
    -S localhost:8000 `
    -t $PSScriptRoot
