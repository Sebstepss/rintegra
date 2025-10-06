<template>
  <div class="modal-overlay" @click="handleBackdropClick">
    <div class="modal-content modal-large" @click.stop>
      <div class="modal-header">
        <h4>Editor de Mapa de Google</h4>
        <button @click="close" class="btn-close">
          <Icon name="close" />
        </button>
      </div>
      
      <div class="modal-body">
        <div class="editor-layout">
          <!-- Panel de configuración -->
          <div class="editor-sidebar">
            <div class="form-section">
              <label>Título (opcional)</label>
              <input 
                v-model="localBlock.title" 
                type="text" 
                placeholder="Título del mapa"
                @input="updateRealTime"
              />
            </div>

            <div class="form-section">
              <label>Dirección o lugar</label>
              <textarea 
                v-model="localBlock.address" 
                placeholder="Ejemplo: Torre Colpatria, Bogotá, Colombia"
                rows="3"
                @input="updateRealTime"
              ></textarea>
              <small class="help-text">
                Ingresa el nombre de un lugar, dirección completa o punto de interés
              </small>
            </div>

            <div class="form-section">
              <label>Zoom (1-20)</label>
              <input 
                v-model.number="localBlock.zoom" 
                type="range" 
                min="1" 
                max="20"
                @input="updateRealTime"
              />
              <span class="range-value">{{ localBlock.zoom }}</span>
            </div>

            <div class="form-section">
              <label>Altura del mapa</label>
              <input 
                v-model.number="localBlock.height" 
                type="range" 
                min="200" 
                max="800"
                step="50"
                @input="updateRealTime"
              />
              <span class="range-value">{{ localBlock.height }}px</span>
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
              <label>Color de fondo</label>
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

          <!-- Vista previa -->
          <div class="editor-preview">
            <div class="preview-header">
              <h5>Vista previa</h5>
              <span class="preview-info">Los cambios se actualizan automáticamente</span>
            </div>
            <div class="preview-content">
              <MapBlock :block="localBlock" :is-editing="false" />
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button @click="close" class="btn-secondary">Cancelar</button>
        <button @click="save" class="btn-primary">Guardar Mapa</button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import MapBlock from '@/components/blocks/MapBlock.vue'
import Icon from '@/components/global/Icon.vue'
import type { MapBlock as MapBlockType } from '@/types/blocks'

interface Props {
  block: MapBlockType
}

interface Emits {
  (e: 'update', block: MapBlockType): void
  (e: 'update-real-time', block: MapBlockType): void
  (e: 'close'): void
}

const props = defineProps<Props>()
const emit = defineEmits<Emits>()

const localBlock = ref<MapBlockType>({ ...props.block })

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
</script>

<style scoped>
.editor-layout {
  display: flex;
  gap: 2rem;
  min-height: 600px;
}

.editor-sidebar {
  flex: 0 0 350px;
  border-right: 1px solid #e9ecef;
  padding-right: 2rem;
  max-height: 600px;
  overflow-y: auto;
}

.editor-preview {
  flex: 1;
  display: flex;
  flex-direction: column;
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
  overflow: hidden;
}

.form-section {
  margin-bottom: 1.5rem;
}

.form-row {
  display: flex;
  gap: 1rem;
}

.form-row .form-section {
  flex: 1;
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
  padding: 0.75rem;
  border: 1px solid #ddd;
  border-radius: 6px;
  font-size: 0.875rem;
  transition: border-color 0.3s ease;
}

.form-section input:focus,
.form-section select:focus,
.form-section textarea:focus {
  outline: none;
  border-color: #007bff;
  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
}

.help-text {
  font-size: 0.75rem;
  color: #6c757d;
  margin-top: 0.25rem;
  display: block;
}

.form-section input[type="range"] {
  padding: 0;
}

.range-value {
  display: inline-block;
  margin-left: 0.5rem;
  font-weight: 600;
  color: #007bff;
  font-size: 0.875rem;
}

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

.btn-clear {
  background: #dc3545;
  color: white;
  border: none;
  padding: 0.5rem;
  border-radius: 4px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
}

.color-hue-control {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  margin-bottom: 0.5rem;
}

.hue-preview {
  width: 30px;
  height: 30px;
  border-radius: 4px;
  border: 2px solid #ddd;
  background: linear-gradient(45deg, 
    rgba(0,0,0,0.1) 25%, 
    transparent 25%, 
    transparent 75%, 
    rgba(0,0,0,0.1) 75%),
  linear-gradient(45deg, 
    rgba(0,0,0,0.1) 25%, 
    transparent 25%, 
    transparent 75%, 
    rgba(0,0,0,0.1) 75%);
  background-size: 8px 8px;
  background-position: 0 0, 4px 4px;
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

.btn-small {
  padding: 0.375rem 0.75rem;
  font-size: 0.875rem;
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
  max-height: 90vh;
  overflow: hidden;
}

.modal-large {
  max-width: 1200px;
  width: 95vw;
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
  overflow-y: auto;
}

.modal-footer {
  display: flex;
  justify-content: flex-end;
  gap: 0.5rem;
  padding: 1rem;
  border-top: 1px solid #e9ecef;
  background: #f8f9fa;
}
</style>