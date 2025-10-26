<template>
  <div class="modal-overlay">
    <div class="modal-content" @click.stop>
      <!-- Modal Header -->
      <div class="modal-header">
        <h3>Editar Contenedor</h3>
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
              <!-- Configuración de Fondo -->
              <div class="editor-section">
                <h4>Fondo del Contenedor</h4>
                
                <div class="form-group">
                  <label>Tipo de fondo</label>
                  <div class="radio-group">
                    <label class="radio-label">
                      <input 
                        type="radio" 
                        v-model="localBlock.backgroundType" 
                        value="color"
                      >
                      <span>Color sólido</span>
                    </label>
                    <label class="radio-label">
                      <input 
                        type="radio" 
                        v-model="localBlock.backgroundType" 
                        value="gradient"
                      >
                      <span>Degradado</span>
                    </label>
                    <label class="radio-label">
                      <input 
                        type="radio" 
                        v-model="localBlock.backgroundType" 
                        value="image"
                      >
                      <span>Imagen</span>
                    </label>
                  </div>
                </div>

                <!-- Color sólido -->
                <div v-if="localBlock.backgroundType === 'color'" class="form-group">
                  <label for="bg-color">Color de fondo</label>
                  <div class="color-input-group">
                    <input 
                      type="color" 
                      id="bg-color" 
                      v-model="localBlock.backgroundColor"
                      class="color-picker"
                    >
                    <input 
                      type="text" 
                      v-model="localBlock.backgroundColor" 
                      class="color-text"
                      placeholder="#ffffff"
                    >
                  </div>
                </div>

                <!-- Degradado -->
                <div v-if="localBlock.backgroundType === 'gradient'" class="gradient-section">
                  <div class="form-group">
                    <label>Degradado</label>
                    <div class="gradient-controls">
                      <div class="color-input-group">
                        <label for="colorStart">Color inicial</label>
                        <input 
                          type="color" 
                          id="colorStart" 
                          v-model="localBlock.backgroundGradient.colorStart"
                          class="color-picker"
                        >
                        <input 
                          type="text" 
                          v-model="localBlock.backgroundGradient.colorStart" 
                          class="color-text"
                          placeholder="#000000"
                        >
                      </div>
                      <div class="color-input-group">
                        <label for="colorEnd">Color final</label>
                        <input 
                          type="color" 
                          id="colorEnd" 
                          v-model="localBlock.backgroundGradient.colorEnd"
                          class="color-picker"
                        >
                        <input 
                          type="text" 
                          v-model="localBlock.backgroundGradient.colorEnd" 
                          class="color-text"
                          placeholder="#ffffff"
                        >
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="direction">Dirección del degradado</label>
                    <select id="direction" v-model="localBlock.backgroundGradient.direction" class="form-input">
                      <option value="to right">Horizontal (izquierda a derecha)</option>
                      <option value="to left">Horizontal (derecha a izquierda)</option>
                      <option value="to bottom">Vertical (arriba a abajo)</option>
                      <option value="to top">Vertical (abajo a arriba)</option>
                      <option value="45deg">Diagonal (45°)</option>
                      <option value="135deg">Diagonal (135°)</option>
                    </select>
                  </div>
                  
                  <div class="gradient-preview" :style="gradientPreviewStyle"></div>
                </div>

                <!-- Imagen -->
                <div v-if="localBlock.backgroundType === 'image'" class="image-section">
                  <div class="form-group">
                    <label>Imagen de fondo</label>
                    <div class="media-selector">
                      <div v-if="localBlock.backgroundImage" class="selected-media">
                        <img 
                          :src="localBlock.backgroundImage" 
                          class="media-preview" 
                          alt="Imagen de fondo"
                          @load="() => console.log('ContainerBlockEditor - Preview image loaded:', localBlock.backgroundImage)"
                          @error="(e) => console.error('ContainerBlockEditor - Preview image error:', localBlock.backgroundImage, e)" 
                        />
                        <button @click="clearBackgroundImage" class="btn-remove" type="button">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                      <div v-else class="media-placeholder">
                        <i class="fas fa-image"></i>
                        <p>No hay imagen seleccionada</p>
                      </div>
                      <button @click="openImagePicker" class="btn-media" type="button">
                        <i class="fas fa-images"></i>
                        Seleccionar imagen
                      </button>
                    </div>
                  </div>
                  
                  <div v-if="localBlock.backgroundImage" class="form-group">
                    <label for="opacity">Opacidad de la imagen (%)</label>
                    <div class="range-input-group">
                      <input 
                        type="range" 
                        id="opacity" 
                        v-model.number="localBlock.backgroundImageOpacity"
                        min="0" 
                        max="100" 
                        step="5"
                        class="range-input"
                      >
                      <span class="range-value">{{ localBlock.backgroundImageOpacity }}%</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Configuración de Espaciado -->
              <div class="editor-section">
                <h4>Espaciado</h4>
                
                <div class="form-group">
                  <label for="padding">Padding interno</label>
                  <select id="padding" v-model="localBlock.padding" class="form-input">
                    <option value="none">Sin padding</option>
                    <option value="small">Pequeño</option>
                    <option value="medium">Mediano</option>
                    <option value="large">Grande</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <!-- Atributos Tab -->
          <div v-show="activeTab === 'attributes'" class="tab-pane">
            <div class="editor-sections">
              <div class="editor-section">
                <h4>Atributos del Contenedor</h4>
                
                <div class="form-group">
                  <label for="block-id">ID del contenedor</label>
                  <input 
                    type="text" 
                    id="block-id" 
                    v-model="localBlock.customId"
                    class="form-input"
                    placeholder="mi-contenedor-unico"
                  >
                  <small class="form-help">ID único para este contenedor (opcional)</small>
                </div>

                <div class="form-group">
                  <label for="block-class">Clases CSS</label>
                  <input 
                    type="text" 
                    id="block-class" 
                    v-model="localBlock.customClass"
                    class="form-input"
                    placeholder="mi-contenedor otra-clase"
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
                    placeholder="/* CSS personalizado para este contenedor */
.mi-contenedor {
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  border-radius: 20px;
  overflow: hidden;
}

/* Aplicar a bloques hijos */
.container-children > div {
  margin-bottom: 20px;
}

.container-children > div:last-child {
  margin-bottom: 0;
}"
                  ></textarea>
                  <small class="form-help">Este CSS se aplicará únicamente a este contenedor</small>
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
      :multiple="true"
      @close="closeMediaPicker"
      @select="onMediaSelected"
    />
  </div>
</template>

<script setup lang="ts">
import { ref, computed, watch } from 'vue'
import MediaPicker from './MediaPicker.vue'
import { useMediaPicker } from '@/composables/useMediaPicker'
import type { ContainerBlock as ContainerBlockType } from '@/types/blocks'

interface Props {
  block: ContainerBlockType
}

interface Emits {
  (e: 'update', block: ContainerBlockType): void
  (e: 'close'): void
}

const props = defineProps<Props>()
const emit = defineEmits<Emits>()

// Estado de las pestañas
const activeTab = ref('general')

// Inicializar bloque con campos de atributos si no existen
const initializeBlock = (block: ContainerBlockType): ContainerBlockType => {
  return {
    ...block,
    customId: block.customId || '',
    customClass: block.customClass || '',
    customCSS: block.customCSS || '',
    backgroundGradient: block.backgroundGradient || {
      colorStart: '#000000',
      colorEnd: '#ffffff',
      direction: 'to right'
    },
    backgroundImageOpacity: block.backgroundImageOpacity ?? 100,
    children: block.children || []
  }
}

const localBlock = ref<ContainerBlockType>(initializeBlock({ ...props.block }))

// Media picker setup
const { getFullMediaUrl } = useMediaPicker()
const showMediaPicker = ref(false)
const selectedMediaForPicker = ref<any[]>([])

const gradientPreviewStyle = computed(() => {
  if (localBlock.value.backgroundGradient) {
    const { colorStart, colorEnd, direction } = localBlock.value.backgroundGradient
    return {
      background: `linear-gradient(${direction}, ${colorStart}, ${colorEnd})`,
      height: '60px',
      borderRadius: '6px',
      marginTop: '1rem'
    }
  }
  return {}
})

// Aplicar cambios y cerrar modal
const applyChanges = () => {
  emit('update', { ...localBlock.value })
  emit('close')
}

// Media picker methods
const openImagePicker = () => {
  selectedMediaForPicker.value = []
  showMediaPicker.value = true
}

const closeMediaPicker = () => {
  showMediaPicker.value = false
  selectedMediaForPicker.value = []
}

const onMediaSelected = (media: any[]) => {
  console.log('ContainerBlockEditor - onMediaSelected:', media)
  console.log('ContainerBlockEditor - Type of media:', typeof media)
  console.log('ContainerBlockEditor - Is array:', Array.isArray(media))
  
  if (media && media.length > 0) {
    const selectedMedia = media[0]
    console.log('ContainerBlockEditor - Selected media:', selectedMedia)
    
    const imageUrl = getFullMediaUrl(selectedMedia)
    console.log('ContainerBlockEditor - Full media URL:', imageUrl)
    
    localBlock.value.backgroundImage = imageUrl
    console.log('ContainerBlockEditor - Background image set to:', localBlock.value.backgroundImage)
  }
  closeMediaPicker()
}

const clearBackgroundImage = () => {
  localBlock.value.backgroundImage = ''
}

const resetToDefaults = () => {
  localBlock.value = {
    ...props.block,
    backgroundType: 'color',
    backgroundColor: '#ffffff',
    backgroundGradient: {
      colorStart: '#000000',
      colorEnd: '#ffffff',
      direction: 'to right'
    },
    backgroundImage: '',
    backgroundImageOpacity: 100,
    padding: 'medium',
    customId: '',
    customClass: '',
    customCSS: '',
    children: localBlock.value.children // Mantener los bloques hijos
  }
}

// Sincronizar con props
watch(() => props.block, (newBlock) => {
  localBlock.value = initializeBlock(newBlock)
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
  width: 90%;
  max-width: 800px;
  height: 90%;
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
  display: flex;
  align-items: center;
  justify-content: center;
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

.radio-group {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
}

.radio-label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  cursor: pointer;
  font-weight: normal;
}

.color-input-group {
  display: flex;
  gap: 0.5rem;
  align-items: center;
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
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
}

.gradient-preview {
  width: 100%;
  border: 1px solid #dee2e6;
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
  max-width: 150px;
  max-height: 100px;
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
  font-size: 0.8rem;
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
  padding: 0.5rem 1rem;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.8rem;
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

.range-input-group {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.range-input {
  flex: 1;
}

.range-value {
  font-weight: 600;
  color: #495057;
  min-width: 50px;
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

@media (max-width: 768px) {
  .modal-content {
    width: 95%;
    height: 95%;
  }
  
  .modal-body {
    padding: 1rem;
  }
  
  .gradient-controls {
    grid-template-columns: 1fr;
  }
  
  .color-input-group {
    flex-direction: column;
    align-items: stretch;
  }
  
  .range-input-group {
    flex-direction: column;
    gap: 0.5rem;
  }
}
</style>