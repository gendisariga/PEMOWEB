$ErrorActionPreference = 'Stop'

$phpPath = (Get-Command php -ErrorAction Stop).Source
$phpDir = Split-Path $phpPath

$sqliteExtension = Join-Path $phpDir 'ext\php_pdo_sqlite.dll'
if (-not (Test-Path $sqliteExtension)) {
    throw "Driver SQLite PHP tidak ditemukan: $sqliteExtension"
}

Write-Host 'Klinik Hewan Winadivet berjalan di http://localhost:8000' -ForegroundColor Green
Write-Host 'Tekan Ctrl+C untuk menghentikan server.' -ForegroundColor Yellow

& $phpPath -d "extension_dir=$phpDir\ext" `
    -d extension=php_pdo_sqlite.dll `
    -S localhost:8000 `
    -t $PSScriptRoot
