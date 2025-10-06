<template>
  <footer class="footer" :style="footerStyles">
    <div class="footer-container">
      <!-- Sección 1: CTA y Formulario de Contacto -->
      <div class="cta-section">
        <div class="cta-content">
          <div class="cta-text">
            <h1 class="cta-title" v-html="footerConfig.ctaTitle"></h1>
            <p class="cta-description" v-html="footerConfig.ctaDescription"></p>
          </div>
          
          <div class="contact-form-wrapper">
            <form @submit.prevent="submitContactForm" class="contact-form">
              <div class="form-group">
                <input 
                  type="text" 
                  id="fullName" 
                  v-model="contactForm.fullName" 
                  required 
                  class="form-input"
                  :placeholder="footerConfig.formLabels.fullName"
                >
              </div>
              
              <div class="form-group">
                <input 
                  type="tel" 
                  id="phone" 
                  v-model="contactForm.phone" 
                  required 
                  class="form-input"
                  :placeholder="footerConfig.formLabels.phone"
                >
              </div>
              
              <div class="form-group">
                <input 
                  type="email" 
                  id="email" 
                  v-model="contactForm.email" 
                  required 
                  class="form-input"
                  :placeholder="footerConfig.formLabels.email"
                >
              </div>
              
              <div class="form-group">
                <textarea 
                  id="message" 
                  v-model="contactForm.message" 
                  required 
                  class="form-textarea"
                  :placeholder="footerConfig.formLabels.message"
                  rows="3"
                ></textarea>
              </div>
              
              <div class="form-group checkbox-group">
                <label class="checkbox-label">
                  <input 
                    type="checkbox" 
                    v-model="contactForm.acceptPolicy" 
                    required 
                    class="checkbox-input"
                  >
                  <span class="checkbox-text">
                    {{ footerConfig.formLabels.acceptPolicy }}
                    <a :href="footerConfig.privacyPolicyUrl" target="_blank" class="policy-link">
                      {{ footerConfig.formLabels.privacyPolicyLink }}
                    </a>
                  </span>
                </label>
              </div>
              
              <button type="submit" class="submit-btn" :disabled="submitting">
                {{ submitting ? 'Enviando...' : footerConfig.formLabels.submitButton }}
              </button>
            </form>
          </div>
        </div>
      </div>
      
      <!-- Sección 2: Logo, Ubicación y Redes Sociales -->
      <div class="info-section">
        <div class="info-content">
          <!-- Columna 1: Logo -->
          <div class="info-column logo-column">
            <div class="footer-logo">
              <img v-if="footerConfig.logoUrl" :src="footerConfig.logoUrl" alt="Logo" class="logo-image">
              <h3 v-else class="logo-text">RIntegra</h3>
            </div>
          </div>
          
          <!-- Columna 2: Ubicación y Contacto -->
          <div class="info-column contact-column">
            <h2 class="section-title">{{ footerConfig.locationTitle }}</h2>
            <div class="contact-info">
              <div 
                v-for="(contact, index) in footerConfig.contactInfo" 
                :key="index" 
                class="contact-item"
              >
                <FontAwesomeIcon 
                  v-if="isIconFontAwesome(contact.icon)"
                  :icon="getFontAwesomeIconArray(contact.icon)" 
                  class="contact-icon"
                />
                <i v-else :class="contact.icon" class="contact-icon"></i>
                <span class="contact-text" v-html="contact.text"></span>
              </div>
            </div>
          </div>
          
          <!-- Columna 3: Redes Sociales -->
          <div class="info-column social-column">
            <h2 class="section-title">{{ footerConfig.socialTitle }}</h2>
            <div class="social-links">
              <a 
                v-for="(social, index) in footerConfig.socialLinks" 
                :key="index"
                :href="social.url" 
                target="_blank"
                class="social-link" 
                :aria-label="social.name"
              >
                <FontAwesomeIcon 
                  v-if="isIconFontAwesome(social.icon)"
                  :icon="getFontAwesomeIconArray(social.icon)" 
                />
                <i v-else :class="social.icon"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { configsApi, formsApi } from '@/services/api'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

const submitting = ref(false)
const contactForm = ref({
  fullName: '',
  phone: '',
  email: '',
  message: '',
  acceptPolicy: false
})

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

const footerStyles = computed(() => ({
  backgroundColor: footerConfig.value.backgroundColor
}))

// Lista de iconos FontAwesome disponibles
const fontAwesomeIcons = [
  'envelope', 'phone', 'map-marker-alt', 'globe', 'clock',
  'facebook-f', 'instagram', 'twitter', 'linkedin-in', 'whatsapp'
]

// Función para detectar si un icono es de FontAwesome
const isIconFontAwesome = (iconName) => {
  return fontAwesomeIcons.includes(iconName)
}

// Función para obtener el array [prefix, name] para FontAwesome
const getFontAwesomeIconArray = (iconName) => {
  const brandIcons = ['facebook-f', 'instagram', 'twitter', 'linkedin-in', 'whatsapp']
  const prefix = brandIcons.includes(iconName) ? 'fab' : 'fas'
  return [prefix, iconName]
}

const loadFooterConfig = async () => {
  try {
    console.log('🌐 Footer: Cargando configuración desde API...')
    const response = await configsApi.getActive('footer')
    
    if (response.data && response.data.data && response.data.data.config_data) {
      const config = response.data.data.config_data
      console.log('✅ Footer: Configuración cargada desde API:', config)
      footerConfig.value = { ...footerConfig.value, ...config }
    } else {
      console.log('⚠️ Footer: No hay configuración activa, usando valores por defecto')
    }
  } catch (error) {
    console.error('❌ Footer: Error al cargar desde API, usando localStorage como fallback:', error)
    
    // Fallback a localStorage solo en caso de error
    const saved = localStorage.getItem('footerConfig')
    if (saved) {
      try {
        const config = JSON.parse(saved)
        footerConfig.value = { ...footerConfig.value, ...config }
        console.log('💾 Footer: Configuración cargada desde localStorage como fallback')
      } catch (parseError) {
        console.error('Error parsing localStorage config:', parseError)
      }
    }
  }
}

const submitContactForm = async () => {
  submitting.value = true
  try {
    const submitData = {
      name: contactForm.value.fullName,
      phone: contactForm.value.phone,
      email: contactForm.value.email,
      message: contactForm.value.message,
      additional_fields: {
        source: 'Footer Contact Form',
        accepts_policy: contactForm.value.acceptPolicy
      }
    }
    
    const response = await formsApi.submitForm('contact', submitData)
    
    if (response.data) {
      alert('Mensaje enviado correctamente. Te contactaremos pronto.')
      
      // Limpiar formulario
      contactForm.value = {
        fullName: '',
        phone: '',
        email: '',
        message: '',
        acceptPolicy: false
      }
    }
  } catch (error) {
    console.error('Error submitting contact form:', error)
    alert('Error al enviar el mensaje. Inténtalo nuevamente.')
  } finally {
    submitting.value = false
  }
}

// Escuchar cambios de configuración
const handleFooterConfigChange = (event) => {
  if (event.key === 'footerConfig') {
    loadFooterConfig()
  }
}

const handleFooterConfigCustomEvent = (event) => {
  const config = event.detail
  footerConfig.value = { ...footerConfig.value, ...config }
}

onMounted(async () => {
  window.addEventListener('storage', handleFooterConfigChange)
  window.addEventListener('footerConfigChanged', handleFooterConfigCustomEvent)
  await loadFooterConfig()
  
  // Cleanup
  const cleanup = () => {
    window.removeEventListener('storage', handleFooterConfigChange)
    window.removeEventListener('footerConfigChanged', handleFooterConfigCustomEvent)
  }
  
  // Registrar cleanup
  window.addEventListener('beforeunload', cleanup)
})
</script>

<style scoped>
.footer {
  color: white;
  margin-top: auto;
  font-family: 'Lato', sans-serif;
  width: 100%;
}

.footer-container {
  width: 100%;
  margin: 0;
}

/* Sección 1: CTA y Formulario */
.cta-section {
  padding: 4rem 0;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.cta-content {
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 2rem;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 4rem;
  align-items: center;
}

.cta-text {
  max-width: 500px;
}

.cta-title {
  font-size: var(--font-size-h1, 3rem);
  font-weight: var(--font-weight-h1, 700);
  font-family: var(--font-family-h1, var(--base-font-family, 'Lato', sans-serif));
  letter-spacing: var(--letter-spacing-h1, 0px);
  margin: 0 0 1.5rem 0;
  color: white;
  line-height: 1.2;
}

.cta-description {
  font-size: var(--font-size-p, 1.1rem);
  font-family: var(--font-family-p, var(--base-font-family, 'Lato', sans-serif));
  font-weight: var(--font-weight-p, 400);
  letter-spacing: var(--letter-spacing-p, 0px);
  line-height: 1.6;
  margin: 0;
  color: rgba(255, 255, 255, 0.9);
}

.contact-form-wrapper {
  background: rgba(255, 255, 255, 0.1);
  padding: 2rem;
  border-radius: 12px;
  backdrop-filter: blur(10px);
}

.contact-form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.form-group {
  display: flex;
  flex-direction: column;
}

.form-input, .form-textarea {
  padding: 0.65rem;
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 8px;
  background: rgba(255, 255, 255, 0.1);
  color: white;
  font-size: 0.9rem;
  transition: all 0.3s ease;
}

.form-input::placeholder, .form-textarea::placeholder {
  color: rgba(255, 255, 255, 0.6);
}

.form-input:focus, .form-textarea:focus {
  outline: none;
  border-color: rgba(255, 255, 255, 0.5);
  background: rgba(255, 255, 255, 0.15);
}

.form-textarea {
  resize: vertical;
  min-height: 80px;
}

.checkbox-group {
  margin: 0.75rem 0;
}

.checkbox-label {
  display: flex;
  align-items: flex-start;
  gap: 0.5rem;
  cursor: pointer;
  font-size: 0.9rem;
  line-height: 1.4;
}

.checkbox-input {
  margin: 0;
  accent-color: white;
}

.checkbox-text {
  color: rgba(255, 255, 255, 0.9);
}

.policy-link {
  color: white;
  text-decoration: underline;
  font-weight: 600;
}

.policy-link:hover {
  text-decoration: none;
}

.submit-btn {
  background: linear-gradient(135deg, #c0894f, #ffffaa, #fdfab2, #cb9452);
  color: #0c6a44;
  border: none;
  padding: 0.8rem 1.5rem;
  border-radius: 8px;
  font-weight: var(--font-weight-p, 600);
  font-family: var(--font-family-p, var(--base-font-family, 'Lato', sans-serif));
  letter-spacing: var(--letter-spacing-p, 0px);
  font-size: 0.95rem;
  cursor: pointer;
  transition: all 0.3s ease;
  text-transform: uppercase;
  font-weight: bold;
  box-shadow: 0 4px 15px rgba(192, 137, 79, 0.3);
}

.submit-btn:hover:not(:disabled) {
  background: linear-gradient(135deg, #b07a42, #f5f59d, #f0f3a5, #b8854a);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(192, 137, 79, 0.4);
}

.submit-btn:disabled {
  opacity: 0.7;
  cursor: not-allowed;
  transform: none;
}

/* Sección 2: Info */
.info-section {
  padding: 3rem 0;
}

.info-content {
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 2rem;
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  gap: 3rem;
  align-items: start;
}

.info-column {
  display: flex;
  flex-direction: column;
}

/* Columna Logo */
.footer-logo {
  display: flex;
  align-items: center;
  justify-content: center;
}

.logo-image {
  max-height: 200px;
  width: auto;
  object-fit: contain;
}

.logo-text {
  font-size: var(--font-size-h2, 2rem);
  font-weight: var(--font-weight-h2, 700);
  font-family: var(--font-family-h2, var(--base-font-family, 'Lato', sans-serif));
  letter-spacing: var(--letter-spacing-h2, 0px);
  color: white;
  margin: 0;
}

/* Columna Contacto */
.section-title {
  font-size: var(--font-size-h3, 1.5rem);
  font-weight: var(--font-weight-h3, 600);
  font-family: var(--font-family-h3, var(--base-font-family, 'Lato', sans-serif));
  letter-spacing: var(--letter-spacing-h3, 0px);
  margin: 0 0 1.5rem 0;
  color: white;
}

.contact-info {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.contact-item {
  display: flex;
  align-items: center;
  gap: 1rem;
  color: rgba(255, 255, 255, 0.9);
  font-size: 0.95rem;
}

.contact-icon {
  width: 20px;
  text-align: center;
  color: white;
  font-size: 1.1rem;
}

.contact-text {
  font-family: var(--font-family-p, var(--base-font-family, 'Lato', sans-serif));
  font-weight: var(--font-weight-p, 400);
  letter-spacing: var(--letter-spacing-p, 0px);
  line-height: 1.4;
}

/* Columna Redes Sociales */
.social-links {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
}

.social-link {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 50px;
  height: 50px;
  background: rgba(255, 255, 255, 0.1);
  color: white;
  border-radius: 50%;
  text-decoration: none;
  transition: all 0.3s ease;
  font-size: 1.3rem;
}

.social-link:hover {
  background: rgba(255, 255, 255, 0.2);
  transform: translateY(-3px);
}

/* Responsive Design */
@media (max-width: 1024px) {
  .cta-content {
    grid-template-columns: 1fr;
    gap: 2rem;
  }
  
  .cta-title {
    font-size: 2.5rem;
    text-align: center;
  }
  
  .cta-description {
    text-align: center;
  }
}

@media (max-width: 768px) {
  .cta-content, .info-content {
    padding: 0 1rem;
  }
  
  .info-content {
    grid-template-columns: 1fr;
    gap: 2rem;
    text-align: center;
  }
  
  .contact-form-wrapper {
    padding: 1.5rem;
  }
  
  .cta-title {
    font-size: 2rem;
  }
  
  .social-links {
    justify-content: center;
  }
  
  .contact-item {
    justify-content: center;
  }
}

@media (max-width: 480px) {
  .cta-content, .info-content {
    padding: 0 1rem;
  }
  
  .cta-title {
    font-size: 1.8rem;
  }
  
  .contact-form-wrapper {
    padding: 1rem;
  }
  
  .form-input, .form-textarea {
    padding: 0.6rem;
    font-size: 0.9rem;
  }
  
  .submit-btn {
    padding: 0.8rem 1.5rem;
    font-size: 0.95rem;
  }
}
</style>