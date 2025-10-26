<template>
  <div class="modal-overlay" @click="closeModal">
    <div class="modal-content" @click.stop>
      <div class="modal-header">
        <h3>Editar Medio</h3>
        <button @click="closeModal" class="btn-close">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <div class="modal-body">
        <!-- Vista previa del archivo -->
        <div class="media-preview">
          <div v-if="media.type === 'image'" class="preview-container">
            <img 
              :src="getFullUrl(media.url)" 
              :alt="media.alt_text || media.name"
              class="preview-image"
              @error="handleImageError"
            />
          </div>
          
          <div v-else class="preview-placeholder">
            <i :class="getFileIcon(media.mime_type)" class="preview-icon"></i>
            <div class="file-info">
              <span class="file-name">{{ media.name }}</span>
              <span class="file-details">
                {{ formatFileSize(media.size) }} • {{ media.extension.toUpperCase() }}
              </span>
              <span class="file-type">{{ getFileTypeLabel(media.type) }}</span>
            </div>
          </div>
        </div>

        <!-- Información del archivo (solo lectura) -->
        <div class="file-metadata">
          <div class="metadata-grid">
            <div class="metadata-item">
              <label>Nombre del archivo:</label>
              <span>{{ media.name }}</span>
            </div>
            <div class="metadata-item">
              <label>Tamaño:</label>
              <span>{{ formatFileSize(media.size) }}</span>
            </div>
            <div class="metadata-item">
              <label>Tipo:</label>
              <span>{{ media.mime_type }}</span>
            </div>
            <div class="metadata-item">
              <label>Subido:</label>
              <span>{{ formatDate(media.created_at) }}</span>
            </div>
            <div v-if="media.uploader" class="metadata-item">
              <label>Por:</label>
              <span>{{ media.uploader.name }}</span>
            </div>
            <div v-if="media.type === 'image' && media.metadata" class="metadata-item">
              <label>Dimensiones:</label>
              <span>{{ media.metadata.width }} × {{ media.metadata.height }}px</span>
            </div>
          </div>
        </div>

        <!-- Formulario de edición -->
        <form @submit.prevent="saveChanges">
          <div class="form-section">
            <h4>Información Editable</h4>
            
            <div class="form-group">
              <label for="alt-text">Texto Alternativo:</label>
              <input 
                id="alt-text"
                v-model="editForm.alt_text"
                type="text" 
                placeholder="Descripción para accesibilidad (especialmente importante para imágenes)"
                maxlength="255"
                :class="{ 'required-field': media.type === 'image' && !editForm.alt_text }"
              />
              <small v-if="media.type === 'image'" class="help-text">
                Recomendado para imágenes - ayuda con la accesibilidad
              </small>
            </div>

            <div class="form-group">
              <label for="description">Descripción:</label>
              <textarea 
                id="description"
                v-model="editForm.description"
                placeholder="Descripción detallada del contenido"
                rows="4"
                maxlength="1000"
              ></textarea>
              <small class="help-text">
                {{ editForm.description?.length || 0 }}/1000 caracteres
              </small>
            </div>
          </div>
        </form>

        <!-- URL y acciones rápidas -->
        <div class="url-section">
          <h4>URL del Archivo</h4>
          <div class="url-container">
            <input 
              :value="getFullUrl(media.url)" 
              readonly 
              class="url-input"
              ref="urlInput"
            />
            <button @click="copyUrl" class="btn-copy" type="button">
              <i class="fas fa-copy"></i>
              Copiar
            </button>
          </div>
        </div>

        <!-- Mensaje de estado -->
        <div v-if="saveMessage" class="save-message" :class="saveMessage.type">
          <i :class="saveMessage.type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-triangle'"></i>
          {{ saveMessage.text }}
        </div>
      </div>

      <div class="modal-footer">
        <button @click="closeModal" class="btn-secondary" :disabled="saving">
          Cancelar
        </button>
        <button @click="saveChanges" class="btn-primary" :disabled="saving || !hasChanges">
          <i class="fas fa-save"></i>
          {{ saving ? 'Guardando...' : 'Guardar Cambios' }}
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue'
import { useMediaStore } from '@/stores/media'
import { buildMediaUrl } from '@/utils/mediaUtils'

const props = defineProps({
  media: {
    type: Object,
    required: true
  }
})

const emit = defineEmits(['close', 'updated'])

const mediaStore = useMediaStore()

// Estado reactivo
const saving = ref(false)
const saveMessage = ref(null)
const urlInput = ref(null)

const editForm = reactive({
  alt_text: '',
  description: ''
})

// Valores originales para detectar cambios
const originalValues = reactive({})

// Computed
const hasChanges = computed(() => {
  return editForm.alt_text !== originalValues.alt_text || 
         editForm.description !== originalValues.description
})

// Lifecycle
onMounted(() => {
  initializeForm()
})

// Métodos
const initializeForm = () => {
  editForm.alt_text = props.media.alt_text || ''
  editForm.description = props.media.description || ''
  
  // Guardar valores originales
  originalValues.alt_text = editForm.alt_text
  originalValues.description = editForm.description
}

const closeModal = () => {
  if (!saving.value) {
    emit('close')
  }
}

const saveChanges = async () => {
  if (!hasChanges.value || saving.value) return

  saving.value = true
  saveMessage.value = null

  try {
    await mediaStore.updateMedia(props.media.id, {
      alt_text: editForm.alt_text || null,
      description: editForm.description || null
    })

    // Actualizar valores originales
    originalValues.alt_text = editForm.alt_text
    originalValues.description = editForm.description

    saveMessage.value = {
      type: 'success',
      text: 'Cambios guardados correctamente'
    }

    // Emitir evento de actualización
    emit('updated')

    // Cerrar modal después de un breve delay
    setTimeout(() => {
      closeModal()
    }, 1500)

  } catch (error) {
    saveMessage.value = {
      type: 'error',
      text: error.message || 'Error al guardar los cambios'
    }
  } finally {
    saving.value = false
  }
}

const copyUrl = async () => {
  try {
    const url = getFullUrl(props.media.url)
    await navigator.clipboard.writeText(url)
    
    saveMessage.value = {
      type: 'success',
      text: 'URL copiada al portapapeles'
    }
    
    setTimeout(() => {
      saveMessage.value = null
    }, 3000)
  } catch (error) {
    saveMessage.value = {
      type: 'error',
      text: 'Error al copiar la URL'
    }
  }
}

// Utilidades
const getFullUrl = (url) => {
  if (!url) return ''
  
  // Si es una URL completa, devolverla tal cual
  if (url.startsWith('http://') || url.startsWith('https://')) {
    return url
  }
  
  // Para URLs del backend Laravel, construir URL completa
  if (url.includes('/storage/')) {
    const storagePath = url.split('/storage/')[1]
    return buildMediaUrl(url)
  }
  
  // Para URLs relativas, construir URL completa
  const urlPath = url.startsWith('/') ? url : `/${url}`
  return buildMediaUrl(url)
}

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

const handleImageError = (event) => {
  event.target.style.display = 'none'
  event.target.parentElement.classList.add('error')
}
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
}

.modal-content {
  background: white;
  border-radius: 12px;
  width: 90%;
  max-width: 700px;
  max-height: 90vh;
  overflow-y: auto;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
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
}

.btn-close {
  background: none;
  border: none;
  font-size: 1.5rem;
  color: #6c757d;
  cursor: pointer;
  padding: 0.25rem;
  border-radius: 4px;
  transition: all 0.2s;
}

.btn-close:hover {
  background: #f8f9fa;
  color: #dc3545;
}

.modal-body {
  padding: 1.5rem;
}

.media-preview {
  margin-bottom: 2rem;
  border: 1px solid #e9ecef;
  border-radius: 12px;
  overflow: hidden;
  background: #f8f9fa;
}

.preview-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 200px;
  max-height: 300px;
  overflow: hidden;
}

.preview-image {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
  border-radius: 8px;
}

.preview-placeholder {
  display: flex;
  align-items: center;
  gap: 1.5rem;
  padding: 2rem;
}

.preview-icon {
  font-size: 4rem;
  color: #007bff;
  min-width: 80px;
  text-align: center;
}

.file-info {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.file-name {
  font-size: 1.2rem;
  font-weight: 600;
  color: #2c3e50;
  word-break: break-all;
}

.file-details {
  color: #6c757d;
  font-size: 0.9rem;
}

.file-type {
  color: #007bff;
  font-weight: 500;
  font-size: 0.9rem;
}

.file-metadata {
  margin-bottom: 2rem;
  padding: 1.5rem;
  background: #f8f9fa;
  border-radius: 8px;
}

.metadata-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1rem;
}

.metadata-item {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}

.metadata-item label {
  font-weight: 600;
  font-size: 0.85rem;
  color: #6c757d;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.metadata-item span {
  color: #2c3e50;
  font-size: 0.9rem;
}

.form-section {
  margin-bottom: 2rem;
}

.form-section h4 {
  margin: 0 0 1.5rem 0;
  color: #2c3e50;
  border-bottom: 1px solid #e9ecef;
  padding-bottom: 0.5rem;
}

.form-group {
  margin-bottom: 1.5rem;
}

.form-group label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 500;
  color: #2c3e50;
}

.form-group input,
.form-group textarea {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #dee2e6;
  border-radius: 6px;
  font-size: 0.9rem;
  font-family: inherit;
  transition: border-color 0.2s, box-shadow 0.2s;
}

.form-group input:focus,
.form-group textarea:focus {
  outline: none;
  border-color: #007bff;
  box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
}

.form-group textarea {
  resize: vertical;
  min-height: 100px;
}

.required-field {
  border-color: #ffc107 !important;
  background-color: #fff8e1;
}

.help-text {
  display: block;
  margin-top: 0.5rem;
  font-size: 0.8rem;
  color: #6c757d;
  font-style: italic;
}

.url-section {
  margin-bottom: 2rem;
}

.url-section h4 {
  margin: 0 0 1rem 0;
  color: #2c3e50;
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
  padding: 0.75rem 1rem;
  background: #007bff;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.9rem;
  transition: all 0.2s;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  white-space: nowrap;
}

.btn-copy:hover {
  background: #0056b3;
}

.save-message {
  padding: 1rem;
  border-radius: 6px;
  margin-bottom: 1rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-weight: 500;
}

.save-message.success {
  background: #d4edda;
  color: #155724;
  border: 1px solid #c3e6cb;
}

.save-message.error {
  background: #f8d7da;
  color: #721c24;
  border: 1px solid #f1aeb5;
}

.modal-footer {
  display: flex;
  justify-content: flex-end;
  gap: 1rem;
  padding: 1.5rem;
  border-top: 1px solid #e9ecef;
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
}

.btn-primary {
  background-color: #007bff;
  color: white;
}

.btn-primary:hover:not(:disabled) {
  background-color: #0056b3;
}

.btn-primary:disabled {
  background-color: #6c757d;
  cursor: not-allowed;
  opacity: 0.6;
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

@media (max-width: 768px) {
  .modal-content {
    width: 95%;
    max-height: 95vh;
  }
  
  .preview-placeholder {
    flex-direction: column;
    text-align: center;
  }
  
  .metadata-grid {
    grid-template-columns: 1fr;
  }
  
  .url-container {
    flex-direction: column;
  }
  
  .modal-footer {
    flex-direction: column;
  }
  
  .btn-primary, .btn-secondary {
    width: 100%;
    justify-content: center;
  }
}
</style>