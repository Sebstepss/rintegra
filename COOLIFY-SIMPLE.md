# 🚀 Deploy en Coolify - Versión Simplificada

## ⚡ Configuración Rápida

### 1️⃣ **En Coolify - Crear Base de Datos**

```
1. Ve a tu proyecto en Coolify
2. Click "Add New Resource" → "Database" → "MySQL 8"
3. Configura:
   - Name: rintegra-db
   - Database Name: rintegra
   - Username: rintegra
   - Password: [genera uno seguro]
4. Guarda y espera que se cree
5. Copia la connection string que te da
```

### 2️⃣ **En Coolify - Crear Aplicación**

```
1. Click "Add New Resource" → "Application"
2. Source: Git Repository
3. Repository URL: https://github.com/Sebstepss/rintegra.git
4. Branch: main
5. Build Pack: Dockerfile
6. Dockerfile Location: ./Dockerfile
7. Ports: 80
```

### 3️⃣ **Variables de Entorno**

En la sección "Environment Variables", agrega:

```env
# App
APP_NAME=RIntegra
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tudominio.com

# Base de datos (usa los datos que te dio Coolify en paso 1)
DB_CONNECTION=mysql
DB_HOST=rintegra-db
DB_PORT=3306
DB_DATABASE=rintegra
DB_USERNAME=rintegra
DB_PASSWORD=el_password_que_pusiste

# Cache
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=database

# Generar APP_KEY:
# En tu local: cd backend && php artisan key:generate --show
# Copia el resultado aquí:
APP_KEY=base64:TU_KEY_GENERADO_AQUI
```

### 4️⃣ **Deploy**

```
1. Click "Deploy"
2. Espera 5-10 minutos
3. Revisa los logs
```

### 5️⃣ **Ejecutar Migraciones (Primera Vez)**

```bash
# SSH al VPS
ssh usuario@tu-vps-ip

# Buscar el contenedor
docker ps | grep rintegra

# Entrar al contenedor (usa el CONTAINER ID o NAME)
docker exec -it CONTAINER_ID sh

# Ir al directorio backend
cd /var/www/backend

# Ejecutar migraciones
php artisan migrate --force

# Optimizar
php artisan config:cache
php artisan route:cache

# Salir
exit
```

---

## 🐛 **Troubleshooting**

### Error: "Connection refused" (DB)
```bash
# Verifica que la DB está corriendo
docker ps | grep mysql

# Verifica las variables de entorno
docker exec -it TU_CONTENEDOR env | grep DB_
```

### Error: "APP_KEY not set"
```bash
# Generar key
docker exec -it TU_CONTENEDOR sh
cd /var/www/backend
php artisan key:generate --force
exit

# Luego reinicia el contenedor
docker restart TU_CONTENEDOR
```

### Ver logs
```bash
# Logs de la aplicación
docker logs -f TU_CONTENEDOR

# Logs de Nginx dentro del contenedor
docker exec -it TU_CONTENEDOR tail -f /var/log/nginx/error.log
```

---

## ✅ **Checklist**

- [ ] Repositorio Git actualizado con los nuevos archivos
- [ ] Base de datos MySQL creada en Coolify
- [ ] Aplicación creada con Dockerfile
- [ ] Variables de entorno configuradas
- [ ] Deploy ejecutado exitosamente
- [ ] Migraciones ejecutadas
- [ ] Sitio accesible

---

## 📝 **Comandos Útiles Post-Deploy**

```bash
# Limpiar cache
docker exec -it TU_CONTENEDOR sh -c "cd /var/www/backend && php artisan cache:clear"

# Ver estado
docker ps
docker stats TU_CONTENEDOR

# Reiniciar
docker restart TU_CONTENEDOR

# Backup DB
docker exec rintegra-db mysqldump -u rintegra -p rintegra > backup.sql
```

---

**Siguiente paso:** Sube los cambios a Git y configura en Coolify 🚀
