<template>
  <div class="modal-overlay">
    <div class="modal-content" @click.stop>
      <!-- Modal Header -->
      <div class="modal-header">
        <h3>Editar Galería de Imágenes</h3>
        <button @click="$emit('close')" class="btn-close">
          <Icon name="close" />
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
            <Icon name="settings" />
            Configuración General
          </button>
          <button 
            @click="activeTab = 'images'"
            class="tab-button"
            :class="{ active: activeTab === 'images' }"
          >
            <Icon name="image" />
            Imágenes ({{ localBlock.items.length }})
          </button>
          <button 
            @click="activeTab = 'styles'"
            class="tab-button"
            :class="{ active: activeTab === 'styles' }"
          >
            <Icon name="palette" />
            Estilos y Máscaras
          </button>
          <button 
            @click="activeTab = 'attributes'"
            class="tab-button"
            :class="{ active: activeTab === 'attributes' }"
          >
            <Icon name="code" />
            Atributos
          </button>
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
          <!-- Configuración General Tab -->
          <div v-show="activeTab === 'general'" class="tab-pane">
            <div class="editor-sections">
              <div class="editor-section">
                <h4>Configuración del Grid</h4>
                
                <div class="form-row">
                  <div class="form-group">
                    <label for="columns">Número de columnas</label>
                    <select id="columns" v-model="localBlock.columnsCount" class="form-input">
                      <option :value="1">1 columna</option>
                      <option :value="2">2 columnas</option>
                      <option :value="3">3 columnas</option>
                      <option :value="4">4 columnas</option>
                      <option :value="5">5 columnas</option>
                      <option :value="6">6 columnas</option>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="gap">Espaciado entre imágenes</label>
                    <select id="gap" v-model="localBlock.gap" class="form-input">
                      <option value="none">Sin espaciado</option>
                      <option value="small">Pequeño</option>
                      <option value="medium">Mediano</option>
                      <option value="large">Grande</option>
                    </select>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group">
                    <label for="padding">Padding del bloque</label>
                    <select id="padding" v-model="localBlock.padding" class="form-input">
                      <option value="none">Sin padding</option>
                      <option value="small">Pequeño</option>
                      <option value="medium">Mediano</option>
                      <option value="large">Grande</option>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="alignment">Alineación</label>
                    <select id="alignment" v-model="localBlock.alignment" class="form-input">
                      <option value="left">Izquierda</option>
                      <option value="center">Centro</option>
                      <option value="right">Derecha</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="bg-color">Color de fondo del bloque</label>
                  <div class="color-input-group">
                    <input 
                      type="color" 
                      id="bg-color" 
                      :value="localBlock.backgroundColor || '#ffffff'"
                      @input="localBlock.backgroundColor = ($event.target as HTMLInputElement).value"
                      class="color-picker"
                    >
                    <input 
                      type="text" 
                      v-model="localBlock.backgroundColor" 
                      class="color-text"
                      placeholder="Transparente"
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Imágenes Tab -->
          <div v-show="activeTab === 'images'" class="tab-pane">
            <div class="editor-sections">
              <div class="editor-section">
                <div class="section-header">
                  <h4>Gestión de Imágenes</h4>
                  <button @click="openMediaPicker" class="btn-primary">
                    <Icon name="plus" />
                    Agregar Imágenes
                  </button>
                </div>
                
                <div v-if="localBlock.items.length === 0" class="empty-images">
                  <div class="empty-state">
                    <i class="fas fa-images"></i>
                    <h4>Sin imágenes</h4>
                    <p>Agrega imágenes para crear tu galería</p>
                    <button @click="openMediaPicker" class="btn-primary">
                      <Icon name="plus" />
                      Agregar Primeras Imágenes
                    </button>
                  </div>
                </div>

                <div v-else class="images-list">
                  <div 
                    v-for="(item, index) in localBlock.items"
                    :key="item.id"
                    class="image-item"
                  >
                    <div class="image-preview">
                      <img :src="buildMediaUrl(item.src)" :alt="item.alt" />
                    </div>
                    <div class="image-details">
                      <div class="form-group">
                        <label>Texto alternativo</label>
                        <input 
                          v-model="item.alt" 
                          type="text" 
                          class="form-input"
                          placeholder="Descripción de la imagen"
                        >
                      </div>
                      <div class="form-group">
                        <label>Caption (opcional)</label>
                        <input 
                          v-model="item.caption" 
                          type="text" 
                          class="form-input"
                          placeholder="Texto que aparece sobre la imagen"
                        >
                      </div>
                      <div class="form-row">
                        <div class="form-group">
                          <label>Enlace (opcional)</label>
                          <input 
                            v-model="item.link" 
                            type="url" 
                            class="form-input"
                            placeholder="https://ejemplo.com"
                          >
                        </div>
                        <div class="form-group">
                          <label>Target</label>
                          <select v-model="item.linkTarget" class="form-input">
                            <option value="_self">Misma ventana</option>
                            <option value="_blank">Nueva ventana</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="image-actions">
                      <button 
                        @click="moveImageUp(index)" 
                        :disabled="index === 0"
                        class="btn-move"
                        title="Mover arriba"
                      >
                        <Icon name="chevron-up" />
                      </button>
                      <button 
                        @click="moveImageDown(index)" 
                        :disabled="index === localBlock.items.length - 1"
                        class="btn-move"
                        title="Mover abajo"
                      >
                        <Icon name="chevron-down" />
                      </button>
                      <button 
                        @click="removeImage(index)" 
                        class="btn-delete"
                        title="Eliminar imagen"
                      >
                        <Icon name="trash" />
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Estilos y Máscaras Tab -->
          <div v-show="activeTab === 'styles'" class="tab-pane">
            <div class="editor-sections">
              <div class="editor-section">
                <h4>Formato de Imagen</h4>
                
                <div class="form-group">
                  <label for="aspect-ratio">Relación de aspecto</label>
                  <select id="aspect-ratio" v-model="localBlock.aspectRatio" class="form-input">
                    <option value="square">Cuadrado (1:1)</option>
                    <option value="4:3">Paisaje (4:3)</option>
                    <option value="16:9">Panorámico (16:9)</option>
                    <option value="3:4">Retrato (3:4)</option>
                    <option value="9:16">Vertical (9:16)</option>
                    <option value="auto">Automático</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="hover-effect">Efecto hover</label>
                  <select id="hover-effect" v-model="localBlock.hoverEffect" class="form-input">
                    <option value="none">Sin efecto</option>
                    <option value="zoom">Zoom</option>
                    <option value="fade">Desvanecimiento</option>
                    <option value="lift">Elevación</option>
                  </select>
                </div>
              </div>

              <div class="editor-section">
                <h4>Máscaras y Formas</h4>
                
                <div class="form-group">
                  <label for="mask-type">Tipo de máscara</label>
                  <select id="mask-type" v-model="localBlock.maskType" class="form-input">
                    <option value="none">Sin máscara</option>
                    <option value="circle">Circular</option>
                    <option value="rounded">Redondeado</option>
                    <option value="custom">Personalizado (SVG)</option>
                  </select>
                </div>

                <div v-if="localBlock.maskType === 'rounded'" class="form-group">
                  <label for="border-radius">Radio del borde (px)</label>
                  <input 
                    type="number" 
                    id="border-radius" 
                    v-model.number="localBlock.borderRadius"
                    min="0"
                    max="50"
                    class="form-input"
                  >
                </div>

                <div v-if="localBlock.maskType === 'custom'" class="form-group">
                  <label for="custom-mask">Path SVG personalizado</label>
                  <textarea 
                    id="custom-mask" 
                    v-model="localBlock.customMask"
                    rows="4"
                    class="form-input"
                    placeholder="M10,10 L90,10 L90,90 L10,90 Z"
                  ></textarea>
                  <small class="form-help">Introduce un path SVG válido para crear formas personalizadas</small>
                </div>

                <!-- Vista previa de máscara -->
                <div v-if="localBlock.maskType !== 'none'" class="mask-preview">
                  <h5>Vista previa</h5>
                  <div 
                    class="preview-sample"
                    :class="[`mask-${localBlock.maskType}`]"
                    :style="getMaskPreviewStyles()"
                  >
                    <div class="sample-content">Ejemplo</div>
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
                    placeholder="mi-galeria-unica"
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
                    placeholder="mi-clase otra-clase"
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
                    placeholder="/* CSS personalizado para esta galería */
.mi-galeria {
  border: 2px solid #007bff;
  border-radius: 15px;
}

.gallery-image {
  filter: grayscale(100%);
  transition: filter 0.3s ease;
}

.gallery-image:hover {
  filter: grayscale(0%);
}"
                  ></textarea>
                  <small class="form-help">Este CSS se aplicará únicamente a esta galería</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Modal Footer -->
      <div class="modal-footer">
        <button @click="$emit('close')" class="btn-secondary">
          <Icon name="close" />
          Cancelar
        </button>
        <button @click="applyChanges" class="btn-primary">
          <Icon name="check" />
          Aplicar Cambios
        </button>
      </div>
    </div>

    <!-- Media Picker Modal -->
    <MediaPicker
      :show="showMediaPicker"
      :type-filter="'image'"
      :multiple="true"
      :selected-media="[]"
      @close="showMediaPicker = false"
      @select="handleMediaSelect"
    />
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import Icon from '@/components/global/Icon.vue'
import MediaPicker from './MediaPicker.vue'
import type { ImageGalleryBlock, ImageGalleryItem } from '@/types/blocks'
import { buildMediaUrl } from '@/utils/mediaUtils'

interface Props {
  block: ImageGalleryBlock
}

interface Emits {
  (e: 'update', block: ImageGalleryBlock): void
  (e: 'update-real-time', block: ImageGalleryBlock): void
  (e: 'close'): void
}

const props = defineProps<Props>()
const emit = defineEmits<Emits>()

// Estado de las pestañas
const activeTab = ref('general')
const showMediaPicker = ref(false)

// Estado local del bloque
const localBlock = ref<ImageGalleryBlock>({ ...props.block })

// Generar ID único
const generateId = () => Math.random().toString(36).substr(2, 9)

// Abrir selector de medios
const openMediaPicker = () => {
  showMediaPicker.value = true
}

// Manejar selección de medios
const handleMediaSelect = (selectedMedia: any[]) => {
  const newItems: ImageGalleryItem[] = selectedMedia.map(media => ({
    id: generateId(),
    mediaId: media.id,
    src: media.url,
    alt: media.name || 'Imagen de galería',
    caption: '',
    link: '',
    linkTarget: '_self'
  }))
  
  localBlock.value.items.push(...newItems)
  showMediaPicker.value = false
}

// Mover imagen hacia arriba
const moveImageUp = (index: number) => {
  if (index > 0) {
    const temp = localBlock.value.items[index]
    localBlock.value.items[index] = localBlock.value.items[index - 1]
    localBlock.value.items[index - 1] = temp
  }
}

// Mover imagen hacia abajo
const moveImageDown = (index: number) => {
  if (index < localBlock.value.items.length - 1) {
    const temp = localBlock.value.items[index]
    localBlock.value.items[index] = localBlock.value.items[index + 1]
    localBlock.value.items[index + 1] = temp
  }
}

// Remover imagen
const removeImage = (index: number) => {
  if (confirm('¿Estás seguro de eliminar esta imagen?')) {
    localBlock.value.items.splice(index, 1)
  }
}

// Obtener estilos para la vista previa de máscara
const getMaskPreviewStyles = () => {
  const styles: Record<string, string> = {}
  
  switch (localBlock.value.maskType) {
    case 'circle':
      styles.clipPath = 'circle(50%)'
      break
    case 'rounded':
      styles.borderRadius = `${localBlock.value.borderRadius || 12}px`
      break
    case 'custom':
      if (localBlock.value.customMask) {
        styles.clipPath = `path('${localBlock.value.customMask}')`
      }
      break
  }
  
  return styles
}

// Aplicar cambios y cerrar modal
const applyChanges = () => {
  emit('update', { ...localBlock.value })
  emit('close')
}
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

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.section-header h4 {
  margin: 0;
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

/* Images management */
.empty-images {
  min-height: 200px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.empty-state {
  text-align: center;
  color: #6c757d;
  padding: 2rem;
}

.empty-state i {
  font-size: 3rem;
  margin-bottom: 1rem;
  opacity: 0.5;
  display: block;
}

.empty-state h4 {
  margin: 0 0 0.5rem 0;
  color: #495057;
  font-size: 1.5rem;
}

.empty-state p {
  margin: 0 0 1rem 0;
  font-size: 1rem;
}

.images-list {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.image-item {
  display: grid;
  grid-template-columns: 120px 1fr auto;
  gap: 1rem;
  padding: 1rem;
  border: 1px solid #dee2e6;
  border-radius: 8px;
  background: white;
  align-items: start;
}

.image-preview {
  width: 120px;
  height: 80px;
  border-radius: 6px;
  overflow: hidden;
  background: #f8f9fa;
}

.image-preview img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.image-details {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.image-details .form-group {
  margin-bottom: 0;
}

.image-actions {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.btn-move,
.btn-delete {
  padding: 0.5rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 0.8rem;
  transition: all 0.2s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn-move {
  background: #17a2b8;
  color: white;
}

.btn-move:hover:not(:disabled) {
  background: #138496;
}

.btn-move:disabled {
  background: #6c757d;
  cursor: not-allowed;
}

.btn-delete {
  background: #dc3545;
  color: white;
}

.btn-delete:hover {
  background: #c82333;
}

/* Mask preview */
.mask-preview {
  margin-top: 1rem;
  padding: 1rem;
  background: white;
  border-radius: 6px;
  border: 1px solid #dee2e6;
}

.mask-preview h5 {
  margin: 0 0 1rem 0;
  color: #495057;
  font-size: 0.9rem;
}

.preview-sample {
  width: 80px;
  height: 80px;
  background: linear-gradient(45deg, #007bff, #17a2b8);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-weight: 600;
  font-size: 0.8rem;
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

/* Responsive */
@media (max-width: 768px) {
  .modal-content {
    width: 95%;
    height: 95%;
  }
  
  .modal-body {
    padding: 1rem;
  }
  
  .form-row {
    grid-template-columns: 1fr;
  }
  
  .image-item {
    grid-template-columns: 1fr;
    text-align: center;
  }
  
  .image-preview {
    justify-self: center;
  }
  
  .tabs-nav {
    flex-wrap: wrap;
  }
  
  .tab-button {
    min-width: 50%;
    font-size: 0.8rem;
  }
}
</style>