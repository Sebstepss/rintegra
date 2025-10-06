<template>
  <div class="modal-overlay">
    <div class="modal" @click.stop>
      <div class="modal-header">
        <h3>{{ isEditing ? 'Editar' : 'Nueva' }} Página</h3>
        <button @click="$emit('close')" class="close-btn">×</button>
      </div>
      
      <div class="modal-body">
        <form @submit.prevent="handleSubmit">
          <div class="form-group">
            <label for="title">Título *</label>
            <input
              id="title"
              v-model="formData.title"
              type="text"
              required
              @input="generateSlug"
            />
          </div>
          
          <div class="form-group">
            <label for="slug">Slug (URL) *</label>
            <input
              id="slug"
              v-model="formData.slug"
              type="text"
              required
              @input="validateSlug"
            />
            <small class="help-text">URL amigable para la página (solo letras, números y guiones)</small>
          </div>
          
          <div class="form-group">
            <label for="meta_description">Meta Descripción</label>
            <textarea
              id="meta_description"
              v-model="formData.meta_description"
              rows="3"
              placeholder="Descripción SEO de la página"
            ></textarea>
            <small class="help-text">Recomendado: 150-160 caracteres para SEO</small>
          </div>
          
          <div class="form-group">
            <label for="status">Estado</label>
            <select id="status" v-model="formData.status">
              <option value="draft">Borrador</option>
              <option value="published">Publicado</option>
            </select>
          </div>

          <div class="form-group">
            <div class="toggle-group">
              <label class="toggle-label">
                Resaltar página (aparece con fondo degradado dorado en el menú)
              </label>
              <div class="toggle-switch">
                <input
                  type="checkbox"
                  id="featured"
                  v-model="formData.featured"
                  class="toggle-input"
                />
                <label for="featured" class="toggle-slider"></label>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="sort_order">Orden en el menú</label>
            <input
              id="sort_order"
              v-model.number="formData.sort_order"
              type="number"
              min="0"
              placeholder="0"
            />
            <small class="help-text">Orden numérico para aparecer en el menú (menor número = más arriba)</small>
          </div>

          <div class="form-group">
            <div class="toggle-group">
              <label class="toggle-label">
                Página Principal (aparece en el menú principal)
              </label>
              <div class="toggle-switch">
                <input
                  type="checkbox"
                  id="is_main_page"
                  v-model="formData.is_main_page"
                  class="toggle-input"
                />
                <label for="is_main_page" class="toggle-slider"></label>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="parent_id">Página padre (opcional)</label>
            <select id="parent_id" v-model="formData.parent_id">
              <option value="">-- Sin página padre --</option>
              <option 
                v-for="page in mainPages" 
                :key="page.id" 
                :value="page.id"
                :disabled="isEditing && page.id === props.page?.id"
              >
                {{ page.title }}
              </option>
            </select>
            <small class="help-text">Selecciona una página padre para crear una subpágina</small>
          </div>
          
          <div class="form-actions">
            <button type="button" @click="$emit('close')" class="btn-secondary">
              Cancelar
            </button>
            <button type="submit" class="btn-primary" :disabled="loading">
              <i v-if="loading" class="fas fa-spinner fa-spin"></i>
              {{ isEditing ? 'Actualizar' : 'Crear' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, watch, onMounted } from 'vue'
import { pagesApi } from '@/services/api'

const props = defineProps({
  page: {
    type: Object,
    default: null
  },
  isEditing: {
    type: Boolean,
    default: false
  }
})

const emit = defineEmits(['save', 'close'])

const loading = ref(false)
const mainPages = ref([])

const formData = reactive({
  title: '',
  slug: '',
  meta_description: '',
  status: 'draft',
  featured: false,
  is_main_page: true,
  sort_order: 0,
  parent_id: null
})

// Inicializar formulario con datos de la página si está editando
if (props.isEditing && props.page) {
  Object.assign(formData, {
    title: props.page.title,
    slug: props.page.slug,
    meta_description: props.page.meta_description || '',
    status: props.page.status,
    featured: props.page.featured || false,
    is_main_page: props.page.is_main_page !== undefined ? props.page.is_main_page : true,
    sort_order: props.page.sort_order || 0,
    parent_id: props.page.parent_id || null
  })
}

const generateSlug = () => {
  if (!props.isEditing) {
    formData.slug = formData.title
      .toLowerCase()
      .replace(/[áäàâã]/g, 'a')
      .replace(/[éëèê]/g, 'e')
      .replace(/[íïìî]/g, 'i')
      .replace(/[óöòôõ]/g, 'o')
      .replace(/[úüùû]/g, 'u')
      .replace(/[ñ]/g, 'n')
      .replace(/[çć]/g, 'c')
      .replace(/[^a-z0-9\s-]/g, '')
      .replace(/\s+/g, '-')
      .replace(/-+/g, '-')
      .replace(/^-|-$/g, '')
  }
}

const validateSlug = () => {
  formData.slug = formData.slug
    .toLowerCase()
    .replace(/[^a-z0-9-]/g, '')
    .replace(/-+/g, '-')
    .replace(/^-|-$/g, '')
}

const loadMainPages = async () => {
  try {
    const response = await pagesApi.getMainPages()
    mainPages.value = response.data
  } catch (error) {
    console.error('Error loading main pages:', error)
  }
}

const handleSubmit = async () => {
  loading.value = true
  try {
    // Ensure parent_id is null instead of empty string
    const submitData = { ...formData }
    if (submitData.parent_id === '') {
      submitData.parent_id = null
    }
    await emit('save', submitData)
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  loadMainPages()
})
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

.modal {
  background: white;
  border-radius: 12px;
  max-width: 600px;
  width: 100%;
  max-height: 90vh;
  overflow-y: auto;
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.5rem;
  border-bottom: 1px solid #e9ecef;
}

.modal-header h3 {
  margin: 0;
  color: #2c3e50;
  font-size: 1.25rem;
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
  padding: 1.5rem;
}

.form-group {
  margin-bottom: 1.5rem;
}

.form-group:last-of-type {
  margin-bottom: 0;
}

.form-group label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 600;
  color: #2c3e50;
}

.form-group input,
.form-group textarea,
.form-group select {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #ced4da;
  border-radius: 6px;
  font-size: 1rem;
  transition: border-color 0.2s;
}

.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {
  outline: none;
  border-color: #007bff;
  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
}

.form-group textarea {
  resize: vertical;
  min-height: 80px;
}

.help-text {
  display: block;
  margin-top: 0.25rem;
  font-size: 0.875rem;
  color: #6c757d;
}

/* Toggle Switch Styles */
.toggle-group {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 1rem;
}

.toggle-label {
  font-weight: 500;
  color: #2c3e50;
  margin: 0 !important;
  flex: 1;
}

.toggle-switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
  flex-shrink: 0;
}

.toggle-input {
  opacity: 0;
  width: 0;
  height: 0;
}

.toggle-slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  border-radius: 24px;
  transition: all 0.3s ease;
}

.toggle-slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  border-radius: 50%;
  transition: all 0.3s ease;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.toggle-input:checked + .toggle-slider {
  background: linear-gradient(135deg, #007bff, #0056b3);
}

.toggle-input:checked + .toggle-slider:before {
  transform: translateX(26px);
}

.toggle-slider:hover {
  box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
}

.toggle-input:checked + .toggle-slider:hover {
  box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
}

.form-actions {
  display: flex;
  gap: 1rem;
  justify-content: flex-end;
  margin-top: 2rem;
  padding-top: 1rem;
  border-top: 1px solid #e9ecef;
}

.btn-primary, .btn-secondary {
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.875rem;
  font-weight: 500;
  transition: all 0.2s;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.btn-primary {
  background-color: #007bff;
  color: white;
}

.btn-primary:hover:not(:disabled) {
  background-color: #0056b3;
}

.btn-primary:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.btn-secondary {
  background-color: #6c757d;
  color: white;
}

.btn-secondary:hover {
  background-color: #545b62;
}

@media (max-width: 640px) {
  .modal-overlay {
    padding: 0.5rem;
  }
  
  .modal-header {
    padding: 1rem;
  }
  
  .modal-body {
    padding: 1rem;
  }
  
  .form-actions {
    flex-direction: column;
  }
  
  .btn-primary, .btn-secondary {
    justify-content: center;
  }
}
</style>