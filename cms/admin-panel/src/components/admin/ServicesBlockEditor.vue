<template>
  <div class="modal-overlay">
    <div class="modal-content" @click.stop>
      <!-- Modal Header -->
      <div class="modal-header">
        <h3>Editar Bloque de Servicios</h3>
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
            @click="activeTab = 'services'"
            class="tab-button"
            :class="{ active: activeTab === 'services' }"
          >
            <Icon name="briefcase" />
            Servicios ({{ localBlock.services.length }})
          </button>
          <button 
            @click="activeTab = 'styles'"
            class="tab-button"
            :class="{ active: activeTab === 'styles' }"
          >
            <Icon name="palette" />
            Estilos
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
                <h4>Información del Bloque</h4>
                
                <div class="form-row">
                  <div class="form-group">
                    <label for="block-title">Título del bloque (opcional)</label>
                    <input 
                      type="text" 
                      id="block-title"
                      v-model="localBlock.title" 
                      class="form-input"
                      placeholder="Nuestros Servicios"
                    >
                  </div>
                  <div class="form-group">
                    <label for="block-subtitle">Subtítulo (opcional)</label>
                    <input 
                      type="text" 
                      id="block-subtitle"
                      v-model="localBlock.subtitle" 
                      class="form-input"
                      placeholder="Descubre lo que podemos hacer por ti"
                    >
                  </div>
                </div>
              </div>

              <div class="editor-section">
                <h4>Configuración del Layout</h4>
                
                <div class="form-row">
                  <div class="form-group">
                    <label for="display-mode">Modo de visualización</label>
                    <select id="display-mode" v-model="localBlock.displayMode" class="form-input">
                      <option value="tabs">Tabs/Pestañas</option>
                      <option value="accordion">Acordeón</option>
                      <option value="cards">Tarjetas</option>
                    </select>
                  </div>
                  
                  <div class="form-group" v-if="localBlock.displayMode === 'cards' || localBlock.displayMode === 'accordion'">
                    <label for="columns">Número de columnas</label>
                    <select id="columns" v-model="localBlock.columnsCount" class="form-input">
                      <option :value="1">1 columna</option>
                      <option :value="2">2 columnas</option>
                      <option :value="3">3 columnas</option>
                      <option :value="4">4 columnas</option>
                    </select>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group">
                    <label for="gap">Espaciado entre servicios</label>
                    <select id="gap" v-model="localBlock.gap" class="form-input">
                      <option value="none">Sin espaciado</option>
                      <option value="small">Pequeño</option>
                      <option value="medium">Mediano</option>
                      <option value="large">Grande</option>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="padding">Padding del bloque</label>
                    <select id="padding" v-model="localBlock.padding" class="form-input">
                      <option value="none">Sin padding</option>
                      <option value="small">Pequeño</option>
                      <option value="medium">Mediano</option>
                      <option value="large">Grande</option>
                    </select>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group">
                    <label for="alignment">Alineación</label>
                    <select id="alignment" v-model="localBlock.alignment" class="form-input">
                      <option value="left">Izquierda</option>
                      <option value="center">Centro</option>
                      <option value="right">Derecha</option>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="icon-size">Tamaño de íconos</label>
                    <select id="icon-size" v-model="localBlock.iconSize" class="form-input">
                      <option value="small">Pequeño</option>
                      <option value="medium">Mediano</option>
                      <option value="large">Grande</option>
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

          <!-- Servicios Tab -->
          <div v-show="activeTab === 'services'" class="tab-pane">
            <div class="editor-sections">
              <div class="editor-section">
                <div class="section-header">
                  <h4>Gestión de Servicios</h4>
                  <button @click="addNewService" class="btn-primary">
                    <Icon name="plus" />
                    Agregar Servicio
                  </button>
                </div>
                
                <div v-if="localBlock.services.length === 0" class="empty-services">
                  <div class="empty-state">
                    <Icon name="briefcase" />
                    <h4>Sin servicios</h4>
                    <p>Agrega servicios para mostrar a tus clientes</p>
                    <button @click="addNewService" class="btn-primary">
                      <Icon name="plus" />
                      Agregar Primer Servicio
                    </button>
                  </div>
                </div>

                <div v-else class="services-list">
                  <div 
                    v-for="(service, index) in localBlock.services"
                    :key="service.id"
                    class="service-item"
                  >
                    <div class="service-icon">
                      <div v-if="service.icon" class="icon-preview">
                        <img 
                          :src="buildMediaUrl(service.icon)" 
                          :alt="service.title"
                          @load="() => console.log('ServicesBlockEditor - Icon loaded:', service.title, service.icon)"
                          @error="(e) => console.error('ServicesBlockEditor - Icon error:', service.title, service.icon, e)"
                        />
                      </div>
                      <div v-else class="icon-placeholder">
                        <Icon name="photo" />
                      </div>
                      <button @click="openMediaPickerForService(index)" class="btn-icon">
                        <Icon name="photo" />
                        {{ service.icon ? 'Cambiar' : 'Agregar' }}
                      </button>
                    </div>
                    
                    <div class="service-details">
                      <div class="form-group">
                        <label>Título del servicio</label>
                        <input 
                          v-model="service.title" 
                          type="text" 
                          class="form-input"
                          placeholder="Desarrollo Web"
                        >
                      </div>
                      
                      <div class="form-group">
                        <label>Descripción corta</label>
                        <textarea 
                          v-model="service.shortDescription" 
                          class="form-input"
                          rows="2"
                          placeholder="Breve descripción que aparece cuando el servicio está cerrado..."
                        ></textarea>
                      </div>
                      
                      <div class="form-group">
                        <label>Descripción larga (con texto enriquecido)</label>
                        <div class="editor-container">
                          <TiptapEditor 
                            v-model="service.longDescription"
                            :loading="false"
                          />
                        </div>
                      </div>
                    </div>
                    
                    <div class="service-actions">
                      <button 
                        @click="moveServiceUp(index)" 
                        :disabled="index === 0"
                        class="btn-move"
                        title="Mover arriba"
                      >
                        <Icon name="chevron-up" />
                      </button>
                      <button 
                        @click="moveServiceDown(index)" 
                        :disabled="index === localBlock.services.length - 1"
                        class="btn-move"
                        title="Mover abajo"
                      >
                        <Icon name="chevron-down" />
                      </button>
                      <button 
                        @click="removeService(index)" 
                        class="btn-delete"
                        title="Eliminar servicio"
                      >
                        <Icon name="trash" />
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Estilos Tab -->
          <div v-show="activeTab === 'styles'" class="tab-pane">
            <div class="editor-sections">
              <div class="editor-section">
                <h4>Personalización Visual</h4>
                
                <div class="form-group">
                  <label>Vista previa del modo de visualización</label>
                  <div class="display-mode-preview" :class="`mode-${localBlock.displayMode}`">
                    <div class="preview-content">
                      <div class="preview-item">
                        <div class="preview-icon"></div>
                        <div class="preview-text">
                          <div class="preview-title">Servicio Ejemplo</div>
                          <div class="preview-desc">Descripción del servicio</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="info-box">
                  <Icon name="info" />
                  <div>
                    <strong>Información sobre modos:</strong>
                    <ul>
                      <li><strong>Tabs:</strong> Los servicios se muestran como pestañas horizontales</li>
                      <li><strong>Acordeón:</strong> Los servicios se expanden/contraen verticalmente. Puedes configurar múltiples columnas para mostrar acordeones lado a lado</li>
                      <li><strong>Cards:</strong> Cada servicio es una tarjeta independiente en un grid</li>
                    </ul>
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
                    placeholder="mis-servicios-unicos"
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
                    placeholder="/* CSS personalizado para este bloque de servicios */
.mis-servicios .service-tab {
  background: linear-gradient(45deg, #007bff, #17a2b8);
  color: white;
  border-radius: 8px;
}

.mis-servicios .service-icon {
  filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
}

.mis-servicios .service-content {
  animation: fadeIn 0.3s ease-in-out;
}"
                  ></textarea>
                  <small class="form-help">Este CSS se aplicará únicamente a este bloque de servicios</small>
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
import TiptapEditor from './TiptapEditor.vue'
import type { ServicesBlock, ServiceItem } from '@/types/blocks'
import { buildMediaUrl } from '@/utils/mediaUtils'

interface Props {
  block: ServicesBlock
}

interface Emits {
  (e: 'update', block: ServicesBlock): void
  (e: 'update-real-time', block: ServicesBlock): void
  (e: 'close'): void
}

const props = defineProps<Props>()
const emit = defineEmits<Emits>()

// Estado de las pestañas
const activeTab = ref('general')
const showMediaPicker = ref(false)
const currentServiceIndex = ref<number | null>(null)

// Estado local del bloque  
const localBlock = ref<ServicesBlock>({ 
  ...props.block,
  services: props.block.services || []
})

// Generar ID único
const generateId = () => Math.random().toString(36).substr(2, 9)

// Abrir selector de medios para un servicio específico
const openMediaPickerForService = (index: number) => {
  currentServiceIndex.value = index
  showMediaPicker.value = true
}

// Manejar selección de medios
const handleMediaSelect = (selectedMedia: any[]) => {
  console.log('ServicesBlockEditor - handleMediaSelect:', selectedMedia)
  
  if (currentServiceIndex.value !== null && selectedMedia.length > 0) {
    const media = selectedMedia[0] // Tomar solo la primera imagen seleccionada
    console.log('ServicesBlockEditor - Selected media:', media)
    
    // Asegurar que el servicio existe
    if (localBlock.value.services[currentServiceIndex.value]) {
      localBlock.value.services[currentServiceIndex.value].icon = media.url
      localBlock.value.services[currentServiceIndex.value].mediaId = media.id
      
      console.log('ServicesBlockEditor - Updated service icon:', media.url)
    }
  }
  showMediaPicker.value = false
  currentServiceIndex.value = null
}

// Agregar nuevo servicio
const addNewService = () => {
  const newService: ServiceItem = {
    id: generateId(),
    icon: '',
    title: '',
    shortDescription: '',
    longDescription: '<p>Descripción detallada del servicio...</p>'
  }
  localBlock.value.services.push(newService)
}

// Mover servicio hacia arriba
const moveServiceUp = (index: number) => {
  if (index > 0) {
    const temp = localBlock.value.services[index]
    localBlock.value.services[index] = localBlock.value.services[index - 1]
    localBlock.value.services[index - 1] = temp
  }
}

// Mover servicio hacia abajo
const moveServiceDown = (index: number) => {
  if (index < localBlock.value.services.length - 1) {
    const temp = localBlock.value.services[index]
    localBlock.value.services[index] = localBlock.value.services[index + 1]
    localBlock.value.services[index + 1] = temp
  }
}

// Remover servicio
const removeService = (index: number) => {
  if (confirm('¿Estás seguro de eliminar este servicio?')) {
    localBlock.value.services.splice(index, 1)
  }
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

/* Services management */
.empty-services {
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

.empty-state h4 {
  margin: 1rem 0 0.5rem 0;
  color: #495057;
  font-size: 1.5rem;
}

.empty-state p {
  margin: 0 0 1rem 0;
  font-size: 1rem;
}

.services-list {
  display: flex;
  flex-direction: column;
  gap: 2rem;
}

.service-item {
  display: grid;
  grid-template-columns: 150px 1fr auto;
  gap: 1.5rem;
  padding: 1.5rem;
  border: 1px solid #dee2e6;
  border-radius: 8px;
  background: white;
  align-items: start;
}

.service-icon {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.75rem;
}

.icon-preview {
  width: 80px;
  height: 80px;
  border-radius: 8px;
  overflow: hidden;
  background: #f8f9fa;
  display: flex;
  align-items: center;
  justify-content: center;
}

.icon-preview img {
  width: 100%;
  height: 100%;
  object-fit: contain;
}

.icon-placeholder {
  width: 80px;
  height: 80px;
  border-radius: 8px;
  background: #f8f9fa;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #6c757d;
  font-size: 2rem;
}

.btn-icon {
  padding: 0.5rem 1rem;
  background: #007bff;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 0.8rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  transition: background 0.2s ease;
}

.btn-icon:hover {
  background: #0056b3;
}

.service-details {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.service-details .form-group {
  margin-bottom: 0;
}

.editor-container {
  border: 1px solid #dee2e6;
  border-radius: 6px;
  overflow: hidden;
}

.service-actions {
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

/* Display mode preview */
.display-mode-preview {
  padding: 1rem;
  border: 1px solid #dee2e6;
  border-radius: 6px;
  background: white;
  margin-top: 0.5rem;
}

.preview-content {
  display: flex;
  gap: 1rem;
}

.preview-item {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem;
  border: 1px solid #e9ecef;
  border-radius: 4px;
  flex: 1;
}

.preview-icon {
  width: 24px;
  height: 24px;
  background: #007bff;
  border-radius: 4px;
}

.preview-text {
  flex: 1;
}

.preview-title {
  font-weight: 600;
  color: #2c3e50;
  font-size: 0.9rem;
  margin-bottom: 0.25rem;
}

.preview-desc {
  color: #6c757d;
  font-size: 0.8rem;
}

.mode-tabs .preview-content {
  flex-direction: row;
}

.mode-accordion .preview-content {
  flex-direction: column;
}

.mode-cards .preview-content {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1rem;
}

.info-box {
  display: flex;
  gap: 1rem;
  padding: 1rem;
  background: #e3f2fd;
  border: 1px solid #bbdefb;
  border-radius: 6px;
  margin-top: 1rem;
}

.info-box ul {
  margin: 0.5rem 0 0 0;
  padding-left: 1.5rem;
}

.info-box li {
  margin-bottom: 0.25rem;
  font-size: 0.9rem;
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
  
  .service-item {
    grid-template-columns: 1fr;
    text-align: center;
  }
  
  .service-icon {
    justify-self: center;
  }
  
  .tabs-nav {
    flex-wrap: wrap;
  }
  
  .tab-button {
    min-width: 50%;
    font-size: 0.8rem;
  }
  
  .preview-content {
    flex-direction: column;
  }
  
  .mode-cards .preview-content {
    grid-template-columns: 1fr;
  }
}
</style>