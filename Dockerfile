# Multi-stage build para optimizar la imagen
FROM php:8.2-fpm-alpine AS base

# Instalar dependencias del sistema
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip \
    mysql-client \
    nginx \
    supervisor \
    nodejs \
    npm

# Instalar extensiones PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Copiar configuración PHP personalizada
COPY ./docker/php.ini /usr/local/etc/php/conf.d/custom.ini

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear usuario no-root
RUN addgroup -g 1000 www && adduser -u 1000 -G www -s /bin/sh -D www

# Directorio de trabajo
WORKDIR /var/www

# ===== BACKEND (Laravel CMS) =====
# Copiar archivos del CMS
COPY --chown=www:www ./cms /var/www/cms

# Instalar dependencias de Composer
WORKDIR /var/www/cms
RUN composer install --optimize-autoloader --no-dev --no-interaction

# ===== FRONTEND (Vue Admin Panel) =====
# Copiar y construir admin-panel
COPY --chown=www:www ./cms/admin-panel /var/www/cms/admin-panel
WORKDIR /var/www/cms/admin-panel
RUN npm ci && npm run build

# Verificar que el build se generó y mover al public de Laravel
RUN ls -la /var/www/cms/admin-panel/dist/ && \
    mkdir -p /var/www/cms/public/admin && \
    cp -r /var/www/cms/admin-panel/dist/* /var/www/cms/public/admin/ && \
    ls -la /var/www/cms/public/admin/

# Volver al CMS
WORKDIR /var/www/cms

# NO copiar .env - Coolify inyecta las variables de entorno en runtime
# Crear .env mínimo solo para que Laravel no falle en build
RUN echo "APP_KEY=base64:dummy" > .env && \
    mkdir -p storage/app/public && \
    php artisan storage:link || true && \
    rm .env || true

# Permisos para Laravel
RUN chown -R www:www /var/www/cms && \
    chmod -R 755 /var/www/cms/storage && \
    chmod -R 755 /var/www/cms/bootstrap/cache && \
    chmod -R 777 /var/www/cms/storage/framework && \
    chmod -R 777 /var/www/cms/storage/logs && \
    chmod -R 777 /var/www/cms/storage/app/public

# Crear y dar permisos a carpetas temporales de Nginx
RUN mkdir -p /var/lib/nginx/tmp/client_body \
    /var/lib/nginx/tmp/proxy \
    /var/lib/nginx/tmp/fastcgi && \
    chown -R www:www /var/lib/nginx && \
    chmod -R 777 /var/lib/nginx/tmp

# Configurar Nginx
COPY ./docker/nginx-unified.conf /etc/nginx/nginx.conf

# Configurar Supervisor
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Exponer puerto
EXPOSE 80

# Health check desactivado - Coolify maneja sus propios health checks
# Si necesitas habilitarlo, descomenta las siguientes líneas:
# HEALTHCHECK --interval=30s --timeout=10s --start-period=120s --retries=5 \
#     CMD curl -f http://localhost/api/health || exit 1

# Comando de inicio
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
