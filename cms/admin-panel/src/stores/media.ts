import { defineStore } from 'pinia'
import api, { mediaApi } from '@/services/api'

interface MediaMetadata {
  width?: number
  height?: number
  channels?: number
  bits?: number
}

interface Media {
  id: number
  name: string
  file_name: string
  mime_type: string
  extension: string
  size: number
  path: string
  url: string
  type: 'image' | 'video' | 'document' | 'other'
  metadata?: MediaMetadata
  uploaded_by?: number
  alt_text?: string
  description?: string
  created_at: string
  updated_at: string
  uploader?: {
    id: number
    name: string
    email: string
  }
}

interface MediaStats {
  total: number
  by_type: {
    image: number
    video: number
    document: number
    other: number
  }
  total_size: number
  recent_uploads: number
}

interface MediaPagination {
  current_page: number
  data: Media[]
  first_page_url: string
  from: number
  last_page: number
  last_page_url: string
  links: any[]
  next_page_url: string | null
  path: string
  per_page: number
  prev_page_url: string | null
  to: number
  total: number
}

interface FetchMediaParams {
  type?: string
  search?: string
  page?: number
  per_page?: number
  sort_by?: string
  sort_dir?: 'asc' | 'desc'
}

// Ya no necesitamos API_BASE_URL porque usamos la instancia api configurada

export const useMediaStore = defineStore('media', {
  state: () => ({
    mediaList: [] as Media[],
    pagination: null as MediaPagination | null,
    stats: null as MediaStats | null,
    currentMedia: null as Media | null,
    loading: false,
    error: null as string | null
  }),

  actions: {
    async fetchMedia(params: FetchMediaParams = {}) {
      this.loading = true
      this.error = null
      
      try {
        const response = await mediaApi.getAll(params)
        
        this.pagination = response.data
        this.mediaList = response.data.data
        
        return response.data
      } catch (error: any) {
        this.error = error.response?.data?.message || error.message || 'Error al cargar medios'
        throw error
      } finally {
        this.loading = false
      }
    },

    async fetchStats() {
      try {
        const response = await mediaApi.getStats()
        this.stats = response.data
        return response.data
      } catch (error: any) {
        this.error = error.response?.data?.message || error.message || 'Error al cargar estadísticas'
        throw error
      }
    },

    async uploadMedia(file: File, metadata?: { alt_text?: string; description?: string }) {
      const formData = new FormData()
      formData.append('file', file)
      
      if (metadata?.alt_text) formData.append('alt_text', metadata.alt_text)
      if (metadata?.description) formData.append('description', metadata.description)

      try {
        const response = await mediaApi.upload(formData)
        
        // Agregar nuevo medio al inicio de la lista
        this.mediaList.unshift(response.data)
        
        return response.data
      } catch (error: any) {
        this.error = error.response?.data?.message || error.message || 'Error al subir archivo'
        throw error
      }
    },

    async bulkUploadMedia(files: File[]) {
      const formData = new FormData()
      
      files.forEach((file, index) => {
        formData.append(`files[${index}]`, file)
      })

      try {
        const response = await mediaApi.bulkUpload(formData)
        
        // Agregar nuevos medios al inicio de la lista
        if (response.data.uploaded && response.data.uploaded.length > 0) {
          this.mediaList.unshift(...response.data.uploaded)
        }
        
        return response.data
      } catch (error: any) {
        this.error = error.response?.data?.message || error.message || 'Error al subir archivos'
        throw error
      }
    },

    async getMedia(id: number) {
      try {
        const response = await mediaApi.getById(id)
        this.currentMedia = response.data
        return response.data
      } catch (error: any) {
        this.error = error.response?.data?.message || error.message || 'Error al obtener medio'
        throw error
      }
    },

    async updateMedia(id: number, data: { alt_text?: string; description?: string }) {
      try {
        const response = await mediaApi.update(id, data)
        
        // Actualizar en la lista
        const index = this.mediaList.findIndex(m => m.id === id)
        if (index !== -1) {
          this.mediaList[index] = response.data
        }
        
        // Actualizar currentMedia si es el mismo
        if (this.currentMedia && this.currentMedia.id === id) {
          this.currentMedia = response.data
        }
        
        return response.data
      } catch (error: any) {
        this.error = error.response?.data?.message || error.message || 'Error al actualizar medio'
        throw error
      }
    },

    async deleteMedia(id: number) {
      try {
        await mediaApi.delete(id)
        
        // Eliminar de la lista
        this.mediaList = this.mediaList.filter(m => m.id !== id)
        
        // Limpiar currentMedia si es el mismo
        if (this.currentMedia && this.currentMedia.id === id) {
          this.currentMedia = null
        }
        
        return true
      } catch (error: any) {
        this.error = error.response?.data?.message || error.message || 'Error al eliminar medio'
        throw error
      }
    },

    // Utilidades
    getMediaById(id: number): Media | undefined {
      return this.mediaList.find(m => m.id === id)
    },

    getMediaByType(type: string): Media[] {
      return this.mediaList.filter(m => m.type === type)
    },

    clearError() {
      this.error = null
    },

    clearCurrentMedia() {
      this.currentMedia = null
    }
  },

  getters: {
    // Getter para obtener medios por tipo
    imageMedia: (state) => state.mediaList.filter(m => m.type === 'image'),
    videoMedia: (state) => state.mediaList.filter(m => m.type === 'video'),
    documentMedia: (state) => state.mediaList.filter(m => m.type === 'document'),
    otherMedia: (state) => state.mediaList.filter(m => m.type === 'other'),
    
    // Getter para obtener el tamaño total formateado
    formattedTotalSize: (state) => {
      if (!state.stats) return '0 B'
      
      const bytes = state.stats.total_size
      const k = 1024
      const sizes = ['B', 'KB', 'MB', 'GB', 'TB']
      const i = Math.floor(Math.log(bytes) / Math.log(k))
      
      return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i]
    },
    
    // Getter para verificar si hay medios cargados
    hasMedia: (state) => state.mediaList.length > 0,
    
    // Getter para verificar si está cargando
    isLoading: (state) => state.loading
  }
})