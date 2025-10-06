<template>
  <div v-if="show" class="modal-overlay" @click="$emit('close')">
    <div class="modal-content" @click.stop>
      <div class="media-picker-header">
        <h3>
          <i class="fas fa-images"></i>
          Seleccionar {{ typeFilter === 'image' ? 'Imagen' : 'Archivo' }}
        </h3>
        <div class="header-info">
          <span v-if="usingMockData" class="mock-data-badge">
            <i class="fas fa-flask"></i>
            Datos de prueba
          </span>
          <button @click="$emit('close')" class="btn-close">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      
      <div class="media-picker-controls">
        <div class="search-controls">
          <div class="search-input-group">
            <i class="fas fa-search"></i>
            <input
              v-model="searchQuery"
              type="text"
              placeholder="Buscar archivos..."
              class="search-input"
            />
          </div>
          <select v-model="typeFilter" class="filter-select">
            <option value="">Todos los archivos</option>
            <option value="image">Solo imágenes</option>
            <option value="video">Solo videos</option>
            <option value="document">Documentos</option>
          </select>
        </div>
        
        <div class="upload-controls">
          <input
            ref="fileInput"
            type="file"
            :accept="getAcceptAttribute()"
            multiple
            style="display: none"
            @change="handleFileSelect"
          />
          <button @click="openFileDialog" class="btn-upload">
            <i class="fas fa-cloud-upload-alt"></i>
            Subir Archivos
          </button>
        </div>
      </div>

      <div 
        class="media-grid-container"
        @dragover.prevent="isDragging = true"
        @dragleave.prevent="isDragging = false"
        @drop.prevent="handleFileDrop"
        :class="{ 'drag-over': isDragging }"
      >
        <!-- Overlay de drag & drop -->
        <div v-if="isDragging" class="drag-overlay">
          <div class="drag-content">
            <i class="fas fa-cloud-upload-alt"></i>
            <h4>Suelta los archivos aquí</h4>
            <p>Se subirán automáticamente</p>
          </div>
        </div>
        
        <div v-if="isLoading" class="loading-state">
          <i class="fas fa-spinner fa-spin"></i>
          <span>Cargando archivos...</span>
        </div>
        
        <!-- Estado de subida -->
        <div v-if="uploading" class="upload-progress">
          <div class="progress-header">
            <span>Subiendo {{ uploadQueue.length }} archivo(s)...</span>
            <span>{{ uploadProgress }}%</span>
          </div>
          <div class="progress-bar">
            <div class="progress-fill" :style="{ width: uploadProgress + '%' }"></div>
          </div>
        </div>
        
        <div v-else-if="filteredMedia.length === 0" class="empty-state">
          <i class="fas fa-folder-open"></i>
          <span v-if="mediaStore.error">
            Error al cargar archivos: {{ mediaStore.error }}
          </span>
          <span v-else-if="searchQuery || typeFilter">
            No se encontraron archivos con los filtros aplicados
          </span>
          <span v-else>
            No hay archivos disponibles. Sube archivos desde el gestor de medios.
          </span>
        </div>
        
        <div v-else class="media-grid">
          <div 
            v-for="media in filteredMedia" 
            :key="media.id"
            class="media-item"
            :class="{ 
              selected: isSelected(media),
              'is-image': media.type === 'image'
            }"
            @click="selectMedia(media)"
          >
            <div class="media-thumbnail">
              <img 
                v-if="media.type === 'image'" 
                :src="getThumbUrl(media)"
                :alt="media.alt_text || media.name"
                loading="lazy"
              />
              <div v-else class="file-placeholder">
                <i :class="getFileIcon(media.mime_type)"></i>
              </div>
            </div>
            <div class="media-info">
              <span class="media-name" :title="media.name">{{ media.name }}</span>
              <span class="media-size">{{ formatFileSize(media.size) }}</span>
            </div>
            <div v-if="isSelected(media)" class="selection-indicator">
              <i class="fas fa-check-circle"></i>
            </div>
          </div>
        </div>
      </div>
      
      <div class="modal-footer">
        <div class="selection-info">
          <span v-if="selectedMediaList.length > 0">
            {{ selectedMediaList.length }} archivo{{ selectedMediaList.length > 1 ? 's' : '' }} seleccionado{{ selectedMediaList.length > 1 ? 's' : '' }}
          </span>
        </div>
        <div class="action-buttons">
          <button @click="$emit('close')" class="btn-secondary">
            Cancelar
          </button>
          <button 
            @click="confirmSelection" 
            :disabled="selectedMediaList.length === 0"
            class="btn-primary"
          >
            <i class="fas fa-check"></i>
            Seleccionar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, watch, onMounted } from 'vue'
import { useMediaStore } from '@/stores/media'
import { buildMediaUrl } from '@/utils/mediaUtils'

interface Props {
  show: boolean
  selectedMedia: any[]
  typeFilter?: string
  multiple?: boolean
}

interface Emits {
  (e: 'close'): void
  (e: 'select', media: any | any[]): void
  (e: 'selectMedia', media: any): void
}

const props = withDefaults(defineProps<Props>(), {
  typeFilter: '',
  multiple: false
})

const emit = defineEmits<Emits>()

const mediaStore = useMediaStore()
const searchQuery = ref('')
const typeFilter = ref(props.typeFilter)
const isLoading = ref(false)
const usingMockData = ref(false)
const isDragging = ref(false)
const uploading = ref(false)
const uploadProgress = ref(0)
const uploadQueue = ref<File[]>([])
const fileInput = ref<HTMLInputElement | null>(null)
const selectedMediaList = ref<any[]>([])

const filteredMedia = computed(() => {
  let media = mediaStore.mediaList || []

  if (typeFilter.value) {
    media = media.filter(m => m.type === typeFilter.value)
  }

  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase()
    media = media.filter(m => 
      m.name.toLowerCase().includes(query) ||
      (m.alt_text && m.alt_text.toLowerCase().includes(query))
    )
  }

  return media
})

const isSelected = (media: any) => {
  return selectedMediaList.value.some(m => m.id === media.id)
}

const selectMedia = (media: any) => {
  if (props.multiple) {
    const currentIndex = selectedMediaList.value.findIndex(m => m.id === media.id)
    if (currentIndex >= 0) {
      // Remove if already selected
      selectedMediaList.value = selectedMediaList.value.filter(m => m.id !== media.id)
    } else {
      // Add to selection
      selectedMediaList.value = [...selectedMediaList.value, media]
    }
  } else {
    // Single selection - directly emit select for single mode
    selectedMediaList.value = [media]
    emit('select', media)
    return
  }
}

const confirmSelection = () => {
  if (selectedMediaList.value.length > 0) {
    const result = props.multiple ? selectedMediaList.value : selectedMediaList.value[0]
    emit('select', result)
  }
}

const getThumbUrl = (media: any) => {
  if (!media || !media.url) return ''
  
  // Log para debug
  console.group('🖼️ MediaPicker - URL Conversion Debug')
  console.log('Media URL original:', media.url)
  
  // Si es una URL completa, devolverla tal cual
  if (media.url.startsWith('http://') || media.url.startsWith('https://')) {
    console.log('URL completa detectada:', media.url)
    console.groupEnd()
    return media.url
  }
  
  // Para URLs del backend Laravel, construir URL completa
  if (media.url.includes('/storage/')) {
    const storagePath = media.url.split('/storage/')[1]
    const fullUrl = buildMediaUrl(media.url)
    console.log('URL completa construida:', fullUrl)
    console.groupEnd()
    return fullUrl
  }
  
  // Para URLs relativas, construir URL completa
  const url = media.url.startsWith('/') ? media.url : `/${media.url}`
  const finalUrl = buildMediaUrl(media.url)
  
  console.log('URL completa final:', finalUrl)
  console.groupEnd()
  
  return finalUrl
}

const getFileIcon = (mimeType: string) => {
  if (mimeType.startsWith('image/')) return 'fas fa-image'
  if (mimeType.startsWith('video/')) return 'fas fa-video'
  if (mimeType.includes('pdf')) return 'fas fa-file-pdf'
  if (mimeType.includes('word')) return 'fas fa-file-word'
  if (mimeType.includes('excel') || mimeType.includes('spreadsheet')) return 'fas fa-file-excel'
  return 'fas fa-file'
}

const formatFileSize = (bytes: number) => {
  if (bytes === 0) return '0 Bytes'
  const k = 1024
  const sizes = ['Bytes', 'KB', 'MB', 'GB']
  const i = Math.floor(Math.log(bytes) / Math.log(k))
  return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i]
}

const getAcceptAttribute = () => {
  switch (typeFilter.value) {
    case 'image':
      return 'image/*'
    case 'video':
      return 'video/*,.mp4,.webm,.ogg,.avi,.mov,.wmv,.flv,.mkv'
    case 'document':
      return '.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt'
    default:
      return '*'
  }
}

const loadMedia = async () => {
  if (mediaStore.mediaList.length === 0) {
    isLoading.value = true
    try {
      await mediaStore.fetchMedia()
    } catch (error) {
      console.error('Error loading media:', error)
      // En desarrollo, usar datos de prueba si falla la conexión
      if (import.meta.env.DEV) {
        useMockMediaData()
        usingMockData.value = true
      }
    } finally {
      isLoading.value = false
    }
  }
}

// Métodos de subida de archivos
const openFileDialog = () => {
  fileInput.value?.click()
}

const handleFileSelect = (event: Event) => {
  const target = event.target as HTMLInputElement
  if (target.files) {
    const files = Array.from(target.files)
    uploadFiles(files)
    target.value = '' // Reset input
  }
}

const handleFileDrop = (event: DragEvent) => {
  isDragging.value = false
  if (event.dataTransfer?.files) {
    const files = Array.from(event.dataTransfer.files)
    uploadFiles(files)
  }
}

const uploadFiles = async (files: File[]) => {
  if (files.length === 0) return
  
  // Filtrar archivos si hay filtro de tipo activo
  let filteredFiles = files
  if (typeFilter.value === 'image') {
    filteredFiles = files.filter(file => file.type.startsWith('image/'))
  }
  
  if (filteredFiles.length === 0) {
    alert('Los archivos seleccionados no coinciden con el filtro activo')
    return
  }
  
  uploadQueue.value = filteredFiles
  uploading.value = true
  uploadProgress.value = 0
  
  try {
    let completedFiles = 0
    
    for (const file of filteredFiles) {
      try {
        await mediaStore.uploadMedia(file)
        completedFiles++
        uploadProgress.value = Math.round((completedFiles / filteredFiles.length) * 100)
      } catch (error) {
        console.error('Error uploading file:', file.name, error)
      }
    }
    
    console.log(`✅ Subida completada: ${completedFiles}/${filteredFiles.length} archivos`)
    
    // Recargar lista de medios
    await mediaStore.fetchMedia()
    
  } catch (error) {
    console.error('Error during upload:', error)
  } finally {
    uploading.value = false
    uploadProgress.value = 0
    uploadQueue.value = []
  }
}

// Datos de prueba para desarrollo
const useMockMediaData = () => {
  const mockMedia = [
    {
      id: 1,
      name: 'imagen-demo-1.jpg',
      file_name: 'imagen-demo-1.jpg',
      mime_type: 'image/jpeg',
      extension: 'jpg',
      size: 245760,
      path: '/storage/media/2024/01/imagen-demo-1.jpg',
      url: '/storage/mock/test-image.svg',
      type: 'image' as const,
      alt_text: 'Imagen de demostración 1', 
      description: 'Imagen de prueba para desarrollo',
      created_at: '2024-01-15T10:00:00Z',
      updated_at: '2024-01-15T10:00:00Z'
    },
    {
      id: 2,
      name: 'imagen-demo-2.jpg',
      file_name: 'imagen-demo-2.jpg',
      mime_type: 'image/jpeg',
      extension: 'jpg',
      size: 312480,
      path: '/storage/media/2024/01/imagen-demo-2.jpg',
      url: '/storage/mock/imagen-demo-2.jpg',
      type: 'image' as const,
      alt_text: 'Imagen de demostración 2',
      description: 'Segunda imagen de prueba',
      created_at: '2024-01-15T11:00:00Z',
      updated_at: '2024-01-15T11:00:00Z'
    },
    {
      id: 3,
      name: 'logo-empresa.png',
      file_name: 'logo-empresa.png',
      mime_type: 'image/png',
      extension: 'png',
      size: 89024,
      path: '/storage/media/2024/01/logo-empresa.png',
      url: '/storage/mock/logo-empresa.png',
      type: 'image' as const,
      alt_text: 'Logo de la empresa',
      description: 'Logo corporativo',
      created_at: '2024-01-15T12:00:00Z',
      updated_at: '2024-01-15T12:00:00Z'
    },
    {
      id: 4,
      name: 'persona-consultor.jpg',
      file_name: 'persona-consultor.jpg',
      mime_type: 'image/jpeg',
      extension: 'jpg',
      size: 567890,
      path: '/storage/media/2024/01/persona-consultor.jpg',
      url: '/storage/mock/persona-consultor.jpg',
      type: 'image' as const,
      alt_text: 'Consultor financiero',
      description: 'Imagen de consultor para banner',
      created_at: '2024-01-15T13:00:00Z',
      updated_at: '2024-01-15T13:00:00Z'
    },
    {
      id: 5,
      name: 'icon-diagnostico.svg',
      file_name: 'icon-diagnostico.svg',
      mime_type: 'image/svg+xml',
      extension: 'svg',
      size: 12048,
      path: '/storage/media/2024/01/icon-diagnostico.svg',
      url: '/storage/mock/icon-diagnostico.svg',
      type: 'image' as const,
      alt_text: 'Icono diagnóstico',
      description: 'Icono para diagnóstico financiero',
      created_at: '2024-01-15T14:00:00Z',
      updated_at: '2024-01-15T14:00:00Z'
    },
    {
      id: 6,
      name: 'icon-asesoria.svg',
      file_name: 'icon-asesoria.svg',
      mime_type: 'image/svg+xml',
      extension: 'svg',
      size: 15632,
      path: '/storage/media/2024/01/icon-asesoria.svg',
      url: '/storage/mock/icon-asesoria.svg',
      type: 'image' as const,
      alt_text: 'Icono asesoría',
      description: 'Icono para asesoría personalizada',
      created_at: '2024-01-15T15:00:00Z',
      updated_at: '2024-01-15T15:00:00Z'
    },
    {
      id: 7,
      name: 'video-presentacion.mp4',
      file_name: 'video-presentacion.mp4',
      mime_type: 'video/mp4',
      extension: 'mp4',
      size: 15728640,
      path: '/storage/media/2024/01/video-presentacion.mp4',
      url: '/storage/mock/video-presentacion.mp4',
      type: 'video' as const,
      alt_text: 'Video de presentación corporativa',
      description: 'Video institucional de la empresa',
      created_at: '2024-01-15T16:00:00Z',
      updated_at: '2024-01-15T16:00:00Z'
    },
    {
      id: 8,
      name: 'tutorial-servicios.mp4',
      file_name: 'tutorial-servicios.mp4',
      mime_type: 'video/mp4',
      extension: 'mp4',
      size: 8912640,
      path: '/storage/media/2024/01/tutorial-servicios.mp4',
      url: '/storage/mock/tutorial-servicios.mp4',
      type: 'video' as const,
      alt_text: 'Tutorial de servicios',
      description: 'Video explicativo de nuestros servicios',
      created_at: '2024-01-15T17:00:00Z',
      updated_at: '2024-01-15T17:00:00Z'
    }
  ]
  
  // Inyectar datos mock directamente en el store
  mediaStore.mediaList = mockMedia
  console.log('📷 Usando datos de medios de prueba para desarrollo')
}

watch(() => props.show, (newShow) => {
  if (newShow) {
    loadMedia()
    selectedMediaList.value = [...props.selectedMedia] // Initialize with current selection
  } else {
    selectedMediaList.value = [] // Clear when closed
  }
})

onMounted(() => {
  if (props.show) {
    loadMedia()
  }
})
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.7);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
  padding: 1rem;
}

.modal-content {
  background: white;
  border-radius: 12px;
  width: 100%;
  max-width: 900px;
  max-height: 90vh;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.media-picker-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.5rem 2rem;
  border-bottom: 1px solid #e9ecef;
  background: #f8f9fa;
}

.header-info {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.media-picker-header h3 {
  margin: 0;
  color: #333;
  font-size: 1.25rem;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  flex: 1;
}

.btn-close {
  background: none;
  border: none;
  font-size: 1.25rem;
  color: #6c757d;
  cursor: pointer;
  padding: 0.5rem;
  border-radius: 6px;
  transition: all 0.2s ease;
}

.btn-close:hover {
  background: #e9ecef;
  color: #495057;
}

.mock-data-badge {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.25rem 0.75rem;
  background: #ffc107;
  color: #212529;
  border-radius: 12px;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
}

.mock-data-badge i {
  font-size: 0.875rem;
}

.media-picker-controls {
  padding: 1rem 2rem;
  border-bottom: 1px solid #e9ecef;
  background: white;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 2rem;
}

.search-controls {
  display: flex;
  gap: 1rem;
  align-items: center;
  flex: 1;
}

.upload-controls {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.search-input-group {
  flex: 1;
  position: relative;
}

.search-input-group i {
  position: absolute;
  left: 1rem;
  top: 50%;
  transform: translateY(-50%);
  color: #6c757d;
}

.search-input {
  width: 100%;
  padding: 0.75rem 1rem 0.75rem 2.5rem;
  border: 1px solid #ced4da;
  border-radius: 8px;
  font-size: 0.9rem;
}

.filter-select {
  padding: 0.75rem 1rem;
  border: 1px solid #ced4da;
  border-radius: 8px;
  background: white;
  min-width: 150px;
}

.btn-upload {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1.5rem;
  background: #28a745;
  color: white;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 0.9rem;
  font-weight: 600;
  transition: all 0.3s ease;
  white-space: nowrap;
}

.btn-upload:hover {
  background: #218838;
  transform: translateY(-1px);
}

.media-grid-container {
  flex: 1;
  overflow-y: auto;
  padding: 1rem 2rem;
  position: relative;
  transition: all 0.3s ease;
}

.media-grid-container.drag-over {
  background: rgba(40, 167, 69, 0.1);
  border: 2px dashed #28a745;
}

.drag-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(40, 167, 69, 0.9);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 10;
  border-radius: 8px;
}

.drag-content {
  text-align: center;
  color: white;
}

.drag-content i {
  font-size: 4rem;
  margin-bottom: 1rem;
  opacity: 0.9;
}

.drag-content h4 {
  margin: 0 0 0.5rem 0;
  font-size: 1.5rem;
  font-weight: 600;
}

.drag-content p {
  margin: 0;
  font-size: 1rem;
  opacity: 0.8;
}

.upload-progress {
  background: #e9ecef;
  border-radius: 8px;
  padding: 1rem;
  margin-bottom: 1rem;
}

.progress-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.5rem;
  font-size: 0.9rem;
  font-weight: 600;
  color: #495057;
}

.progress-bar {
  width: 100%;
  height: 8px;
  background: #dee2e6;
  border-radius: 4px;
  overflow: hidden;
}

.progress-fill {
  height: 100%;
  background: #28a745;
  border-radius: 4px;
  transition: width 0.3s ease;
}

.loading-state,
.empty-state {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 1rem;
  padding: 3rem 1rem;
  color: #6c757d;
}

.loading-state i {
  font-size: 2rem;
}

.empty-state i {
  font-size: 3rem;
  color: #dee2e6;
}

.media-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
  gap: 1rem;
}

.media-item {
  position: relative;
  border: 2px solid transparent;
  border-radius: 8px;
  overflow: hidden;
  cursor: pointer;
  transition: all 0.3s ease;
  background: #f8f9fa;
}

.media-item:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.media-item.selected {
  border-color: #007bff;
  box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
}

.media-thumbnail {
  aspect-ratio: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  background: #f8f9fa;
}

.media-thumbnail img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.file-placeholder {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100%;
  color: #6c757d;
  font-size: 2rem;
}

.media-info {
  padding: 0.75rem;
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}

.media-name {
  font-size: 0.8rem;
  font-weight: 500;
  color: #495057;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.media-size {
  font-size: 0.7rem;
  color: #6c757d;
}

.selection-indicator {
  position: absolute;
  top: 0.5rem;
  right: 0.5rem;
  background: #007bff;
  color: white;
  border-radius: 50%;
  width: 1.5rem;
  height: 1.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.8rem;
}

.modal-footer {
  padding: 1.5rem 2rem;
  border-top: 1px solid #e9ecef;
  background: #f8f9fa;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.selection-info {
  color: #6c757d;
  font-size: 0.9rem;
}

.action-buttons {
  display: flex;
  gap: 1rem;
}

.btn-primary,
.btn-secondary {
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.9rem;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  transition: all 0.3s ease;
}

.btn-primary {
  background: #007bff;
  color: white;
}

.btn-primary:hover:not(:disabled) {
  background: #0056b3;
  transform: translateY(-1px);
}

.btn-primary:disabled {
  background: #6c757d;
  cursor: not-allowed;
  opacity: 0.6;
}

.btn-secondary {
  background: #6c757d;
  color: white;
}

.btn-secondary:hover {
  background: #545b62;
  transform: translateY(-1px);
}

@media (max-width: 768px) {
  .modal-content {
    max-height: 95vh;
    margin: 1rem 0.5rem;
  }
  
  .media-picker-header {
    padding: 1rem 1.5rem;
  }
  
  .media-picker-controls {
    padding: 1rem 1.5rem;
    flex-direction: column;
    gap: 1rem;
  }
  
  .search-controls {
    flex-direction: column;
    gap: 0.5rem;
    width: 100%;
  }
  
  .upload-controls {
    width: 100%;
    justify-content: center;
  }
  
  .btn-upload {
    width: 100%;
    justify-content: center;
  }
  
  .media-grid-container {
    padding: 1rem 1.5rem;
  }
  
  .media-grid {
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 0.75rem;
  }
  
  .modal-footer {
    padding: 1rem 1.5rem;
    flex-direction: column;
    gap: 1rem;
  }
  
  .action-buttons {
    width: 100%;
    justify-content: stretch;
  }
  
  .btn-primary,
  .btn-secondary {
    flex: 1;
    justify-content: center;
  }
}
</style>