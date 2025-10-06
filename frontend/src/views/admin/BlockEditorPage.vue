<template>
  <div class="block-editor-page">
    <!-- Header fijo -->
    <div class="editor-header">
      <div class="header-left">
        <button @click="goBack" class="btn-back">
          <i class="fas fa-arrow-left"></i>
          Volver
        </button>
        <div class="page-info">
          <h1>{{ page.title }}</h1>
          <span class="page-slug">/{{ page.slug }}</span>
        </div>
      </div>
      <div class="header-actions">
        <button @click="previewMode = !previewMode" class="btn-secondary">
          <i :class="previewMode ? 'fas fa-edit' : 'fas fa-eye'"></i>
          {{ previewMode ? 'Editar' : 'Vista previa' }}
        </button>
        <button @click="saveBlocks" class="btn-primary" :disabled="saving">
          <i class="fas fa-save"></i>
          {{ saving ? 'Guardando...' : 'Guardar' }}
        </button>
      </div>
    </div>

    <!-- Contenido principal -->
    <div class="editor-content">
      <!-- Modo de edición -->
      <div v-if="!previewMode" class="edit-mode">
        <BlockEditor 
          v-model="pageBlocks" 
          :page-id="page.id"
          @save="saveBlocks"
          :is-full-page="true"
        />
      </div>

      <!-- Modo de vista previa -->
      <div v-else class="preview-mode">
        <div v-if="pageBlocks.length === 0" class="empty-preview">
          <i class="fas fa-eye-slash"></i>
          <h3>Sin contenido</h3>
          <p>Agrega bloques para ver la vista previa</p>
          <button @click="previewMode = false" class="btn-primary">
            <i class="fas fa-plus"></i>
            Agregar Bloques
          </button>
        </div>
        
        <div v-else class="preview-content">
          <BlockRenderer 
            v-for="block in sortedBlocks" 
            :key="block.id"
            :block="block"
            :is-editing="false"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, watch, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import BlockEditor from '@/components/admin/BlockEditor.vue'
import BlockRenderer from '@/components/blocks/BlockRenderer.vue'
import { pagesApi } from '@/services/api'
import type { Block } from '@/types/blocks'

const route = useRoute()
const router = useRouter()

const page = ref({
  id: 0,
  title: '',
  slug: '',
  pagecontent: [] as Block[]
})

const pageBlocks = ref<Block[]>([])
const previewMode = ref(false)
const saving = ref(false)

const sortedBlocks = computed(() => {
  return [...pageBlocks.value].sort((a, b) => a.order - b.order)
})

// Cargar datos de la página
onMounted(async () => {
  const pageId = parseInt(route.params.id as string)
  if (pageId) {
    try {
      const response = await pagesApi.getById(pageId)
      page.value = response.data
      
      if (page.value.pagecontent && Array.isArray(page.value.pagecontent)) {
        pageBlocks.value = page.value.pagecontent
      }
    } catch (error) {
      console.error('Error loading page:', error)
      // Redirigir de vuelta si no se puede cargar la página
      goBack()
    }
  }
})

const goBack = () => {
  router.push('/admin')
}

const saveBlocks = async () => {
  saving.value = true
  try {
    // Actualizar el orden de los bloques
    pageBlocks.value.forEach((block, index) => {
      block.order = index
    })

    console.log('Saving blocks for page:', page.value.id)
    console.log('Blocks data:', pageBlocks.value)

    // Guardar en la base de datos
    const response = await pagesApi.update(page.value.id, {
      pagecontent: pageBlocks.value
    })

    console.log('Save response:', response.data)
    
    // Mostrar mensaje de éxito
    showSuccessMessage()
    
  } catch (error) {
    console.error('Error saving blocks:', error)
    console.error('Error response:', error.response?.data)
    
    let errorMessage = 'Error al guardar los bloques. Por favor, intenta de nuevo.'
    
    if (error.response?.data?.message) {
      errorMessage = error.response.data.message
    } else if (error.response?.data?.errors) {
      errorMessage = Object.values(error.response.data.errors).flat().join(', ')
    }
    
    alert(errorMessage)
  } finally {
    saving.value = false
  }
}

const showSuccessMessage = () => {
  // Crear notificación temporal
  const notification = document.createElement('div')
  notification.innerHTML = `
    <div style="
      position: fixed;
      top: 20px;
      right: 20px;
      background: #28a745;
      color: white;
      padding: 1rem 1.5rem;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      z-index: 10000;
      font-weight: 600;
      animation: slideIn 0.3s ease-out;
    ">
      <i class="fas fa-check-circle" style="margin-right: 0.5rem;"></i>
      Bloques guardados exitosamente
    </div>
  `
  
  document.body.appendChild(notification)
  
  setTimeout(() => {
    notification.remove()
  }, 3000)
}

// Atajos de teclado
onMounted(() => {
  const handleKeyDown = (event: KeyboardEvent) => {
    // Ctrl/Cmd + S para guardar
    if ((event.ctrlKey || event.metaKey) && event.key === 's') {
      event.preventDefault()
      saveBlocks()
    }
    
    // Escape para volver
    if (event.key === 'Escape') {
      goBack()
    }
  }
  
  document.addEventListener('keydown', handleKeyDown)
  
  return () => {
    document.removeEventListener('keydown', handleKeyDown)
  }
})
</script>

<style scoped>
.block-editor-page {
  height: 100vh;
  display: flex;
  flex-direction: column;
  background: #f8f9fa;
}

.editor-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 2rem;
  background: white;
  border-bottom: 1px solid #e9ecef;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  z-index: 100;
}

.header-left {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.btn-back {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  background: #6c757d;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.9rem;
  transition: all 0.3s ease;
}

.btn-back:hover {
  background: #545b62;
  transform: translateY(-1px);
}

.page-info h1 {
  margin: 0;
  color: #2c3e50;
  font-size: 1.5rem;
  font-weight: 600;
}

.page-slug {
  font-size: 0.9rem;
  color: #6c757d;
  font-family: monospace;
}

.header-actions {
  display: flex;
  gap: 1rem;
  align-items: center;
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

.btn-primary:hover:not(:disabled) {
  background: #0056b3;
  transform: translateY(-1px);
}

.btn-primary:disabled {
  opacity: 0.6;
  cursor: not-allowed;
  transform: none;
}

.btn-secondary {
  background: #6c757d;
  color: white;
}

.btn-secondary:hover {
  background: #545b62;
  transform: translateY(-1px);
}

.editor-content {
  flex: 1;
  overflow: hidden;
  display: flex;
  flex-direction: column;
}

.edit-mode,
.preview-mode {
  flex: 1;
  overflow: hidden;
  display: flex;
  flex-direction: column;
}

.preview-mode {
  background: white;
  margin: 1rem;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.empty-preview {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  flex: 1;
  padding: 3rem;
  color: #6c757d;
}

.empty-preview i {
  font-size: 4rem;
  margin-bottom: 1rem;
  opacity: 0.5;
}

.empty-preview h3 {
  margin: 0 0 0.5rem 0;
  color: #495057;
}

.empty-preview p {
  margin: 0 0 2rem 0;
  text-align: center;
}

.preview-content {
  flex: 1;
  overflow-y: auto;
}

@keyframes slideIn {
  from {
    transform: translateX(100%);
    opacity: 0;
  }
  to {
    transform: translateX(0);
    opacity: 1;
  }
}

@media (max-width: 768px) {
  .editor-header {
    flex-direction: column;
    gap: 1rem;
    padding: 1rem;
  }
  
  .header-left {
    width: 100%;
    justify-content: space-between;
  }
  
  .header-actions {
    width: 100%;
    justify-content: space-between;
  }
  
  .btn-primary,
  .btn-secondary,
  .btn-back {
    font-size: 0.8rem;
    padding: 0.5rem 1rem;
  }
  
  .page-info h1 {
    font-size: 1.2rem;
  }
  
  .editor-content {
    margin: 0.5rem;
  }
}
</style>