@echo off
echo Optimizando Laravel...

echo.
echo [1/6] Limpiando cache de configuracion...
php artisan config:clear
php artisan config:cache

echo.
echo [2/6] Limpiando cache de rutas...
php artisan route:clear
php artisan route:cache

echo.
echo [3/6] Limpiando cache de vistas...
php artisan view:clear
php artisan view:cache

echo.
echo [4/6] Optimizando autoloader...
composer dump-autoload -o

echo.
echo [5/6] Limpiando cache de eventos...
php artisan event:clear
php artisan event:cache

echo.
echo [6/6] Limpiando cache de aplicacion...
php artisan cache:clear

echo.
echo ======================================
echo   Optimizacion completada con exito!
echo ======================================
pause
