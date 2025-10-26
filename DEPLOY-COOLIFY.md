# Guía de Deployment en Coolify - Rintegra

## Estructura del Proyecto

Rintegra ha sido reestructurado de la siguiente manera:

```
rintegra/
├── cms/                          # Laravel Backend (anteriormente /backend)
│   ├── admin-panel/             # Vue.js Admin Panel (anteriormente /frontend)
│   │   ├── src/
│   │   ├── public/
│   │   ├── package.json
│   │   └── vite.config.ts
│   ├── app/
│   ├── public/
│   │   └── admin/               # Build del admin-panel (generado en deploy)
│   ├── resources/
│   ├── routes/
│   └── composer.json
├── docker/
│   ├── nginx-unified.conf       # Configuración Nginx
│   └── supervisord.conf         # Supervisor para PHP-FPM y Nginx
├── Dockerfile                   # Dockerfile principal
├── docker-compose.yml           # Configuración de servicios
└── .dockerignore
```

## Arquitectura

- **CMS (Laravel)**: Maneja el backend, API y renderizado de páginas públicas con Blade
- **Admin Panel (Vue)**: Panel de administración SPA que se construye y sirve desde `/admin`
- **Base de Datos**: MySQL 8.0
- **Servidor Web**: Nginx con PHP-FPM

## Deployment en Coolify

### 1. Requisitos Previos

- Cuenta en Coolify
- Repositorio Git configurado
- Variables de entorno preparadas

### 2. Variables de Entorno Requeridas

Crear un archivo `.env` en Coolify o configurar las siguientes variables:

```env
# App
APP_NAME=Rintegra
APP_ENV=production
APP_KEY=                          # Se genera automáticamente
APP_DEBUG=false
APP_URL=https://tu-dominio.com

# Database
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=rintegra
DB_USERNAME=rintegra
DB_PASSWORD=                      # Contraseña segura
DB_ROOT_PASSWORD=                 # Contraseña root MySQL

# Mail (Opcional)
MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=Rintegra

# Cache & Session
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

# Port (Coolify lo maneja automáticamente)
PORT=80
```

### 3. Configuración en Coolify

#### Paso 1: Crear Nueva Aplicación

1. En Coolify, ir a **Projects** → **New Resource**
2. Seleccionar **Docker Compose**
3. Conectar el repositorio: `https://github.com/Sebstepss/rintegra`
4. Branch: `main`

#### Paso 2: Configurar Build

- **Build Pack**: Docker Compose
- **Dockerfile**: `./Dockerfile`
- **Docker Compose**: `./docker-compose.yml`

#### Paso 3: Variables de Entorno

1. Ir a la pestaña **Environment**
2. Agregar todas las variables listadas arriba
3. Asegurarse de que `DB_HOST=db` (nombre del servicio en docker-compose)

#### Paso 4: Volúmenes Persistentes

Coolify automáticamente maneja los volúmenes definidos en `docker-compose.yml`:
- `db-data`: Base de datos MySQL
- `./cms/storage`: Archivos de Laravel
- `./cms/public/uploads`: Uploads de usuarios

#### Paso 5: Deploy

1. Click en **Deploy**
2. Esperar a que el build se complete (puede tomar 5-10 minutos la primera vez)
3. Verificar los logs en tiempo real

### 4. Post-Deployment

#### Verificar Health Check

El contenedor incluye un health check en `/api/health`. Verificar que responda correctamente:

```bash
curl https://tu-dominio.com/api/health
```

#### Ejecutar Migraciones (Primera vez)

Si necesitas ejecutar migraciones manualmente:

```bash
docker exec -it rintegra-app php artisan migrate --force
```

#### Crear Usuario Admin (Primera vez)

```bash
docker exec -it rintegra-app php artisan db:seed --class=UserSeeder
```

### 5. URLs de Acceso

- **Sitio Público**: `https://tu-dominio.com`
- **Admin Panel**: `https://tu-dominio.com/admin`
- **API**: `https://tu-dominio.com/api/*`
- **Storage**: `https://tu-dominio.com/storage/*`

## Troubleshooting

### Build Falla

1. Verificar logs de Coolify
2. Asegurar que todas las variables de entorno estén configuradas
3. Verificar que el repositorio sea accesible

### Base de Datos No Conecta

1. Verificar que `DB_HOST=db` (nombre del servicio)
2. Verificar credenciales de base de datos
3. Revisar logs: `docker logs rintegra-db`

### Admin Panel No Carga

1. Verificar que el build de Vue se completó correctamente
2. Revisar logs del contenedor
3. Verificar permisos en `/var/www/cms/public/admin`

### Permisos de Storage

Si hay problemas con archivos:

```bash
docker exec -it rintegra-app chown -R www:www /var/www/cms/storage
docker exec -it rintegra-app chmod -R 777 /var/www/cms/storage
```

## Actualizaciones

Para actualizar la aplicación:

1. Push los cambios al repositorio
2. En Coolify, click en **Redeploy**
3. Coolify automáticamente:
   - Hace pull del código nuevo
   - Reconstruye la imagen Docker
   - Ejecuta las migraciones si están configuradas
   - Reinicia los contenedores

## Backups

### Base de Datos

Coolify permite configurar backups automáticos. También puedes hacerlo manualmente:

```bash
docker exec rintegra-db mysqldump -u root -p rintegra > backup.sql
```

### Storage

Los volúmenes persistentes deben incluirse en el backup de Coolify o hacerlo manualmente.

## Optimizaciones

El Dockerfile ya incluye:
- ✅ Optimización de dependencias Composer
- ✅ Build de producción de Vue
- ✅ Cache de configuración de Laravel
- ✅ Compresión Gzip
- ✅ Health checks
- ✅ Logs dirigidos a stdout/stderr

## Soporte

Para problemas específicos de deployment:
- Revisar logs de Coolify
- Verificar configuración de Docker Compose
- Contactar soporte de Coolify si es necesario
