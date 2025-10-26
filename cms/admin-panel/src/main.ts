import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { createHead } from '@vueuse/head'

import App from './App.vue'
import router from './router'
import { useAuthStore } from '@/stores/auth'
import Icon from '@/components/global/Icon.vue'

// FontAwesome
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

// Importar exactamente los 10 iconos del IconPicker
import { 
  faEnvelope, 
  faPhone, 
  faMapMarkerAlt, 
  faGlobe, 
  faClock
} from '@fortawesome/free-solid-svg-icons'

import { 
  faFacebookF, 
  faInstagram, 
  faTwitter, 
  faLinkedinIn, 
  faWhatsapp
} from '@fortawesome/free-brands-svg-icons'

// Agregar iconos a la librería
library.add(
  // Solid icons (contacto)
  faEnvelope, 
  faPhone, 
  faMapMarkerAlt, 
  faGlobe, 
  faClock,
  // Brand icons (redes sociales)
  faFacebookF, 
  faInstagram, 
  faTwitter, 
  faLinkedinIn, 
  faWhatsapp
)

const app = createApp(App)
const pinia = createPinia()
const head = createHead()

app.use(pinia)
app.use(router)
app.use(head)

// Registrar componentes globalmente
app.component('Icon', Icon)
app.component('FontAwesomeIcon', FontAwesomeIcon)

app.mount('#app')

// Inicializar autenticación después de montar
const authStore = useAuthStore()
authStore.initializeAuth()

// Emitir evento para pre-renderizado después de que Vue esté listo
router.isReady().then(() => {
  // Pequeño delay para asegurar que todo está renderizado
  setTimeout(() => {
    document.dispatchEvent(new Event('app-rendered'))
  }, 100)
})
