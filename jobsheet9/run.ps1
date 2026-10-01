$ErrorActionPreference = 'Stop'

$phpPath = (Get-Command php -ErrorAction Stop).Source
$phpDir = Split-Path $phpPath

Write-Host 'Klinik Hewan Winadivet berjalan di http://localhost:8000' -ForegroundColor Green
Write-Host 'Tekan Ctrl+C untuk menghentikan server.' -ForegroundColor Yellow

php -d "extension_dir=$phpDir\ext" `
    -d extension=php_pdo_sqlite.dll `
    -S localhost:8000 `
    -t $PSScriptRoot
