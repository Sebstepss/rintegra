import axios from 'axios'

const API_BASE_URL = import.meta.env.VITE_API_BASE_URL || 'http://localhost:8000'

export async function checkBackendStatus(): Promise<boolean> {
  try {
    const response = await axios.get(`${API_BASE_URL}/api/health`, {
      timeout: 3000
    })
    return response.status === 200
  } catch (error) {
    return false
  }
}

export function showBackendStatusMessage() {
  if (import.meta.env.DEV) {
    checkBackendStatus().then(isOnline => {
      if (!isOnline) {
        console.warn(`
🚨 Backend no disponible en ${API_BASE_URL}

Para desarrollar con datos reales:
1. Asegúrate de que el servidor Laravel esté ejecutándose en el puerto 8000
2. Ejecuta: php artisan serve --port=8000
3. Recarga la página

Mientras tanto, se están usando datos de prueba para el desarrollo.
        `)
      } else {
        console.log('✅ Backend conectado correctamente')
      }
    })
  }
}