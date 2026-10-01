param(
    [switch]$ResetPassword
)

$ErrorActionPreference = 'Stop'

$phpPath = (Get-Command php -ErrorAction Stop).Source
$phpDir = Split-Path $phpPath

$env:PGHOST = 'ep-ancient-fog-b49op6nd-pooler.c-6.us-east-2.aws.neon.tech'
$env:PGPORT = '5432'
$env:PGDATABASE = 'neondb'
$env:PGUSER = 'neondb_owner'

$credentialPath = Join-Path $PSScriptRoot '.neon-credential.xml'

if ($ResetPassword -and (Test-Path $credentialPath)) {
    Remove-Item $credentialPath -Force
}

function Read-NeonCredential {
    $securePassword = Read-Host 'Password Neon baru (disimpan terenkripsi)' -AsSecureString
    $newCredential = [System.Management.Automation.PSCredential]::new($env:PGUSER, $securePassword)
    $newCredential | Export-Clixml $credentialPath
    return $newCredential
}

if (Test-Path $credentialPath) {
    $credential = Import-Clixml $credentialPath
} else {
    $credential = Read-NeonCredential
}

$env:PGPASSWORD = $credential.GetNetworkCredential().Password

$testScript = '$dsn = "pgsql:host=" . getenv("PGHOST") . ";port=" . getenv("PGPORT") . ";dbname=" . getenv("PGDATABASE") . ";sslmode=require"; try { new PDO($dsn, getenv("PGUSER"), getenv("PGPASSWORD")); exit(0); } catch (Throwable $exception) { exit(1); }'
& php -d "extension_dir=$phpDir\ext" -d extension=php_pdo_pgsql.dll -r $testScript

if ($LASTEXITCODE -ne 0) {
    Remove-Item $credentialPath -Force -ErrorAction SilentlyContinue
    Write-Host 'Password tersimpan ditolak oleh Neon. Masukkan password Neon yang baru.' -ForegroundColor Red
    $credential = Read-NeonCredential
    $env:PGPASSWORD = $credential.GetNetworkCredential().Password
}

Write-Host 'Jobsheet 9 berjalan di http://localhost:8000' -ForegroundColor Green
Write-Host 'Tekan Ctrl+C untuk menghentikan server.' -ForegroundColor Yellow

php -d "extension_dir=$phpDir\ext" `
    -d extension=php_pdo_pgsql.dll `
    -S localhost:8000 `
    -t $PSScriptRoot
