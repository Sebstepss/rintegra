import axios from 'axios'
import fs from 'fs'

const API_URL = process.env.VITE_API_URL || 'http://localhost:8000/api'

async function getRoutes() {
  try {
    // Obtener todas las páginas del backend
    const response = await axios.get(`${API_URL}/pages`)
    const pages = response.data.data || response.data

    // Rutas estáticas base
    const routes = [
      '/',
    ]

    // Agregar rutas dinámicas de páginas
    pages.forEach(page => {
      if (page.slug && page.slug !== 'inicio') {
        routes.push(`/${page.slug}`)
      }
    })

    console.log('Rutas a pre-renderizar:', routes)
    return routes
  } catch (error) {
    console.error('Error obteniendo rutas:', error.message)
    // Fallback a rutas estáticas si falla la API
    return ['/']
  }
}

// Exportar para usar en vite.config
export { getRoutes }

// Ejecutar si se llama directamente
if (import.meta.url === `file://${process.argv[1]}`) {
  getRoutes().then(routes => {
    fs.writeFileSync(
      './prerender-routes.json',
      JSON.stringify(routes, null, 2)
    )
    console.log('Rutas guardadas en prerender-routes.json')
  })
}
