<template>
  <div class="media-manager">
    <!-- Header de la sección de medios -->
    <div class="section-header">
      <h2>
        Gestionar Medios
        <span v-if="usingMockData" class="mock-data-badge">
          <Icon name="flask" />
          Datos de prueba
        </span>
      </h2>
      <div class="header-actions">
        <select v-model="selectedType" class="type-filter" @change="fetchMedia">
          <option value="">Todos los tipos</option>
          <option value="image">Imágenes</option>
          <option value="video">Videos</option>
          <option value="document">Documentos</option>
          <option value="other">Otros</option>
        </select>
        <div class="search-box">
          <input 
            v-model="searchTerm" 
            @input="searchMedia"
            placeholder="Buscar medios..." 
            class="search-input"
          />
          <Icon name="search" class="search-icon" />
        </div>
        <button @click="showUploadModal = true" class="btn-primary">
          <Icon name="upload" />
          Subir Archivos
        </button>
      </div>
    </div>

    <!-- Estadísticas de medios -->
    <div class="media-stats" v-if="stats">
      <div class="stat-card">
        <div class="stat-icon">
          <Icon name="document" />
        </div>
        <div class="stat-content">
          <h3>{{ stats.total }}</h3>
          <p>Total de Archivos</p>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">
          <Icon name="photo" />
        </div>
        <div class="stat-content">
          <h3>{{ stats.by_type.image }}</h3>
          <p>Imágenes</p>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">
          <Icon name="video" />
        </div>
        <div class="stat-content">
          <h3>{{ stats.by_type.video }}</h3>
          <p>Videos</p>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">
          <Icon name="document-text" />
        </div>
        <div class="stat-content">
          <h3>{{ stats.by_type.document }}</h3>
          <p>Documentos</p>
        </div>
      </div>
    </div>

    <!-- Loading -->
    <div v-if="loading" class="loading">
      <Icon name="refresh" class="animate-spin" />
      Cargando medios...
    </div>

    <!-- Grid de medios -->
    <div v-else class="media-grid">
      <div v-for="media in mediaList" :key="media.id" class="media-card">
        <!-- Previsualización del archivo -->
        <div class="media-preview">
          <img 
            v-if="media.type === 'image'" 
            :src="getFullUrl(media.url)" 
            :alt="media.alt_text || media.name"
            class="preview-image"
            @error="handleImageError"
          />
          <div v-else-if="media.type === 'video'" class="preview-video">
            <Icon name="video" class="preview-icon" />
            <span class="file-extension">.{{ media.extension }}</span>
          </div>
          <div v-else-if="media.type === 'document'" class="preview-document">
            <Icon name="document-text" class="preview-icon" />
            <span class="file-extension">.{{ media.extension }}</span>
          </div>
          <div v-else class="preview-other">
            <Icon name="document" class="preview-icon" />
            <span class="file-extension">.{{ media.extension }}</span>
          </div>
        </div>

        <!-- Información del archivo -->
        <div class="media-info">
          <h4 class="media-name" :title="media.name">{{ truncateName(media.name) }}</h4>
          <p class="media-details">
            <span class="file-size">{{ formatFileSize(media.size) }}</span>
            <span class="file-type">{{ media.type }}</span>
          </p>
          <p class="media-date">{{ formatDate(media.created_at) }}</p>
          
          <!-- Metadatos para imágenes -->
          <div v-if="media.type === 'image' && media.metadata" class="image-metadata">
            {{ media.metadata.width }} x {{ media.metadata.height }}px
          </div>
        </div>

        <!-- Acciones -->
        <div class="media-actions">
          <button @click="viewMedia(media)" class="btn-action" title="Ver">
            <Icon name="eye" />
          </button>
          <button @click="copyUrl(media)" class="btn-action" title="Copiar URL">
            <Icon name="link" />
          </button>
          <button @click="editMedia(media)" class="btn-action" title="Editar">
            <Icon name="edit" />
          </button>
          <button @click="deleteMedia(media)" class="btn-action btn-danger" title="Eliminar">
            <Icon name="delete" />
          </button>
        </div>
      </div>
    </div>

    <!-- Paginación -->
    <div v-if="pagination && pagination.last_page > 1" class="pagination">
      <button 
        @click="changePage(pagination.current_page - 1)"
        :disabled="pagination.current_page <= 1"
        class="btn-secondary btn-sm"
      >
        <Icon name="chevron-left" />
        Anterior
      </button>
      
      <span class="page-info">
        Página {{ pagination.current_page }} de {{ pagination.last_page }}
      </span>
      
      <button 
        @click="changePage(pagination.current_page + 1)"
        :disabled="pagination.current_page >= pagination.last_page"
        class="btn-secondary btn-sm"
      >
        Siguiente
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>

    <!-- Modal de subida -->
    <MediaUploadModal
      v-if="showUploadModal"
      @close="showUploadModal = false"
      @uploaded="handleMediaUploaded"
    />

    <!-- Modal de edición -->
    <MediaEditModal
      v-if="showEditModal && selectedMedia"
      :media="selectedMedia"
      @close="showEditModal = false"
      @updated="handleMediaUpdated"
    />

    <!-- Modal de vista previa -->
    <MediaViewModal
      v-if="showViewModal && selectedMedia"
      :media="selectedMedia"
      @close="showViewModal = false"
    />
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import { useMediaStore } from '@/stores/media'
import MediaUploadModal from './MediaUploadModal.vue'
import MediaEditModal from './MediaEditModal.vue'
import MediaViewModal from './MediaViewModal.vue'

const mediaStore = useMediaStore()

// Estado reactivo
const loading = ref(false)
const selectedType = ref('')
const searchTerm = ref('')
const showUploadModal = ref(false)
const showEditModal = ref(false)
const showViewModal = ref(false)
const selectedMedia = ref(null)
const usingMockData = ref(false)

// Computadas
const mediaList = computed(() => mediaStore.mediaList)
const pagination = computed(() => mediaStore.pagination)
const stats = computed(() => mediaStore.stats)

// Lifecycle
onMounted(() => {
  fetchMedia()
  fetchStats()
})

// Métodos
const fetchMedia = async (page = 1) => {
  loading.value = true
  try {
    await mediaStore.fetchMedia({
      type: selectedType.value,
      search: searchTerm.value,
      page
    })
  } catch (error) {
    console.error('Error loading media:', error)
    // Fallback a datos de prueba en desarrollo
    if (import.meta.env.DEV) {
      useMockMediaData()
      usingMockData.value = true
    }
  } finally {
    loading.value = false
  }
}

const fetchStats = async () => {
  try {
    await mediaStore.fetchStats()
  } catch (error) {
    console.error('Error loading media stats:', error)
    // Fallback a estadísticas mock en desarrollo
    if (import.meta.env.DEV && usingMockData.value) {
      useMockStats()
    }
  }
}

const searchMedia = () => {
  // Debounce search
  clearTimeout(window.mediaSearchTimeout)
  window.mediaSearchTimeout = setTimeout(() => {
    fetchMedia()
  }, 300)
}

const changePage = (page) => {
  if (page >= 1 && page <= pagination.value.last_page) {
    fetchMedia(page)
  }
}

const viewMedia = (media) => {
  selectedMedia.value = media
  showViewModal.value = true
}

const editMedia = (media) => {
  selectedMedia.value = media
  showEditModal.value = true
}

const copyUrl = async (media) => {
  try {
    await navigator.clipboard.writeText(getFullUrl(media.url))
    showSuccessMessage('URL copiada al portapapeles')
  } catch (err) {
    showErrorMessage('Error al copiar URL')
  }
}

const showSuccessMessage = (message) => {
  // Aquí podrías integrar un sistema de notificaciones toast más sofisticado
  alert('✅ ' + message)
}

const showErrorMessage = (message) => {
  alert('❌ ' + message)
}

const deleteMedia = async (media) => {
  if (confirm(`¿Estás seguro de eliminar "${media.name}"? Esta acción no se puede deshacer.`)) {
    try {
      if (usingMockData.value) {
        // Eliminar directamente del store para datos mock
        mediaStore.mediaList = mediaStore.mediaList.filter(m => m.id !== media.id)
        
        // Actualizar estadísticas mock
        if (mediaStore.stats) {
          mediaStore.stats.total -= 1
          if (mediaStore.stats.by_type[media.type] > 0) {
            mediaStore.stats.by_type[media.type] -= 1
          }
          mediaStore.stats.total_size = Math.max(0, mediaStore.stats.total_size - media.size)
        }
        
        console.log(`🗑️ MediaManager: Archivo mock "${media.name}" eliminado`)
        showSuccessMessage(`Archivo "${media.name}" eliminado correctamente`)
      } else {
        // Usar la función del store para datos reales
        await mediaStore.deleteMedia(media.id)
        await fetchMedia()
        await fetchStats()
        showSuccessMessage(`Archivo "${media.name}" eliminado correctamente`)
      }
    } catch (error) {
      console.error('Error al eliminar archivo:', error)
      showErrorMessage('Error al eliminar el archivo: ' + (error?.message || 'Error desconocido'))
    }
  }
}

const handleMediaUploaded = () => {
  fetchMedia()
  fetchStats()
}

const handleMediaUpdated = () => {
  fetchMedia()
}

// Importar utilidad centralizada
import { buildMediaUrl } from '@/utils/mediaUtils'

// Utilidades
const getFullUrl = (url) => {
  // Log para debug
  console.log('🖼️ MediaManager - URL original:', url)
  const fullUrl = buildMediaUrl(url)
  console.log('URL completa construida:', fullUrl)
  return fullUrl
}

const truncateName = (name, maxLength = 20) => {
  if (name.length <= maxLength) return name
  return name.substring(0, maxLength) + '...'
}

const formatFileSize = (bytes) => {
  if (!bytes) return '0 B'
  const k = 1024
  const sizes = ['B', 'KB', 'MB', 'GB']
  const i = Math.floor(Math.log(bytes) / Math.log(k))
  return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i]
}

const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString('es-ES', {
    year: 'numeric',
    month: 'short',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  })
}

const handleImageError = (event) => {
  event.target.style.display = 'none'
  event.target.nextElementSibling?.classList.add('error')
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
      type: 'image',
      alt_text: 'Imagen de demostración 1', 
      description: 'Imagen de prueba para desarrollo',
      metadata: { width: 800, height: 600 },
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
      type: 'image',
      alt_text: 'Imagen de demostración 2',
      description: 'Segunda imagen de prueba',
      metadata: { width: 1024, height: 768 },
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
      type: 'image',
      alt_text: 'Logo de la empresa',
      description: 'Logo corporativo',
      metadata: { width: 200, height: 100 },
      created_at: '2024-01-15T12:00:00Z',
      updated_at: '2024-01-15T12:00:00Z'
    },
    {
      id: 4,
      name: 'documento-ejemplo.pdf',
      file_name: 'documento-ejemplo.pdf',
      mime_type: 'application/pdf',
      extension: 'pdf',
      size: 1048576,
      path: '/storage/media/2024/01/documento-ejemplo.pdf',
      url: '/storage/mock/documento-ejemplo.pdf',
      type: 'document',
      alt_text: 'Documento de ejemplo',
      description: 'Documento PDF de prueba',
      created_at: '2024-01-15T13:00:00Z',
      updated_at: '2024-01-15T13:00:00Z'
    },
    {
      id: 5,
      name: 'video-presentacion.mp4',
      file_name: 'video-presentacion.mp4',
      mime_type: 'video/mp4',
      extension: 'mp4',
      size: 5242880,
      path: '/storage/media/2024/01/video-presentacion.mp4',
      url: '/storage/mock/video-presentacion.mp4',
      type: 'video',
      alt_text: 'Video de presentación',
      description: 'Video corporativo de prueba',
      created_at: '2024-01-15T14:00:00Z',
      updated_at: '2024-01-15T14:00:00Z'
    }
  ]
  
  // Inyectar datos mock directamente en el store
  mediaStore.mediaList = mockMedia
  
  // Mock pagination
  mediaStore.pagination = {
    current_page: 1,
    last_page: 1,
    per_page: 20,
    total: mockMedia.length,
    data: mockMedia
  }
  
  console.log('📷 MediaManager: Usando datos de medios de prueba para desarrollo')
}

const useMockStats = () => {
  mediaStore.stats = {
    total: 5,
    by_type: {
      image: 3,
      video: 1,
      document: 1,
      other: 0
    },
    total_size: 7298560
  }
  console.log('📊 MediaManager: Usando estadísticas de prueba para desarrollo')
}
</script>

<style scoped>
.media-manager {
  width: 100%;
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
  flex-wrap: wrap;
  gap: 1rem;
}

.section-header h2 {
  color: #2c3e50;
  margin: 0;
}

.header-actions {
  display: flex;
  align-items: center;
  gap: 1rem;
  flex-wrap: wrap;
}

.type-filter {
  padding: 0.5rem;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 0.9rem;
}

.search-box {
  position: relative;
}

.search-input {
  padding: 0.5rem 2.5rem 0.5rem 1rem;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 0.9rem;
  min-width: 200px;
}

.search-icon {
  position: absolute;
  right: 0.75rem;
  top: 50%;
  transform: translateY(-50%);
  color: #6c757d;
}

.media-stats {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1.5rem;
  margin-bottom: 3rem;
}

.stat-card {
  background: white;
  border-radius: 12px;
  padding: 1.5rem;
  display: flex;
  align-items: center;
  gap: 1rem;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  border: 1px solid #e9ecef;
}

.stat-icon {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: linear-gradient(135deg, #007bff, #0056b3);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 1.2rem;
}

.stat-content h3 {
  font-size: 2rem;
  font-weight: 700;
  margin: 0;
  color: #2c3e50;
}

.stat-content p {
  margin: 0;
  color: #6c757d;
  font-size: 0.9rem;
}

.loading {
  text-align: center;
  padding: 3rem;
  color: #6c757d;
}

.loading i {
  font-size: 2rem;
  margin-bottom: 1rem;
  display: block;
}

.media-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
  gap: 1.5rem;
}

.media-card {
  background: white;
  border: 1px solid #e9ecef;
  border-radius: 12px;
  padding: 0.5rem;
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
}

.media-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.media-preview {
  border: #dde3e9 1px solid;
  height: 160px;
  background: #f8f9fa;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1rem;
  overflow: hidden;
  position: relative;
}

.preview-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 8px;
}

.preview-video,
.preview-document,
.preview-other {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
}

.preview-icon {
  font-size: 3rem;
  color: #6c757d;
}

.file-extension {
  background: #007bff;
  color: white;
  padding: 0.25rem 0.5rem;
  border-radius: 4px;
  font-size: 0.75rem;
  font-weight: 500;
  text-transform: uppercase;
}

.media-info {
  flex: 1;
  margin-bottom: 1rem;
}

.media-name {
  margin: 0 0 0 0;
  font-size: 1rem;
  font-weight: 600;
  color: #2c3e50;
}

.media-details {
  margin: 0 0 0 0;
  font-size: 0.65rem;
  color: #ffffff;
  padding: 0.1rem 0.3rem ;
  display: inline-flex;
  border-radius: 9px;
  background-color: #b4d1f0;
}

.file-size::after {
  content: ' • ';
  margin: 0 0.25rem;
}

.media-date {
  margin: 0 0 0 0;
  font-size: 0.8rem;
  color: #6c757d;
}

.image-metadata {
  font-size: 0.8rem;
  color: #829cb8;
  font-weight: 500;
}

.media-actions {
  display: flex;
  gap: 0.5rem;
  justify-content: flex-end;
  margin-top: auto;
}

.btn-action {
  width: 32px;
  height: 32px;
  border: none;
  border-radius: 6px;
  background: #f8f9fa;
  color: #6c757d;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s;
}

.btn-action:hover {
  background: #e9ecef;
  transform: scale(1.1);
}

.btn-action.btn-danger {
  background: #ffe6e6;
  color: #dc3545;
}

.btn-action.btn-danger:hover {
  background: #ffcccc;
}

.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 1rem;
  margin-top: 2rem;
  padding: 1rem;
}

.page-info {
  color: #6c757d;
  font-size: 0.9rem;
}

.btn-primary, .btn-secondary {
  padding: 0.5rem 1rem;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.875rem;
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  transition: all 0.2s;
}

.btn-sm {
  padding: 0.375rem 0.75rem;
  font-size: 0.75rem;
}

.btn-primary {
  background-color: #007bff;
  color: white;
}

.btn-primary:hover {
  background-color: #0056b3;
}

.btn-secondary {
  background-color: #6c757d;
  color: white;
}

.btn-secondary:hover:not(:disabled) {
  background-color: #545b62;
}

.btn-secondary:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.mock-data-badge {
  background: linear-gradient(135deg, #ff6b6b, #ee5a24);
  color: white;
  padding: 0.25rem 0.75rem;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 500;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  box-shadow: 0 2px 8px rgba(255, 107, 107, 0.3);
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0% { opacity: 1; }
  50% { opacity: 0.7; }
  100% { opacity: 1; }
}

.section-header h2 {
  display: flex;
  align-items: center;
  gap: 1rem;
}

@media (max-width: 768px) {
  .section-header {
    flex-direction: column;
    align-items: stretch;
  }

  .header-actions {
    flex-direction: column;
    gap: 0.5rem;
  }

  .search-input {
    min-width: 100%;
  }

  .media-stats {
    grid-template-columns: 1fr;
  }

  .media-grid {
    grid-template-columns: 1fr;
  }
}
</style>