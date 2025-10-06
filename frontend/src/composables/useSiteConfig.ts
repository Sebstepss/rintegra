import { ref, onMounted } from 'vue'
import { configsApi } from '@/services/api'

interface SiteConfig {
  siteName: string
  tagline: string
  description: string | null
  contactEmail: string | null
  contactPhone: string | null
  address: string | null
  timezone: string
  favicon: string
}

const siteConfig = ref<SiteConfig>({
  siteName: 'R-Integra',
  tagline: 'Solidez contable, proyección empresarial',
  description: null,
  contactEmail: null,
  contactPhone: null,
  address: null,
  timezone: 'America/Mexico_City',
  favicon: ''
})

let configLoaded = false

const loadSiteConfig = async () => {
  if (configLoaded) return siteConfig.value
  
  try {
    const response = await configsApi.getActive('site')
    if (response.data?.data?.config_data) {
      siteConfig.value = { ...siteConfig.value, ...response.data.data.config_data }
      
      // Update favicon dynamically
      if (siteConfig.value.favicon) {
        updateFavicon(siteConfig.value.favicon)
      }
      
      // Update document title
      if (siteConfig.value.siteName) {
        document.title = siteConfig.value.siteName
      }
    }
    configLoaded = true
  } catch (error) {
    console.error('Error loading site configuration:', error)
  }
  
  return siteConfig.value
}

const updateFavicon = (faviconUrl: string) => {
  // Remove existing favicon links
  const existingLinks = document.querySelectorAll('link[rel="icon"], link[rel="shortcut icon"]')
  existingLinks.forEach(link => link.remove())
  
  // Add new favicon link
  const link = document.createElement('link')
  link.rel = 'icon'
  link.href = faviconUrl
  link.type = 'image/png'
  document.head.appendChild(link)
}

export function useSiteConfig() {
  onMounted(() => {
    loadSiteConfig()
  })

  return {
    siteConfig: siteConfig,
    loadSiteConfig,
    updateFavicon
  }
}