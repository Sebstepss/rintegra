<template>
  <div class="notes-manager">
    <!-- Header -->
    <div class="notes-header">
      <h2>Gestión de Notas</h2>
      <div class="header-actions">
        <button @click="openCreateModal" class="btn-primary">
          <Icon name="plus" />
          Nueva Nota
        </button>
      </div>
    </div>

    <!-- Stats -->
    <div class="notes-stats">
      <div class="stat-card">
        <div class="stat-icon">
          <Icon name="document-text" />
        </div>
        <div class="stat-content">
          <h3>{{ notes.length }}</h3>
          <p>Total de Notas</p>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">
          <Icon name="eye" />
        </div>
        <div class="stat-content">
          <h3>{{ recentNotes }}</h3>
          <p>Recientes (7 días)</p>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">
          <Icon name="star" />
        </div>
        <div class="stat-content">
          <h3>{{ favoriteNotes }}</h3>
          <p>Favoritas</p>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">
          <Icon name="folder" />
        </div>
        <div class="stat-content">
          <h3>{{ uniqueCategories }}</h3>
          <p>Categorías</p>
        </div>
      </div>
    </div>

    <!-- Filters and Search -->
    <div class="notes-controls">
      <div class="search-section">
        <div class="search-input-group">
          <Icon name="magnifying-glass" />
          <input 
            type="text" 
            v-model="searchQuery" 
            placeholder="Buscar notas..." 
            class="search-input"
          >
        </div>
      </div>
      
      <div class="filters-section">
        <select v-model="selectedCategory" class="filter-select">
          <option value="">Todas las categorías</option>
          <option v-for="category in categories" :key="category" :value="category">
            {{ category }}
          </option>
        </select>
        
        <select v-model="sortBy" class="filter-select">
          <option value="updated_at">Más recientes</option>
          <option value="created_at">Fecha de creación</option>
          <option value="title">Alfabético</option>
          <option value="category">Por categoría</option>
        </select>
        
        <button 
          @click="showFavoritesOnly = !showFavoritesOnly" 
          class="btn-filter" 
          :class="{ active: showFavoritesOnly }"
        >
          <Icon name="star" />
          Solo favoritas
        </button>
      </div>
    </div>

    <!-- Notes Grid -->
    <div class="notes-container">
      <div v-if="filteredNotes.length === 0" class="empty-state">
        <Icon name="document-text" />
        <h3>No hay notas</h3>
        <p v-if="searchQuery || selectedCategory || showFavoritesOnly">
          No se encontraron notas con los filtros aplicados
        </p>
        <p v-else>Crea tu primera nota para comenzar</p>
        <button @click="openCreateModal" class="btn-primary">
          <Icon name="plus" />
          Crear Primera Nota
        </button>
      </div>

      <div v-else class="notes-grid">
        <div 
          v-for="note in paginatedNotes" 
          :key="note.id" 
          class="note-card"
          @click="openViewModal(note)"
        >
          <div class="note-header">
            <div class="note-title-section">
              <h3>{{ note.title }}</h3>
              <span v-if="note.category" class="note-category">{{ note.category }}</span>
            </div>
            <div class="note-actions" @click.stop>
              <button 
                @click="toggleFavorite(note)" 
                class="btn-icon"
                :class="{ favorite: note.is_favorite }"
                :title="note.is_favorite ? 'Quitar de favoritos' : 'Agregar a favoritos'"
              >
                <Icon name="star" />
              </button>
              <button @click="openEditModal(note)" class="btn-icon" title="Editar">
                <Icon name="edit" />
              </button>
              <button @click="deleteNote(note)" class="btn-icon btn-danger" title="Eliminar">
                <Icon name="delete" />
              </button>
            </div>
          </div>
          
          <div class="note-preview" v-html="getPreviewText(note.content)"></div>
          
          <div class="note-meta">
            <span class="note-date">
              <Icon name="clock" />
              {{ formatDate(note.updated_at) }}
            </span>
            <span class="note-word-count">{{ getWordCount(note.content) }} palabras</span>
          </div>
        </div>
      </div>

      <!-- Pagination -->
      <div class="pagination" v-if="totalPages > 1">
        <button 
          @click="currentPage--" 
          :disabled="currentPage === 1"
          class="btn-pagination"
        >
          <Icon name="chevron-left" />
          Anterior
        </button>
        
        <span class="pagination-info">
          Página {{ currentPage }} de {{ totalPages }} 
          ({{ filteredNotes.length }} notas)
        </span>
        
        <button 
          @click="currentPage++" 
          :disabled="currentPage === totalPages"
          class="btn-pagination"
        >
          Siguiente
          <Icon name="chevron-right" />
        </button>
      </div>
    </div>

    <!-- Create/Edit Modal -->
    <div v-if="showModal" class="modal-overlay">
      <div class="modal-content large-modal" @click.stop>
        <div class="modal-header">
          <p>{{ isEditing ? 'Editar Nota' : 'Nueva Nota' }}</p>
          <button @click="closeModal" class="btn-close">
            <Icon name="close" />
          </button>
        </div>
        
        <form @submit.prevent="saveNote" class="modal-form">
          <div class="modal-body">
            <div class="form-row">
              <div class="form-group">
                <label for="note-title">Título de la nota *</label>
                <input 
                  type="text" 
                  id="note-title"
                  v-model="noteForm.title" 
                  class="form-input"
                  placeholder="Ingresa el título de la nota"
                  required
                >
              </div>
              <div class="form-group">
                <label for="note-category">Categoría</label>
                <input 
                  type="text" 
                  id="note-category"
                  v-model="noteForm.category" 
                  class="form-input"
                  placeholder="Categoría (opcional)"
                  list="categories-list"
                >
                <datalist id="categories-list">
                  <option v-for="category in categories" :key="category" :value="category"></option>
                </datalist>
              </div>
            </div>
            
            <div class="form-group">
              <label>Contenido *</label>
              <div class="editor-container">
                <TiptapEditor 
                  v-model="noteForm.content"
                  :loading="saving"
                />
              </div>
            </div>
            
          </div>
          
          <div class="modal-footer">
            <div class="form-options">
              <label class="checkbox-label">
                <input type="checkbox" v-model="noteForm.is_favorite">
                <span class="checkmark"></span>
                Marcar como favorita
              </label>
            </div>
            
            <div class="action-buttons">
              <button type="button" @click="closeModal" class="btn-secondary">
                <Icon name="close" />
                Cancelar
              </button>
              <button type="submit" class="btn-primary" :disabled="saving">
                <Icon name="save" />
                {{ saving ? 'Guardando...' : (isEditing ? 'Actualizar' : 'Crear Nota') }}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- View Modal -->
    <div v-if="showViewModal" class="modal-overlay">
      <div class="modal-content large-modal" @click.stop>
        <div class="modal-header">
          <div class="view-header-info">
            <h3>{{ viewingNote?.title }}</h3>
            <span v-if="viewingNote?.category" class="note-category">{{ viewingNote.category }}</span>
          </div>
          <div class="view-header-actions">
            <button 
              @click="toggleFavorite(viewingNote)" 
              class="btn-icon"
              :class="{ favorite: viewingNote?.is_favorite }"
            >
              <Icon name="star" />
            </button>
            <button @click="openEditModalFromView" class="btn-icon">
              <Icon name="edit" />
            </button>
            <button @click="closeViewModal" class="btn-close">
              <Icon name="close" />
            </button>
          </div>
        </div>
        
        <div class="modal-body">
          <div class="note-metadata">
            <span class="meta-item">
              <Icon name="calendar" />
              Creada: {{ formatDateTime(viewingNote?.created_at) }}
            </span>
            <span class="meta-item">
              <Icon name="clock" />
              Actualizada: {{ formatDateTime(viewingNote?.updated_at) }}
            </span>
            <span class="meta-item">
              <Icon name="document-text" />
              {{ getWordCount(viewingNote?.content) }} palabras
            </span>
          </div>
          
          <div class="note-content-view" v-html="viewingNote?.content"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import Icon from '@/components/global/Icon.vue'
import TiptapEditor from '@/components/admin/TiptapEditor.vue'
import { notesApi } from '@/services/notesApi'

// Estado reactivo
const notes = ref([])
const searchQuery = ref('')
const selectedCategory = ref('')
const sortBy = ref('updated_at')
const showFavoritesOnly = ref(false)
const currentPage = ref(1)
const itemsPerPage = ref(12)
const loading = ref(false)
const saving = ref(false)

// Modales
const showModal = ref(false)
const showViewModal = ref(false)
const isEditing = ref(false)
const viewingNote = ref(null)

// Formulario
const noteForm = ref({
  title: '',
  content: '',
  category: '',
  is_favorite: false
})

const editingNoteId = ref(null)

// Cargar datos al montar
onMounted(() => {
  loadNotes()
})

// Computed properties
const categories = computed(() => {
  const cats = notes.value
    .map(note => note.category)
    .filter(cat => cat && cat.trim())
    .filter((cat, index, arr) => arr.indexOf(cat) === index)
  return cats.sort()
})

const recentNotes = computed(() => {
  const sevenDaysAgo = new Date()
  sevenDaysAgo.setDate(sevenDaysAgo.getDate() - 7)
  return notes.value.filter(note => new Date(note.updated_at) > sevenDaysAgo).length
})

const favoriteNotes = computed(() => 
  notes.value.filter(note => note.is_favorite).length
)

const uniqueCategories = computed(() => categories.value.length)

const filteredNotes = computed(() => {
  let filtered = [...notes.value]

  // Filtrar por búsqueda
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase()
    filtered = filtered.filter(note =>
      note.title.toLowerCase().includes(query) ||
      note.content.toLowerCase().includes(query) ||
      (note.category && note.category.toLowerCase().includes(query))
    )
  }

  // Filtrar por categoría
  if (selectedCategory.value) {
    filtered = filtered.filter(note => note.category === selectedCategory.value)
  }

  // Filtrar solo favoritas
  if (showFavoritesOnly.value) {
    filtered = filtered.filter(note => note.is_favorite)
  }

  // Ordenar
  filtered.sort((a, b) => {
    switch (sortBy.value) {
      case 'title':
        return a.title.localeCompare(b.title)
      case 'category':
        return (a.category || '').localeCompare(b.category || '')
      case 'created_at':
        return new Date(b.created_at) - new Date(a.created_at)
      case 'updated_at':
      default:
        return new Date(b.updated_at) - new Date(a.updated_at)
    }
  })

  return filtered
})

const totalPages = computed(() => 
  Math.ceil(filteredNotes.value.length / itemsPerPage.value)
)

const paginatedNotes = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value
  const end = start + itemsPerPage.value
  return filteredNotes.value.slice(start, end)
})

// Métodos CRUD
const loadNotes = async () => {
  try {
    loading.value = true
    const response = await notesApi.getAll()
    notes.value = response.data
  } catch (error) {
    console.error('Error loading notes:', error)
    alert('Error al cargar las notas')
  } finally {
    loading.value = false
  }
}

const saveNote = async () => {
  if (!noteForm.value.title.trim() || !noteForm.value.content.trim()) {
    alert('El título y el contenido son obligatorios')
    return
  }

  try {
    saving.value = true
    
    if (isEditing.value) {
      const response = await notesApi.update(editingNoteId.value, noteForm.value)
      const index = notes.value.findIndex(n => n.id === editingNoteId.value)
      if (index > -1) {
        notes.value[index] = response.data
      }
    } else {
      const response = await notesApi.create(noteForm.value)
      notes.value.unshift(response.data)
    }
    
    closeModal()
    alert(isEditing.value ? 'Nota actualizada correctamente' : 'Nota creada correctamente')
  } catch (error) {
    console.error('Error saving note:', error)
    alert('Error al guardar la nota')
  } finally {
    saving.value = false
  }
}

const deleteNote = async (note) => {
  if (!confirm(`¿Estás seguro de eliminar la nota "${note.title}"?`)) {
    return
  }

  try {
    await notesApi.delete(note.id)
    const index = notes.value.findIndex(n => n.id === note.id)
    if (index > -1) {
      notes.value.splice(index, 1)
    }
    alert('Nota eliminada correctamente')
  } catch (error) {
    console.error('Error deleting note:', error)
    alert('Error al eliminar la nota')
  }
}

const toggleFavorite = async (note) => {
  try {
    const updatedNote = { ...note, is_favorite: !note.is_favorite }
    const response = await notesApi.update(note.id, updatedNote)
    
    const index = notes.value.findIndex(n => n.id === note.id)
    if (index > -1) {
      notes.value[index] = response.data
    }
    
    // Actualizar también en viewingNote si es la misma nota
    if (viewingNote.value?.id === note.id) {
      viewingNote.value = response.data
    }
  } catch (error) {
    console.error('Error toggling favorite:', error)
    alert('Error al actualizar favorito')
  }
}

// Métodos de modal
const openCreateModal = () => {
  noteForm.value = {
    title: '',
    content: '',
    category: '',
    is_favorite: false
  }
  isEditing.value = false
  editingNoteId.value = null
  showModal.value = true
}

const openEditModal = (note) => {
  noteForm.value = {
    title: note.title,
    content: note.content,
    category: note.category || '',
    is_favorite: note.is_favorite
  }
  isEditing.value = true
  editingNoteId.value = note.id
  showModal.value = true
}

const openEditModalFromView = () => {
  if (viewingNote.value) {
    closeViewModal()
    openEditModal(viewingNote.value)
  }
}

const closeModal = () => {
  showModal.value = false
  isEditing.value = false
  editingNoteId.value = null
  noteForm.value = {
    title: '',
    content: '',
    category: '',
    is_favorite: false
  }
}

const openViewModal = (note) => {
  viewingNote.value = note
  showViewModal.value = true
}

const closeViewModal = () => {
  showViewModal.value = false
  viewingNote.value = null
}

// Utilidades
const formatDate = (dateString) => {
  const date = new Date(dateString)
  const now = new Date()
  const diffTime = Math.abs(now - date)
  const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24))
  
  if (diffDays === 1) return 'Hoy'
  if (diffDays === 2) return 'Ayer'
  if (diffDays <= 7) return `Hace ${diffDays - 1} días`
  
  return date.toLocaleDateString('es-ES')
}

const formatDateTime = (dateString) => {
  return new Date(dateString).toLocaleString('es-ES')
}

const getPreviewText = (content) => {
  // Remover HTML tags y obtener solo texto
  const textContent = content.replace(/<[^>]*>/g, ' ').replace(/\s+/g, ' ').trim()
  return textContent.length > 150 ? textContent.substring(0, 150) + '...' : textContent
}

const getWordCount = (content) => {
  if (!content) return 0
  const textContent = content.replace(/<[^>]*>/g, ' ').replace(/\s+/g, ' ').trim()
  return textContent ? textContent.split(' ').length : 0
}
</script>

<style scoped>
.notes-manager {
  padding: 0;
}

.notes-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}

.notes-header h2 {
  margin: 0;
  color: #2c3e50;
}

.header-actions {
  display: flex;
  gap: 1rem;
  align-items: center;
}

.notes-stats {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1rem;
  margin-bottom: 2rem;
}

.stat-card {
  background: white;
  border-radius: 8px;
  padding: 1.5rem;
  display: flex;
  align-items: center;
  gap: 1rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  border: 1px solid #e9ecef;
}

.stat-icon {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background: linear-gradient(135deg, #007bff, #0056b3);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
}

.stat-content h3 {
  font-size: 1.8rem;
  font-weight: 700;
  margin: 0;
  color: #2c3e50;
}

.stat-content p {
  margin: 0;
  color: #6c757d;
  font-size: 0.9rem;
}

.notes-controls {
  background: white;
  border-radius: 8px;
  padding: 1.5rem;
  margin-bottom: 2rem;
  border: 1px solid #e9ecef;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 2rem;
}

.search-section {
  flex: 1;
}

.search-input-group {
  position: relative;
  display: flex;
  align-items: center;
  max-width: 400px;
}

.search-input-group .w-4 {
  position: absolute;
  left: 1rem;
  color: #6c757d;
  z-index: 1;
}

.search-input {
  width: 100%;
  padding: 0.75rem 1rem 0.75rem 3rem;
  border: 1px solid #dee2e6;
  border-radius: 6px;
  font-size: 0.9rem;
}

.search-input:focus {
  outline: none;
  border-color: #007bff;
  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
}

.filters-section {
  display: flex;
  gap: 1rem;
  align-items: center;
}

.filter-select {
  padding: 0.5rem;
  border: 1px solid #dee2e6;
  border-radius: 4px;
  font-size: 0.9rem;
}

.btn-filter {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  border: 1px solid #dee2e6;
  background: white;
  border-radius: 4px;
  cursor: pointer;
  color: #6c757d;
  transition: all 0.2s;
}

.btn-filter:hover {
  border-color: #007bff;
  color: #007bff;
}

.btn-filter.active {
  background: #007bff;
  color: white;
  border-color: #007bff;
}

.notes-container {
  background: white;
  border-radius: 8px;
  border: 1px solid #e9ecef;
  min-height: 400px;
}

.empty-state {
  text-align: center;
  padding: 4rem 2rem;
  color: #6c757d;
}

.empty-state h3 {
  margin: 1rem 0 0.5rem 0;
  color: #495057;
}

.empty-state p {
  margin-bottom: 2rem;
}

.notes-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
  gap: 1.5rem;
  padding: 1.5rem;
}

.note-card {
  border: 1px solid #e9ecef;
  border-radius: 8px;
  padding: 1.5rem;
  transition: all 0.2s;
  cursor: pointer;
  background: white;
}

.note-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  border-color: #007bff;
}

.note-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 1rem;
}

.note-title-section h3 {
  margin: 0 0 0.5rem 0;
  color: #2c3e50;
  font-size: 1.1rem;
  line-height: 1.3;
  display: none;
}

.note-category {
  display: inline-block;
  background: #e9ecef;
  color: #495057;
  padding: 0.25rem 0.5rem;
  border-radius: 12px;
  font-size: 0.75rem;
  font-weight: 500;
}

.note-actions {
  display: flex;
  gap: 0.25rem;
  opacity: 0;
  transition: opacity 0.2s;
}

.note-card:hover .note-actions {
  opacity: 1;
}

.btn-icon {
  padding: 0.5rem;
  border: none;
  background: transparent;
  border-radius: 4px;
  cursor: pointer;
  color: #6c757d;
  transition: all 0.2s;
}

.btn-icon:hover {
  background: #e9ecef;
  color: #495057;
}

.btn-icon.favorite {
  color: #ffc107;
}

.btn-icon.btn-danger:hover {
  background: #f8d7da;
  color: #721c24;
}

.note-preview {
  color: #6c757d;
  font-size: 0.9rem;
  line-height: 1.5;
  margin-bottom: 1rem;
  min-height: 3rem;
  overflow: hidden;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
}

.note-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 0.8rem;
  color: #6c757d;
  border-top: 1px solid #f8f9fa;
  padding-top: 0.75rem;
}

.note-date {
  display: flex;
  align-items: center;
  gap: 0.25rem;
}

.pagination {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  border-top: 1px solid #e9ecef;
}

.btn-pagination {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  border: 1px solid #dee2e6;
  background: white;
  border-radius: 4px;
  cursor: pointer;
  color: #495057;
  transition: all 0.2s;
}

.btn-pagination:hover:not(:disabled) {
  background: #f8f9fa;
  border-color: #adb5bd;
}

.btn-pagination:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.pagination-info {
  color: #6c757d;
  font-size: 0.9rem;
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
  width: 90%;
  max-width: 600px;
  max-height: 90vh;
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

.modal-content.large-modal {
  max-width: 80%;
  width: 95%;
}

.modal-header {
  font-weight: bold !important;
  padding-top: 0.5rem;
  padding-left: 1.5rem;
  padding-right: 0.5rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #e9ecef;
  flex-shrink: 0;
}

.modal-header h3 {
  margin: 0;
  color: #2c3e50;
}

.view-header-info {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.view-header-actions {
  display: flex;
  gap: 0.5rem;
  align-items: center;
}

.btn-close {
  background: none;
  border: none;
  font-size: 1.2rem;
  cursor: pointer;
  color: #6c757d;
  padding: 0.5rem;
  border-radius: 4px;
}

.btn-close:hover {
  background: #f8f9fa;
}

.modal-form {
  display: flex;
  flex-direction: column;
  height: 100%;
  flex: 1;
  min-height: 0;
}

.modal-body {
  flex: 1;
  padding: 1.5rem;
  overflow-y: auto;
  min-height: 0;
}

.form-row {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 0.2rem;
  margin-bottom: 1rem;
}

.form-group {
  margin-bottom: 0.2rem;
}

.form-group label {
  display: none;
  margin-bottom: 0.5rem;
  font-weight: 600;
  color: #495057;
}

.form-input {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #dee2e6;
  border-radius: 4px;
  font-size: 0.9rem;
}

.form-input:focus {
  outline: none;
  border-color: #007bff;
  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
}

.editor-container {
  border: 1px solid #dee2e6;
  border-radius: 4px;
  overflow: hidden;
}

.modal-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.5rem;
  border-top: 1px solid #e9ecef;
  background: #f8f9fa;
  flex-shrink: 0;
}

.form-actions {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 2rem;
  padding-top: 1rem;
  border-top: 1px solid #e9ecef;
}

.checkbox-label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  cursor: pointer;
  color: #495057;
}

.checkbox-label input[type="checkbox"] {
  width: 18px;
  height: 18px;
  margin: 0;
}

.action-buttons {
  display: flex;
  gap: 1rem;
}

.btn-primary,
.btn-secondary {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-weight: 600;
  transition: all 0.2s;
}

.btn-primary {
  background: #007bff;
  color: white;
}

.btn-primary:hover:not(:disabled) {
  background: #0056b3;
}

.btn-primary:disabled {
  background: #6c757d;
  cursor: not-allowed;
}

.btn-secondary {
  background: #6c757d;
  color: white;
}

.btn-secondary:hover {
  background: #545b62;
}

.note-metadata {
  display: flex;
  gap: 2rem;
  margin-bottom: 2rem;
  padding: 1rem;
  background: #f8f9fa;
  border-radius: 6px;
  flex-wrap: wrap;
}

.meta-item {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  color: #6c757d;
  font-size: 0.9rem;
}

.note-content-view {
  line-height: 1.6;
  color: #495057;
}

.note-content-view h1,
.note-content-view h2,
.note-content-view h3,
.note-content-view h4,
.note-content-view h5,
.note-content-view h6 {
  color: #2c3e50;
  margin-top: 1.5rem;
  margin-bottom: 1rem;
}

.note-content-view p {
  margin-bottom: 1rem;
}

.note-content-view ul,
.note-content-view ol {
  margin-bottom: 1rem;
  padding-left: 2rem;
}

.note-content-view blockquote {
  border-left: 4px solid #007bff;
  padding-left: 1rem;
  margin: 1rem 0;
  font-style: italic;
  color: #6c757d;
}

.note-content-view pre {
  background: #f8f9fa;
  padding: 1rem;
  border-radius: 4px;
  overflow-x: auto;
  font-family: 'Courier New', monospace;
}

.note-content-view code {
  background: #f8f9fa;
  padding: 0.2rem 0.4rem;
  border-radius: 3px;
  font-family: 'Courier New', monospace;
  font-size: 0.9em;
}

/* Responsive */
@media (max-width: 1024px) {
  .notes-controls {
    flex-direction: column;
    gap: 1rem;
  }
  
  .search-section {
    width: 100%;
  }
  
  .search-input-group {
    max-width: none;
  }
  
  .filters-section {
    width: 100%;
    justify-content: space-between;
  }
  
  .notes-grid {
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  }
}

@media (max-width: 768px) {
  .notes-header {
    flex-direction: column;
    gap: 1rem;
    align-items: stretch;
  }
  
  .notes-stats {
    grid-template-columns: repeat(2, 1fr);
  }
  
  .filters-section {
    flex-wrap: wrap;
  }
  
  .notes-grid {
    grid-template-columns: 1fr;
    gap: 1rem;
  }
  
  .form-row {
    grid-template-columns: 1fr;
  }
  
  .form-actions {
    flex-direction: column;
    gap: 1rem;
    align-items: stretch;
  }
  
  .action-buttons {
    width: 100%;
    justify-content: space-between;
  }
  
  .note-metadata {
    gap: 1rem;
  }
  
  .pagination {
    flex-direction: column;
    gap: 1rem;
  }
}

@media (max-width: 480px) {
  .notes-stats {
    grid-template-columns: 1fr;
  }
  
  .modal-content.large-modal {
    width: 98%;
    margin: 1%;
  }
}
</style>