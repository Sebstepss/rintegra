<template>
  <div class="modal-overlay" @click="handleBackdropClick">
    <div class="modal-content modal-xlarge" @click.stop>
      <div class="modal-header">
        <h4>Editor de Bloque de Contacto</h4>
        <button @click="close" class="btn-close">
          <Icon name="close" />
        </button>
      </div>

      <div class="modal-body">
        <div class="editor-layout">
          <!-- Panel de configuración -->
          <div class="editor-sidebar">
            <!-- Títulos -->
            <div class="form-section">
              <label>Título</label>
              <input
                v-model="localBlock.title"
                type="text"
                placeholder="Contáctanos"
                @input="updateRealTime"
              />
            </div>

            <div class="form-section">
              <label>Subtítulo</label>
              <textarea
                v-model="localBlock.subtitle"
                placeholder="Estamos aquí para ayudarte..."
                rows="2"
                @input="updateRealTime"
              ></textarea>
            </div>

            <!-- Colores -->
            <div class="form-section">
              <label>Color de iconos</label>
              <div class="color-input-group">
                <input
                  v-model="localBlock.iconColor"
                  type="color"
                  @input="updateRealTime"
                />
                <input
                  v-model="localBlock.iconColor"
                  type="text"
                  placeholder="#0C6444"
                  @input="updateRealTime"
                />
              </div>
            </div>

            <div class="form-section">
              <label>Color de texto</label>
              <div class="color-input-group">
                <input
                  v-model="localBlock.textColor"
                  type="color"
                  @input="updateRealTime"
                />
                <input
                  v-model="localBlock.textColor"
                  type="text"
                  placeholder="#333"
                  @input="updateRealTime"
                />
              </div>
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
              </div>
            </div>

            <!-- Espaciado -->
            <div class="form-section">
              <label>Espaciado</label>
              <select v-model="localBlock.padding" @change="updateRealTime">
                <option value="none">Sin espaciado</option>
                <option value="small">Pequeño</option>
                <option value="medium">Mediano</option>
                <option value="large">Grande</option>
              </select>
            </div>

            <!-- Mapa -->
            <div class="form-section">
              <label class="checkbox-label">
                <input
                  v-model="localBlock.showMap"
                  type="checkbox"
                  @change="updateRealTime"
                />
                <span>Mostrar mapa de Google</span>
              </label>
            </div>

            <template v-if="localBlock.showMap">
              <div class="form-section">
                <label>Dirección del mapa</label>
                <textarea
                  v-model="localBlock.mapAddress"
                  placeholder="Cra 14 #18-50, Cali, Valle del Cauca"
                  rows="2"
                  @input="updateRealTime"
                ></textarea>
              </div>

              <div class="form-section">
                <label>Zoom del mapa (1-20)</label>
                <input
                  v-model.number="localBlock.mapZoom"
                  type="range"
                  min="1"
                  max="20"
                  @input="updateRealTime"
                />
                <span class="range-value">{{ localBlock.mapZoom }}</span>
              </div>

              <div class="form-section">
                <label>Altura del mapa</label>
                <input
                  v-model.number="localBlock.mapHeight"
                  type="range"
                  min="300"
                  max="600"
                  step="50"
                  @input="updateRealTime"
                />
                <span class="range-value">{{ localBlock.mapHeight }}px</span>
              </div>
            </template>

            <!-- Items de contacto -->
            <div class="form-section">
              <label>Tarjetas de contacto</label>
              <button @click="addContactItem" class="btn-add">
                <Icon name="add" /> Agregar tarjeta
              </button>
            </div>

            <div v-for="(item, index) in localBlock.contactItems" :key="item.id" class="contact-item-editor">
              <div class="item-header">
                <span class="item-number">{{ index + 1 }}</span>
                <button @click="removeContactItem(index)" class="btn-remove">
                  <Icon name="delete" />
                </button>
              </div>

              <div class="form-section">
                <label>Tipo</label>
                <select v-model="item.type" @change="updateRealTime">
                  <option value="address">Dirección</option>
                  <option value="phone">Teléfono</option>
                  <option value="email">Email</option>
                  <option value="hours">Horarios</option>
                  <option value="social">Redes Sociales</option>
                  <option value="custom">Personalizado</option>
                </select>
              </div>

              <div class="form-section">
                <label>Icono (FontAwesome)</label>
                <input
                  v-model="item.icon"
                  type="text"
                  placeholder="fas fa-map-marker-alt"
                  @input="updateRealTime"
                />
              </div>

              <div class="form-section">
                <label>Título</label>
                <input
                  v-model="item.title"
                  type="text"
                  placeholder="Nuestra oficina"
                  @input="updateRealTime"
                />
              </div>

              <div v-if="item.type === 'hours'" class="form-section">
                <label>Horarios (uno por línea)</label>
                <textarea
                  :value="item.hours?.join('\n')"
                  @input="updateHours(item, $event)"
                  placeholder="Lunes a Viernes: 9:00 - 18:00&#10;Sábados: 9:00 - 13:00"
                  rows="3"
                ></textarea>
              </div>

              <div v-else-if="item.type === 'social'" class="form-section">
                <label>Redes sociales</label>
                <button @click="addSocial(item)" class="btn-small btn-add">
                  <Icon name="add" /> Agregar red social
                </button>
                <div v-for="(social, sIdx) in item.socials" :key="sIdx" class="social-item">
                  <input
                    v-model="social.name"
                    type="text"
                    placeholder="Facebook"
                    @input="updateRealTime"
                  />
                  <input
                    v-model="social.icon"
                    type="text"
                    placeholder="fab fa-facebook"
                    @input="updateRealTime"
                  />
                  <input
                    v-model="social.url"
                    type="text"
                    placeholder="https://facebook.com/..."
                    @input="updateRealTime"
                  />
                  <button @click="removeSocial(item, sIdx)" class="btn-remove-small">
                    <Icon name="delete" />
                  </button>
                </div>
              </div>

              <div v-else class="form-section">
                <label>Valor</label>
                <textarea
                  v-model="item.value"
                  placeholder="Contenido..."
                  rows="2"
                  @input="updateRealTime"
                ></textarea>
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
              <ContactBlock :block="localBlock" :is-editing="false" />
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button @click="close" class="btn-secondary">Cancelar</button>
        <button @click="save" class="btn-primary">Guardar Bloque</button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import ContactBlock from '@/components/blocks/ContactBlock.vue'
import Icon from '@/components/global/Icon.vue'
import type { ContactBlock as ContactBlockType, ContactItem } from '@/types/blocks'

interface Props {
  block: ContactBlockType
}

interface Emits {
  (e: 'update', block: ContactBlockType): void
  (e: 'update-real-time', block: ContactBlockType): void
  (e: 'close'): void
}

const props = defineProps<Props>()
const emit = defineEmits<Emits>()

const localBlock = ref<ContactBlockType>({ ...props.block })

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

const addContactItem = () => {
  localBlock.value.contactItems.push({
    id: `item-${Date.now()}`,
    type: 'custom',
    icon: 'fas fa-info-circle',
    title: 'Nueva tarjeta',
    value: ''
  })
  updateRealTime()
}

const removeContactItem = (index: number) => {
  localBlock.value.contactItems.splice(index, 1)
  updateRealTime()
}

const updateHours = (item: ContactItem, event: Event) => {
  const target = event.target as HTMLTextAreaElement
  item.hours = target.value.split('\n').filter(h => h.trim())
  updateRealTime()
}

const addSocial = (item: ContactItem) => {
  if (!item.socials) {
    item.socials = []
  }
  item.socials.push({
    name: '',
    icon: 'fab fa-facebook',
    url: ''
  })
  updateRealTime()
}

const removeSocial = (item: ContactItem, index: number) => {
  item.socials?.splice(index, 1)
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
  flex: 0 0 400px;
  border-right: 1px solid #e9ecef;
  padding-right: 2rem;
  max-height: 70vh;
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
  overflow-y: auto;
  background: #f8f9fa;
}

.form-section {
  margin-bottom: 1.5rem;
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

.btn-add {
  background: #28a745;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  width: 100%;
  justify-content: center;
}

.btn-add:hover {
  background: #218838;
}

.btn-small {
  padding: 0.375rem 0.75rem;
  font-size: 0.875rem;
}

.contact-item-editor {
  background: #f8f9fa;
  border: 1px solid #dee2e6;
  border-radius: 8px;
  padding: 1rem;
  margin-bottom: 1rem;
}

.item-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.item-number {
  font-weight: 700;
  color: #007bff;
  font-size: 1.25rem;
}

.btn-remove {
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

.btn-remove:hover {
  background: #c82333;
}

.social-item {
  display: grid;
  grid-template-columns: 1fr 1.5fr 2fr auto;
  gap: 0.5rem;
  margin-top: 0.5rem;
  align-items: center;
}

.btn-remove-small {
  background: #dc3545;
  color: white;
  border: none;
  padding: 0.5rem;
  border-radius: 4px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  min-width: 35px;
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

.modal-xlarge {
  max-width: 1400px;
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
