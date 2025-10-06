# 🚀 Guía de Despliegue en Hostinger

## Paso 1: Preparar Backend (Laravel)

### 1.1 Optimizar para Producción
```bash
# En tu proyecto local, ejecutar:
cd backend
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 1.2 Crear archivo .env para producción
Crear `backend/.env.production` con:
```env
APP_NAME="R-Integra"
APP_ENV=production
APP_KEY=base64:TU_NUEVA_CLAVE_AQUI
APP_DEBUG=false
APP_URL=https://tudominio.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=tu_database_name
DB_USERNAME=tu_username
DB_PASSWORD=tu_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

SANCTUM_STATEFUL_DOMAINS=tudominio.com,www.tudominio.com
SESSION_DOMAIN=.tudominio.com
```

## Paso 2: Preparar Frontend (Vue.js)

### 2.1 Actualizar configuración para producción
Actualizar `frontend/src/services/api.ts`:
```typescript
const api = axios.create({
  baseURL: 'https://tudominio.com/api', // Tu dominio real
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  }
})
```

### 2.2 Compilar para producción
```bash
cd frontend
npm run build
```

## Paso 3: Configurar Hostinger

### 3.1 Crear Base de Datos MySQL
1. Ir a Panel de Control → Bases de Datos → MySQL
2. Crear nueva base de datos
3. Crear usuario y asignar permisos
4. Anotar credenciales

### 3.2 Estructura de Archivos en Hostinger
```
public_html/
├── api/                 # Backend Laravel (carpeta publica)
│   ├── index.php
│   └── ...
├── index.html          # Frontend compilado
├── assets/             # Assets del frontend
└── ...

private/                # Backend Laravel (archivos privados)
├── app/
├── config/
├── database/
└── ...
```

## Paso 4: Subir Archivos

### 4.1 Subir Backend
1. Crear carpeta `private` en tu hosting
2. Subir TODO el contenido de `backend/` a `private/`
3. Copiar `backend/public/*` a `public_html/api/`
4. Editar `public_html/api/index.php`:

```php
<?php
require_once __DIR__.'/../../private/vendor/autoload.php';
$app = require_once __DIR__.'/../../private/bootstrap/app.php';
```

### 4.2 Subir Frontend
1. Copiar contenido de `frontend/dist/*` a `public_html/`

## Paso 5: Configuración Final

### 5.1 Configurar .env en producción
1. Copiar `.env.production` como `.env` en la carpeta `private/`
2. Generar nueva APP_KEY:
```bash
php artisan key:generate
```

### 5.2 Ejecutar Migraciones
```bash
cd private
php artisan migrate --force
```

### 5.3 Permisos de Carpetas
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

## Paso 6: Configurar Dominios

### 6.1 SSL Certificate
Activar SSL gratuito en Hostinger

### 6.2 Redirecciones .htaccess
Crear `.htaccess` en `public_html/`:
```apache
RewriteEngine On

# Redirigir API calls
RewriteRule ^api/(.*)$ api/index.php [QSA,L]

# Frontend routing (Vue Router)
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.html [L]
```

## Paso 7: Verificación y Testing

### 7.1 URLs a probar:
- https://tudominio.com (Frontend)
- https://tudominio.com/api/pages (Backend API)
- https://tudominio.com/admin (Admin panel)

### 7.2 Logs para debugging:
- `private/storage/logs/laravel.log`
- Panel de Control → Error Logs

## Comandos de Mantenimiento

### Limpiar cache:
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### Actualizar proyecto:
```bash
# Subir archivos actualizados
php artisan migrate
php artisan config:cache
php artisan route:cache
```