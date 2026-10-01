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

if (Test-Path $credentialPath) {
    $credential = Import-Clixml $credentialPath
} else {
    $securePassword = Read-Host 'Password Neon (disimpan terenkripsi di komputer ini)' -AsSecureString
    $credential = [System.Management.Automation.PSCredential]::new($env:PGUSER, $securePassword)
    $credential | Export-Clixml $credentialPath
}

$env:PGPASSWORD = $credential.GetNetworkCredential().Password

Write-Host 'Jobsheet 9 berjalan di http://localhost:8000' -ForegroundColor Green
Write-Host 'Tekan Ctrl+C untuk menghentikan server.' -ForegroundColor Yellow

php -d "extension_dir=$phpDir\ext" `
    -d extension=php_pdo_pgsql.dll `
    -S localhost:8000 `
    -t $PSScriptRoot
