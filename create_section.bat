@echo off
set /p SECTION_NAME=Enter Section Name (e.g. HeroSection): 

if "%SECTION_NAME%"=="" (
    echo ❌ You must enter a section name.
    exit /b
)

REM Auto lowercase slug
for /f %%a in ('powershell -command "[regex]::Replace('%SECTION_NAME%', '([a-z])([A-Z])', '$1-$2').ToLower()"') do set SECTION_SLUG=%%a

REM Step 1: Model + Migration
php artisan make:model %SECTION_NAME% -m

REM Step 2: Filament Resource
php artisan make:filament-resource %SECTION_NAME%

REM Step 3: API Resource
php artisan make:resource %SECTION_NAME%Resource

REM Step 4: API Controller
php artisan make:controller Api\%SECTION_NAME%Controller

REM Step 5: Append to routes/api.php
echo Route::apiResource("%SECTION_SLUG%s", App\Http\Controllers\Api\%SECTION_NAME%Controller::class); >> routes\api.php

echo.
echo ✅ Done creating section: %SECTION_NAME%
echo 🔧 Now edit the files to add title, description, and image fields.
pause
