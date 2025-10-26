<template>
  <div class="modal-overlay" @click="$emit('close')">
    <div class="modal-content" @click.stop>
      <div class="modal-header">
        <h2>Editar Contenido: {{ page.title }}</h2>
        <button @click="$emit('close')" class="close-btn">×</button>
      </div>
      
      <div class="modal-body">
        <div class="content-editor">
          <div class="content-toolbar">
            <button @click="addContent('text')" class="btn-primary">
              <i class="fas fa-plus"></i>
              Agregar Texto
            </button>
            <button @click="addContent('hero')" class="btn-secondary">
              <i class="fas fa-star"></i>
              Agregar Hero
            </button>
            <button @click="saveAllContent" class="btn-success" :disabled="saving">
              <i class="fas fa-save"></i>
              {{ saving ? 'Guardando...' : 'Guardar Todo' }}
            </button>
          </div>

          <div class="content-sections">
            <div
              v-for="(content, index) in sortedContents"
              :key="content.id || `new-${index}`"
              class="content-item"
              :class="{ 'is-new': !content.id }"
            >
              <div class="content-header">
                <div class="content-type-badge" :class="content.content_type">
                  {{ getContentTypeLabel(content.content_type) }}
                </div>
                <div class="content-controls">
                  <button @click="moveContent(index, -1)" :disabled="index === 0" class="btn-sm">
                    <i class="fas fa-arrow-up"></i>
                  </button>
                  <button @click="moveContent(index, 1)" :disabled="index === sortedContents.length - 1" class="btn-sm">
                    <i class="fas fa-arrow-down"></i>
                  </button>
                  <button @click="deleteContent(index)" class="btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
              </div>

              <div class="content-editor-area">
                <!-- Editor de texto -->
                <div v-if="content.content_type === 'text'" class="text-editor">
                  <TipTapEditor
                    v-model="content.content_data.html"
                    :editable="true"
                  />
                </div>

                <!-- Editor de hero -->
                <div v-else-if="content.content_type === 'hero'" class="hero-editor">
                  <div class="form-group">
                    <label>Título Principal</label>
                    <input
                      v-model="content.content_data.title"
                      type="text"
                      placeholder="Título del hero"
                    />
                  </div>
                  <div class="form-group">
                    <label>Subtítulo</label>
                    <input
                      v-model="content.content_data.subtitle"
                      type="text"
                      placeholder="Subtítulo o descripción"
                    />
                  </div>
                  <div class="form-group">
                    <label>Contenido Adicional</label>
                    <TipTapEditor
                      v-model="content.content_data.html"
                      :editable="true"
                    />
                  </div>
                </div>
              </div>
            </div>

            <div v-if="sortedContents.length === 0" class="empty-state">
              <i class="fas fa-file-alt"></i>
              <h3>Sin contenido</h3>
              <p>Esta página no tiene contenido aún. Agrega secciones usando los botones de arriba.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useContentStore } from '@/stores/content'
import TipTapEditor from '@/components/Editor/TipTapEditor.vue'

const props = defineProps({
  page: {
    type: Object,
    required: true
  }
})

const emit = defineEmits(['close'])

const contentStore = useContentStore()
const saving = ref(false)
const contents = ref([])

const sortedContents = computed(() => {
  return [...contents.value].sort((a, b) => a.order - b.order)
})

onMounted(async () => {
  await loadPageContent()
})

const loadPageContent = async () => {
  try {
    await contentStore.fetchPageBySlug(props.page.slug)
    contents.value = [...(contentStore.currentPage?.contents || [])]
  } catch (error) {
    console.error('Error loading page content:', error)
    contents.value = []
  }
}

const addContent = (type) => {
  const newContent = {
    id: null, // Marca como nuevo
    page_id: props.page.id,
    content_type: type,
    content_data: getDefaultContentData(type),
    order: contents.value.length
  }
  
  contents.value.push(newContent)
}

const getDefaultContentData = (type) => {
  switch (type) {
    case 'text':
      return { html: '<p>Escribe tu contenido aquí...</p>' }
    case 'hero':
      return {
        title: 'Título Principal',
        subtitle: 'Subtítulo descriptivo',
        html: '<p>Contenido adicional del hero</p>'
      }
    default:
      return {}
  }
}

const getContentTypeLabel = (type) => {
  const labels = {
    text: 'Texto',
    hero: 'Hero Section'
  }
  return labels[type] || type
}

const moveContent = (index, direction) => {
  const newIndex = index + direction
  if (newIndex >= 0 && newIndex < contents.value.length) {
    // Intercambiar posiciones
    const temp = contents.value[index]
    contents.value[index] = contents.value[newIndex]
    contents.value[newIndex] = temp
    
    // Actualizar órdenes
    updateOrder()
  }
}

const deleteContent = (index) => {
  if (confirm('¿Estás seguro de eliminar esta sección?')) {
    contents.value.splice(index, 1)
    updateOrder()
  }
}

const updateOrder = () => {
  contents.value.forEach((content, index) => {
    content.order = index
  })
}

const saveAllContent = async () => {
  saving.value = true
  try {
    // Actualizar órdenes antes de guardar
    updateOrder()
    
    for (const content of contents.value) {
      if (content.id) {
        // Actualizar contenido existente
        await contentStore.updateContent(content.id, {
          content_type: content.content_type,
          content_data: content.content_data,
          order: content.order,
          page_id: content.page_id
        })
      } else {
        // Crear nuevo contenido
        const newContent = await contentStore.createContent({
          page_id: content.page_id,
          content_type: content.content_type,
          content_data: content.content_data,
          order: content.order
        })
        // Actualizar el ID local
        content.id = newContent.id
      }
    }
    
    alert('Contenido guardado exitosamente')
  } catch (error) {
    console.error('Error saving content:', error)
    alert('Error al guardar el contenido')
  } finally {
    saving.value = false
  }
}
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
  padding: 1rem;
}

.modal-content {
  background: white;
  border-radius: 12px;
  width: 95%;
  max-width: 1200px;
  height: 90vh;
  display: flex;
  flex-direction: column;
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.5rem 2rem;
  border-bottom: 1px solid #e9ecef;
  flex-shrink: 0;
}

.modal-header h2 {
  margin: 0;
  color: #2c3e50;
}

.close-btn {
  background: none;
  border: none;
  font-size: 2rem;
  color: #6c757d;
  cursor: pointer;
  padding: 0;
  width: 30px;
  height: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  transition: all 0.2s;
}

.close-btn:hover {
  background-color: #f8f9fa;
  color: #495057;
}

.modal-body {
  flex: 1;
  overflow: hidden;
  padding: 0;
}

.content-editor {
  height: 100%;
  display: flex;
  flex-direction: column;
}

.content-toolbar {
  padding: 1rem 2rem;
  border-bottom: 1px solid #e9ecef;
  display: flex;
  gap: 1rem;
  align-items: center;
  flex-shrink: 0;
}

.content-sections {
  flex: 1;
  overflow-y: auto;
  padding: 1rem 2rem;
}

.content-item {
  border: 1px solid #e9ecef;
  border-radius: 8px;
  margin-bottom: 1.5rem;
  background: #f8f9fa;
}

.content-item.is-new {
  border-color: #007bff;
  background: #f0f8ff;
}

.content-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  background: white;
  border-bottom: 1px solid #e9ecef;
  border-radius: 8px 8px 0 0;
}

.content-type-badge {
  padding: 0.25rem 0.75rem;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
}

.content-type-badge.text {
  background-color: #e3f2fd;
  color: #1976d2;
}

.content-type-badge.hero {
  background-color: #f3e5f5;
  color: #7b1fa2;
}

.content-controls {
  display: flex;
  gap: 0.5rem;
}

.content-editor-area {
  padding: 1rem;
  background: white;
  border-radius: 0 0 8px 8px;
}

.text-editor {
  min-height: 200px;
}

.hero-editor .form-group {
  margin-bottom: 1rem;
}

.hero-editor label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 600;
  color: #2c3e50;
}

.hero-editor input {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #ced4da;
  border-radius: 6px;
  font-size: 1rem;
}

.empty-state {
  text-align: center;
  padding: 4rem 2rem;
  color: #6c757d;
}

.empty-state i {
  font-size: 3rem;
  margin-bottom: 1rem;
  opacity: 0.5;
}

.empty-state h3 {
  margin-bottom: 0.5rem;
}

.btn-primary, .btn-secondary, .btn-success, .btn-sm {
  padding: 0.5rem 1rem;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.875rem;
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  transition: all 0.2s;
}

.btn-sm {
  padding: 0.25rem 0.5rem;
  font-size: 0.75rem;
}

.btn-primary {
  background-color: #007bff;
  color: white;
}

.btn-secondary {
  background-color: #6c757d;
  color: white;
}

.btn-success {
  background-color: #28a745;
  color: white;
}

.btn-danger {
  background-color: #dc3545;
  color: white;
}

.btn-primary:hover { background-color: #0056b3; }
.btn-secondary:hover { background-color: #545b62; }
.btn-success:hover { background-color: #218838; }
.btn-danger:hover { background-color: #c82333; }

.btn-sm:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

@media (max-width: 768px) {
  .modal-content {
    width: 98%;
    height: 95vh;
  }
  
  .modal-header {
    padding: 1rem;
  }
  
  .content-toolbar {
    padding: 1rem;
    flex-wrap: wrap;
  }
  
  .content-sections {
    padding: 1rem;
  }
  
  .content-header {
    flex-direction: column;
    gap: 1rem;
    align-items: flex-start;
  }
  
  .content-controls {
    width: 100%;
    justify-content: flex-end;
  }
}
</style>