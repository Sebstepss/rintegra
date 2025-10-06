<template>
  <div class="modal-overlay">
    <div class="modal-content" @click.stop>
      <!-- Modal Header -->
      <div class="modal-header">
        <h3>Editar Bloque de Equipo</h3>
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
            @click="activeTab = 'members'"
            class="tab-button"
            :class="{ active: activeTab === 'members' }"
          >
            <Icon name="users" />
            Miembros ({{ localBlock.members.length }})
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
                    <label for="gap">Espaciado entre miembros</label>
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

          <!-- Miembros Tab -->
          <div v-show="activeTab === 'members'" class="tab-pane">
            <div class="editor-sections">
              <div class="editor-section">
                <div class="section-header">
                  <h4>Gestión de Miembros del Equipo</h4>
                  <button @click="addNewMember" class="btn-primary">
                    <Icon name="plus" />
                    Agregar Miembro
                  </button>
                </div>
                
                <div v-if="localBlock.members.length === 0" class="empty-members">
                  <div class="empty-state">
                    <i class="fas fa-users"></i>
                    <h4>Sin miembros</h4>
                    <p>Agrega miembros para crear tu equipo</p>
                    <button @click="addNewMember" class="btn-primary">
                      <Icon name="plus" />
                      Agregar Primer Miembro
                    </button>
                  </div>
                </div>

                <div v-else class="members-list">
                  <div 
                    v-for="(member, index) in localBlock.members"
                    :key="member.id"
                    class="member-item"
                  >
                    <div class="member-photo">
                      <div v-if="member.photo" class="photo-preview">
                        <img 
                          :src="buildMediaUrl(member.photo)" 
                          :alt="member.name"
                          @load="() => console.log('TeamBlockEditor - Preview image loaded:', member.name, member.photo)"
                          @error="(e) => console.error('TeamBlockEditor - Preview image error:', member.name, member.photo, e)"
                        />
                      </div>
                      <div v-else class="photo-placeholder">
                        <Icon name="photo" />
                      </div>
                      <button @click="openMediaPickerForMember(index)" class="btn-photo">
                        <Icon name="photo" />
                        {{ member.photo ? 'Cambiar' : 'Agregar' }}
                      </button>
                    </div>
                    
                    <div class="member-details">
                      <div class="form-row">
                        <div class="form-group">
                          <label>Nombre completo</label>
                          <input 
                            v-model="member.name" 
                            type="text" 
                            class="form-input"
                            placeholder="Juan Pérez"
                          >
                        </div>
                        <div class="form-group">
                          <label>Cargo/Posición</label>
                          <input 
                            v-model="member.position" 
                            type="text" 
                            class="form-input"
                            placeholder="CEO, Director, etc."
                          >
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label>Descripción breve</label>
                        <textarea 
                          v-model="member.description" 
                          class="form-input"
                          rows="3"
                          placeholder="Descripción del miembro del equipo..."
                        ></textarea>
                      </div>

                      <!-- Redes Sociales -->
                      <div class="socials-section">
                        <h5>Redes Sociales</h5>
                        <div class="socials-list">
                          <div 
                            v-for="(social, socialIndex) in member.socials"
                            :key="socialIndex"
                            class="social-item"
                          >
                            <select v-model="social.platform" class="form-input social-platform">
                              <option value="facebook">Facebook</option>
                              <option value="twitter">Twitter</option>
                              <option value="instagram">Instagram</option>
                              <option value="linkedin">LinkedIn</option>
                              <option value="github">GitHub</option>
                              <option value="email">Email</option>
                              <option value="website">Sitio Web</option>
                            </select>
                            <input 
                              v-model="social.url" 
                              type="url" 
                              class="form-input social-url"
                              :placeholder="getSocialPlaceholder(social.platform)"
                            >
                            <button 
                              @click="removeSocial(index, socialIndex)" 
                              class="btn-delete-social"
                              title="Eliminar red social"
                            >
                              <Icon name="trash" />
                            </button>
                          </div>
                        </div>
                        <button @click="addSocial(index)" class="btn-add-social">
                          <Icon name="plus" />
                          Agregar Red Social
                        </button>
                      </div>
                    </div>
                    
                    <div class="member-actions">
                      <button 
                        @click="moveMemberUp(index)" 
                        :disabled="index === 0"
                        class="btn-move"
                        title="Mover arriba"
                      >
                        <Icon name="chevron-up" />
                      </button>
                      <button 
                        @click="moveMemberDown(index)" 
                        :disabled="index === localBlock.members.length - 1"
                        class="btn-move"
                        title="Mover abajo"
                      >
                        <Icon name="chevron-down" />
                      </button>
                      <button 
                        @click="removeMember(index)" 
                        class="btn-delete"
                        title="Eliminar miembro"
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
                <h4>Formato de Foto</h4>
                
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
                    placeholder="mi-equipo-unico"
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
                    placeholder="/* CSS personalizado para este equipo */
.mi-equipo {
  border: 2px solid #007bff;
  border-radius: 15px;
}

.team-member {
  filter: grayscale(100%);
  transition: filter 0.3s ease;
}

.team-member:hover {
  filter: grayscale(0%);
}"
                  ></textarea>
                  <small class="form-help">Este CSS se aplicará únicamente a este bloque de equipo</small>
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
import type { TeamBlock, TeamMemberItem, TeamMemberSocial } from '@/types/blocks'
import { buildMediaUrl } from '@/utils/mediaUtils'

interface Props {
  block: TeamBlock
}

interface Emits {
  (e: 'update', block: TeamBlock): void
  (e: 'update-real-time', block: TeamBlock): void
  (e: 'close'): void
}

const props = defineProps<Props>()
const emit = defineEmits<Emits>()

// Estado de las pestañas
const activeTab = ref('general')
const showMediaPicker = ref(false)
const currentMemberIndex = ref<number | null>(null)

// Estado local del bloque  
const localBlock = ref<TeamBlock>({ 
  ...props.block,
  members: props.block.members || []
})

// Generar ID único
const generateId = () => Math.random().toString(36).substr(2, 9)

// Abrir selector de medios para un miembro específico
const openMediaPickerForMember = (index: number) => {
  currentMemberIndex.value = index
  showMediaPicker.value = true
}

// Manejar selección de medios
const handleMediaSelect = (selectedMedia: any[]) => {
  console.log('TeamBlockEditor - handleMediaSelect:', selectedMedia)
  console.log('TeamBlockEditor - Type of selectedMedia:', typeof selectedMedia)
  console.log('TeamBlockEditor - Is array:', Array.isArray(selectedMedia))
  
  if (currentMemberIndex.value !== null && selectedMedia.length > 0) {
    const media = selectedMedia[0] // Tomar solo la primera imagen seleccionada
    console.log('TeamBlockEditor - Selected media:', media)
    console.log('TeamBlockEditor - Member index:', currentMemberIndex.value)
    console.log('TeamBlockEditor - Media URL field:', media.url)
    
    // Asegurar que el miembro existe
    if (localBlock.value.members[currentMemberIndex.value]) {
      localBlock.value.members[currentMemberIndex.value].photo = media.url
      localBlock.value.members[currentMemberIndex.value].mediaId = media.id
      
      console.log('TeamBlockEditor - Updated member photo:', media.url)
      console.log('TeamBlockEditor - Updated member:', localBlock.value.members[currentMemberIndex.value])
    }
  }
  showMediaPicker.value = false
  currentMemberIndex.value = null
}

// Agregar nuevo miembro
const addNewMember = () => {
  const newMember: TeamMemberItem = {
    id: generateId(),
    photo: '',
    name: '',
    position: '',
    description: '',
    socials: []
  }
  localBlock.value.members.push(newMember)
}

// Mover miembro hacia arriba
const moveMemberUp = (index: number) => {
  if (index > 0) {
    const temp = localBlock.value.members[index]
    localBlock.value.members[index] = localBlock.value.members[index - 1]
    localBlock.value.members[index - 1] = temp
  }
}

// Mover miembro hacia abajo
const moveMemberDown = (index: number) => {
  if (index < localBlock.value.members.length - 1) {
    const temp = localBlock.value.members[index]
    localBlock.value.members[index] = localBlock.value.members[index + 1]
    localBlock.value.members[index + 1] = temp
  }
}

// Remover miembro
const removeMember = (index: number) => {
  if (confirm('¿Estás seguro de eliminar este miembro?')) {
    localBlock.value.members.splice(index, 1)
  }
}

// Agregar red social
const addSocial = (memberIndex: number) => {
  const newSocial: TeamMemberSocial = {
    platform: 'facebook',
    url: ''
  }
  localBlock.value.members[memberIndex].socials.push(newSocial)
}

// Remover red social
const removeSocial = (memberIndex: number, socialIndex: number) => {
  localBlock.value.members[memberIndex].socials.splice(socialIndex, 1)
}

// Obtener placeholder para red social
const getSocialPlaceholder = (platform: string) => {
  const placeholders = {
    facebook: 'https://facebook.com/usuario',
    twitter: 'https://twitter.com/usuario',
    instagram: 'https://instagram.com/usuario',
    linkedin: 'https://linkedin.com/in/usuario',
    github: 'https://github.com/usuario',
    email: 'correo@ejemplo.com',
    website: 'https://sitio.com'
  }
  return placeholders[platform as keyof typeof placeholders] || 'https://'
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

/* Members management */
.empty-members {
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

.members-list {
  display: flex;
  flex-direction: column;
  gap: 2rem;
}

.member-item {
  display: grid;
  grid-template-columns: 150px 1fr auto;
  gap: 1.5rem;
  padding: 1.5rem;
  border: 1px solid #dee2e6;
  border-radius: 8px;
  background: white;
  align-items: start;
}

.member-photo {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.75rem;
}

.photo-preview {
  width: 120px;
  height: 120px;
  border-radius: 8px;
  overflow: hidden;
  background: #f8f9fa;
}

.photo-preview img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.photo-placeholder {
  width: 120px;
  height: 120px;
  border-radius: 8px;
  background: #f8f9fa;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #6c757d;
  font-size: 2rem;
}

.btn-photo {
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

.btn-photo:hover {
  background: #0056b3;
}

.member-details {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.member-details .form-group {
  margin-bottom: 0;
}

.socials-section {
  margin-top: 1rem;
  padding-top: 1rem;
  border-top: 1px solid #e9ecef;
}

.socials-section h5 {
  margin: 0 0 1rem 0;
  color: #2c3e50;
  font-size: 1rem;
  font-weight: 600;
}

.socials-list {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
  margin-bottom: 1rem;
}

.social-item {
  display: grid;
  grid-template-columns: 140px 1fr auto;
  gap: 0.5rem;
  align-items: center;
}

.social-platform {
  padding: 0.5rem;
  font-size: 0.85rem;
}

.social-url {
  padding: 0.5rem;
  font-size: 0.85rem;
}

.btn-delete-social {
  padding: 0.5rem;
  background: #dc3545;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background 0.2s ease;
}

.btn-delete-social:hover {
  background: #c82333;
}

.btn-add-social {
  padding: 0.5rem 1rem;
  background: #28a745;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 0.85rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  transition: background 0.2s ease;
}

.btn-add-social:hover {
  background: #218838;
}

.member-actions {
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
  
  .member-item {
    grid-template-columns: 1fr;
    text-align: center;
  }
  
  .member-photo {
    justify-self: center;
  }
  
  .tabs-nav {
    flex-wrap: wrap;
  }
  
  .tab-button {
    min-width: 50%;
    font-size: 0.8rem;
  }
  
  .social-item {
    grid-template-columns: 1fr;
    gap: 0.5rem;
  }
}
</style>