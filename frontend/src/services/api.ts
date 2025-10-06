import axios from 'axios'

const api = axios.create({
  baseURL: import.meta.env.DEV
    ? 'http://localhost/rintegra/backend/public/api'  // Local XAMPP
    : 'https://r-integra.com/api',                    // Producción
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    'Cache-Control': 'no-cache',
    'Pragma': 'no-cache'
  }
})

// Interceptor para agregar token de autenticación y prevenir caché
api.interceptors.request.use((config) => {
  const token = localStorage.getItem('token')
  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  }

  // Agregar timestamp para evitar caché del navegador en peticiones GET
  if (config.method === 'get') {
    config.params = {
      ...config.params,
      _t: Date.now()
    }
  }

  return config
})

export const pagesApi = {
  getAll: () => api.get('/pages'),
  getNavigation: () => api.get('/pages/navigation'),
  getMainPages: () => api.get('/pages/main-pages'),
  getHomepage: () => api.get('/pages/homepage'),
  getById: (id: number) => api.get(`/pages/id/${id}`),
  getBySlug: (slug: string) => api.get(`/pages/${slug}`),
  create: (data: any) => api.post('/pages', data),
  update: (id: number, data: any) => api.put(`/pages/${id}`, data),
  updateOrder: (data: any) => api.patch('/pages/update-order', data),
  delete: (id: number) => api.delete(`/pages/${id}`)
}

export const contentsApi = {
  getAll: () => api.get('/contents'),
  getById: (id: number) => api.get(`/contents/${id}`),
  create: (data: any) => api.post('/contents', data),
  update: (id: number, data: any) => api.put(`/contents/${id}`, data),
  delete: (id: number) => api.delete(`/contents/${id}`),
  updateOrder: (data: any) => api.patch('/contents/update-order', data)
}

export const configsApi = {
  getActive: (type: string) => {
    console.log(`🌐 API: Solicitando configuración activa para tipo: ${type}`)
    return api.get(`/configs/${type}`).then(response => {
      console.log(`✅ API: Configuración ${type} obtenida:`, response.data)
      return response
    }).catch(error => {
      console.error(`❌ API: Error al obtener configuración ${type}:`, error)
      throw error
    })
  },
  save: (type: string, data: any, description?: string) => {
    console.log(`💾 API: Guardando configuración ${type}:`, data)
    return api.post(`/configs/${type}`, {
      config_data: data,
      description
    }).then(response => {
      console.log(`✅ API: Configuración ${type} guardada:`, response.data)
      return response
    }).catch(error => {
      console.error(`❌ API: Error al guardar configuración ${type}:`, error)
      throw error
    })
  },
  getVersions: (type: string) => api.get(`/configs/${type}/versions`),
  activateVersion: (type: string, version: number) => api.put(`/configs/${type}/activate`, { version }),
  getById: (id: number) => api.get(`/configs/id/${id}`),
  delete: (id: number) => api.delete(`/configs/id/${id}`)
}

export const formsApi = {
  // Envío de formularios desde el frontend
  submitForm: (type: string, data: any) => api.post(`/forms/submit`, {
    form_type: type,
    ...data
  }),
  
  // Gestión de formularios desde CRM (requiere autenticación)
  getAll: (filters?: any) => api.get('/forms', { params: filters }),
  getById: (id: number) => api.get(`/forms/${id}`),
  updateStatus: (id: number, status: string) => api.patch(`/forms/${id}/status`, { status }),
  reply: (id: number, replyData: any) => api.post(`/forms/${id}/reply`, replyData),
  markAllAsRead: () => api.patch('/forms/mark-all-read'),
  exportCsv: (filters?: any) => api.get('/forms/export', { 
    params: filters,
    responseType: 'blob'
  }),
  delete: (id: number) => api.delete(`/forms/${id}`)
}

export const usersApi = {
  getAll: (filters?: any) => api.get('/users', { params: filters }),
  getById: (id: number) => api.get(`/users/${id}`),
  create: (data: any) => api.post('/users', data),
  update: (id: number, data: any) => api.put(`/users/${id}`, data),
  delete: (id: number) => api.delete(`/users/${id}`),
  getRoles: () => api.get('/roles')
}

export const backupsApi = {
  getAll: (filters?: any) => api.get('/backups', { params: filters }),
  getById: (id: number) => api.get(`/backups/${id}`),
  create: (data: any) => api.post('/backups', data),
  update: (id: number, data: any) => api.put(`/backups/${id}`, data),
  delete: (id: number) => api.delete(`/backups/${id}`),
  download: (id: number) => api.get(`/backups/${id}/download`, {
    responseType: 'blob'
  }),
  restore: (id: number, data: any) => api.post(`/backups/${id}/restore`, data),
  cancel: (id: number) => api.post(`/backups/${id}/cancel`),
  getStats: () => api.get('/backups-stats')
}

export const mediaApi = {
  getAll: (filters?: any) => api.get('/media', { params: filters }),
  getById: (id: number) => api.get(`/media/${id}`),
  upload: (formData: FormData) => api.post('/media', formData, {
    headers: { 'Content-Type': 'multipart/form-data' }
  }),
  bulkUpload: (formData: FormData) => api.post('/media/bulk-upload', formData, {
    headers: { 'Content-Type': 'multipart/form-data' }
  }),
  update: (id: number, data: any) => api.put(`/media/${id}`, data),
  delete: (id: number) => api.delete(`/media/${id}`),
  getStats: () => api.get('/media-stats')
}

export default api