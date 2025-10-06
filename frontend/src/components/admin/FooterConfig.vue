<template>
  <div class="footer-config">
    <div class="config-section">
      <h3>Configuración del Footer</h3>
      <p class="section-desc">Personaliza el contenido y apariencia del footer de tu sitio web</p>
    </div>

    <div class="config-form">
      <!-- Color de fondo -->
      <div class="form-section">
        <h4>Apariencia General</h4>
        <div class="form-row">
          <div class="form-group">
            <label for="bg-color">Color de fondo</label>
            <div class="color-input-group">
              <input 
                type="color" 
                id="bg-color" 
                v-model="footerConfig.backgroundColor"
                class="color-picker"
              >
              <input 
                type="text" 
                v-model="footerConfig.backgroundColor" 
                class="color-text"
                placeholder="#17a2b8"
              >
            </div>
          </div>
        </div>
      </div>

      <!-- Sección CTA -->
      <div class="form-section">
        <h4>Sección ¿Hablamos?</h4>
        <div class="form-row">
          <div class="form-group">
            <label for="cta-title">Título principal</label>
            <input 
              type="text" 
              id="cta-title" 
              v-model="footerConfig.ctaTitle" 
              class="form-input"
              placeholder="¿Hablamos?"
            >
          </div>
        </div>
        <div class="form-group">
          <label>Descripción CTA</label>
          <div class="editor-container">
            <editor-content :editor="ctaEditor" />
          </div>
        </div>
      </div>

      <!-- Formulario de Contacto -->
      <div class="form-section">
        <h4>Formulario de Contacto</h4>
        <div class="form-row">
          <div class="form-group">
            <label for="label-name">Label Nombre</label>
            <input 
              type="text" 
              id="label-name" 
              v-model="footerConfig.formLabels.fullName" 
              class="form-input"
            >
          </div>
          <div class="form-group">
            <label for="label-phone">Label Teléfono</label>
            <input 
              type="text" 
              id="label-phone" 
              v-model="footerConfig.formLabels.phone" 
              class="form-input"
            >
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="label-email">Label Email</label>
            <input 
              type="text" 
              id="label-email" 
              v-model="footerConfig.formLabels.email" 
              class="form-input"
            >
          </div>
          <div class="form-group">
            <label for="label-message">Label Mensaje</label>
            <input 
              type="text" 
              id="label-message" 
              v-model="footerConfig.formLabels.message" 
              class="form-input"
            >
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="accept-policy">Texto políticas</label>
            <input 
              type="text" 
              id="accept-policy" 
              v-model="footerConfig.formLabels.acceptPolicy" 
              class="form-input"
            >
          </div>
          <div class="form-group">
            <label for="privacy-link">Texto enlace privacidad</label>
            <input 
              type="text" 
              id="privacy-link" 
              v-model="footerConfig.formLabels.privacyPolicyLink" 
              class="form-input"
            >
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="privacy-url">URL políticas de privacidad</label>
            <input 
              type="url" 
              id="privacy-url" 
              v-model="footerConfig.privacyPolicyUrl" 
              class="form-input"
            >
          </div>
          <div class="form-group">
            <label for="submit-btn">Texto botón enviar</label>
            <input 
              type="text" 
              id="submit-btn" 
              v-model="footerConfig.formLabels.submitButton" 
              class="form-input"
            >
          </div>
        </div>
      </div>

      <!-- Logo -->
      <div class="form-section">
        <h4>Logo</h4>
        <div class="form-group">
          <label for="logo-upload">Logo del footer</label>
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

      <!-- Información de Contacto -->
      <div class="form-section">
        <h4>Información de Contacto</h4>
        <div class="form-group">
          <label for="location-title">Título sección</label>
          <input 
            type="text" 
            id="location-title" 
            v-model="footerConfig.locationTitle" 
            class="form-input"
          >
        </div>
        
        <div class="contact-items">
          <div v-for="(contact, index) in footerConfig.contactInfo" :key="index" class="contact-item-config">
            <div class="contact-item-header">
              <h5>Contacto {{ index + 1 }}</h5>
              <button @click="removeContactItem(index)" class="btn-remove-small" type="button">
                <Icon name="delete" />
              </button>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label>Icono</label>
                <IconPicker v-model="contact.icon" />
              </div>
              <div class="form-group">
                <label>Texto</label>
                <input 
                  type="text" 
                  v-model="contact.text" 
                  class="form-input"
                >
              </div>
            </div>
          </div>
          
          <button @click="addContactItem" class="btn-add" type="button">
            <Icon name="plus" />
            Agregar información de contacto
          </button>
        </div>
      </div>

      <!-- Redes Sociales -->
      <div class="form-section">
        <h4>Redes Sociales</h4>
        <div class="form-group">
          <label for="social-title">Título sección</label>
          <input 
            type="text" 
            id="social-title" 
            v-model="footerConfig.socialTitle" 
            class="form-input"
          >
        </div>
        
        <div class="social-items">
          <div v-for="(social, index) in footerConfig.socialLinks" :key="index" class="social-item-config">
            <div class="social-item-header">
              <h5>{{ social.name }}</h5>
              <button @click="removeSocialItem(index)" class="btn-remove-small" type="button">
                <Icon name="delete" />
              </button>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label>Icono de Red Social</label>
                <IconPicker v-model="social.icon" @update:modelValue="updateSocialName(index)" />
              </div>
              <div class="form-group">
                <label>URL</label>
                <input 
                  type="url" 
                  v-model="social.url" 
                  class="form-input"
                  placeholder="https://..."
                >
              </div>
            </div>
          </div>
          
          <button @click="addSocialItem" class="btn-add" type="button">
            <Icon name="plus" />
            Agregar red social
          </button>
        </div>
      </div>

      <div class="form-actions">
        <button @click="previewChanges" class="btn-info" type="button">
          <Icon name="eye" />
          Vista Previa
        </button>
        <button @click="saveConfig" class="btn-primary" :disabled="saving">
          <Icon name="save" />
          {{ saving ? 'Guardando...' : 'Guardar Cambios' }}
        </button>
        <button @click="resetConfig" class="btn-secondary" type="button">
          <Icon name="undo" />
          Restaurar Default
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
import { ref, onMounted, onBeforeUnmount } from 'vue'
import { useEditor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import { configsApi } from '@/services/api'
import MediaPicker from './MediaPicker.vue'
import { useMediaPicker } from '@/composables/useMediaPicker'
import IconPicker from '@/components/ui/IconPicker.vue'

const saving = ref(false)
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

const footerConfig = ref({
  backgroundColor: '#17a2b8',
  ctaTitle: '¿Hablamos?',
  ctaDescription: 'Si necesitas estructurar tus finanzas o resolver dudas contables y tributarias, agenda una cita o déjanos tu mensaje.',
  logoUrl: '',
  locationTitle: 'Ubicación',
  socialTitle: 'Síguenos en',
  privacyPolicyUrl: '/privacy-policy',
  formLabels: {
    fullName: 'Nombre completo',
    phone: 'Teléfono',
    email: 'Correo electrónico',
    message: 'Mensaje',
    acceptPolicy: 'Acepto las políticas de tratamiento de datos',
    privacyPolicyLink: 'Políticas de Privacidad',
    submitButton: 'Enviar'
  },
  contactInfo: [
    {
      icon: 'map-marker-alt',
      text: 'Cra 14 #18-50, Cali, Valle del Cauca'
    },
    {
      icon: 'phone',
      text: '+57 320 8994424'
    },
    {
      icon: 'envelope',
      text: 'contacto@r-integra.com'
    }
  ],
  socialLinks: [
    {
      name: 'Instagram',
      icon: 'instagram',
      url: '#'
    },
    {
      name: 'Facebook',
      icon: 'facebook-f',
      url: '#'
    },
    {
      name: 'LinkedIn',
      icon: 'linkedin-in',
      url: '#'
    }
  ]
})

const ctaEditor = useEditor({
  content: footerConfig.value.ctaDescription,
  extensions: [StarterKit],
  editorProps: {
    attributes: {
      class: 'prose prose-sm focus:outline-none min-h-[100px] p-3'
    }
  }
})


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
  footerConfig.value.logoUrl = getFullMediaUrl(media)
  closeMediaPicker()
}

const handleLogoUpload = (event) => {
  const file = event.target.files[0]
  if (file) {
    const reader = new FileReader()
    reader.onload = (e) => {
      logoPreview.value = e.target.result
      footerConfig.value.logoUrl = e.target.result
    }
    reader.readAsDataURL(file)
  }
}

const removeLogo = () => {
  logoPreview.value = ''
  footerConfig.value.logoUrl = ''
  logoMedia.value = null
  document.getElementById('logo-upload').value = ''
}

const addContactItem = () => {
  footerConfig.value.contactInfo.push({
    icon: 'phone',
    text: 'Nuevo contacto'
  })
}

const removeContactItem = (index) => {
  footerConfig.value.contactInfo.splice(index, 1)
}

const addSocialItem = () => {
  footerConfig.value.socialLinks.push({
    name: 'Nueva red',
    icon: 'instagram',
    url: '#'
  })
}

const removeSocialItem = (index) => {
  footerConfig.value.socialLinks.splice(index, 1)
}

const updateSocialName = (index) => {
  const iconToName = {
    'instagram': 'Instagram',
    'facebook-f': 'Facebook',
    'linkedin-in': 'LinkedIn',
    'twitter': 'Twitter',
    'whatsapp': 'WhatsApp',
    'globe': 'Sitio Web',
    'envelope': 'Email',
    'phone': 'Teléfono',
    'map-marker-alt': 'Ubicación',
    'clock': 'Horario'
  }
  const icon = footerConfig.value.socialLinks[index].icon
  footerConfig.value.socialLinks[index].name = iconToName[icon] || 'Red Social'
}

const previewChanges = () => {
  const configToPreview = {
    ...footerConfig.value,
    ctaDescription: ctaEditor.value?.getHTML() || footerConfig.value.ctaDescription
  }
  
  window.dispatchEvent(new CustomEvent('footerConfigChanged', { 
    detail: configToPreview 
  }))
}

const saveConfig = async () => {
  saving.value = true
  try {
    const configToSave = {
      ...footerConfig.value,
      ctaDescription: ctaEditor.value?.getHTML() || footerConfig.value.ctaDescription
    }
    
    // Guardar solo en backend API
    await configsApi.save('footer', configToSave, 'Configuración del footer actualizada')
    
    window.dispatchEvent(new CustomEvent('footerConfigChanged', { 
      detail: configToSave 
    }))
    
    alert('Configuración del footer guardada exitosamente')
  } catch (error) {
    console.error('Error al guardar la configuración del footer:', error)
    alert('Error al guardar la configuración del footer')
  } finally {
    saving.value = false
  }
}

const resetConfig = () => {
  footerConfig.value = {
    backgroundColor: '#17a2b8',
    ctaTitle: '¿Hablamos?',
    ctaDescription: 'Si necesitas estructurar tus finanzas o resolver dudas contables y tributarias, agenda una cita o déjanos tu mensaje.',
    logoUrl: '',
    locationTitle: 'Ubicación',
    socialTitle: 'Síguenos en',
    privacyPolicyUrl: '/privacy-policy',
    formLabels: {
      fullName: 'Nombre completo',
      phone: 'Teléfono',
      email: 'Correo electrónico',
      message: 'Mensaje',
      acceptPolicy: 'Acepto las políticas de tratamiento de datos',
      privacyPolicyLink: 'Políticas de Privacidad',
      submitButton: 'Enviar'
    },
    contactInfo: [
      {
        icon: 'map-marker-alt',
        text: 'Cra 14 #18-50, Cali, Valle del Cauca'
      },
      {
        icon: 'phone',
        text: '+57 320 8994424'
      },
      {
        icon: 'envelope',
        text: 'contacto@r-integra.com'
      }
    ],
    socialLinks: [
      {
        name: 'Instagram',
        icon: 'instagram',
        url: '#'
      },
      {
        name: 'Facebook',
        icon: 'facebook-f',
        url: '#'
      },
      {
        name: 'LinkedIn',
        icon: 'linkedin-in',
        url: '#'
      }
    ]
  }
  
  ctaEditor.value?.commands.setContent(footerConfig.value.ctaDescription)
  removeLogo()
}


const loadConfig = async () => {
  try {
    console.log('🔍 FooterConfig: Cargando configuración desde API...')
    const response = await configsApi.getActive('footer')
    console.log('📰 FooterConfig: Respuesta de API:', response.data)
    
    if (response.data && response.data.data && response.data.data.config_data) {
      const config = response.data.data.config_data
      console.log('⚙️ FooterConfig: Configuración recibida:', config)
      console.log('🎨 FooterConfig: Color de fondo anterior:', footerConfig.value.backgroundColor)
      
      footerConfig.value = { ...footerConfig.value, ...config }
      
      console.log('🎨 FooterConfig: Color de fondo después:', footerConfig.value.backgroundColor)
      
      if (config.logoUrl) {
        logoPreview.value = config.logoUrl
      }
      if (config.ctaDescription) {
        ctaEditor.value?.commands.setContent(config.ctaDescription)
      }
      
      console.log('✅ FooterConfig: Configuración cargada exitosamente')
    } else {
      console.log('⚠️ FooterConfig: No hay configuración activa en la respuesta')
    }
  } catch (error) {
    console.error('❌ FooterConfig: Error al cargar configuración:', error)
  }
}

onMounted(async () => {
  await loadConfig()
})

onBeforeUnmount(() => {
  if (ctaEditor.value) {
    ctaEditor.value.destroy()
  }
})
</script>

<style scoped>
.footer-config {
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

.form-group {
  margin-bottom: 2rem;
}

.form-section {
  margin-bottom: 3rem;
  padding-bottom: 2rem;
  border-bottom: 1px solid #e9ecef;
}

.form-section:last-of-type {
  border-bottom: none;
}

.form-section h4 {
  color: #2c3e50;
  margin: 0 0 1.5rem 0;
  font-size: 1.2rem;
  font-weight: 600;
  font-family: 'Lato', sans-serif;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.5rem;
  margin-bottom: 1rem;
}

.form-group {
  margin-bottom: 1rem;
}

.form-group label {
  display: block;
  font-weight: 600;
  color: #2c3e50;
  margin-bottom: 0.5rem;
  font-family: 'Lato', sans-serif;
  font-size: 0.9rem;
}

.form-input, .form-select {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #dee2e6;
  border-radius: 6px;
  font-size: 0.95rem;
  transition: border-color 0.3s ease;
}

.form-input:focus, .form-select:focus {
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

.editor-container {
  border: 1px solid #dee2e6;
  border-radius: 8px;
  overflow: hidden;
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

.contact-items, .social-items {
  margin-top: 1rem;
}

.contact-item-config, .social-item-config {
  background: #f8f9fa;
  border: 1px solid #dee2e6;
  border-radius: 8px;
  padding: 1.5rem;
  margin-bottom: 1rem;
}

.contact-item-header, .social-item-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.contact-item-header h5, .social-item-header h5 {
  margin: 0;
  color: #2c3e50;
  font-size: 1rem;
  font-weight: 600;
}

.btn-remove-small {
  background: #dc3545;
  color: white;
  border: none;
  padding: 0.25rem 0.5rem;
  border-radius: 4px;
  cursor: pointer;
  font-size: 0.75rem;
}

.btn-remove-small:hover {
  background: #c82333;
}


.btn-add {
  background: #28a745;
  color: white;
  border: none;
  padding: 0.75rem 1.5rem;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.875rem;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  transition: background-color 0.3s ease;
  margin-top: 1rem;
}

.btn-add:hover {
  background: #218838;
}

.form-actions {
  display: flex;
  gap: 1rem;
  justify-content: flex-end;
}

.btn-primary, .btn-secondary, .btn-info, .btn-warning {
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

.btn-warning {
  background-color: #ffc107;
  color: #212529;
}

.btn-warning:hover {
  background-color: #e0a800;
}

:deep(.ProseMirror) {
  outline: none;
  padding: 1rem;
  min-height: 200px;
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

@media (max-width: 768px) {
  .config-form {
    padding: 1rem;
  }
  
  .form-row {
    grid-template-columns: 1fr;
    gap: 1rem;
  }
  
  .form-actions {
    flex-direction: column;
  }
  
  .form-actions button {
    width: 100%;
    justify-content: center;
  }
  
  .contact-item-config, .social-item-config {
    padding: 1rem;
  }
}
</style>