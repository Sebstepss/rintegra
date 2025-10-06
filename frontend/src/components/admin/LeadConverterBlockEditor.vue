<template>
  <div class="modal-overlay" @click="handleBackdropClick">
    <div class="modal-content modal-extra-large" @click.stop>
      <div class="modal-header">
        <h4>Editor de Conversor de Leads</h4>
        <button @click="close" class="btn-close">
          <Icon name="close" />
        </button>
      </div>
      
      <div class="modal-body">
        <div class="editor-layout">
          <!-- Panel de configuración -->
          <div class="editor-sidebar">
            <div class="tabs">
              <button 
                v-for="tab in tabs" 
                :key="tab.id"
                @click="activeTab = tab.id"
                :class="['tab-button', { active: activeTab === tab.id }]"
              >
                {{ tab.label }}
              </button>
            </div>

            <!-- Tab: Contenido -->
            <div v-show="activeTab === 'content'" class="tab-content">
              <div class="form-section">
                <label>Headline Principal</label>
                <textarea 
                  v-model="localBlock.headline" 
                  rows="3"
                  @input="updateRealTime"
                ></textarea>
              </div>

              <div class="form-section">
                <label>Subheadline</label>
                <textarea 
                  v-model="localBlock.subheadline" 
                  rows="3"
                  @input="updateRealTime"
                ></textarea>
              </div>

              <div class="form-section">
                <label class="checkbox-label">
                  <input 
                    type="checkbox" 
                    v-model="localBlock.showCountdown"
                    @change="updateRealTime"
                  />
                  Mostrar contador regresivo
                </label>
              </div>

              <div v-if="localBlock.showCountdown" class="form-section">
                <label>Texto del countdown</label>
                <input 
                  v-model="localBlock.countdownLabel" 
                  type="text"
                  @input="updateRealTime"
                />
              </div>

              <div v-if="localBlock.showCountdown" class="form-section">
                <label>Duración en horas</label>
                <input 
                  v-model.number="localBlock.countdownHours" 
                  type="number"
                  min="1"
                  max="168"
                  @input="updateRealTime"
                />
              </div>
            </div>

            <!-- Tab: Formulario -->
            <div v-show="activeTab === 'form'" class="tab-content">
              <div class="form-section">
                <label>URL de destino (webhook)</label>
                <input 
                  v-model="localBlock.formAction" 
                  type="url"
                  placeholder="https://tu-webhook.com/lead"
                  @input="updateRealTime"
                />
              </div>

              <div class="form-section">
                <label>Método HTTP</label>
                <select v-model="localBlock.formMethod" @change="updateRealTime">
                  <option value="POST">POST</option>
                  <option value="GET">GET</option>
                </select>
              </div>

              <div class="form-section">
                <label>Label Nombre</label>
                <input 
                  v-model="localBlock.nameLabel" 
                  type="text"
                  @input="updateRealTime"
                />
              </div>

              <div class="form-section">
                <label>Label WhatsApp</label>
                <input 
                  v-model="localBlock.phoneLabel" 
                  type="text"
                  @input="updateRealTime"
                />
              </div>

              <div class="form-section">
                <label>Label Email</label>
                <input 
                  v-model="localBlock.emailLabel" 
                  type="text"
                  @input="updateRealTime"
                />
              </div>

              <div class="form-section">
                <label>Label Situación</label>
                <input 
                  v-model="localBlock.situationLabel" 
                  type="text"
                  @input="updateRealTime"
                />
              </div>

              <div class="form-section">
                <label>Label Urgencia</label>
                <input 
                  v-model="localBlock.urgencyLabel" 
                  type="text"
                  @input="updateRealTime"
                />
              </div>

              <div class="form-section">
                <label>Texto del botón CTA</label>
                <input 
                  v-model="localBlock.ctaButtonText" 
                  type="text"
                  @input="updateRealTime"
                />
              </div>
            </div>

            <!-- Tab: Opciones Dropdown -->
            <div v-show="activeTab === 'dropdowns'" class="tab-content">
              <div class="form-section">
                <label>Opciones de Situación</label>
                <div class="options-list">
                  <div 
                    v-for="(option, index) in localBlock.situationOptions" 
                    :key="index"
                    class="option-item"
                  >
                    <input 
                      v-model="localBlock.situationOptions[index]"
                      type="text"
                      @input="updateRealTime"
                    />
                    <button 
                      @click="removeSituationOption(index)"
                      class="btn-remove"
                    >
                      <Icon name="delete" />
                    </button>
                  </div>
                </div>
                <button @click="addSituationOption" class="btn-add">
                  Agregar opción
                </button>
              </div>

              <div class="form-section">
                <label>Opciones de Urgencia</label>
                <div class="options-list">
                  <div 
                    v-for="(option, index) in localBlock.urgencyOptions" 
                    :key="index"
                    class="option-item"
                  >
                    <input 
                      v-model="localBlock.urgencyOptions[index]"
                      type="text"
                      @input="updateRealTime"
                    />
                    <button 
                      @click="removeUrgencyOption(index)"
                      class="btn-remove"
                    >
                      <Icon name="delete" />
                    </button>
                  </div>
                </div>
                <button @click="addUrgencyOption" class="btn-add">
                  Agregar opción
                </button>
              </div>
            </div>

            <!-- Tab: Value Stack -->
            <div v-show="activeTab === 'valuestack'" class="tab-content">
              <div class="form-section">
                <label class="checkbox-label">
                  <input 
                    type="checkbox" 
                    v-model="localBlock.showValueStack"
                    @change="updateRealTime"
                  />
                  Mostrar value stack
                </label>
              </div>

              <div v-if="localBlock.showValueStack" class="form-section">
                <label>Título del value stack</label>
                <input 
                  v-model="localBlock.valueStackTitle" 
                  type="text"
                  @input="updateRealTime"
                />
              </div>

              <div v-if="localBlock.showValueStack" class="form-section">
                <label>Items del value stack</label>
                <div class="value-items-list">
                  <div 
                    v-for="(item, index) in (localBlock.valueStackItems || [])" 
                    :key="item.id"
                    class="value-item-editor"
                  >
                    <label class="checkbox-label">
                      <input 
                        type="checkbox" 
                        v-model="item.enabled"
                        @change="updateRealTime"
                      />
                      Activo
                    </label>
                    <input 
                      v-model="item.text"
                      type="text"
                      placeholder="Texto del beneficio"
                      @input="updateRealTime"
                    />
                    <input 
                      v-model="item.value"
                      type="text"
                      placeholder="$300K"
                      @input="updateRealTime"
                    />
                    <button 
                      @click="removeValueItem(index)"
                      class="btn-remove"
                    >
                      <Icon name="delete" />
                    </button>
                  </div>
                </div>
                <button @click="addValueItem" class="btn-add">
                  Agregar item
                </button>
              </div>

              <div v-if="localBlock.showValueStack" class="form-section">
                <label>Valor total</label>
                <input 
                  v-model="localBlock.totalValue" 
                  type="text"
                  placeholder="$1,300K"
                  @input="updateRealTime"
                />
              </div>

              <div v-if="localBlock.showValueStack" class="form-section">
                <label>Precio de hoy</label>
                <input 
                  v-model="localBlock.todayPrice" 
                  type="text"
                  placeholder="COMPLETAMENTE GRATIS"
                  @input="updateRealTime"
                />
              </div>
            </div>

            <!-- Tab: Urgencia -->
            <div v-show="activeTab === 'urgency'" class="tab-content">
              <div class="form-section">
                <label class="checkbox-label">
                  <input 
                    type="checkbox" 
                    v-model="localBlock.showUrgencyElements"
                    @change="updateRealTime"
                  />
                  Mostrar elementos de urgencia
                </label>
              </div>

              <div v-if="localBlock.showUrgencyElements" class="form-section">
                <label>Elementos de urgencia</label>
                <div class="urgency-items-list">
                  <div 
                    v-for="(item, index) in (localBlock.urgencyItems || [])" 
                    :key="item.id"
                    class="urgency-item-editor"
                  >
                    <label class="checkbox-label">
                      <input 
                        type="checkbox" 
                        v-model="item.enabled"
                        @change="updateRealTime"
                      />
                      Activo
                    </label>
                    <label class="checkbox-label">
                      <input 
                        type="checkbox" 
                        v-model="item.animated"
                        @change="updateRealTime"
                      />
                      Animado
                    </label>
                    <input 
                      v-model="item.text"
                      type="text"
                      @input="updateRealTime"
                    />
                    <button 
                      @click="removeUrgencyItem(index)"
                      class="btn-remove"
                    >
                      <Icon name="delete" />
                    </button>
                  </div>
                </div>
                <button @click="addUrgencyItem" class="btn-add">
                  Agregar elemento
                </button>
              </div>

              <div v-if="localBlock.showUrgencyElements" class="form-section">
                <label>Texto de la barra de progreso</label>
                <input 
                  v-model="localBlock.progressBarText" 
                  type="text"
                  @input="updateRealTime"
                />
              </div>

              <div v-if="localBlock.showUrgencyElements" class="form-row">
                <div class="form-section">
                  <label>Total espacios</label>
                  <input 
                    v-model.number="localBlock.progressBarTotal" 
                    type="number"
                    min="1"
                    @input="updateRealTime"
                  />
                </div>
                <div class="form-section">
                  <label>Espacios ocupados</label>
                  <input 
                    v-model.number="localBlock.progressBarCurrent" 
                    type="number"
                    min="0"
                    :max="localBlock.progressBarTotal"
                    @input="updateRealTime"
                  />
                </div>
              </div>
            </div>

            <!-- Tab: Confianza -->
            <div v-show="activeTab === 'trust'" class="tab-content">
              <div class="form-section">
                <label class="checkbox-label">
                  <input 
                    type="checkbox" 
                    v-model="localBlock.showTrustElements"
                    @change="updateRealTime"
                  />
                  Mostrar elementos de confianza
                </label>
              </div>

              <div v-if="localBlock.showTrustElements" class="form-section">
                <label>Elementos de confianza</label>
                <div class="trust-items-list">
                  <div 
                    v-for="(item, index) in (localBlock.trustItems || [])" 
                    :key="item.id"
                    class="trust-item-editor"
                  >
                    <label class="checkbox-label">
                      <input 
                        type="checkbox" 
                        v-model="item.enabled"
                        @change="updateRealTime"
                      />
                      Activo
                    </label>
                    <textarea 
                      v-model="item.icon"
                      placeholder="<svg>...</svg> o emoji"
                      class="icon-input"
                      rows="2"
                      @input="updateRealTime"
                    ></textarea>
                    <input 
                      v-model="item.text"
                      type="text"
                      placeholder="Texto del elemento"
                      @input="updateRealTime"
                    />
                    <button 
                      @click="removeTrustItem(index)"
                      class="btn-remove"
                    >
                      <Icon name="delete" />
                    </button>
                  </div>
                </div>
                <button @click="addTrustItem" class="btn-add">
                  Agregar elemento
                </button>
              </div>
            </div>

            <!-- Tab: Colores -->
            <div v-show="activeTab === 'colors'" class="tab-content">
              <div class="form-section">
                <label class="checkbox-label">
                  <input 
                    type="checkbox" 
                    v-model="localBlock.useCustomColors"
                    @change="updateRealTime"
                  />
                  Usar colores personalizados
                </label>
              </div>

              <div v-if="localBlock.useCustomColors" class="color-customization">
                <div class="form-section">
                  <label>Verde principal</label>
                  <div class="color-input-group">
                    <input 
                      v-model="localBlock.primaryGreen" 
                      type="color"
                      @input="updateRealTime"
                    />
                    <input 
                      v-model="localBlock.primaryGreen" 
                      type="text"
                      @input="updateRealTime"
                    />
                  </div>
                </div>

                <div class="form-section">
                  <label>Dorado principal</label>
                  <div class="color-input-group">
                    <input 
                      v-model="localBlock.primaryGold" 
                      type="color"
                      @input="updateRealTime"
                    />
                    <input 
                      v-model="localBlock.primaryGold" 
                      type="text"
                      @input="updateRealTime"
                    />
                  </div>
                </div>

                <div class="form-section">
                  <label>Beige</label>
                  <div class="color-input-group">
                    <input 
                      v-model="localBlock.beige" 
                      type="color"
                      @input="updateRealTime"
                    />
                    <input 
                      v-model="localBlock.beige" 
                      type="text"
                      @input="updateRealTime"
                    />
                  </div>
                </div>

                <div class="form-section">
                  <label>Terracota</label>
                  <div class="color-input-group">
                    <input 
                      v-model="localBlock.terracotta" 
                      type="color"
                      @input="updateRealTime"
                    />
                    <input 
                      v-model="localBlock.terracotta" 
                      type="text"
                      @input="updateRealTime"
                    />
                  </div>
                </div>

                <div class="form-section">
                  <label>Blanco</label>
                  <div class="color-input-group">
                    <input 
                      v-model="localBlock.white" 
                      type="color"
                      @input="updateRealTime"
                    />
                    <input 
                      v-model="localBlock.white" 
                      type="text"
                      @input="updateRealTime"
                    />
                  </div>
                </div>
              </div>

              <div class="form-section">
                <label>Espaciado</label>
                <select v-model="localBlock.padding" @change="updateRealTime">
                  <option value="none">Sin espaciado</option>
                  <option value="small">Pequeño</option>
                  <option value="medium">Mediano</option>
                  <option value="large">Grande</option>
                </select>
              </div>

              <div class="form-section">
                <label>Color de fondo del bloque</label>
                <div class="color-input-group">
                  <input 
                    v-model="localBlock.backgroundColor" 
                    type="color"
                    @input="updateRealTime"
                  />
                  <input 
                    v-model="localBlock.backgroundColor" 
                    type="text"
                    placeholder="#ffffff"
                    @input="updateRealTime"
                  />
                  <button @click="clearBackgroundColor" class="btn-clear">
                    <Icon name="delete" />
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Vista previa -->
          <div class="editor-preview">
            <div class="preview-header">
              <h5>Vista previa</h5>
              <span class="preview-info">Los cambios se actualizan en tiempo real</span>
            </div>
            <div class="preview-content">
              <LeadConverterBlock :block="localBlock" :is-editing="true" />
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button @click="close" class="btn-secondary">Cancelar</button>
        <button @click="save" class="btn-primary">Guardar Conversor</button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import LeadConverterBlock from '@/components/blocks/LeadConverterBlock.vue'
import Icon from '@/components/global/Icon.vue'
import type { 
  LeadConverterBlock as LeadConverterBlockType,
  LeadConverterValueStackItem,
  LeadConverterUrgencyItem,
  LeadConverterTrustItem
} from '@/types/blocks'

interface Props {
  block: LeadConverterBlockType
}

interface Emits {
  (e: 'update', block: LeadConverterBlockType): void
  (e: 'update-real-time', block: LeadConverterBlockType): void
  (e: 'close'): void
}

const props = defineProps<Props>()
const emit = defineEmits<Emits>()

const localBlock = ref<LeadConverterBlockType>({ ...props.block })
const activeTab = ref('content')

const tabs = [
  { id: 'content', label: 'Contenido' },
  { id: 'form', label: 'Formulario' },
  { id: 'dropdowns', label: 'Opciones' },
  { id: 'valuestack', label: 'Value Stack' },
  { id: 'urgency', label: 'Urgencia' },
  { id: 'trust', label: 'Confianza' },
  { id: 'colors', label: 'Colores' }
]

const updateRealTime = () => {
  emit('update-real-time', { ...localBlock.value })
}

const save = () => {
  emit('update', { ...localBlock.value })
}

const close = () => {
  emit('close')
}

const handleBackdropClick = (event: MouseEvent) => {
  if (event.target === event.currentTarget) {
    close()
  }
}

const clearBackgroundColor = () => {
  localBlock.value.backgroundColor = ''
  updateRealTime()
}

// Dropdown options management
const addSituationOption = () => {
  localBlock.value.situationOptions.push('Nueva opción')
  updateRealTime()
}

const removeSituationOption = (index: number) => {
  localBlock.value.situationOptions.splice(index, 1)
  updateRealTime()
}

const addUrgencyOption = () => {
  localBlock.value.urgencyOptions.push('Nueva opción')
  updateRealTime()
}

const removeUrgencyOption = (index: number) => {
  localBlock.value.urgencyOptions.splice(index, 1)
  updateRealTime()
}

// Value stack management
const generateId = () => Date.now().toString(36) + Math.random().toString(36).substr(2)

const addValueItem = () => {
  const newItem: LeadConverterValueStackItem = {
    id: generateId(),
    text: 'Nuevo beneficio',
    value: '$100K',
    enabled: true
  }
  if (!localBlock.value.valueStackItems) localBlock.value.valueStackItems = []
  localBlock.value.valueStackItems.push(newItem)
  updateRealTime()
}

const removeValueItem = (index: number) => {
  if (localBlock.value.valueStackItems) {
    localBlock.value.valueStackItems.splice(index, 1)
  }
  updateRealTime()
}

// Urgency management
const addUrgencyItem = () => {
  const newItem: LeadConverterUrgencyItem = {
    id: generateId(),
    text: 'Nuevo elemento de urgencia',
    enabled: true,
    animated: false
  }
  if (!localBlock.value.urgencyItems) localBlock.value.urgencyItems = []
  localBlock.value.urgencyItems.push(newItem)
  updateRealTime()
}

const removeUrgencyItem = (index: number) => {
  if (localBlock.value.urgencyItems) {
    localBlock.value.urgencyItems.splice(index, 1)
  }
  updateRealTime()
}

// Trust elements management
const addTrustItem = () => {
  const newItem: LeadConverterTrustItem = {
    id: generateId(),
    text: 'Nuevo elemento de confianza',
    icon: '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M9,20.42L2.79,14.21L5.62,11.38L9,14.77L18.88,4.88L21.71,7.71L9,20.42Z"/></svg>',
    enabled: true
  }
  if (!localBlock.value.trustItems) localBlock.value.trustItems = []
  localBlock.value.trustItems.push(newItem)
  updateRealTime()
}

const removeTrustItem = (index: number) => {
  if (localBlock.value.trustItems) {
    localBlock.value.trustItems.splice(index, 1)
  }
  updateRealTime()
}
</script>

<style scoped>
.modal-extra-large {
  max-width: 1400px;
  width: 98vw;
  height: 95vh;
}

.editor-layout {
  display: flex;
  gap: 2rem;
  height: 70vh;
}

.editor-sidebar {
  flex: 0 0 400px;
  border-right: 1px solid #e9ecef;
  padding-right: 2rem;
  overflow-y: auto;
}

.tabs {
  display: flex;
  flex-wrap: wrap;
  gap: 0.25rem;
  margin-bottom: 1.5rem;
  border-bottom: 1px solid #e9ecef;
  padding-bottom: 1rem;
}

.tab-button {
  background: #f8f9fa;
  border: 1px solid #dee2e6;
  border-radius: 6px 6px 0 0;
  padding: 0.5rem 0.75rem;
  cursor: pointer;
  font-size: 0.875rem;
  transition: all 0.3s ease;
}

.tab-button:hover {
  background: #e9ecef;
}

.tab-button.active {
  background: #007bff;
  color: white;
  border-color: #007bff;
}

.tab-content {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.editor-preview {
  flex: 1;
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

.preview-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
  padding-bottom: 0.5rem;
  border-bottom: 1px solid #e9ecef;
}

.preview-header h5 {
  margin: 0;
  color: #333;
}

.preview-info {
  font-size: 0.875rem;
  color: #6c757d;
}

.preview-content {
  flex: 1;
  border: 2px dashed #dee2e6;
  border-radius: 8px;
  overflow: auto;
  background: #f8f9fa;
}

/* Form styles */
.form-section {
  margin-bottom: 1rem;
}

.form-row {
  display: flex;
  gap: 1rem;
}

.form-row .form-section {
  flex: 1;
  margin-bottom: 0;
}

.form-section label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 600;
  color: #333;
  font-size: 0.875rem;
}

.checkbox-label {
  display: flex !important;
  align-items: center;
  gap: 0.5rem;
  cursor: pointer;
}

.form-section input,
.form-section select,
.form-section textarea {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 0.875rem;
}

.form-section input:focus,
.form-section select:focus,
.form-section textarea:focus {
  outline: none;
  border-color: #007bff;
  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
}

/* Lists */
.options-list,
.value-items-list,
.urgency-items-list,
.trust-items-list {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
  margin-bottom: 1rem;
}

.option-item,
.value-item-editor,
.urgency-item-editor,
.trust-item-editor {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem;
  background: #f8f9fa;
  border-radius: 6px;
  border: 1px solid #e9ecef;
}

.option-item input,
.value-item-editor input,
.urgency-item-editor input,
.trust-item-editor input {
  flex: 1;
  margin: 0;
}

.icon-input {
  flex: 0 0 120px !important;
  font-size: 0.75rem;
  font-family: monospace;
  resize: vertical;
}

.btn-add,
.btn-remove,
.btn-clear {
  padding: 0.375rem 0.75rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 0.875rem;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.25rem;
}

.btn-add {
  background: #28a745;
  color: white;
  width: 100%;
}

.btn-remove {
  background: #dc3545;
  color: white;
  flex: 0 0 auto;
}

.btn-clear {
  background: #6c757d;
  color: white;
  flex: 0 0 auto;
}

.btn-add:hover,
.btn-remove:hover,
.btn-clear:hover {
  opacity: 0.8;
}

/* Color inputs */
.color-input-group {
  display: flex;
  gap: 0.5rem;
  align-items: center;
}

.color-input-group input[type="color"] {
  flex: 0 0 50px;
  height: 40px;
  padding: 2px;
  cursor: pointer;
}

.color-input-group input[type="text"] {
  flex: 1;
}

.color-customization {
  border: 1px solid #dee2e6;
  border-radius: 6px;
  padding: 1rem;
  background: #f8f9fa;
}

/* Modal styles */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
}

.modal-content {
  background: white;
  border-radius: 8px;
  display: flex;
  flex-direction: column;
  max-height: 95vh;
  overflow: hidden;
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  border-bottom: 1px solid #e9ecef;
  background: #f8f9fa;
}

.modal-header h4 {
  margin: 0;
  color: #333;
}

.btn-close {
  background: none;
  border: none;
  font-size: 1.25rem;
  cursor: pointer;
  color: #6c757d;
  padding: 0.25rem;
  border-radius: 4px;
  transition: background-color 0.2s;
}

.btn-close:hover {
  background: #e9ecef;
}

.modal-body {
  flex: 1;
  padding: 1rem;
  overflow: hidden;
}

.modal-footer {
  display: flex;
  justify-content: flex-end;
  gap: 0.5rem;
  padding: 1rem;
  border-top: 1px solid #e9ecef;
  background: #f8f9fa;
}

.btn-secondary {
  background: #6c757d;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 600;
  transition: all 0.3s ease;
}

.btn-secondary:hover {
  background: #545b62;
  transform: translateY(-1px);
}

.btn-primary {
  background: #007bff;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 600;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.btn-primary:hover {
  background: #0056b3;
  transform: translateY(-1px);
}
</style>