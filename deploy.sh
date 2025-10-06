#!/bin/bash

echo "🚀 Iniciando deployment de R-Integra..."

# Backend
echo "📦 Instalando dependencias de backend..."
cd backend
composer install --optimize-autoloader --no-dev

echo "🔑 Generando APP_KEY si no existe..."
if ! grep -q "APP_KEY=base64:" .env; then
    php artisan key:generate --force
fi

echo "🗄️ Ejecutando migraciones..."
php artisan migrate --force

echo "⚡ Optimizando Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "📁 Configurando permisos..."
chmod -R 775 storage bootstrap/cache
chown -R www:www storage bootstrap/cache

cd ..

# Frontend
echo "🎨 Building frontend..."
cd frontend
npm install
npm run build

echo "✅ Deployment completado!"
