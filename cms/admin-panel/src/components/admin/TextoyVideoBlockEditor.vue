<template>
  <div class="modal-overlay">
    <div class="modal-content" @click.stop>
      <!-- Modal Header -->
      <div class="modal-header">
        <h3>Editar Texto y Video</h3>
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
          <!-- Configuración General -->
          <div class="editor-section">
            <h4>Configuración General</h4>

            <div class="form-group">
              <label>Modo de diseño</label>
              <div class="radio-group">
                <label class="radio-label">
                  <input
                    type="radio"
                    v-model="localBlock.layoutMode"
                    value="two-column"
                  >
                  <span>Dos columnas (Texto + Video)</span>
                </label>
                <label class="radio-label">
                  <input
                    type="radio"
                    v-model="localBlock.layoutMode"
                    value="multi-column"
                  >
                  <span>Múltiples Columnas</span>
                </label>
              </div>
            </div>

            <div class="form-group">
              <label for="aspect-ratio">Relación de aspecto del video</label>
              <select v-model="localBlock.aspectRatio" class="form-input">
                <option value="4:5">4:5 (Vertical - Reels/Shorts)</option>
                <option value="16:9">16:9 (Horizontal)</option>
                <option value="9:16">9:16 (Vertical)</option>
                <option value="1:1">1:1 (Cuadrado)</option>
              </select>
            </div>

            <div class="form-group">
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
          </div>

          <!-- Configuración de Texto - Solo para Layout Dos Columnas -->
          <div v-if="localBlock.layoutMode === 'two-column'" class="editor-section">
            <h4>Contenido de Texto</h4>

            <div class="form-group">
              <label for="title">Título Principal</label>
              <input
                type="text"
                id="title"
                v-model="localBlock.title"
                class="form-input"
                placeholder="Solidez contable, proyección empresarial"
              >
            </div>

            <div class="form-group">
              <label for="title-color">Color del título</label>
              <div class="color-input-group">
                <input
                  type="color"
                  id="title-color"
                  v-model="localBlock.titleColor"
                  class="color-picker"
                >
                <input
                  type="text"
                  v-model="localBlock.titleColor"
                  class="color-text"
                  placeholder="#000000"
                >
              </div>
            </div>

            <div class="form-group">
              <label for="description">Descripción</label>
              <div class="editor-container">
                <editor-content :editor="descriptionEditor" />
              </div>
            </div>

            <div class="form-group">
              <label for="desc-color">Color de la descripción</label>
              <div class="color-input-group">
                <input
                  type="color"
                  id="desc-color"
                  v-model="localBlock.descriptionColor"
                  class="color-picker"
                >
                <input
                  type="text"
                  v-model="localBlock.descriptionColor"
                  class="color-text"
                  placeholder="#666666"
                >
              </div>
            </div>
          </div>

          <!-- Configuración de Botón - Solo para Layout Dos Columnas -->
          <div v-if="localBlock.layoutMode === 'two-column'" class="editor-section">
            <h4>Botón de Acción</h4>

            <div class="form-row">
              <div class="form-group">
                <label for="btn-text">Texto del botón</label>
                <input
                  type="text"
                  id="btn-text"
                  v-model="localBlock.buttonText"
                  class="form-input"
                  placeholder="Conoce más sobre nosotros"
                >
              </div>
              <div class="form-group">
                <label for="btn-link">Enlace del botón</label>
                <input
                  type="url"
                  id="btn-link"
                  v-model="localBlock.buttonLink"
                  class="form-input"
                  placeholder="https://..."
                >
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="btn-bg-color">Color de fondo del botón</label>
                <div class="color-input-group">
                  <input
                    type="color"
                    id="btn-bg-color"
                    v-model="localBlock.buttonColor"
                    class="color-picker"
                  >
                  <input
                    type="text"
                    v-model="localBlock.buttonColor"
                    class="color-text"
                    placeholder="#007bff"
                  >
                </div>
              </div>
              <div class="form-group">
                <label for="btn-text-color">Color del texto del botón</label>
                <div class="color-input-group">
                  <input
                    type="color"
                    id="btn-text-color"
                    v-model="localBlock.buttonTextColor"
                    class="color-picker"
                  >
                  <input
                    type="text"
                    v-model="localBlock.buttonTextColor"
                    class="color-text"
                    placeholder="#ffffff"
                  >
                </div>
              </div>
            </div>
          </div>

          <!-- Configuración de Video - Layout Dos Columnas -->
          <div v-if="localBlock.layoutMode === 'two-column'" class="editor-section">
            <h4>Configuración de Video</h4>

            <div class="form-group">
              <label>Tipo de video</label>
              <div class="radio-group">
                <label class="radio-label">
                  <input
                    type="radio"
                    v-model="localBlock.videoType"
                    value="youtube"
                    @change="handleVideoTypeChange"
                  >
                  <span>YouTube (incluyendo Shorts)</span>
                </label>
                <label class="radio-label">
                  <input
                    type="radio"
                    v-model="localBlock.videoType"
                    value="vimeo"
                    @change="handleVideoTypeChange"
                  >
                  <span>Vimeo</span>
                </label>
                <label class="radio-label">
                  <input
                    type="radio"
                    v-model="localBlock.videoType"
                    value="media"
                    @change="handleVideoTypeChange"
                  >
                  <span>Video Local</span>
                </label>
              </div>
            </div>

            <!-- YouTube Video -->
            <div v-if="localBlock.videoType === 'youtube'" class="form-group">
              <label for="youtube-url">URL de YouTube</label>
              <input
                type="url"
                id="youtube-url"
                v-model="localBlock.videoUrl"
                class="form-input"
                placeholder="https://www.youtube.com/watch?v=... o https://www.youtube.com/shorts/..."
              >
              <small class="form-help">
                Soporta: youtube.com/watch?v=ID, youtu.be/ID, youtube.com/shorts/ID, o solo el ID
              </small>

              <div class="form-row" style="margin-top: 1rem;">
                <div class="form-group">
                  <label class="checkbox-label">
                    <input
                      type="checkbox"
                      v-model="localBlock.videoAutoplay"
                    >
                    <span>Autoplay al cargar</span>
                  </label>
                </div>
              </div>
            </div>

            <!-- Vimeo Video -->
            <div v-if="localBlock.videoType === 'vimeo'" class="form-group">
              <label for="vimeo-url">URL de Vimeo</label>
              <input
                type="url"
                id="vimeo-url"
                v-model="localBlock.videoUrl"
                class="form-input"
                placeholder="https://vimeo.com/... o solo el ID"
              >
              <small class="form-help">
                Puedes usar: vimeo.com/ID o solo el ID del video
              </small>

              <div class="form-row" style="margin-top: 1rem;">
                <div class="form-group">
                  <label class="checkbox-label">
                    <input
                      type="checkbox"
                      v-model="localBlock.videoAutoplay"
                    >
                    <span>Autoplay al cargar</span>
                  </label>
                </div>
              </div>
            </div>

            <!-- Cover Image for YouTube/Vimeo -->
            <div v-if="(localBlock.videoType === 'youtube' || localBlock.videoType === 'vimeo') && localBlock.videoUrl" class="form-group">
              <label>Portada personalizada</label>
              <div class="media-selector">
                <div v-if="localBlock.videoCoverUrl" class="selected-media">
                  <img :src="localBlock.videoCoverUrl" class="media-preview" style="object-fit: cover;">
                  <button @click="removeVideoCover" class="btn-remove" type="button">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <div v-else class="media-placeholder">
                  <i class="fas fa-image"></i>
                  <p>No hay portada seleccionada</p>
                </div>
                <button @click="openCoverMediaPicker" class="btn-media" type="button">
                  <i class="fas fa-image"></i>
                  Seleccionar portada
                </button>
              </div>
              <small class="form-help">
                La portada se mostrará hasta que el usuario haga click en el botón play
              </small>
            </div>

            <!-- Media Video -->
            <div v-if="localBlock.videoType === 'media'" class="form-group">
              <label>Video desde biblioteca de medios</label>
              <div class="media-selector">
                <div v-if="selectedVideoPreview" class="selected-media">
                  <video :src="selectedVideoPreview" class="media-preview" controls>
                    Tu navegador no soporta el elemento de video.
                  </video>
                  <button @click="removeSelectedVideo" class="btn-remove" type="button">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <div v-else class="media-placeholder">
                  <i class="fas fa-video"></i>
                  <p>No hay video seleccionado</p>
                </div>
                <button @click="openVideoMediaPicker" class="btn-media" type="button">
                  <i class="fas fa-video"></i>
                  Seleccionar video
                </button>
              </div>
            </div>
          </div>

          <!-- Configuración de Múltiples Columnas -->
          <div v-if="localBlock.layoutMode === 'multi-column'" class="editor-section">
            <h4>Configuración de Columnas</h4>

            <div class="form-row">
              <div class="form-group">
                <label for="columns-count">Número de columnas</label>
                <select v-model.number="localBlock.columnsCount" class="form-input">
                  <option :value="1">1 columna</option>
                  <option :value="2">2 columnas</option>
                  <option :value="3">3 columnas</option>
                  <option :value="4">4 columnas</option>
                </select>
              </div>
              <div class="form-group">
                <label for="gap">Espacio entre columnas</label>
                <select v-model="localBlock.gap" class="form-input">
                  <option value="small">Pequeño</option>
                  <option value="medium">Medio</option>
                  <option value="large">Grande</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <h5>Videos en columnas</h5>
              <div class="columns-list">
                <div v-for="(col, idx) in localBlock.columns" :key="col.id" class="column-item">
                  <div class="column-header">
                    <h6>Columna {{ idx + 1 }}</h6>
                    <button @click="removeColumn(idx)" class="btn-small btn-danger" type="button">
                      <i class="fas fa-trash"></i>
                    </button>
                  </div>

                  <div class="form-group">
                    <label :for="`col-type-${idx}`">Tipo de video</label>
                    <select :id="`col-type-${idx}`" v-model="col.videoType" class="form-input">
                      <option value="youtube">YouTube</option>
                      <option value="vimeo">Vimeo</option>
                      <option value="media">Video Local</option>
                    </select>
                  </div>

                  <!-- YouTube/Vimeo URL -->
                  <div v-if="col.videoType === 'youtube' || col.videoType === 'vimeo'" class="form-group">
                    <label :for="`col-url-${idx}`">URL del video</label>
                    <input
                      :id="`col-url-${idx}`"
                      type="url"
                      v-model="col.videoUrl"
                      class="form-input"
                      :placeholder="col.videoType === 'youtube' ? 'https://www.youtube.com/watch?v=...' : 'https://vimeo.com/...'"
                    >
                    <small class="form-help">
                      {{ col.videoType === 'youtube' ? 'Soporta: youtube.com/watch?v=ID, youtu.be/ID, youtube.com/shorts/ID' : 'Ejemplo: vimeo.com/123456789' }}
                    </small>
                  </div>

                  <!-- Media Picker para Video Local -->
                  <div v-if="col.videoType === 'media'" class="form-group">
                    <label>Video desde biblioteca de medios</label>
                    <div class="media-selector">
                      <div v-if="col.videoUrl" class="selected-media">
                        <video :src="col.videoUrl" class="media-preview" controls>
                          Tu navegador no soporta el elemento de video.
                        </video>
                        <button @click="removeColumnVideo(idx)" class="btn-remove" type="button">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                      <div v-else class="media-placeholder">
                        <i class="fas fa-video"></i>
                        <p>No hay video seleccionado</p>
                      </div>
                      <button @click="openColumnMediaPicker(idx)" class="btn-media" type="button">
                        <i class="fas fa-video"></i>
                        Seleccionar video
                      </button>
                    </div>
                  </div>

                  <div class="form-group">
                    <label :for="`col-title-${idx}`">Título</label>
                    <input
                      :id="`col-title-${idx}`"
                      type="text"
                      v-model="col.title"
                      class="form-input"
                      placeholder="Título de la columna"
                    >
                  </div>

                  <div class="form-group">
                    <label :for="`col-desc-${idx}`">Descripción</label>
                    <textarea
                      :id="`col-desc-${idx}`"
                      v-model="col.description"
                      class="form-input"
                      rows="3"
                      placeholder="Descripción de la columna"
                    ></textarea>
                  </div>
                </div>
              </div>

              <button @click="addColumn" class="btn-small btn-primary" type="button">
                <i class="fas fa-plus"></i>
                Añadir columna
              </button>
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
                    placeholder="mi-texto-video-unico"
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
                    placeholder="mi-texto-video otra-clase"
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
                    placeholder="/* CSS personalizado para este bloque texto y video */
.mi-texto-video {
  background: linear-gradient(45deg, #f9f9f9, #e8e8e8);
  border-radius: 20px;
  padding: 40px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.mi-texto-video .video-container {
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.mi-texto-video .button {
  background: linear-gradient(45deg, #ff6b6b, #ee5a52);
  border-radius: 25px;
  transition: all 0.3s ease;
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
    
    <!-- MediaPicker Modal -->
    <MediaPicker
      :show="showMediaPicker"
      :selected-media="selectedMedia"
      :type-filter="'video'"
      :multiple="false"
      @close="closeMediaPicker"
      @select="onVideoMediaSelected"
    />
  </div>
</template>

<script setup lang="ts">
import { ref, watch, computed, onMounted, onBeforeUnmount } from 'vue'
import { useEditor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import MediaPicker from './MediaPicker.vue'
import { useMediaPicker } from '@/composables/useMediaPicker'
import type { TextoyVideoBlock as TextoyVideoBlockType } from '@/types/blocks'

interface Props {
  block: TextoyVideoBlockType
}

interface Emits {
  (e: 'update', block: TextoyVideoBlockType): void
  (e: 'close'): void
}

const props = defineProps<Props>()
const emit = defineEmits<Emits>()

// Estado de las pestañas
const activeTab = ref('general')

// Media picker composable
const { 
  showMediaPicker, 
  selectedMedia, 
  openMediaPicker, 
  closeMediaPicker, 
  getFullMediaUrl 
} = useMediaPicker()

// Inicializar bloque con campos de atributos si no existen
const initializeBlock = (block: TextoyVideoBlockType): TextoyVideoBlockType => {
  return {
    ...block,
    layoutMode: block.layoutMode || 'two-column',
    aspectRatio: block.aspectRatio || '16:9',
    columnsCount: block.columnsCount || 2,
    gap: block.gap || 'medium',
    columns: block.columns || [],
    // Asegurar valores por defecto para modo dos columnas
    title: block.title || '',
    titleColor: block.titleColor || '#000000',
    description: block.description || '',
    descriptionColor: block.descriptionColor || '#666666',
    buttonText: block.buttonText || '',
    buttonLink: block.buttonLink || '',
    buttonColor: block.buttonColor || '#007bff',
    buttonTextColor: block.buttonTextColor || '#ffffff',
    videoType: block.videoType || 'youtube',
    videoUrl: block.videoUrl || '',
    videoAutoplay: block.videoAutoplay ?? false,
    videoCoverUrl: block.videoCoverUrl || '',
    backgroundColor: block.backgroundColor || '#ffffff',
    customId: block.customId || '',
    customClass: block.customClass || '',
    customCSS: block.customCSS || ''
  }
}

// Estado local del bloque
const localBlock = ref<TextoyVideoBlockType>(initializeBlock({ ...props.block }))

// Editor para la descripción
const descriptionEditor = useEditor({
  content: localBlock.value.description,
  extensions: [StarterKit],
  editorProps: {
    attributes: {
      class: 'prose prose-sm focus:outline-none min-h-[120px] p-3'
    }
  },
  onUpdate: ({ editor }) => {
    localBlock.value.description = editor.getHTML()
  }
})

// Preview del video seleccionado
const selectedVideoPreview = computed(() => {
  if (localBlock.value.videoType === 'media' && localBlock.value.videoUrl) {
    return localBlock.value.videoUrl
  }
  return null
})

// Manejar cambio de tipo de video
const handleVideoTypeChange = () => {
  localBlock.value.videoUrl = ''
  localBlock.value.videoMediaId = undefined
}

// Abrir selector de video (modo dos columnas)
const openVideoMediaPicker = () => {
  currentColumnIndex.value = null // Asegurar que NO estamos en modo columna
  openMediaPicker({
    typeFilter: 'video',
    multiple: false,
    onSelect: onVideoMediaSelected
  })
}

// Manejar selección de video desde medios (UNIFICADO para ambos modos)
const onVideoMediaSelected = (media: any) => {
  console.log('🎬 onVideoMediaSelected called')
  console.log('📍 currentColumnIndex:', currentColumnIndex.value)
  console.log('📦 media:', media)

  // Si currentColumnIndex tiene un valor, estamos en modo columnas
  if (currentColumnIndex.value !== null && localBlock.value.columns) {
    console.log('✅ Setting video for column', currentColumnIndex.value)
    const fullUrl = getFullMediaUrl(media)
    localBlock.value.columns[currentColumnIndex.value].videoUrl = fullUrl
    localBlock.value.columns[currentColumnIndex.value].videoMediaId = media.id
    currentColumnIndex.value = null
  } else {
    // Modo dos columnas (comportamiento original)
    console.log('✅ Setting video for two-column mode')
    localBlock.value.videoUrl = getFullMediaUrl(media)
    localBlock.value.videoMediaId = media.id
  }

  closeMediaPicker()
}

// Remover video seleccionado
const removeSelectedVideo = () => {
  localBlock.value.videoUrl = ''
  localBlock.value.videoMediaId = undefined
}

// Estado para manejar el MediaPicker de portada
const coverMediaPickerActive = ref(false)

// Abrir selector de portada
const openCoverMediaPicker = () => {
  coverMediaPickerActive.value = true
  openMediaPicker({
    typeFilter: 'image',
    multiple: false,
    onSelect: onCoverMediaSelected
  })
}

// Manejar selección de portada
const onCoverMediaSelected = (media: any) => {
  localBlock.value.videoCoverUrl = getFullMediaUrl(media)
  coverMediaPickerActive.value = false
  closeMediaPicker()
}

// Remover portada seleccionada
const removeVideoCover = () => {
  localBlock.value.videoCoverUrl = ''
}

// Métodos para manejar columnas (múltiple layout)
const addColumn = () => {
  const newColumn = {
    id: `col-${Date.now()}`,
    videoType: 'youtube' as const,
    videoUrl: '',
    title: '',
    description: ''
  }
  localBlock.value.columns = localBlock.value.columns || []
  localBlock.value.columns.push(newColumn)
}

const removeColumn = (index: number) => {
  if (localBlock.value.columns) {
    localBlock.value.columns.splice(index, 1)
  }
}

// Estado para manejar el MediaPicker de columnas
const currentColumnIndex = ref<number | null>(null)

// Abrir MediaPicker para una columna específica
const openColumnMediaPicker = (index: number) => {
  currentColumnIndex.value = index
  openMediaPicker({
    typeFilter: 'video',
    multiple: false,
    onSelect: onVideoMediaSelected // Reutilizar la función unificada
  })
}

// Remover video de una columna
const removeColumnVideo = (index: number) => {
  if (localBlock.value.columns?.[index]) {
    localBlock.value.columns[index].videoUrl = ''
    localBlock.value.columns[index].videoMediaId = undefined
  }
}

// Aplicar cambios y cerrar modal
const applyChanges = () => {
  emit('update', { ...localBlock.value })
  emit('close')
}

// Emitir cambios solo cuando se apliquen manualmente
// watch(localBlock, (newBlock) => {
//   emit('update', { ...newBlock })
// }, { deep: true })

// Sincronizar con props (solo cuando el bloque cambia externamente, no durante ediciones locales)
watch(() => props.block, (newBlock, oldBlock) => {
  // Solo actualizar si el ID del bloque cambió (significa que estamos editando un bloque diferente)
  if (newBlock.id !== oldBlock?.id) {
    localBlock.value = initializeBlock(newBlock)
    if (descriptionEditor.value) {
      descriptionEditor.value.commands.setContent(newBlock.description)
    }
  }
}, { deep: false })

onMounted(() => {
  if (descriptionEditor.value) {
    descriptionEditor.value.commands.setContent(localBlock.value.description)
  }
})

onBeforeUnmount(() => {
  if (descriptionEditor.value) {
    descriptionEditor.value.destroy()
  }
})
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

.radio-group {
  display: flex;
  gap: 1rem;
}

.radio-label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  cursor: pointer;
  font-weight: normal;
}

.radio-label input[type="radio"] {
  margin: 0;
}

.editor-container {
  border: 1px solid #dee2e6;
  border-radius: 8px;
  overflow: hidden;
  background: white;
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

:deep(.ProseMirror) {
  outline: none;
  padding: 1rem;
  min-height: 120px;
  font-family: 'Lato', sans-serif;
}

:deep(.ProseMirror p) {
  margin: 0.5rem 0;
}

:deep(.ProseMirror h1) {
  font-size: 1.5rem;
  font-weight: 700;
  margin: 1rem 0 0.5rem 0;
}

:deep(.ProseMirror h2) {
  font-size: 1.25rem;
  font-weight: 600;
  margin: 1rem 0 0.5rem 0;
}

:deep(.ProseMirror ul, .ProseMirror ol) {
  padding-left: 1.5rem;
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
  
  .radio-group {
    flex-direction: column;
    gap: 0.5rem;
  }
  
  .color-input-group {
    flex-direction: column;
    align-items: stretch;
  }
  
  .color-picker {
    align-self: center;
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

/* Estilos para columnas múltiples */
.columns-list {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
  margin-bottom: 1.5rem;
}

.column-item {
  padding: 1rem;
  background: white;
  border: 1px solid #dee2e6;
  border-radius: 8px;
}

.column-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
  padding-bottom: 1rem;
  border-bottom: 1px solid #dee2e6;
}

.column-header h6 {
  margin: 0;
  font-size: 0.95rem;
  font-weight: 600;
  color: #2c3e50;
}

.btn-small {
  padding: 0.5rem 1rem;
  font-size: 0.85rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  gap: 0.25rem;
}

.btn-small.btn-primary {
  background: #007bff;
  color: white;
}

.btn-small.btn-primary:hover {
  background: #0056b3;
  transform: translateY(-1px);
}

.btn-small.btn-danger {
  background: #dc3545;
  color: white;
}

.btn-small.btn-danger:hover {
  background: #c82333;
  transform: translateY(-1px);
}

.column-item .form-group {
  margin-bottom: 1rem;
}

.column-item .form-group:last-child {
  margin-bottom: 0;
}

/* Checkbox styles */
.checkbox-label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  cursor: pointer;
  font-weight: normal;
  margin: 0;
}

.checkbox-label input[type="checkbox"] {
  margin: 0;
  width: 18px;
  height: 18px;
  cursor: pointer;
  accent-color: #007bff;
}

.checkbox-label span {
  user-select: none;
}
</style>