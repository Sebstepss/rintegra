<template>
  <div class="seo-settings">
    <div class="config-section">
      <h3>Configuración SEO</h3>
      <p class="section-desc">Optimiza tu sitio web para motores de búsqueda</p>
    </div>

    <div class="config-form">
      <div class="form-section">
        <h4>Meta Tags Globales</h4>
        
        <div class="form-group">
          <label for="meta-title">Título por defecto (Meta Title)</label>
          <input 
            type="text" 
            id="meta-title" 
            v-model="seoConfig.defaultTitle"
            class="form-input"
            placeholder="R-Integra - Solidez contable, proyección empresarial"
            maxlength="60"
          >
          <small class="form-help">
            Recomendado: 50-60 caracteres. Actual: {{ seoConfig.defaultTitle.length }}
          </small>
        </div>

        <div class="form-group">
          <label for="meta-description">Descripción por defecto (Meta Description)</label>
          <textarea 
            id="meta-description" 
            v-model="seoConfig.defaultDescription"
            class="form-textarea"
            placeholder="Servicios contables y de asesoría empresarial profesional..."
            maxlength="160"
            rows="3"
          ></textarea>
          <small class="form-help">
            Recomendado: 150-160 caracteres. Actual: {{ seoConfig.defaultDescription.length }}
          </small>
        </div>

        <div class="form-group">
          <label for="meta-keywords">Palabras clave (Keywords)</label>
          <input 
            type="text" 
            id="meta-keywords" 
            v-model="seoConfig.keywords"
            class="form-input"
            placeholder="contabilidad, asesoría empresarial, consultoría financiera"
          >
          <small class="form-help">
            Separa las palabras clave con comas
          </small>
        </div>
      </div>

      <div class="form-section">
        <h4>Open Graph (Redes Sociales)</h4>
        
        <div class="form-row">
          <div class="form-group">
            <label for="og-title">Título para redes sociales</label>
            <input 
              type="text" 
              id="og-title" 
              v-model="seoConfig.openGraph.title"
              class="form-input"
              placeholder="R-Integra - Servicios Contables"
            >
          </div>

          <div class="form-group">
            <label for="og-type">Tipo de contenido</label>
            <select id="og-type" v-model="seoConfig.openGraph.type" class="form-select">
              <option value="website">Sitio Web</option>
              <option value="business.business">Negocio</option>
              <option value="article">Artículo</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="og-description">Descripción para redes sociales</label>
          <textarea 
            id="og-description" 
            v-model="seoConfig.openGraph.description"
            class="form-textarea"
            placeholder="Descripción optimizada para redes sociales"
            rows="3"
          ></textarea>
        </div>

        <div class="form-group">
          <label>Imagen por defecto para redes sociales</label>
          <div class="media-selector">
            <div v-if="ogImagePreview" class="selected-media">
              <img :src="ogImagePreview" class="media-preview" alt="OG Image">
              <button @click="removeOgImage" class="btn-remove" type="button">
                <i class="fas fa-times"></i>
              </button>
            </div>
            <div v-else class="media-placeholder">
              <i class="fas fa-image"></i>
              <p>No hay imagen seleccionada</p>
            </div>
            <button @click="openOgImagePicker" class="btn-media" type="button">
              <i class="fas fa-image"></i>
              Seleccionar imagen
            </button>
          </div>
          <small class="form-help">
            Recomendado: 1200x630px para mejor visualización en redes sociales
          </small>
        </div>
      </div>

      <div class="form-section">
        <h4>Configuración Técnica</h4>
        
        <div class="form-row">
          <div class="form-group">
            <label for="robots">Robots Meta Tag</label>
            <select id="robots" v-model="seoConfig.robots" class="form-select">
              <option value="index, follow">Indexar y seguir enlaces</option>
              <option value="index, nofollow">Indexar pero no seguir enlaces</option>
              <option value="noindex, follow">No indexar pero seguir enlaces</option>
              <option value="noindex, nofollow">No indexar ni seguir enlaces</option>
            </select>
          </div>

          <div class="form-group">
            <label for="canonical">URL Canónica base</label>
            <input 
              type="url" 
              id="canonical" 
              v-model="seoConfig.canonicalUrl"
              class="form-input"
              placeholder="https://www.r-integra.com"
            >
          </div>
        </div>

      </div>

      <div class="form-section">
        <h4>Schema.org (Datos Estructurados)</h4>
        
        <div class="form-row">
          <div class="form-group">
            <label for="business-name">Nombre del negocio</label>
            <input 
              type="text" 
              id="business-name" 
              v-model="seoConfig.schema.businessName"
              class="form-input"
              placeholder="R-Integra"
            >
          </div>

          <div class="form-group">
            <label for="business-type">Tipo de negocio</label>
            <select id="business-type" v-model="seoConfig.schema.businessType" class="form-select">
              <option value="ProfessionalService">Servicio Profesional</option>
              <option value="AccountingService">Servicio Contable</option>
              <option value="FinancialService">Servicio Financiero</option>
              <option value="ConsultingService">Servicio de Consultoría</option>
            </select>
          </div>
        </div>
      </div>

      <div class="form-actions">
        <button @click="saveConfig" class="btn-primary" :disabled="saving">
          <i class="fas fa-save"></i>
          {{ saving ? 'Guardando...' : 'Guardar Configuración SEO' }}
        </button>
        <button @click="resetConfig" class="btn-secondary" type="button">
          <i class="fas fa-undo"></i>
          Restaurar Defaults
        </button>
      </div>
    </div>

    <!-- MediaPicker Modal -->
    <MediaPicker
      :show="showMediaPicker"
      :selected-media="selectedMedia"
      :type-filter="'image'"
      :multiple="false"
      @close="closeMediaPicker"
      @select="onOgImageSelected"
    />
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue'
import { configsApi } from '@/services/api'
import MediaPicker from './MediaPicker.vue'
import { useMediaPicker } from '@/composables/useMediaPicker'

const saving = ref(false)

// Media picker composable
const { 
  showMediaPicker, 
  selectedMedia, 
  openMediaPicker, 
  closeMediaPicker, 
  getFullMediaUrl 
} = useMediaPicker()

const seoConfig = ref({
  defaultTitle: 'R-Integra - Solidez contable, proyección empresarial',
  defaultDescription: '',
  keywords: '',
  robots: 'index, follow',
  canonicalUrl: '',
  openGraph: {
    title: '',
    description: '',
    type: 'website',
    image: ''
  },
  schema: {
    businessName: 'R-Integra',
    businessType: 'AccountingService'
  }
})

const ogImagePreview = computed(() => seoConfig.value.openGraph.image)

const openOgImagePicker = () => {
  openMediaPicker({
    typeFilter: 'image',
    multiple: false,
    onSelect: onOgImageSelected
  })
}

const onOgImageSelected = (media: any) => {
  seoConfig.value.openGraph.image = getFullMediaUrl(media)
  closeMediaPicker()
}

const removeOgImage = () => {
  seoConfig.value.openGraph.image = ''
}

const saveConfig = async () => {
  saving.value = true
  try {
    await configsApi.save('seo', seoConfig.value, 'Configuración SEO actualizada')
    alert('Configuración SEO guardada exitosamente')
  } catch (error) {
    console.error('Error al guardar la configuración SEO:', error)
    alert('Error al guardar la configuración SEO')
  } finally {
    saving.value = false
  }
}

const resetConfig = () => {
  seoConfig.value = {
    defaultTitle: 'R-Integra - Solidez contable, proyección empresarial',
    defaultDescription: '',
    keywords: '',
    robots: 'index, follow',
    canonicalUrl: '',
    openGraph: {
      title: '',
      description: '',
      type: 'website',
      image: ''
    },
    schema: {
      businessName: 'R-Integra',
      businessType: 'AccountingService'
    }
  }
}

const loadConfig = async () => {
  try {
    const response = await configsApi.getActive('seo')
    if (response.data?.data?.config_data) {
      seoConfig.value = { ...seoConfig.value, ...response.data.data.config_data }
    }
  } catch (error) {
    console.error('Error al cargar configuración SEO:', error)
  }
}

onMounted(() => {
  loadConfig()
})
</script>

<style scoped>
.seo-settings {
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
  margin-bottom: 2rem;
  padding-bottom: 2rem;
  border-bottom: 1px solid #dee2e6;
}

.form-section:last-child {
  border-bottom: none;
  margin-bottom: 0;
  padding-bottom: 0;
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

.form-group {
  display: flex;
  flex-direction: column;
  margin-bottom: 1.5rem;
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
}

.form-help {
  display: block;
  margin-top: 0.5rem;
  font-size: 0.8rem;
  color: #6c757d;
  font-style: italic;
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

.form-actions {
  margin-top: 3rem;
  padding-top: 2rem;
  border-top: 1px solid #dee2e6;
  display: flex;
  gap: 1rem;
  justify-content: flex-end;
}

.btn-primary,
.btn-secondary,
.btn-info {
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

.btn-info {
  background: #17a2b8;
  color: white;
}

.btn-info:hover {
  background: #138496;
  transform: translateY(-1px);
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