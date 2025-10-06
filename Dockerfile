# Imagen base
FROM php:8.2-fpm-alpine

# Instalar dependencias
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

# Extensiones PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Usuario
RUN addgroup -g 1000 www && adduser -u 1000 -G www -s /bin/sh -D www

WORKDIR /var/www

# Copiar backend
COPY --chown=www:www ./backend /var/www/backend
WORKDIR /var/www/backend
RUN composer install --optimize-autoloader --no-dev --no-interaction

# Copiar frontend y buildearlo
COPY --chown=www:www ./frontend /var/www/frontend
WORKDIR /var/www/frontend
RUN npm install && npm run build

# Verificar que el build se generó y mover al public de Laravel
RUN ls -la /var/www/frontend/dist/ && \
    cp -r /var/www/frontend/dist/* /var/www/backend/public/ && \
    ls -la /var/www/backend/public/

# Volver a backend
WORKDIR /var/www/backend

# Copiar .env.example a .env y generar APP_KEY
RUN cp .env.example .env \
    && php artisan key:generate --force \
    && mkdir -p storage/app/public \
    && php artisan storage:link \
    && php artisan migrate --force \
    && php artisan config:cache

# Permisos
RUN chown -R www:www /var/www/backend \
    && chmod -R 775 /var/www/backend/storage \
    && chmod -R 775 /var/www/backend/bootstrap/cache \
    && chmod -R 777 /var/www/backend/storage/framework \
    && chmod -R 777 /var/www/backend/storage/logs

# Nginx config
COPY ./docker/nginx-unified.conf /etc/nginx/nginx.conf

# Supervisor config
COPY ./docker/supervisord.conf /etc/nginx/conf.d/supervisord.conf

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/nginx/conf.d/supervisord.conf"]
