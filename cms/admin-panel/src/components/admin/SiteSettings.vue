<template>
  <div class="site-settings">
    <div class="config-section">
      <h3>Configuración General del Sitio</h3>
      <p class="section-desc">Configura la información básica y general del sitio web</p>
    </div>

    <div class="config-form">
      <div class="form-row">
        <div class="form-group">
          <label for="site-name">Nombre del sitio</label>
          <input 
            type="text" 
            id="site-name" 
            v-model="siteConfig.siteName"
            class="form-input"
            placeholder="R-Integra"
          >
        </div>

        <div class="form-group">
          <label for="site-tagline">Eslogan del sitio</label>
          <input 
            type="text" 
            id="site-tagline" 
            v-model="siteConfig.tagline"
            class="form-input"
            placeholder="Solidez contable, proyección empresarial"
          >
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="site-description">Descripción del sitio</label>
          <textarea 
            id="site-description" 
            v-model="siteConfig.description"
            class="form-textarea"
            placeholder="Descripción general del sitio web"
            rows="4"
          ></textarea>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="contact-email">Email de contacto</label>
          <input 
            type="email" 
            id="contact-email" 
            v-model="siteConfig.contactEmail"
            class="form-input"
            placeholder="contacto@r-integra.com"
          >
        </div>

        <div class="form-group">
          <label for="contact-phone">Teléfono de contacto</label>
          <input 
            type="tel" 
            id="contact-phone" 
            v-model="siteConfig.contactPhone"
            class="form-input"
            placeholder="+1 234 567 8900"
          >
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="address">Dirección</label>
          <input 
            type="text" 
            id="address" 
            v-model="siteConfig.address"
            class="form-input"
            placeholder="Dirección de la empresa"
          >
        </div>

        <div class="form-group">
          <label for="timezone">Zona horaria</label>
          <select id="timezone" v-model="siteConfig.timezone" class="form-select">
            <option value="America/New_York">Eastern Time (ET)</option>
            <option value="America/Chicago">Central Time (CT)</option>
            <option value="America/Denver">Mountain Time (MT)</option>
            <option value="America/Los_Angeles">Pacific Time (PT)</option>
            <option value="America/Mexico_City">Mexico City</option>
            <option value="America/Bogota">Bogotá</option>
            <option value="America/Lima">Lima</option>
            <option value="Europe/Madrid">Madrid</option>
          </select>
        </div>
      </div>

      <div class="form-section">
        <h4>Identidad Visual</h4>
        <div class="form-group">
          <label>Favicon del sitio</label>
          <div class="media-selector">
            <div v-if="faviconPreview" class="selected-media">
              <img :src="faviconPreview" class="media-preview favicon-preview" alt="Favicon">
              <button @click="removeFavicon" class="btn-remove" type="button">
                <i class="fas fa-times"></i>
              </button>
            </div>
            <div v-else class="media-placeholder">
              <i class="fas fa-image"></i>
              <p>No hay favicon seleccionado</p>
            </div>
            <button @click="openFaviconPicker" class="btn-media" type="button">
              <i class="fas fa-image"></i>
              Seleccionar favicon
            </button>
          </div>
          <small class="form-help">
            Recomendado: imagen cuadrada 32x32px o 64x64px en formato PNG o ICO
          </small>
        </div>
      </div>

      <div class="form-actions">
        <button @click="saveConfig" class="btn-primary" :disabled="saving">
          <i class="fas fa-save"></i>
          {{ saving ? 'Guardando...' : 'Guardar Configuración' }}
        </button>
        <button @click="resetConfig" class="btn-secondary" type="button">
          <i class="fas fa-undo"></i>
          Restaurar Defaults
        </button>
      </div>
    </div>

    <MediaPicker
      :show="showMediaPicker"
      :selected-media="selectedMedia"
      :type-filter="'image'"
      :multiple="false"
      @close="closeMediaPicker"
      @select="onFaviconSelected"
    />
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue'
import { configsApi } from '@/services/api'
import MediaPicker from './MediaPicker.vue'
import { useMediaPicker } from '@/composables/useMediaPicker'
import { useSiteConfig } from '@/composables/useSiteConfig'

const saving = ref(false)

const { 
  showMediaPicker, 
  selectedMedia, 
  openMediaPicker, 
  closeMediaPicker, 
  getFullMediaUrl 
} = useMediaPicker()

const { updateFavicon } = useSiteConfig()

const siteConfig = ref({
  siteName: 'R-Integra',
  tagline: 'Solidez contable, proyección empresarial',
  description: '',
  contactEmail: '',
  contactPhone: '',
  address: '',
  timezone: 'America/Mexico_City',
  favicon: ''
})

const saveConfig = async () => {
  saving.value = true
  try {
    await configsApi.save('site', siteConfig.value, 'Configuración del sitio actualizada')
    
    // Update favicon immediately after saving
    if (siteConfig.value.favicon) {
      updateFavicon(siteConfig.value.favicon)
    }
    
    // Update document title
    if (siteConfig.value.siteName) {
      document.title = siteConfig.value.siteName
    }
    
    alert('Configuración guardada exitosamente')
  } catch (error) {
    console.error('Error al guardar la configuración:', error)
    alert('Error al guardar la configuración')
  } finally {
    saving.value = false
  }
}

const faviconPreview = computed(() => siteConfig.value.favicon)

const openFaviconPicker = () => {
  openMediaPicker({
    typeFilter: 'image',
    multiple: false,
    onSelect: onFaviconSelected
  })
}

const onFaviconSelected = (media: any) => {
  siteConfig.value.favicon = getFullMediaUrl(media)
  closeMediaPicker()
}

const removeFavicon = () => {
  siteConfig.value.favicon = ''
}

const resetConfig = () => {
  siteConfig.value = {
    siteName: 'R-Integra',
    tagline: 'Solidez contable, proyección empresarial',
    description: '',
    contactEmail: '',
    contactPhone: '',
    address: '',
    timezone: 'America/Mexico_City',
    favicon: ''
  }
}

const loadConfig = async () => {
  try {
    const response = await configsApi.getActive('site')
    if (response.data?.data?.config_data) {
      siteConfig.value = { ...siteConfig.value, ...response.data.data.config_data }
    }
  } catch (error) {
    console.error('Error al cargar configuración:', error)
  }
}

onMounted(() => {
  loadConfig()
})
</script>

<style scoped>
.site-settings {
  max-width: 100%;
}

.config-section {
  margin-bottom: 2rem;
}

.config-section h3 {
  color: #2c3e50;
  margin: 0 0 0.5rem 0;
  font-size: 1.5rem;
  font-family: 'Lato', sans-serif;
}

.section-desc {
  color: #6c757d;
  margin: 0;
  font-size: 0.95rem;
}

.config-form {
  background: #f8f9fa;
  border-radius: 8px;
  padding: 2rem;
}

.form-section {
  margin-top: 2rem;
  padding-top: 2rem;
  border-top: 1px solid #dee2e6;
}

.form-section h4 {
  color: #495057;
  margin: 0 0 1.5rem 0;
  font-size: 1.2rem;
  font-weight: 600;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2rem;
  margin-bottom: 1.5rem;
}

.form-row:last-child {
  margin-bottom: 0;
}

.form-group {
  display: flex;
  flex-direction: column;
}

.form-group label {
  font-weight: 600;
  color: #2c3e50;
  margin-bottom: 0.5rem;
  font-size: 0.9rem;
}

.form-input,
.form-textarea,
.form-select {
  padding: 0.75rem;
  border: 1px solid #ced4da;
  border-radius: 6px;
  font-size: 0.95rem;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
  background: white;
}

.form-input:focus,
.form-textarea:focus,
.form-select:focus {
  outline: none;
  border-color: #007bff;
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.form-textarea {
  resize: vertical;
  min-height: 100px;
}

.form-actions {
  margin-top: 3rem;
  padding-top: 2rem;
  border-top: 1px solid #dee2e6;
  display: flex;
  gap: 1rem;
  justify-content: flex-end;
}

.btn-primary,
.btn-secondary {
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.9rem;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 0.5rem;
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
  background: #6c757d;
  cursor: not-allowed;
  opacity: 0.6;
}

.btn-secondary {
  background: #6c757d;
  color: white;
}

.btn-secondary:hover {
  background: #545b62;
  transform: translateY(-1px);
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

.favicon-preview {
  max-width: 64px;
  max-height: 64px;
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

.form-help {
  display: block;
  margin-top: 0.5rem;
  font-size: 0.8rem;
  color: #6c757d;
  font-style: italic;
}

@media (max-width: 768px) {
  .form-row {
    grid-template-columns: 1fr;
    gap: 1rem;
  }
  
  .config-form {
    padding: 1rem;
  }
  
  .form-actions {
    flex-direction: column;
  }
  
  .form-actions button {
    width: 100%;
    justify-content: center;
  }
}
</style>