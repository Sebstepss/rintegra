<template>
  <div class="modal-overlay" @click="closeModal">
    <div class="modal-content" @click.stop :class="{ 'fullscreen': isFullscreen }">
      <div class="modal-header" v-if="!isFullscreen">
        <h3>{{ media.name }}</h3>
        <div class="header-actions">
          <button @click="toggleFullscreen" class="btn-action" title="Pantalla completa">
            <i class="fas fa-expand"></i>
          </button>
          <button @click="closeModal" class="btn-close">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>

      <!-- Overlay para pantalla completa -->
      <div v-if="isFullscreen" class="fullscreen-overlay">
        <button @click="toggleFullscreen" class="btn-fullscreen-close">
          <i class="fas fa-compress"></i>
        </button>
      </div>

      <div class="modal-body" :class="{ 'fullscreen-body': isFullscreen }">
        <!-- Vista previa principal -->
        <div class="media-display" :class="{ 'fullscreen-display': isFullscreen }">
          
          <!-- Imágenes -->
          <div v-if="media.type === 'image'" class="image-container">
            <img 
              :src="getFullUrl(media.url)" 
              :alt="media.alt_text || media.name"
              class="main-image"
              @load="handleImageLoad"
              @error="handleImageError"
            />
            <div v-if="imageLoading" class="image-loading">
              <i class="fas fa-spinner fa-spin"></i>
              Cargando imagen...
            </div>
          </div>

          <!-- Videos -->
          <div v-else-if="media.type === 'video'" class="video-container">
            <video 
              :src="getFullUrl(media.url)" 
              controls 
              class="main-video"
              preload="metadata"
              @loadstart="handleVideoLoad"
              @error="handleVideoError"
            >
              Tu navegador no soporta la reproducción de video.
            </video>
          </div>

          <!-- Documentos y otros archivos -->
          <div v-else class="document-container">
            <div class="document-preview">
              <i :class="getFileIcon(media.mime_type)" class="document-icon"></i>
              <div class="document-info">
                <h4>{{ media.name }}</h4>
                <p class="document-details">
                  {{ getFileTypeLabel(media.type) }} • {{ formatFileSize(media.size) }} • {{ media.extension.toUpperCase() }}
                </p>
                <div class="document-actions">
                  <a 
                    :href="getFullUrl(media.url)" 
                    target="_blank" 
                    rel="noopener noreferrer"
                    class="btn-primary"
                  >
                    <i class="fas fa-external-link-alt"></i>
                    Abrir en nueva pestaña
                  </a>
                  <a 
                    :href="getFullUrl(media.url)" 
                    :download="media.name"
                    class="btn-secondary"
                  >
                    <i class="fas fa-download"></i>
                    Descargar
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Información del archivo (solo visible en modo normal) -->
        <div v-if="!isFullscreen" class="media-info">
          
          <!-- Metadatos básicos -->
          <div class="info-section">
            <h4>Información del Archivo</h4>
            <div class="info-grid">
              <div class="info-item">
                <span class="info-label">Nombre:</span>
                <span class="info-value">{{ media.name }}</span>
              </div>
              <div class="info-item">
                <span class="info-label">Tipo:</span>
                <span class="info-value">{{ getFileTypeLabel(media.type) }}</span>
              </div>
              <div class="info-item">
                <span class="info-label">Tamaño:</span>
                <span class="info-value">{{ formatFileSize(media.size) }}</span>
              </div>
              <div class="info-item">
                <span class="info-label">Formato:</span>
                <span class="info-value">{{ media.mime_type }}</span>
              </div>
            </div>
          </div>

          <!-- Metadatos específicos de imagen -->
          <div v-if="media.type === 'image' && media.metadata" class="info-section">
            <h4>Propiedades de Imagen</h4>
            <div class="info-grid">
              <div class="info-item">
                <span class="info-label">Dimensiones:</span>
                <span class="info-value">{{ media.metadata.width }} × {{ media.metadata.height }} píxeles</span>
              </div>
              <div v-if="media.metadata.channels" class="info-item">
                <span class="info-label">Canales:</span>
                <span class="info-value">{{ media.metadata.channels }}</span>
              </div>
              <div v-if="media.metadata.bits" class="info-item">
                <span class="info-label">Profundidad:</span>
                <span class="info-value">{{ media.metadata.bits }} bits</span>
              </div>
            </div>
          </div>

          <!-- Información adicional -->
          <div class="info-section">
            <h4>Detalles Adicionales</h4>
            <div class="info-grid">
              <div v-if="media.alt_text" class="info-item full-width">
                <span class="info-label">Texto Alternativo:</span>
                <span class="info-value">{{ media.alt_text }}</span>
              </div>
              <div v-if="media.description" class="info-item full-width">
                <span class="info-label">Descripción:</span>
                <span class="info-value">{{ media.description }}</span>
              </div>
              <div class="info-item">
                <span class="info-label">Subido:</span>
                <span class="info-value">{{ formatDate(media.created_at) }}</span>
              </div>
              <div v-if="media.uploader" class="info-item">
                <span class="info-label">Por:</span>
                <span class="info-value">{{ media.uploader.name }}</span>
              </div>
            </div>
          </div>

          <!-- URL y acciones -->
          <div class="info-section">
            <h4>URL del Archivo</h4>
            <div class="url-container">
              <input 
                :value="getFullUrl(media.url)" 
                readonly 
                class="url-input"
                ref="urlInput"
              />
              <button @click="copyUrl" class="btn-copy">
                <i class="fas fa-copy"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

      <div v-if="!isFullscreen" class="modal-footer">
        <div class="footer-info">
          <span class="file-path">{{ media.path }}</span>
        </div>
        <div class="footer-actions">
          <a 
            :href="getFullUrl(media.url)" 
            :download="media.name"
            class="btn-secondary"
          >
            <i class="fas fa-download"></i>
            Descargar
          </a>
          <button @click="$emit('edit', media)" class="btn-primary">
            <i class="fas fa-edit"></i>
            Editar
          </button>
        </div>
      </div>

      <!-- Mensaje de estado -->
      <div v-if="statusMessage" class="status-message" :class="statusMessage.type">
        {{ statusMessage.text }}
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { buildMediaUrl } from '@/utils/mediaUtils'

const props = defineProps({
  media: {
    type: Object,
    required: true
  }
})

const emit = defineEmits(['close', 'edit'])

// Estado reactivo
const isFullscreen = ref(false)
const imageLoading = ref(true)
const statusMessage = ref(null)
const urlInput = ref(null)

// Lifecycle
onMounted(() => {
  document.addEventListener('keydown', handleKeyDown)
})

onUnmounted(() => {
  document.removeEventListener('keydown', handleKeyDown)
})

// Métodos
const closeModal = () => {
  emit('close')
}

const toggleFullscreen = () => {
  isFullscreen.value = !isFullscreen.value
}

const handleKeyDown = (event) => {
  if (event.key === 'Escape') {
    if (isFullscreen.value) {
      isFullscreen.value = false
    } else {
      closeModal()
    }
  } else if (event.key === 'f' || event.key === 'F') {
    if (props.media.type === 'image' || props.media.type === 'video') {
      toggleFullscreen()
    }
  }
}

const handleImageLoad = () => {
  imageLoading.value = false
}

const handleImageError = () => {
  imageLoading.value = false
  statusMessage.value = {
    type: 'error',
    text: 'Error al cargar la imagen'
  }
}

const handleVideoLoad = () => {
  console.log('Video cargando...')
}

const handleVideoError = () => {
  statusMessage.value = {
    type: 'error',
    text: 'Error al cargar el video'
  }
}

const copyUrl = async () => {
  try {
    const url = getFullUrl(props.media.url)
    await navigator.clipboard.writeText(url)
    
    statusMessage.value = {
      type: 'success',
      text: 'URL copiada al portapapeles'
    }
    
    setTimeout(() => {
      statusMessage.value = null
    }, 3000)
  } catch (error) {
    statusMessage.value = {
      type: 'error',
      text: 'Error al copiar la URL'
    }
  }
}

// Utilidades
const getFullUrl = buildMediaUrl

const getFileIcon = (mimeType) => {
  if (mimeType.startsWith('image/')) return 'fas fa-image'
  if (mimeType.startsWith('video/')) return 'fas fa-video'
  if (mimeType.includes('pdf')) return 'fas fa-file-pdf'
  if (mimeType.includes('word') || mimeType.includes('document')) return 'fas fa-file-word'
  if (mimeType.includes('excel') || mimeType.includes('sheet')) return 'fas fa-file-excel'
  if (mimeType.includes('powerpoint') || mimeType.includes('presentation')) return 'fas fa-file-powerpoint'
  if (mimeType.includes('text')) return 'fas fa-file-alt'
  return 'fas fa-file'
}

const getFileTypeLabel = (type) => {
  switch (type) {
    case 'image': return 'Imagen'
    case 'video': return 'Video'
    case 'document': return 'Documento'
    default: return 'Otro'
  }
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
    month: 'long',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  })
}
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.8);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
}

.modal-content {
  background: white;
  border-radius: 12px;
  width: 90%;
  max-width: 900px;
  max-height: 90vh;
  overflow-y: auto;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
  transition: all 0.3s ease;
}

.modal-content.fullscreen {
  width: 100vw;
  height: 100vh;
  max-width: none;
  max-height: none;
  border-radius: 0;
  overflow: hidden;
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.5rem;
  border-bottom: 1px solid #e9ecef;
}

.modal-header h3 {
  margin: 0;
  color: #2c3e50;
  flex: 1;
  padding-right: 1rem;
  word-break: break-all;
}

.header-actions {
  display: flex;
  gap: 0.5rem;
}

.btn-action, .btn-close {
  background: none;
  border: none;
  font-size: 1.2rem;
  color: #6c757d;
  cursor: pointer;
  padding: 0.5rem;
  border-radius: 4px;
  transition: all 0.2s;
}

.btn-action:hover, .btn-close:hover {
  background: #f8f9fa;
  color: #007bff;
}

.btn-close:hover {
  color: #dc3545;
}

.fullscreen-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  z-index: 10;
  padding: 1rem;
  display: flex;
  justify-content: flex-end;
}

.btn-fullscreen-close {
  background: rgba(0, 0, 0, 0.7);
  color: white;
  border: none;
  padding: 0.75rem;
  border-radius: 50%;
  cursor: pointer;
  font-size: 1.2rem;
  transition: all 0.2s;
}

.btn-fullscreen-close:hover {
  background: rgba(0, 0, 0, 0.9);
  transform: scale(1.1);
}

.modal-body {
  padding: 1.5rem;
}

.fullscreen-body {
  padding: 0;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: black;
}

.media-display {
  margin-bottom: 2rem;
}

.fullscreen-display {
  margin: 0;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.image-container {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 200px;
  background: #f8f9fa;
  border-radius: 8px;
  overflow: hidden;
}

.main-image {
  max-width: 100%;
  max-height: 400px;
  object-fit: contain;
  border-radius: 8px;
}

.fullscreen-display .main-image {
  max-height: 90vh;
  max-width: 90vw;
}

.image-loading {
  position: absolute;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 1rem;
  color: #6c757d;
}

.video-container {
  display: flex;
  justify-content: center;
  border-radius: 8px;
  overflow: hidden;
  background: black;
}

.main-video {
  width: 100%;
  max-height: 400px;
}

.fullscreen-display .main-video {
  max-height: 90vh;
  max-width: 90vw;
}

.document-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 300px;
  background: #f8f9fa;
  border-radius: 12px;
}

.document-preview {
  text-align: center;
  padding: 2rem;
}

.document-icon {
  font-size: 4rem;
  color: #007bff;
  margin-bottom: 1rem;
}

.document-info h4 {
  margin: 0 0 1rem 0;
  color: #2c3e50;
  font-size: 1.2rem;
}

.document-details {
  color: #6c757d;
  margin-bottom: 2rem;
  font-size: 0.9rem;
}

.document-actions {
  display: flex;
  gap: 1rem;
  justify-content: center;
  flex-wrap: wrap;
}

.media-info {
  display: grid;
  gap: 2rem;
}

.info-section h4 {
  margin: 0 0 1rem 0;
  color: #2c3e50;
  border-bottom: 1px solid #e9ecef;
  padding-bottom: 0.5rem;
}

.info-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1rem;
}

.info-item {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}

.info-item.full-width {
  grid-column: 1 / -1;
}

.info-label {
  font-weight: 600;
  font-size: 0.85rem;
  color: #6c757d;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.info-value {
  color: #2c3e50;
  word-break: break-word;
}

.url-container {
  display: flex;
  gap: 0.5rem;
}

.url-input {
  flex: 1;
  padding: 0.75rem;
  border: 1px solid #dee2e6;
  border-radius: 6px;
  font-size: 0.9rem;
  background: #f8f9fa;
  color: #495057;
  font-family: monospace;
}

.btn-copy {
  padding: 0.75rem;
  background: #007bff;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.2s;
}

.btn-copy:hover {
  background: #0056b3;
}

.modal-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.5rem;
  border-top: 1px solid #e9ecef;
  background: #f8f9fa;
}

.footer-info {
  flex: 1;
}

.file-path {
  font-size: 0.8rem;
  color: #6c757d;
  font-family: monospace;
}

.footer-actions {
  display: flex;
  gap: 1rem;
}

.btn-primary, .btn-secondary {
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.9rem;
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  transition: all 0.2s;
  text-decoration: none;
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

.btn-secondary:hover {
  background-color: #545b62;
}

.status-message {
  position: absolute;
  top: 1rem;
  right: 1rem;
  padding: 0.75rem 1rem;
  border-radius: 6px;
  font-size: 0.9rem;
  font-weight: 500;
  z-index: 20;
}

.status-message.success {
  background: #d4edda;
  color: #155724;
  border: 1px solid #c3e6cb;
}

.status-message.error {
  background: #f8d7da;
  color: #721c24;
  border: 1px solid #f1aeb5;
}

@media (max-width: 768px) {
  .modal-content {
    width: 95%;
    max-height: 95vh;
  }
  
  .document-actions {
    flex-direction: column;
    align-items: center;
  }
  
  .info-grid {
    grid-template-columns: 1fr;
  }
  
  .url-container {
    flex-direction: column;
  }
  
  .modal-footer {
    flex-direction: column;
    gap: 1rem;
    align-items: stretch;
  }
  
  .footer-actions {
    justify-content: stretch;
  }
  
  .btn-primary, .btn-secondary {
    flex: 1;
    justify-content: center;
  }
}
</style>