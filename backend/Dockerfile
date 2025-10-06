# Multi-stage build para optimizar imagen
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
    supervisor

# Instalar extensiones PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear usuario no-root
RUN addgroup -g 1000 www && adduser -u 1000 -G www -s /bin/sh -D www

# Directorio de trabajo
WORKDIR /var/www

# Copiar archivos de la aplicación
COPY --chown=www:www . .

# Instalar dependencias de Composer
RUN composer install --optimize-autoloader --no-dev --no-interaction

# Permisos
RUN chown -R www:www /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache

# Configurar Nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Configurar Supervisor
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Exponer puerto
EXPOSE 80

# Comando de inicio
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
