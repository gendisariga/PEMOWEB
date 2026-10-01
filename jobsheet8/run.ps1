$ErrorActionPreference = 'Stop'

$phpPath = (Get-Command php -ErrorAction Stop).Source
$phpDir = Split-Path $phpPath

$env:PGHOST = 'ep-ancient-fog-b49op6nd-pooler.c-6.us-east-2.aws.neon.tech'
$env:PGPORT = '5432'
$env:PGDATABASE = 'neondb'
$env:PGUSER = 'neondb_owner'

$securePassword = Read-Host 'Password Neon' -AsSecureString
$env:PGPASSWORD = [System.Net.NetworkCredential]::new('', $securePassword).Password

Write-Host 'Server berjalan di http://localhost:8000' -ForegroundColor Green
Write-Host 'Tekan Ctrl+C untuk menghentikan server.' -ForegroundColor Yellow

php -d "extension_dir=$phpDir\ext" `
    -d extension=php_pdo_pgsql.dll `
    -S localhost:8000 `
    -t $PSScriptRoot `
    $PSScriptRoot\router.php
