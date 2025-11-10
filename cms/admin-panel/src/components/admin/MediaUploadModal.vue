<template>
  <div class="modal-overlay" @click="closeModal">
    <div class="modal-content" @click.stop>
      <div class="modal-header">
        <h3>Subir Archivos</h3>
        <button @click="closeModal" class="btn-close">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <div class="modal-body">
        <!-- Zona de arrastre de archivos -->
        <div 
          class="upload-zone" 
          :class="{ 'drag-over': isDragOver, 'has-files': selectedFiles.length > 0 }"
          @drop="handleDrop"
          @dragover.prevent="handleDragOver"
          @dragleave="handleDragLeave"
          @click="triggerFileInput"
        >
          <input 
            ref="fileInput" 
            type="file" 
            multiple 
            @change="handleFileSelect"
            accept="image/*,video/*,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.csv,.rtf"
            style="display: none"
          />
          
          <div v-if="selectedFiles.length === 0" class="upload-prompt">
            <i class="fas fa-cloud-upload-alt upload-icon"></i>
            <h4>Arrastra archivos aquí o haz clic para seleccionar</h4>
            <p>Máximo 10 archivos, 20MB por archivo</p>
            <p class="file-types">
              Soporta: Imágenes, Videos, PDF, Word, Excel, PowerPoint, TXT, CSV
            </p>
          </div>
          
          <div v-else class="files-preview">
            <h4>{{ selectedFiles.length }} archivo(s) seleccionado(s)</h4>
            <div class="files-list">
              <div v-for="(file, index) in selectedFiles" :key="index" class="file-item">
                <div class="file-info">
                  <i :class="getFileIcon(file.type)" class="file-icon"></i>
                  <div class="file-details">
                    <span class="file-name">{{ truncateFileName(file.name) }}</span>
                    <span class="file-size">{{ formatFileSize(file.size) }}</span>
                  </div>
                </div>
                <button @click="removeFile(index)" class="btn-remove" type="button">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Metadatos adicionales -->
        <div v-if="selectedFiles.length > 0" class="metadata-section">
          <h4>Metadatos (opcional)</h4>
          <div class="form-group">
            <label for="alt-text">Texto alternativo (para imágenes):</label>
            <input 
              id="alt-text"
              v-model="metadata.alt_text" 
              type="text" 
              placeholder="Descripción de la imagen para accesibilidad"
              maxlength="255"
            />
          </div>
          <div class="form-group">
            <label for="description">Descripción:</label>
            <textarea 
              id="description"
              v-model="metadata.description" 
              placeholder="Descripción del archivo"
              rows="3"
              maxlength="1000"
            ></textarea>
          </div>
        </div>

        <!-- Progress bar -->
        <div v-if="uploading" class="upload-progress">
          <div class="progress-info">
            <span>Subiendo archivos...</span>
            <span>{{ uploadProgress }}%</span>
          </div>
          <div class="progress-bar">
            <div class="progress-fill" :style="{ width: uploadProgress + '%' }"></div>
          </div>
        </div>

        <!-- Resultados de la subida -->
        <div v-if="uploadResults" class="upload-results">
          <div v-if="uploadResults.uploaded && uploadResults.uploaded.length > 0" class="success-results">
            <h4><i class="fas fa-check-circle"></i> Archivos subidos exitosamente ({{ uploadResults.uploaded.length }})</h4>
            <ul>
              <li v-for="media in uploadResults.uploaded" :key="media.id">
                {{ media.name }}
              </li>
            </ul>
          </div>
          
          <div v-if="uploadResults.errors && uploadResults.errors.length > 0" class="error-results">
            <h4><i class="fas fa-exclamation-triangle"></i> Errores ({{ uploadResults.errors.length }})</h4>
            <ul>
              <li v-for="(error, index) in uploadResults.errors" :key="index">
                {{ error }}
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button @click="closeModal" class="btn-secondary" :disabled="uploading">
          Cancelar
        </button>
        <button 
          @click="uploadFiles" 
          class="btn-primary" 
          :disabled="selectedFiles.length === 0 || uploading"
        >
          <i class="fas fa-upload"></i>
          {{ uploading ? 'Subiendo...' : `Subir ${selectedFiles.length} archivo(s)` }}
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { useMediaStore } from '@/stores/media'

const emit = defineEmits(['close', 'uploaded'])

const mediaStore = useMediaStore()

// Estado reactivo
const selectedFiles = ref([])
const isDragOver = ref(false)
const uploading = ref(false)
const uploadProgress = ref(0)
const uploadResults = ref(null)
const fileInput = ref(null)

const metadata = reactive({
  alt_text: '',
  description: ''
})

// Métodos
const closeModal = () => {
  if (!uploading.value) {
    emit('close')
  }
}

const triggerFileInput = () => {
  if (!uploading.value) {
    fileInput.value?.click()
  }
}

const handleFileSelect = (event) => {
  const files = Array.from(event.target.files)
  addFiles(files)
}

const handleDrop = (event) => {
  event.preventDefault()
  isDragOver.value = false
  
  const files = Array.from(event.dataTransfer.files)
  addFiles(files)
}

const handleDragOver = (event) => {
  event.preventDefault()
  isDragOver.value = true
}

const handleDragLeave = () => {
  isDragOver.value = false
}

const addFiles = (files) => {
  // Filtrar archivos válidos y limitar a 10
  const validFiles = files.filter(file => {
    // Verificar tamaño (10MB máximo)
    if (file.size > 10 * 1024 * 1024) {
      alert(`El archivo "${file.name}" es muy grande. Máximo 10MB.`)
      return false
    }
    
    // Verificar si ya está seleccionado
    if (selectedFiles.value.some(f => f.name === file.name && f.size === file.size)) {
      return false
    }
    
    return true
  })
  
  // Limitar total a 10 archivos
  const remainingSlots = 10 - selectedFiles.value.length
  const filesToAdd = validFiles.slice(0, remainingSlots)
  
  if (filesToAdd.length < validFiles.length) {
    alert(`Solo se pueden subir máximo 10 archivos. Se seleccionaron ${filesToAdd.length} de ${validFiles.length} archivos.`)
  }
  
  selectedFiles.value = [...selectedFiles.value, ...filesToAdd]
}

const removeFile = (index) => {
  selectedFiles.value.splice(index, 1)
}

const uploadFiles = async () => {
  if (selectedFiles.value.length === 0) return
  
  uploading.value = true
  uploadProgress.value = 0
  uploadResults.value = null
  
  try {
    let result
    
    if (selectedFiles.value.length === 1) {
      // Subida individual con metadatos
      result = await mediaStore.uploadMedia(selectedFiles.value[0], {
        alt_text: metadata.alt_text || undefined,
        description: metadata.description || undefined
      })
      
      result = {
        uploaded: [result],
        errors: [],
        total_uploaded: 1,
        total_errors: 0
      }
    } else {
      // Subida múltiple
      result = await mediaStore.bulkUploadMedia(selectedFiles.value)
    }
    
    uploadProgress.value = 100
    uploadResults.value = result
    
    // Emitir evento de subida exitosa después de un breve delay
    setTimeout(() => {
      if (result.total_uploaded > 0) {
        emit('uploaded')
      }
    }, 1000)
    
  } catch (error) {
    uploadResults.value = {
      uploaded: [],
      errors: [error.message || 'Error al subir archivos'],
      total_uploaded: 0,
      total_errors: 1
    }
  } finally {
    uploading.value = false
  }
}

// Utilidades
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

const formatFileSize = (bytes) => {
  if (!bytes) return '0 B'
  const k = 1024
  const sizes = ['B', 'KB', 'MB', 'GB']
  const i = Math.floor(Math.log(bytes) / Math.log(k))
  return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i]
}

const truncateFileName = (name, maxLength = 30) => {
  if (name.length <= maxLength) return name
  const extension = name.split('.').pop()
  const nameWithoutExt = name.substring(0, name.lastIndexOf('.'))
  const truncated = nameWithoutExt.substring(0, maxLength - extension.length - 4)
  return `${truncated}...${extension}`
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
  max-width: 600px;
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

.upload-zone {
  border: 2px dashed #dee2e6;
  border-radius: 12px;
  padding: 3rem 2rem;
  text-align: center;
  cursor: pointer;
  transition: all 0.3s ease;
  background: #f8f9fa;
  margin-bottom: 1.5rem;
}

.upload-zone:hover {
  border-color: #007bff;
  background: #f0f8ff;
}

.upload-zone.drag-over {
  border-color: #007bff;
  background: #e3f2fd;
}

.upload-zone.has-files {
  cursor: default;
  border-color: #28a745;
  background: #f0fff4;
}

.upload-prompt {
  color: #6c757d;
}

.upload-icon {
  font-size: 3rem;
  color: #007bff;
  margin-bottom: 1rem;
  display: block;
}

.upload-prompt h4 {
  margin: 0 0 0.5rem 0;
  color: #2c3e50;
}

.upload-prompt p {
  margin: 0.5rem 0;
  font-size: 0.9rem;
}

.file-types {
  font-size: 0.8rem !important;
  color: #6c757d;
}

.files-preview h4 {
  margin: 0 0 1rem 0;
  color: #28a745;
}

.files-list {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  max-height: 200px;
  overflow-y: auto;
}

.file-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0.75rem;
  background: white;
  border: 1px solid #dee2e6;
  border-radius: 8px;
}

.file-info {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  flex: 1;
}

.file-icon {
  font-size: 1.5rem;
  color: #007bff;
  width: 24px;
  text-align: center;
}

.file-details {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}

.file-name {
  font-weight: 500;
  color: #2c3e50;
  font-size: 0.9rem;
}

.file-size {
  font-size: 0.8rem;
  color: #6c757d;
}

.btn-remove {
  background: #ffe6e6;
  border: none;
  color: #dc3545;
  width: 28px;
  height: 28px;
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s;
}

.btn-remove:hover {
  background: #ffcccc;
  transform: scale(1.1);
}

.metadata-section {
  border-top: 1px solid #e9ecef;
  padding-top: 1.5rem;
  margin-bottom: 1.5rem;
}

.metadata-section h4 {
  margin: 0 0 1rem 0;
  color: #2c3e50;
}

.form-group {
  margin-bottom: 1rem;
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
  resize: vertical;
}

.form-group input:focus,
.form-group textarea:focus {
  outline: none;
  border-color: #007bff;
  box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
}

.upload-progress {
  margin-bottom: 1.5rem;
}

.progress-info {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.5rem;
  font-size: 0.9rem;
  color: #2c3e50;
}

.progress-bar {
  height: 8px;
  background: #e9ecef;
  border-radius: 4px;
  overflow: hidden;
}

.progress-fill {
  height: 100%;
  background: linear-gradient(90deg, #007bff, #0056b3);
  transition: width 0.3s ease;
  border-radius: 4px;
}

.upload-results {
  border-top: 1px solid #e9ecef;
  padding-top: 1.5rem;
  margin-bottom: 1.5rem;
}

.success-results,
.error-results {
  margin-bottom: 1rem;
}

.success-results h4 {
  color: #28a745;
  margin: 0 0 0.5rem 0;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.error-results h4 {
  color: #dc3545;
  margin: 0 0 0.5rem 0;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.success-results ul,
.error-results ul {
  margin: 0;
  padding-left: 1.5rem;
  font-size: 0.9rem;
}

.success-results li {
  color: #28a745;
  margin-bottom: 0.25rem;
}

.error-results li {
  color: #dc3545;
  margin-bottom: 0.25rem;
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
  
  .upload-zone {
    padding: 2rem 1rem;
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