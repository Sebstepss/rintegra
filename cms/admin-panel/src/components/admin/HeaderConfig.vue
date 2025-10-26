<template>
  <div class="header-config">
    <div class="config-section">
      <h3>Configuración del Header</h3>
      <p class="section-desc">Personaliza la apariencia y contenido del header de tu sitio web</p>
    </div>

    <div class="config-form">
      <div class="form-row">
        <div class="form-group">
          <label for="logo-upload">Logo del sitio</label>
          <div class="logo-upload-area">
            <div v-if="logoPreview" class="logo-preview">
              <img :src="logoPreview" alt="Logo preview" />
              <button @click="removeLogo" class="btn-remove" type="button">
                <Icon name="close" />
              </button>
            </div>
            <div v-else class="upload-placeholder">
              <Icon name="photo" />
              <p>Sube tu logo</p>
            </div>
            <input 
              type="file" 
              id="logo-upload" 
              @change="handleLogoUpload" 
              accept="image/*"
              class="file-input"
            >
            <div class="upload-buttons">
              <button @click="openLogoMediaPicker" class="btn-upload" type="button">
                <Icon name="photo" />
                Seleccionar desde Medios
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="bg-normal">Color de fondo normal</label>
          <div class="color-input-group">
            <input 
              type="color" 
              id="bg-normal" 
              v-model="headerConfig.backgroundNormal"
              class="color-picker"
            >
            <input 
              type="text" 
              v-model="headerConfig.backgroundNormal" 
              class="color-text"
              placeholder="#ffffff"
            >
          </div>
        </div>

        <div class="form-group">
          <label for="bg-sticky">Color de fondo sticky</label>
          <div class="color-input-group">
            <input 
              type="color" 
              id="bg-sticky" 
              v-model="headerConfig.backgroundSticky"
              class="color-picker"
            >
            <input 
              type="text" 
              v-model="headerConfig.backgroundSticky" 
              class="color-text"
              placeholder="#0a5a39"
            >
          </div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="text-color">Color del texto de navegación</label>
          <div class="color-input-group">
            <input 
              type="color" 
              id="text-color" 
              v-model="headerConfig.textColor"
              class="color-picker"
            >
            <input 
              type="text" 
              v-model="headerConfig.textColor" 
              class="color-text"
              placeholder="#ffffff"
            >
          </div>
        </div>

        <div class="form-group">
          <label for="text-hover-color">Color del texto al hacer hover</label>
          <div class="color-input-group">
            <input 
              type="color" 
              id="text-hover-color" 
              v-model="headerConfig.textHoverColor"
              class="color-picker"
            >
            <input 
              type="text" 
              v-model="headerConfig.textHoverColor" 
              class="color-text"
              placeholder="#ffffff"
            >
          </div>
        </div>
      </div>

      <div class="preview-section">
        <h4>Vista previa</h4>
        <div class="header-preview">
          <div class="preview-header normal" :style="previewNormalStyles">
            <div class="preview-nav">
              <div class="preview-logo">
                <img v-if="logoPreview" :src="logoPreview" alt="Logo">
                <span v-else>Logo</span>
              </div>
              <div class="preview-menu">
                <span>Inicio</span>
                <span>Nosotros</span>
                <span>Servicios</span>
                <span>Contacto</span>
              </div>
            </div>
          </div>
          <div class="preview-label">Estado normal</div>
          
          <div class="preview-header sticky" :style="previewStickyStyles">
            <div class="preview-nav">
              <div class="preview-logo">
                <img v-if="logoPreview" :src="logoPreview" alt="Logo">
                <span v-else>Logo</span>
              </div>
              <div class="preview-menu">
                <span>Inicio</span>
                <span>Nosotros</span>
                <span>Servicios</span>
                <span>Contacto</span>
              </div>
            </div>
          </div>
          <div class="preview-label">Estado sticky</div>
        </div>
      </div>

      <div class="form-actions">
        <button @click="previewChanges" class="btn-info" type="button">
          <Icon name="eye" />
          Vista Previa Inmediata
        </button>
        <button @click="saveConfig" class="btn-primary" :disabled="saving">
          <Icon name="save" />
          {{ saving ? 'Guardando...' : 'Guardar Cambios' }}
        </button>
        <button @click="resetConfig" class="btn-secondary" type="button">
          <Icon name="undo" />
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
      @select="onLogoMediaSelected"
    />
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { configsApi } from '@/services/api'
import MediaPicker from './MediaPicker.vue'
import { useMediaPicker } from '@/composables/useMediaPicker'

const saving = ref(false)
const logoFile = ref(null)
const logoPreview = ref('')
const logoMedia = ref(null)

// Media picker composable
const { 
  showMediaPicker, 
  selectedMedia, 
  openMediaPicker, 
  closeMediaPicker, 
  getFullMediaUrl 
} = useMediaPicker()

const headerConfig = ref({
  logoUrl: '',
  backgroundNormal: 'transparent',
  backgroundSticky: '#0a5a39',
  textColor: '#ffffff',
  textHoverColor: '#ffffff'
})

const previewNormalStyles = computed(() => ({
  backgroundColor: headerConfig.value.backgroundNormal,
  color: headerConfig.value.textColor
}))

const previewStickyStyles = computed(() => ({
  backgroundColor: headerConfig.value.backgroundSticky,
  color: headerConfig.value.textColor
}))

const triggerFileInput = () => {
  document.getElementById('logo-upload').click()
}

const openLogoMediaPicker = () => {
  openMediaPicker({
    typeFilter: 'image',
    multiple: false,
    onSelect: onLogoMediaSelected
  })
}

const onLogoMediaSelected = (media) => {
  logoMedia.value = media
  logoPreview.value = getFullMediaUrl(media)
  headerConfig.value.logoUrl = getFullMediaUrl(media)
  closeMediaPicker()
}

const handleLogoUpload = (event) => {
  const file = event.target.files[0]
  if (file) {
    logoFile.value = file
    const reader = new FileReader()
    reader.onload = (e) => {
      logoPreview.value = e.target.result
    }
    reader.readAsDataURL(file)
  }
}

const removeLogo = () => {
  logoFile.value = null
  logoPreview.value = ''
  headerConfig.value.logoUrl = ''
  document.getElementById('logo-upload').value = ''
}

const previewChanges = () => {
  const configToPreview = {
    ...headerConfig.value,
    logoUrl: logoPreview.value
  }
  
  // Disparar evento personalizado para vista previa inmediata
  window.dispatchEvent(new CustomEvent('headerConfigChanged', { 
    detail: configToPreview 
  }))
}

const saveConfig = async () => {
  saving.value = true
  try {
    const configToSave = {
      ...headerConfig.value,
      logoUrl: logoPreview.value
    }
    
    // Guardar solo en backend API
    await configsApi.save('header', configToSave, 'Configuración del header actualizada')
    
    // Disparar evento personalizado para notificar cambios
    window.dispatchEvent(new CustomEvent('headerConfigChanged', { 
      detail: configToSave 
    }))
    
    alert('Configuración guardada exitosamente')
  } catch (error) {
    console.error('Error al guardar la configuración:', error)
    alert('Error al guardar la configuración')
  } finally {
    saving.value = false
  }
}

const resetConfig = () => {
  headerConfig.value = {
    logoUrl: '',
    backgroundNormal: 'transparent',
    backgroundSticky: '#0a5a39',
    textColor: '#ffffff',
    textHoverColor: '#ffffff'
  }
  removeLogo()
}

const loadConfig = async () => {
  try {
    console.log('🔍 HeaderConfig: Cargando configuración desde API...')
    const response = await configsApi.getActive('header')
    console.log('📰 HeaderConfig: Respuesta de API:', response.data)
    
    if (response.data && response.data.data && response.data.data.config_data) {
      const config = response.data.data.config_data
      console.log('⚙️ HeaderConfig: Configuración recibida:', config)
      console.log('🎨 HeaderConfig: Colores anteriores:', {
        backgroundNormal: headerConfig.value.backgroundNormal,
        backgroundSticky: headerConfig.value.backgroundSticky
      })
      
      headerConfig.value = { ...headerConfig.value, ...config }
      
      console.log('🎨 HeaderConfig: Colores después:', {
        backgroundNormal: headerConfig.value.backgroundNormal,
        backgroundSticky: headerConfig.value.backgroundSticky
      })
      
      if (config.logoUrl) {
        logoPreview.value = config.logoUrl
      }
      
      console.log('✅ HeaderConfig: Configuración cargada exitosamente')
    } else {
      console.log('⚠️ HeaderConfig: No hay configuración activa en la respuesta')
    }
  } catch (error) {
    console.error('❌ HeaderConfig: Error al cargar configuración:', error)
  }
}

onMounted(async () => {
  await loadConfig()
})
</script>

<style scoped>
.header-config {
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
  background: white;
  border-radius: 12px;
  padding: 2rem;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2rem;
  margin-bottom: 2rem;
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
  font-family: 'Lato', sans-serif;
}

.logo-upload-area {
  border: 2px dashed #dee2e6;
  border-radius: 8px;
  padding: 2rem;
  text-align: center;
  position: relative;
  transition: border-color 0.3s ease;
}

.logo-upload-area:hover {
  border-color: #007bff;
}

.logo-preview {
  position: relative;
  display: inline-block;
  margin-bottom: 1rem;
}

.logo-preview img {
  max-width: 150px;
  max-height: 80px;
  object-fit: contain;
  border-radius: 4px;
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

.upload-placeholder {
  color: #6c757d;
  margin-bottom: 1rem;
}

.upload-placeholder i {
  font-size: 2rem;
  margin-bottom: 0.5rem;
  display: block;
}

.file-input {
  display: none;
}

.btn-upload {
  background: #007bff;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.875rem;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  transition: background-color 0.3s ease;
}

.btn-upload:hover {
  background: #0056b3;
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

.preview-section {
  margin-top: 3rem;
  padding-top: 2rem;
  border-top: 1px solid #e9ecef;
}

.preview-section h4 {
  color: #2c3e50;
  margin: 0 0 1.5rem 0;
  font-family: 'Lato', sans-serif;
}

.header-preview {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.preview-header {
  border-radius: 8px;
  padding: 1rem 2rem;
  transition: all 0.3s ease;
}

.preview-nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.preview-logo img {
  height: 30px;
  object-fit: contain;
}

.preview-logo span {
  font-weight: 700;
  font-size: 1.2rem;
}

.preview-menu {
  display: flex;
  gap: 1.5rem;
}

.preview-menu span {
  font-weight: 500;
  cursor: pointer;
  transition: opacity 0.3s ease;
}

.preview-menu span:hover {
  opacity: 0.8;
}

.preview-label {
  text-align: center;
  font-size: 0.875rem;
  color: #6c757d;
  font-style: italic;
}

.form-actions {
  margin-top: 3rem;
  padding-top: 2rem;
  border-top: 1px solid #e9ecef;
  display: flex;
  gap: 1rem;
  justify-content: flex-end;
}

.btn-primary, .btn-secondary, .btn-info {
  padding: 0.75rem 1.5rem;
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

.btn-primary {
  background-color: #007bff;
  color: white;
}

.btn-primary:hover:not(:disabled) {
  background-color: #0056b3;
}

.btn-primary:disabled {
  background-color: #6c757d;
  cursor: not-allowed;
}

.btn-secondary {
  background-color: #6c757d;
  color: white;
}

.btn-secondary:hover {
  background-color: #545b62;
}

.btn-info {
  background-color: #17a2b8;
  color: white;
}

.btn-info:hover {
  background-color: #138496;
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