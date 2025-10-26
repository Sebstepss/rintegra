<template>
  <div class="modal-overlay">
    <div class="modal-content" @click.stop>
      <!-- Modal Header -->
      <div class="modal-header">
        <h3>Editar Banner R-Integra</h3>
        <button @click="$emit('close')" class="btn-close">
          <i class="fas fa-times"></i>
        </button>
      </div>
      
      <!-- Modal Body -->
      <div class="modal-body">
        <!-- Tabs Navigation -->
        <div class="tabs-nav">
          <button 
            @click="activeTab = 'general'"
            class="tab-button"
            :class="{ active: activeTab === 'general' }"
          >
            <i class="fas fa-cog"></i>
            Configuración General
          </button>
          <button 
            @click="activeTab = 'attributes'"
            class="tab-button"
            :class="{ active: activeTab === 'attributes' }"
          >
            <i class="fas fa-code"></i>
            Atributos
          </button>
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
          <!-- Configuración General Tab -->
          <div v-show="activeTab === 'general'" class="tab-pane">
            <div class="editor-sections">
          <!-- Sección de Contenido -->
          <div class="editor-section">
            <h4>Contenido</h4>
            
            <div class="form-group">
              <label for="title">Título Principal</label>
              <input
                id="title"
                v-model="localBlock.title"
                type="text"
                class="form-input"
                placeholder="Organización financiera con visión estratégica"
              />
            </div>
            
            <div class="form-group">
              <label for="description">Descripción</label>
              <textarea
                id="description"
                v-model="localBlock.description"
                rows="4"
                class="form-input"
                placeholder="Acompañamos a empresarios, emprendedores..."
              ></textarea>
            </div>
            
            <div class="form-row">
              <div class="form-group">
                <label for="buttonText">Texto del Botón</label>
                <input
                  id="buttonText"
                  v-model="localBlock.buttonText"
                  type="text"
                  class="form-input"
                  placeholder="Agenda aquí tu cita"
                />
              </div>
              
              <div class="form-group">
                <label for="buttonLink">Enlace del Botón</label>
                <input
                  id="buttonLink"
                  v-model="localBlock.buttonLink"
                  type="text"
                  class="form-input"
                  placeholder="#contacto o https://..."
                />
              </div>
            </div>
          </div>

          <!-- Sección de Colores -->
          <div class="editor-section">
            <h4>Colores</h4>
            
            <div class="form-group">
              <label>Degradado de Fondo</label>
              <div class="gradient-controls">
                <div class="color-input-group">
                  <label for="colorStart">Color Inicial</label>
                  <input
                    id="colorStart"
                    v-model="localBlock.backgroundGradient.colorStart"
                    type="color"
                    class="color-picker"
                  />
                  <input
                    v-model="localBlock.backgroundGradient.colorStart"
                    type="text"
                    class="color-text"
                    placeholder="#052b1b"
                  />
                </div>
                <div class="color-input-group">
                  <label for="colorEnd">Color Final</label>
                  <input
                    id="colorEnd"
                    v-model="localBlock.backgroundGradient.colorEnd"
                    type="color"
                    class="color-picker"
                  />
                  <input
                    v-model="localBlock.backgroundGradient.colorEnd"
                    type="text"
                    class="color-text"
                    placeholder="#0c6a44"
                  />
                </div>
              </div>
              <div class="gradient-preview" :style="gradientPreviewStyle"></div>
            </div>
            
            <div class="form-group">
              <label for="titleColor">Color del Título</label>
              <div class="color-input-group">
                <input
                  id="titleColor"
                  v-model="localBlock.titleColor"
                  type="color"
                  class="color-picker"
                />
                <input
                  v-model="localBlock.titleColor"
                  type="text"
                  class="color-text"
                  placeholder="#ffffff"
                />
              </div>
            </div>
            
            <div class="form-group">
              <label for="descriptionColor">Color de la Descripción</label>
              <div class="color-input-group">
                <input
                  id="descriptionColor"
                  v-model="localBlock.descriptionColor"
                  type="color"
                  class="color-picker"
                />
                <input
                  v-model="localBlock.descriptionColor"
                  type="text"
                  class="color-text"
                  placeholder="#ffffff"
                />
              </div>
            </div>
          </div>

          <!-- Sección de Imágenes -->
          <div class="editor-section">
            <h4>Imágenes</h4>
            
            <div class="form-group">
              <label>Imagen de Fondo</label>
              <div class="media-selector">
                <div v-if="localBlock.backgroundImage" class="selected-media">
                  <img :src="localBlock.backgroundImage" class="media-preview" alt="Imagen de fondo" />
                  <button @click="clearBackgroundImage" class="btn-remove" type="button">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <div v-else class="media-placeholder">
                  <i class="fas fa-image"></i>
                  <p>No hay imagen seleccionada</p>
                </div>
                <button @click="openBackgroundImagePicker" class="btn-media" type="button">
                  <i class="fas fa-images"></i>
                  Seleccionar imagen
                </button>
              </div>
              
              <div class="form-group">
                <label for="backgroundImageOpacity">Opacidad de Imagen de Fondo</label>
                <div class="range-input-group">
                  <input
                    id="backgroundImageOpacity"
                    v-model.number="localBlock.backgroundImageOpacity"
                    type="range"
                    min="0"
                    max="100"
                    step="5"
                    class="range-input"
                  />
                  <span class="range-value">{{ localBlock.backgroundImageOpacity }}%</span>
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <label>Imagen de Persona</label>
              <div class="media-selector">
                <div v-if="localBlock.personImage" class="selected-media">
                  <img :src="localBlock.personImage" class="media-preview" alt="Imagen de persona" />
                  <button @click="clearPersonImage" class="btn-remove" type="button">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <div v-else class="media-placeholder">
                  <i class="fas fa-user"></i>
                  <p>No hay imagen seleccionada</p>
                </div>
                <button @click="openPersonImagePicker" class="btn-media" type="button">
                  <i class="fas fa-images"></i>
                  Seleccionar imagen
                </button>
              </div>
              <small class="form-help">PNG con transparencia recomendado</small>
            </div>
          </div>
            </div>
          </div>

          <!-- Atributos Tab -->
          <div v-show="activeTab === 'attributes'" class="tab-pane">
            <div class="editor-sections">
              <div class="editor-section">
                <h4>Atributos del Bloque</h4>
                
                <div class="form-group">
                  <label for="block-id">ID del bloque</label>
                  <input 
                    type="text" 
                    id="block-id" 
                    v-model="localBlock.customId"
                    class="form-input"
                    placeholder="mi-banner-unico"
                  >
                  <small class="form-help">ID único para este bloque (opcional)</small>
                </div>

                <div class="form-group">
                  <label for="block-class">Clases CSS</label>
                  <input 
                    type="text" 
                    id="block-class" 
                    v-model="localBlock.customClass"
                    class="form-input"
                    placeholder="mi-banner otra-clase"
                  >
                  <small class="form-help">Clases CSS separadas por espacios (opcional)</small>
                </div>

                <div class="form-group">
                  <label for="custom-css">CSS Personalizado</label>
                  <textarea 
                    id="custom-css" 
                    v-model="localBlock.customCSS"
                    rows="12"
                    class="form-input css-editor"
                    placeholder="/* CSS personalizado para este banner */
.mi-banner {
  box-shadow: 0 10px 30px rgba(0,0,0,0.2);
  border-radius: 20px;
}

.mi-banner .title {
  text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
  font-size: 3rem;
}

.mi-banner .button {
  animation: pulse 2s infinite;
}"
                  ></textarea>
                  <small class="form-help">Este CSS se aplicará únicamente a este banner</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Modal Footer -->
      <div class="modal-footer">
        <button @click="resetToDefaults" class="btn-secondary">
          <i class="fas fa-undo"></i>
          Restaurar por Defecto
        </button>
        <button @click="$emit('close')" class="btn-secondary">
          <i class="fas fa-times"></i>
          Cancelar
        </button>
        <button @click="applyChanges" class="btn-primary">
          <i class="fas fa-check"></i>
          Aplicar Cambios
        </button>
      </div>
    </div>
    
    <!-- Media Picker Modal -->
    <MediaPicker
      :show="showMediaPicker"
      :selected-media="selectedMediaForPicker"
      :type-filter="'image'"
      :multiple="false"
      @close="closeMediaPicker"
      @select="onMediaSelected"
    />
  </div>
</template>

<script setup lang="ts">
import { ref, computed, watch } from 'vue'
import MediaPicker from './MediaPicker.vue'
import { useMediaPicker } from '@/composables/useMediaPicker'
import type { BannerIntegraBlock as BannerIntegraBlockType } from '@/types/blocks'

interface Props {
  block: BannerIntegraBlockType
}

interface Emits {
  (e: 'update', block: BannerIntegraBlockType): void
  (e: 'close'): void
}

const props = defineProps<Props>()
const emit = defineEmits<Emits>()

// Estado de las pestañas
const activeTab = ref('general')

// Inicializar bloque con campos de atributos si no existen
const initializeBlock = (block: BannerIntegraBlockType): BannerIntegraBlockType => {
  return {
    ...block,
    customId: block.customId || '',
    customClass: block.customClass || '',
    customCSS: block.customCSS || ''
  }
}

const localBlock = ref<BannerIntegraBlockType>(initializeBlock({ ...props.block }))

// Media picker setup
const { getFullMediaUrl } = useMediaPicker()
const showMediaPicker = ref(false)
const selectedMediaForPicker = ref<any[]>([])
const currentMediaType = ref<'background' | 'person'>('background')

const gradientPreviewStyle = computed(() => ({
  background: `radial-gradient(circle at center, ${localBlock.value.backgroundGradient.colorStart}, ${localBlock.value.backgroundGradient.colorEnd})`
}))

// Aplicar cambios y cerrar modal
const applyChanges = () => {
  emit('update', { ...localBlock.value })
  emit('close')
}

// Media picker methods
const openBackgroundImagePicker = () => {
  currentMediaType.value = 'background'
  selectedMediaForPicker.value = []
  showMediaPicker.value = true
}

const openPersonImagePicker = () => {
  currentMediaType.value = 'person'
  selectedMediaForPicker.value = []
  showMediaPicker.value = true
}

const closeMediaPicker = () => {
  showMediaPicker.value = false
  selectedMediaForPicker.value = []
}

const onMediaSelected = (media: any) => {
  if (currentMediaType.value === 'background') {
    localBlock.value.backgroundImage = getFullMediaUrl(media)
  } else if (currentMediaType.value === 'person') {
    localBlock.value.personImage = getFullMediaUrl(media)
  }
  closeMediaPicker()
}

const clearBackgroundImage = () => {
  localBlock.value.backgroundImage = ''
}

const clearPersonImage = () => {
  localBlock.value.personImage = ''
}

const resetToDefaults = () => {
  localBlock.value = {
    ...localBlock.value,
    title: 'Organización financiera con visión estratégica',
    description: 'Acompañamos a empresarios, emprendedores y profesionales a cumplir con sus obligaciones contables y tributarias, estructurando procesos claros, sostenibles y alineados con sus objetivos de crecimiento.',
    buttonText: 'Agenda aquí tu cita',
    buttonLink: '#contacto',
    backgroundGradient: {
      colorStart: '#052b1b',
      colorEnd: '#0c6a44'
    },
    backgroundImage: '',
    backgroundImageOpacity: 30,
    personImage: '',
    titleColor: '#ffffff',
    descriptionColor: '#ffffff'
  }
}

// Watch para emitir cambios solo cuando se apliquen manualmente
// watch(localBlock, (newBlock) => {
//   emit('update', { ...newBlock })
// }, { deep: true })

// Sincronizar con props
watch(() => props.block, (newBlock) => {
  localBlock.value = { ...newBlock }
}, { deep: true })
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
  padding: 2rem;
}

.modal-content {
  background: white;
  border-radius: 12px;
  width: 80%;
  height: 80%;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.5rem 2rem;
  border-bottom: 1px solid #e9ecef;
  background: #f8f9fa;
  flex-shrink: 0;
}

.modal-header h3 {
  margin: 0;
  color: #2c3e50;
  font-size: 1.25rem;
  font-weight: 600;
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

.modal-body {
  flex: 1;
  overflow-y: auto;
  padding: 2rem;
}

.editor-sections {
  display: flex;
  flex-direction: column;
  gap: 2rem;
}

.editor-section {
  margin-bottom: 2rem;
  padding: 1.5rem;
  background: #f8f9fa;
  border-radius: 8px;
  border: 1px solid #e9ecef;
}

.editor-section h4 {
  margin: 0 0 1rem 0;
  color: #2c3e50;
  font-size: 1.1rem;
  font-weight: 600;
}

.modal-footer {
  display: flex;
  justify-content: flex-end;
  gap: 1rem;
  padding: 1.5rem 2rem;
  border-top: 1px solid #e9ecef;
  background: #f8f9fa;
  flex-shrink: 0;
}

.btn-primary,
.btn-secondary {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.9rem;
  font-weight: 600;
  transition: all 0.3s ease;
}

.btn-primary {
  background: #007bff;
  color: white;
}

.btn-primary:hover {
  background: #0056b3;
  transform: translateY(-1px);
}

.btn-secondary {
  background: #6c757d;
  color: white;
}

.btn-secondary:hover {
  background: #545b62;
  transform: translateY(-1px);
}

.form-group {
  margin-bottom: 1.5rem;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
  margin-bottom: 1rem;
}

.form-group label {
  display: block;
  font-weight: 600;
  color: #2c3e50;
  margin-bottom: 0.5rem;
  font-size: 0.9rem;
}

.form-input {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #dee2e6;
  border-radius: 6px;
  font-size: 0.95rem;
  transition: border-color 0.3s ease;
}

.form-input:focus {
  outline: none;
  border-color: #007bff;
}

.form-help {
  display: block;
  margin-top: 0.5rem;
  font-size: 0.8rem;
  color: #6c757d;
  font-style: italic;
}

.color-input-group {
  display: flex;
  gap: 0.5rem;
  align-items: center;
  margin-bottom: 1rem;
}

.color-picker {
  width: 50px;
  height: 40px;
  border: 1px solid #dee2e6;
  border-radius: 6px;
  cursor: pointer;
  padding: 0;
}

.color-text {
  flex: 1;
  padding: 0.5rem;
  border: 1px solid #dee2e6;
  border-radius: 6px;
  font-family: monospace;
}

.gradient-controls {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  margin-bottom: 1rem;
}

.gradient-preview {
  height: 60px;
  border-radius: 8px;
  border: 2px solid #dee2e6;
  margin-top: 0.5rem;
}

.range-input-group {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.range-input {
  flex: 1;
  height: 6px;
  background: #ddd;
  border-radius: 3px;
  outline: none;
}

.range-value {
  font-weight: 600;
  color: #495057;
  min-width: 50px;
  text-align: center;
}

.media-selector {
  border: 2px dashed #dee2e6;
  border-radius: 8px;
  padding: 1rem;
  text-align: center;
  transition: border-color 0.3s ease;
}

.media-selector:hover {
  border-color: #007bff;
}

.selected-media {
  position: relative;
  display: inline-block;
  margin-bottom: 1rem;
}

.media-preview {
  max-width: 200px;
  max-height: 120px;
  border-radius: 6px;
  object-fit: cover;
}

.btn-remove {
  position: absolute;
  top: -8px;
  right: -8px;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background: #dc3545;
  color: white;
  border: none;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.75rem;
}

.media-placeholder {
  color: #6c757d;
  margin-bottom: 1rem;
}

.media-placeholder i {
  font-size: 2rem;
  margin-bottom: 0.5rem;
  display: block;
}

.btn-media {
  background: #007bff;
  color: white;
  border: none;
  padding: 0.75rem 1.5rem;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.9rem;
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  transition: all 0.3s ease;
}

.btn-media:hover {
  background: #0056b3;
  transform: translateY(-1px);
}

@media (max-width: 1024px) {
  .modal-content {
    width: 95%;
    height: 95%;
  }
  
  .modal-body {
    padding: 1rem;
  }
  
  .modal-header,
  .modal-footer {
    padding: 1rem;
  }
}

@media (max-width: 768px) {
  .form-row {
    grid-template-columns: 1fr;
  }
  
  .gradient-controls {
    gap: 0.5rem;
  }
  
  .color-input-group {
    flex-wrap: wrap;
  }
}

/* Tabs */
.tabs-nav {
  display: flex;
  background: #f8f9fa;
  border-bottom: 1px solid #e9ecef;
  margin: -2rem -2rem 2rem -2rem;
}

.tab-button {
  flex: 1;
  padding: 1rem 1.5rem;
  border: none;
  background: transparent;
  color: #6c757d;
  font-size: 0.95rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  position: relative;
}

.tab-button:hover {
  background: rgba(0, 123, 255, 0.1);
  color: #007bff;
}

.tab-button.active {
  background: white;
  color: #007bff;
  border-bottom: 3px solid #007bff;
}

.tab-button.active::after {
  content: '';
  position: absolute;
  bottom: -1px;
  left: 0;
  right: 0;
  height: 1px;
  background: white;
}

.tab-content {
  position: relative;
}

.tab-pane {
  display: block;
}

.form-help {
  display: block;
  font-size: 0.8rem;
  color: #6c757d;
  margin-top: 0.25rem;
  font-style: italic;
}

.css-editor {
  font-family: 'Courier New', monospace;
  font-size: 0.9rem;
  line-height: 1.5;
  resize: vertical;
  min-height: 200px;
}
</style>