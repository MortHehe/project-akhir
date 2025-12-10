@echo off
REM ============================================================
REM WORKZY Database Setup Script for Windows (XAMPP)
REM ============================================================

color 0A
echo ========================================
echo WORKZY Database Setup
echo ========================================
echo.

REM Check if MySQL is running
echo [1/5] Checking MySQL service...
tasklist /FI "IMAGENAME eq mysqld.exe" 2>NUL | find /I /N "mysqld.exe">NUL
if "%ERRORLEVEL%"=="0" (
    echo [OK] MySQL is running
) else (
    echo [ERROR] MySQL is not running!
    echo Please start MySQL from XAMPP Control Panel
    pause
    exit /b 1
)
echo.

REM Set MySQL path (adjust if needed)
set MYSQL_PATH=C:\xampp\mysql\bin
set PROJECT_PATH=%~dp0

echo [2/5] Checking MySQL installation...
if exist "%MYSQL_PATH%\mysql.exe" (
    echo [OK] MySQL found at %MYSQL_PATH%
) else (
    echo [ERROR] MySQL not found at %MYSQL_PATH%
    echo Please update MYSQL_PATH in this script
    pause
    exit /b 1
)
echo.

REM Ask for MySQL root password
echo [3/5] MySQL Authentication
set /p MYSQL_PASS="Enter MySQL root password (press Enter if no password): "
echo.

REM Create database and import schema
echo [4/5] Creating database and importing schema...
echo This may take a minute...
echo.

if "%MYSQL_PASS%"=="" (
    "%MYSQL_PATH%\mysql.exe" -u root < "%PROJECT_PATH%database\workzy_database_setup.sql"
) else (
    "%MYSQL_PATH%\mysql.exe" -u root -p%MYSQL_PASS% < "%PROJECT_PATH%database\workzy_database_setup.sql"
)

if %ERRORLEVEL% EQU 0 (
    echo [OK] Database setup completed successfully!
) else (
    echo [ERROR] Database setup failed!
    echo Check your MySQL credentials and try again
    pause
    exit /b 1
)
echo.

REM Update .env file
echo [5/5] Updating .env configuration...
if not exist "%PROJECT_PATH%.env" (
    if exist "%PROJECT_PATH%.env.example" (
        copy "%PROJECT_PATH%.env.example" "%PROJECT_PATH%.env"
        echo [OK] Created .env from .env.example
    ) else (
        echo [WARNING] .env.example not found
    )
)

REM Update .env database settings
if exist "%PROJECT_PATH%.env" (
    echo [INFO] Please update your .env file with these settings:
    echo.
    echo DB_CONNECTION=mysql
    echo DB_HOST=127.0.0.1
    echo DB_PORT=3306
    echo DB_DATABASE=workzy
    echo DB_USERNAME=root
    echo DB_PASSWORD=%MYSQL_PASS%
    echo.
)

echo ========================================
echo Setup Complete!
echo ========================================
echo.
echo Database: workzy
echo Tables Created: 13
echo Default Users Created: 3
echo.
echo Login Credentials:
echo   Admin:      admin@workzy.com / admin123
echo   Freelancer: freelancer@workzy.com / freelancer123
echo   Client:     client@workzy.com / client123
echo.
echo Next Steps:
echo   1. Update .env file with database credentials
echo   2. Run: php artisan key:generate
echo   3. Run: php artisan migrate (if not using SQL import)
echo   4. Run: php artisan serve
echo   5. Open: http://localhost:8000
echo.
echo ========================================
pause
