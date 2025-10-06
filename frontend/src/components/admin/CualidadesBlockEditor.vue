<template>
  <div class="modal-overlay">
    <div class="modal-content" @click.stop>
      <!-- Modal Header -->
      <div class="modal-header">
        <h3>Editar Cualidades</h3>
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
          <!-- Sección de Contenido General -->
          <div class="editor-section">
            <h4>Configuración General</h4>
            
            <div class="form-group">
              <label for="title">Título Principal</label>
              <input
                id="title"
                v-model="localBlock.title"
                type="text"
                class="form-input"
                placeholder="Un enfoque claro, confiable y estructurado"
              />
            </div>
          </div>

          <!-- Sección de Colores -->
          <div class="editor-section">
            <h4>Diseño y Colores</h4>
            
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
              <label for="titleColor">Color del Título Principal</label>
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
              <label for="itemsTextColor">Color del Texto de Cualidades</label>
              <div class="color-input-group">
                <input
                  id="itemsTextColor"
                  v-model="localBlock.itemsTextColor"
                  type="color"
                  class="color-picker"
                />
                <input
                  v-model="localBlock.itemsTextColor"
                  type="text"
                  class="color-text"
                  placeholder="#ffffff"
                />
              </div>
            </div>
          </div>

          <!-- Sección de Items de Cualidades -->
          <div class="editor-section items-section">
            <h4>Items de Cualidades (Máximo 8)</h4>
            
            <div class="items-list">
              <div 
                v-for="(item, index) in localBlock.items" 
                :key="index"
                class="item-editor"
              >
                <div class="item-header">
                  <h5>Cualidad {{ index + 1 }}</h5>
                  <button 
                    @click="removeItem(index)" 
                    class="btn-remove"
                    type="button"
                  >
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
                
                <div class="item-content">
                  <div class="form-group">
                    <label>Imagen</label>
                    <div class="media-selector">
                      <div v-if="item.image" class="selected-media">
                        <img :src="item.image" class="media-preview" :alt="item.text" />
                        <button @click="clearItemImage(index)" class="btn-remove-media" type="button">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                      <div v-else class="media-placeholder">
                        <i class="fas fa-image"></i>
                        <p>No hay imagen</p>
                      </div>
                      <button @click="openImagePicker(index)" class="btn-media" type="button">
                        <i class="fas fa-images"></i>
                        Seleccionar
                      </button>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label>Texto</label>
                    <input
                      v-model="item.text"
                      type="text"
                      class="form-input"
                      placeholder="Diagnóstico financiero y contable inicial"
                    />
                  </div>
                  
                  <div class="form-group">
                    <label>Color del Texto (Opcional)</label>
                    <div class="color-input-group">
                      <input
                        v-model="item.textColor"
                        type="color"
                        class="color-picker"
                      />
                      <input
                        v-model="item.textColor"
                        type="text"
                        class="color-text"
                        placeholder="#ffffff"
                      />
                      <button 
                        v-if="item.textColor"
                        @click="clearItemTextColor(index)"
                        type="button"
                        class="btn-clear-small"
                        title="Usar color por defecto"
                      >
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                    <small class="form-help">Deja vacío para usar el color por defecto</small>
                  </div>
                </div>
              </div>
              
              <!-- Botón agregar nuevo item -->
              <div class="add-item-section">
                <button 
                  @click="addItem" 
                  class="btn-add-item"
                  type="button"
                  :disabled="localBlock.items.length >= maxItems"
                >
                  <i class="fas fa-plus"></i>
                  Agregar Nueva Cualidad
                </button>
                <small v-if="localBlock.items.length >= maxItems" class="max-items-notice">
                  Máximo {{ maxItems }} items permitidos
                </small>
              </div>
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
                    placeholder="mis-cualidades-unicas"
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
                    placeholder="mis-cualidades otra-clase"
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
                    placeholder="/* CSS personalizado para este bloque de cualidades */
.mis-cualidades {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  border-radius: 15px;
  box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

.mis-cualidades .item {
  transition: transform 0.3s ease;
}

.mis-cualidades .item:hover {
  transform: scale(1.05);
}"
                  ></textarea>
                  <small class="form-help">Este CSS se aplicará únicamente a este bloque</small>
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
import type { CualidadesBlock as CualidadesBlockType, CualidadItem } from '@/types/blocks'

interface Props {
  block: CualidadesBlockType
}

interface Emits {
  (e: 'update', block: CualidadesBlockType): void
  (e: 'close'): void
}

const props = defineProps<Props>()
const emit = defineEmits<Emits>()

// Estado de las pestañas
const activeTab = ref('general')

// Inicializar bloque con campos de atributos si no existen
const initializeBlock = (block: CualidadesBlockType): CualidadesBlockType => {
  return {
    ...block,
    customId: block.customId || '',
    customClass: block.customClass || '',
    customCSS: block.customCSS || ''
  }
}

const localBlock = ref<CualidadesBlockType>(initializeBlock({ ...props.block }))
const maxItems = 8 // Máximo 8 items (2 filas de 4)

// Media picker setup
const { getFullMediaUrl } = useMediaPicker()
const showMediaPicker = ref(false)
const selectedMediaForPicker = ref<any[]>([])
const currentItemIndex = ref<number>(-1)

const gradientPreviewStyle = computed(() => ({
  background: `radial-gradient(circle at center, ${localBlock.value.backgroundGradient.colorStart}, ${localBlock.value.backgroundGradient.colorEnd})`
}))

// Aplicar cambios y cerrar modal
const applyChanges = () => {
  emit('update', { ...localBlock.value })
  emit('close')
}

// Métodos para manejo de items
const addItem = () => {
  if (localBlock.value.items.length < maxItems) {
    const newItem: CualidadItem = {
      image: '',
      text: `Cualidad ${localBlock.value.items.length + 1}`,
      textColor: ''
    }
    localBlock.value.items.push(newItem)
  }
}

const removeItem = (index: number) => {
  localBlock.value.items.splice(index, 1)
}

// Media picker methods
const openImagePicker = (index: number) => {
  currentItemIndex.value = index
  selectedMediaForPicker.value = []
  showMediaPicker.value = true
}

const closeMediaPicker = () => {
  showMediaPicker.value = false
  selectedMediaForPicker.value = []
  currentItemIndex.value = -1
}

const onMediaSelected = (media: any) => {
  if (currentItemIndex.value >= 0) {
    localBlock.value.items[currentItemIndex.value].image = getFullMediaUrl(media)
  }
  closeMediaPicker()
}

const clearItemImage = (index: number) => {
  localBlock.value.items[index].image = ''
}

const clearItemTextColor = (index: number) => {
  localBlock.value.items[index].textColor = ''
}

const resetToDefaults = () => {
  localBlock.value = {
    ...localBlock.value,
    title: 'Un enfoque claro, confiable y estructurado',
    titleColor: '#ffffff',
    itemsTextColor: '#ffffff',
    backgroundGradient: {
      colorStart: '#0c6a44',
      colorEnd: '#052b1b'
    },
    items: [
      {
        image: '',
        text: 'Diagnóstico financiero y contable inicial',
        textColor: ''
      },
      {
        image: '',
        text: 'Asesoría personalizada',
        textColor: ''
      },
      {
        image: '',
        text: 'Implementación de procesos',
        textColor: ''
      },
      {
        image: '',
        text: 'Seguimiento continuo',
        textColor: ''
      }
    ]
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

.gradient-controls {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  margin-bottom: 1rem;
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

.gradient-preview {
  height: 60px;
  border-radius: 8px;
  border: 2px solid #dee2e6;
  margin-top: 0.5rem;
}

.items-section {
  grid-column: 1 / -1;
}

.items-list {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.item-editor {
  background: white;
  border: 2px solid #e9ecef;
  border-radius: 8px;
  padding: 1rem;
  transition: border-color 0.3s ease;
}

.item-editor:hover {
  border-color: #007bff;
}

.item-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
  padding-bottom: 0.5rem;
  border-bottom: 1px solid #e9ecef;
}

.item-header h5 {
  margin: 0;
  color: #495057;
  font-size: 1rem;
  font-weight: 600;
}

.btn-remove {
  background: #dc3545;
  color: white;
  border: none;
  border-radius: 6px;
  padding: 0.5rem 0.75rem;
  cursor: pointer;
  font-size: 0.875rem;
  display: flex;
  align-items: center;
  gap: 0.25rem;
  transition: all 0.3s ease;
}

.btn-remove:hover {
  background: #c82333;
  transform: translateY(-1px);
}

.item-content {
  display: grid;
  grid-template-columns: 1fr 2fr 1fr;
  gap: 1rem;
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
  max-width: 80px;
  max-height: 80px;
  border-radius: 6px;
  object-fit: cover;
}

.btn-remove-media {
  position: absolute;
  top: -8px;
  right: -8px;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: #dc3545;
  color: white;
  border: none;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.7rem;
}

.media-placeholder {
  color: #6c757d;
  margin-bottom: 1rem;
}

.media-placeholder i {
  font-size: 1.5rem;
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

.btn-clear-small {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 32px;
  height: 32px;
  background: #dc3545;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 0.75rem;
  transition: all 0.3s ease;
}

.btn-clear-small:hover {
  background: #c82333;
  transform: translateY(-1px);
}

.add-item-section {
  text-align: center;
  padding: 1rem;
  background: #f8f9fa;
  border: 2px dashed #dee2e6;
  border-radius: 8px;
}

.btn-add-item {
  background: #28a745;
  color: white;
  border: none;
  border-radius: 6px;
  padding: 0.75rem 1.5rem;
  cursor: pointer;
  font-size: 0.9rem;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  margin: 0 auto;
  transition: all 0.3s ease;
}

.btn-add-item:hover:not(:disabled) {
  background: #218838;
  transform: translateY(-1px);
}

.btn-add-item:disabled {
  background: #6c757d;
  cursor: not-allowed;
  opacity: 0.6;
}

.max-items-notice {
  display: block;
  margin-top: 0.5rem;
  color: #6c757d;
  font-style: italic;
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
  .gradient-controls {
    gap: 0.5rem;
  }
  
  .item-content {
    grid-template-columns: 1fr;
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