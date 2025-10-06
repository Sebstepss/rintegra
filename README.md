# RIntegra - Sitio Web Dinámico con Editor de Contenido

Sistema de gestión de contenido web con editor TipTap, desarrollado con Vue.js y Laravel.

## Stack Tecnológico

### Backend
- **Laravel 12** - API REST
- **MySQL** - Base de datos
- **Eloquent ORM** - Modelos y relaciones

### Frontend
- **Vue 3** - Framework frontend
- **TipTap** - Editor WYSIWYG
- **Pinia** - Gestión de estado
- **Axios** - Cliente HTTP

## Configuración de Desarrollo

### Requisitos
- PHP 8.2+
- Node.js 18+
- MySQL
- XAMPP (recomendado)

### Instalación Backend (Laravel)

```bash
cd backend
composer install
php artisan key:generate
php artisan migrate
php artisan serve
```

### Instalación Frontend (Vue)

```bash
cd frontend
npm install
npm run dev
```

## Estructura de Base de Datos

### Tabla `pages`
- `id` - Primary Key
- `title` - Título de la página
- `slug` - URL amigable única
- `meta_description` - Meta descripción SEO
- `status` - Estado (draft/published)
- `timestamps` - Created/Updated

### Tabla `contents`
- `id` - Primary Key  
- `page_id` - Foreign Key a pages
- `content_type` - Tipo de contenido
- `content_data` - Datos JSON del contenido
- `order` - Orden de visualización
- `timestamps` - Created/Updated

## API Endpoints

### Páginas
- `GET /api/pages` - Listar páginas
- `GET /api/pages/{slug}` - Obtener página por slug
- `POST /api/pages` - Crear página
- `PUT /api/pages/{id}` - Actualizar página
- `DELETE /api/pages/{id}` - Eliminar página

### Contenidos
- `GET /api/contents` - Listar contenidos
- `GET /api/contents/{id}` - Obtener contenido
- `POST /api/contents` - Crear contenido
- `PUT /api/contents/{id}` - Actualizar contenido
- `DELETE /api/contents/{id}` - Eliminar contenido
- `PATCH /api/contents/update-order` - Actualizar orden

## Configuración CORS

El CORS está configurado para permitir:
- Orígenes: `http://localhost:5173`, `http://127.0.0.1:5173`
- Métodos: Todos (GET, POST, PUT, DELETE, etc.)
- Headers: Todos

## URLs de Desarrollo

- **Frontend**: http://localhost:5173
- **Backend API**: http://localhost:8000/api
- **Panel Admin**: http://localhost:5173/admin

## Características

✅ Editor WYSIWYG con TipTap  
✅ Gestión de páginas dinámicas  
✅ Contenido editable en tiempo real  
✅ API REST completa  
✅ Panel de administración  
✅ Base de datos MySQL  
✅ CORS configurado  
✅ Validación de datos  
✅ Relaciones Eloquent