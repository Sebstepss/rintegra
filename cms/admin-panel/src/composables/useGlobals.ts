import { ref, onMounted } from 'vue'
import { configsApi } from '@/services/api'

interface TypographyConfig {
  fontFamily: string
  fontSize: number
  fontWeight: string
  letterSpacing: number
}

interface ContactInfo {
  icon: string
  text: string
  link: string
}

interface SocialNetwork {
  icon: string
  name: string
  url: string
}

interface GlobalsConfig {
  baseFontFamily: string
  typography: {
    h1: TypographyConfig
    h2: TypographyConfig
    h3: TypographyConfig
    h4: TypographyConfig
    h5: TypographyConfig
    h6: TypographyConfig
    p: TypographyConfig
  }
  colorPalette: string[]
  buttons: {
    outline: {
      borderColor: string
      textColor: string
      borderRadius: number
      borderWidth: number
    }
    flat: {
      backgroundColor: string
      textColor: string
      borderRadius: number
    }
    gradient: {
      color1: string
      color2: string
      color3: string
      textColor: string
      borderRadius: number
    }
  }
  footer?: {
    contactInfo: ContactInfo[]
    socialNetworks: SocialNetwork[]
  }
}

const defaultConfig: GlobalsConfig = {
  baseFontFamily: "'Lato', sans-serif",
  typography: {
    h1: {
      fontFamily: 'inherit',
      fontSize: 48,
      fontWeight: '700',
      letterSpacing: 0
    },
    h2: {
      fontFamily: 'inherit',
      fontSize: 36,
      fontWeight: '600',
      letterSpacing: 0
    },
    h3: {
      fontFamily: 'inherit',
      fontSize: 28,
      fontWeight: '600',
      letterSpacing: 0
    },
    h4: {
      fontFamily: 'inherit',
      fontSize: 24,
      fontWeight: '600',
      letterSpacing: 0
    },
    h5: {
      fontFamily: 'inherit',
      fontSize: 20,
      fontWeight: '600',
      letterSpacing: 0
    },
    h6: {
      fontFamily: 'inherit',
      fontSize: 18,
      fontWeight: '600',
      letterSpacing: 0
    },
    p: {
      fontFamily: 'inherit',
      fontSize: 16,
      fontWeight: '400',
      letterSpacing: 0
    }
  },
  colorPalette: [
    '#007bff',
    '#17a2b8',
    '#28a745',
    '#dc3545',
    '#ffc107',
    '#6c757d',
    '#343a40'
  ],
  buttons: {
    outline: {
      borderColor: '#007bff',
      textColor: '#007bff',
      borderRadius: 8,
      borderWidth: 2
    },
    flat: {
      backgroundColor: '#007bff',
      textColor: '#ffffff',
      borderRadius: 8
    },
    gradient: {
      color1: '#007bff',
      color2: '#0056b3',
      color3: '#004085',
      textColor: '#ffffff',
      borderRadius: 8
    }
  },
  footer: {
    contactInfo: [
      {
        icon: 'phone',
        text: '+57 320 899 4424',
        link: 'tel:+573208994424'
      },
      {
        icon: 'envelope',
        text: 'contacto@r-integra.com',
        link: 'mailto:contacto@r-integra.com'
      },
      {
        icon: 'map-marker-alt',
        text: 'Cra 14 #18-50, Cali, Valle del Cauca',
        link: 'https://maps.google.com/?q=Cra+14+%2318-50,+Cali,+Valle+del+Cauca'
      }
    ],
    socialNetworks: [
      {
        icon: 'facebook-f',
        name: 'Facebook',
        url: 'https://facebook.com/rintegra'
      },
      {
        icon: 'instagram',
        name: 'Instagram',
        url: 'https://instagram.com/rintegra'
      },
      {
        icon: 'linkedin',
        name: 'LinkedIn',
        url: 'https://linkedin.com/company/rintegra'
      }
    ]
  }
}

export function useGlobals() {
  const globalsConfig = ref<GlobalsConfig>(defaultConfig)

  const applyGlobalsToCSS = (config: GlobalsConfig) => {
    const root = document.documentElement

    // Aplicar fuente base
    root.style.setProperty('--base-font-family', config.baseFontFamily)

    // Aplicar tipografías individuales
    Object.entries(config.typography).forEach(([element, typography]) => {
      const fontFamily = typography.fontFamily === 'inherit' ? config.baseFontFamily : typography.fontFamily
      const fontWeight = typography.fontWeight === 'inherit' ? 'normal' : typography.fontWeight
      
      root.style.setProperty(`--font-family-${element}`, fontFamily)
      root.style.setProperty(`--font-size-${element}`, `${typography.fontSize}px`)
      root.style.setProperty(`--font-weight-${element}`, fontWeight)
      root.style.setProperty(`--letter-spacing-${element}`, `${typography.letterSpacing}px`)
    })

    // Aplicar colores
    config.colorPalette.forEach((color, index) => {
      root.style.setProperty(`--color-${index + 1}`, color)
    })

    // Aplicar estilos de botones
    // Botón outline
    root.style.setProperty('--btn-outline-border-color', config.buttons.outline.borderColor)
    root.style.setProperty('--btn-outline-text-color', config.buttons.outline.textColor)
    root.style.setProperty('--btn-outline-border-radius', `${config.buttons.outline.borderRadius}px`)
    root.style.setProperty('--btn-outline-border-width', `${config.buttons.outline.borderWidth}px`)

    // Botón plano
    root.style.setProperty('--btn-flat-bg-color', config.buttons.flat.backgroundColor)
    root.style.setProperty('--btn-flat-text-color', config.buttons.flat.textColor)
    root.style.setProperty('--btn-flat-border-radius', `${config.buttons.flat.borderRadius}px`)

    // Botón degradado
    root.style.setProperty('--btn-gradient-color-1', config.buttons.gradient.color1)
    root.style.setProperty('--btn-gradient-color-2', config.buttons.gradient.color2)
    root.style.setProperty('--btn-gradient-color-3', config.buttons.gradient.color3)
    root.style.setProperty('--btn-gradient-text-color', config.buttons.gradient.textColor)
    root.style.setProperty('--btn-gradient-border-radius', `${config.buttons.gradient.borderRadius}px`)
  }

  const loadGlobalsConfig = async () => {
    try {
      const response = await configsApi.getActive('globals')
      if (response.data.data && response.data.data.config_data) {
        const config = response.data.data.config_data
        globalsConfig.value = { ...defaultConfig, ...config }
        applyGlobalsToCSS(globalsConfig.value)
      } else {
        // No hay configuración en BD, usar configuración por defecto
        applyGlobalsToCSS(defaultConfig)
      }
    } catch (error) {
      console.error('Error loading globals config from database:', error)
      // Fallback a localStorage si hay error con la BD
      const saved = localStorage.getItem('globalsConfig')
      if (saved) {
        try {
          const config = JSON.parse(saved)
          globalsConfig.value = { ...defaultConfig, ...config }
          applyGlobalsToCSS(globalsConfig.value)
        } catch (parseError) {
          console.error('Error parsing localStorage config:', parseError)
          applyGlobalsToCSS(defaultConfig)
        }
      } else {
        applyGlobalsToCSS(defaultConfig)
      }
    }
  }

  const updateGlobalsConfig = (newConfig: GlobalsConfig) => {
    globalsConfig.value = newConfig
    applyGlobalsToCSS(newConfig)
  }

  const saveGlobalsConfig = async (config: GlobalsConfig, description?: string) => {
    try {
      await configsApi.save('globals', config, description)
      globalsConfig.value = config
      applyGlobalsToCSS(config)
      
      // También guardar en localStorage como backup
      localStorage.setItem('globalsConfig', JSON.stringify(config))
      
      return true
    } catch (error) {
      console.error('Error saving globals config:', error)
      return false
    }
  }

  // Escuchar cambios de configuración
  const handleGlobalsConfigChange = (event: CustomEvent) => {
    const config = event.detail as GlobalsConfig
    updateGlobalsConfig(config)
  }

  const init = () => {
    loadGlobalsConfig()
    
    // Escuchar eventos de cambio de configuración
    window.addEventListener('globalsConfigChanged', handleGlobalsConfigChange as EventListener)
    
  //     // Escuchar cambios en localStorage desde otras pestañas
    // window.addEventListener('storage', (e) => {
    //   if (e.key === 'globalsConfig') {
    //     loadGlobalsConfig()
    //   }
    // })
  }

  const destroy = () => {
    window.removeEventListener('globalsConfigChanged', handleGlobalsConfigChange as EventListener)
  }

  return {
    globalsConfig,
    loadGlobalsConfig,
    updateGlobalsConfig,
    saveGlobalsConfig,
    applyGlobalsToCSS,
    init,
    destroy
  }
}