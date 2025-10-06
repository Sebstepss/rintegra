# 🚀 Deployment en Coolify - Guía Paso a Paso

## 📋 Pre-requisitos

- [x] VPS con Coolify instalado
- [x] Git repository (GitHub, GitLab, etc.)
- [x] Dominio apuntando al VPS (opcional, puedes usar IP)

---

## 🔧 Paso 1: Preparar el Repositorio

### 1. Inicializar Git (si no lo tienes)
```bash
cd d:\xampp\htdocs\rintegra
git init
git add .
git commit -m "Initial commit - Ready for Coolify deployment"
```

### 2. Subir a GitHub/GitLab
```bash
# Crear repo en GitHub primero, luego:
git remote add origin https://github.com/TU-USUARIO/rintegra.git
git branch -M main
git push -u origin main
```

### 3. Crear .gitignore en raíz (si no existe)
```gitignore
# Backend
backend/vendor/
backend/.env
backend/storage/logs/*
backend/storage/framework/cache/*
backend/storage/framework/sessions/*
backend/storage/framework/views/*
backend/node_modules/

# Frontend
frontend/node_modules/
frontend/dist/
frontend/.env

# General
.DS_Store
*.log
```

---

## 🐳 Paso 2: Configurar en Coolify

### 1. Acceder a Coolify
```
https://tu-vps-ip:8000
```

### 2. Crear Nuevo Proyecto
```
1. Click en "New Project"
2. Nombre: "rintegra"
3. Click "Create"
```

### 3. Agregar Nuevo Recurso
```
1. Click en "Add New Resource"
2. Selecciona "Docker Compose"
3. Source: "Git Repository"
```

### 4. Configurar Git Repository
```
Repository URL: https://github.com/TU-USUARIO/rintegra.git
Branch: main
Base Directory: /
Docker Compose Location: docker-compose.yml
```

### 5. Variables de Entorno
```
Click en "Environment Variables" y agrega:

# Base de Datos
DB_DATABASE=rintegra
DB_USERNAME=rintegra
DB_PASSWORD=TU_PASSWORD_SUPER_SEGURO

# Laravel
APP_NAME=RIntegra
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tudominio.com

# Generar APP_KEY
# En el VPS, ejecuta:
cd /ruta/al/proyecto/backend
php artisan key:generate --show
# Copia el resultado y agrégalo aquí:
APP_KEY=base64:EL_KEY_GENERADO_AQUI
```

---

## 🚢 Paso 3: Deploy

### 1. Configurar Build Command (Opcional)
```bash
# En Coolify, en "Build Pack Settings":
Build Command: ./deploy.sh
```

### 2. Iniciar Deployment
```
1. Click en "Deploy"
2. Espera a que termine (puede tomar 5-10 minutos)
3. Revisa los logs en tiempo real
```

---

## 🔍 Paso 4: Verificación

### 1. Verificar Contenedores
```bash
# SSH al VPS
ssh usuario@tu-vps-ip

# Ver contenedores corriendo
docker ps

# Deberías ver:
# - rintegra-backend
# - rintegra-frontend
# - rintegra-nginx
# - rintegra-db
```

### 2. Verificar Logs
```bash
# Backend logs
docker logs rintegra-backend

# Nginx logs
docker logs rintegra-nginx

# Base de datos
docker logs rintegra-db
```

### 3. Ejecutar Migraciones (primera vez)
```bash
# Entrar al contenedor backend
docker exec -it rintegra-backend sh

# Ejecutar migraciones
php artisan migrate --force

# Salir
exit
```

---

## 🌐 Paso 5: Configurar Dominio

### 1. En Coolify
```
1. Ve a tu proyecto
2. Click en "Domains"
3. Agrega tu dominio: "tudominio.com"
4. Coolify generará SSL automáticamente con Let's Encrypt
```

### 2. En tu Proveedor de Dominio
```
Tipo: A
Nombre: @ (o www)
Valor: IP_DE_TU_VPS
TTL: 3600
```

### 3. Esperar propagación DNS
```
# Verificar (puede tomar 5-60 minutos)
nslookup tudominio.com
```

---

## 🔄 Paso 6: Actualizar la Aplicación

### Método 1: Git Push (Automático)
```bash
# En tu local
git add .
git commit -m "Update feature X"
git push origin main

# Coolify detecta el cambio y redeploy automáticamente
```

### Método 2: Manual en Coolify
```
1. Ve a tu proyecto en Coolify
2. Click "Redeploy"
3. Espera a que termine
```

---

## 🐛 Troubleshooting

### Error: "APP_KEY not set"
```bash
docker exec -it rintegra-backend sh
php artisan key:generate --force
exit

# Luego restart
docker restart rintegra-backend
```

### Error: "Database connection refused"
```bash
# Verifica variables de entorno
docker exec -it rintegra-backend sh
cat .env | grep DB_

# Verifica que DB esté corriendo
docker ps | grep db
```

### Error: "Frontend no carga"
```bash
# Rebuild frontend
docker exec -it rintegra-frontend sh
npm run build
exit
```

### Ver logs en tiempo real
```bash
# Backend
docker logs -f rintegra-backend

# Nginx
docker logs -f rintegra-nginx
```

---

## 📊 Comandos Útiles

### Entrar a la base de datos
```bash
docker exec -it rintegra-db mysql -u rintegra -p
# Contraseña: LA_QUE_CONFIGURASTE
```

### Limpiar caché de Laravel
```bash
docker exec -it rintegra-backend sh
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
exit
```

### Ver uso de recursos
```bash
docker stats
```

### Backup de base de datos
```bash
docker exec rintegra-db mysqldump -u rintegra -p rintegra > backup-$(date +%Y%m%d).sql
```

---

## ✅ Checklist Post-Deployment

- [ ] Sitio carga correctamente en https://tudominio.com
- [ ] API funciona: https://tudominio.com/api/pages
- [ ] Sitemap accesible: https://tudominio.com/sitemap.xml
- [ ] SSL instalado (candado verde)
- [ ] Block editor funciona
- [ ] Cambios se reflejan al guardar
- [ ] Base de datos tiene datos
- [ ] Logs sin errores críticos

---

## 🎯 Optimizaciones Post-Deployment

### 1. Configurar Backups Automáticos
```bash
# En Coolify
Settings → Backups → Enable Automatic Backups
Frequency: Daily
Retention: 7 days
```

### 2. Monitoreo
```bash
# Coolify tiene monitoreo integrado
Settings → Monitoring → Enable
```

### 3. CDN (Opcional)
```
Cloudflare (gratis):
1. Agrega tu dominio a Cloudflare
2. Cambia nameservers
3. SSL/TLS: Full
4. Cache: Standard
```

---

## 📞 Soporte

Si algo falla:
1. Revisa logs: `docker logs -f NOMBRE_CONTENEDOR`
2. Verifica variables de entorno en Coolify
3. Consulta docs de Coolify: https://coolify.io/docs

---

**Fecha:** 2025-10-05
**Versión:** 1.0
**Estado:** ✅ Listo para deployment
