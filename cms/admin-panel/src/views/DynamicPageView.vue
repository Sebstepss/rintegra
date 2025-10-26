<template>
  <div class="dynamic-page-view">
    <div v-if="loading" class="loading-container">
      <div class="loading-spinner">
        <i class="fas fa-spinner fa-spin"></i>
        <p>Cargando página...</p>
      </div>
    </div>

    <div v-else-if="error" class="error-container">
      <div class="error-content">
        <i class="fas fa-exclamation-triangle"></i>
        <h2>Página no encontrada</h2>
        <p>{{ error }}</p>
        <router-link to="/" class="btn-primary">
          <i class="fas fa-home"></i>
          Volver al inicio
        </router-link>
      </div>
    </div>

    <PageContent 
      v-else-if="page" 
      :page="page" 
    />
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, watch, withDefaults, computed } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useHead } from '@vueuse/head'
import { pagesApi } from '@/services/api'
import PageContent from '@/components/PageContent.vue'

const route = useRoute()
const router = useRouter()

const page = ref(null)
const loading = ref(true)
const error = ref('')

const loadPage = async (slug: string) => {
  loading.value = true
  error.value = ''
  
  try {
    let response
    
    // Si el slug es 'inicio' o corresponde a la homepage, usar el endpoint específico
    if (slug === 'inicio' || slug === props.defaultSlug) {
      response = await pagesApi.getHomepage()
    } else {
      response = await pagesApi.getBySlug(slug)
    }
    
    if (response.data && response.data.status === 'published') {
      page.value = response.data
    } else if (response.data && response.data.status === 'draft') {
      error.value = 'Esta página está en borrador y no está disponible públicamente.'
    } else {
      error.value = 'La página solicitada no existe.'
    }
  } catch (err) {
    console.error('Error loading page:', err)
    
    if (err.response?.status === 404) {
      error.value = 'La página solicitada no existe.'
    } else {
      error.value = 'Error al cargar la página. Por favor, intenta de nuevo.'
    }
  } finally {
    loading.value = false
  }
}

interface Props {
  defaultSlug?: string
}

const props = withDefaults(defineProps<Props>(), {
  defaultSlug: 'inicio'
})

// Cargar página inicial
onMounted(() => {
  const slug = route.params.slug as string || props.defaultSlug
  loadPage(slug)
})

// Recargar cuando cambie la ruta
watch(() => route.params.slug, (newSlug) => {
  if (newSlug) {
    loadPage(newSlug as string)
  }
}, { immediate: false })

// SEO dinámico con VueUse Head
const siteUrl = 'https://rintegra.com' // TODO: Cambiar por tu dominio real

useHead(computed(() => {
  if (!page.value) {
    return {
      title: 'Cargando... | R-Integra',
    }
  }

  const currentUrl = `${siteUrl}${route.fullPath}`
  const description = page.value.meta_description || 'R-Integra - Soluciones integrales para tu negocio'
  const title = `${page.value.title} | R-Integra`

  return {
    title: title,
    meta: [
      { name: 'description', content: description },
      { name: 'keywords', content: page.value.meta_keywords || 'servicios, soluciones, negocio' },

      // Open Graph
      { property: 'og:type', content: 'website' },
      { property: 'og:url', content: currentUrl },
      { property: 'og:title', content: title },
      { property: 'og:description', content: description },
      { property: 'og:image', content: page.value.featured_image || `${siteUrl}/og-image.jpg` },

      // Twitter
      { name: 'twitter:card', content: 'summary_large_image' },
      { name: 'twitter:url', content: currentUrl },
      { name: 'twitter:title', content: title },
      { name: 'twitter:description', content: description },
      { name: 'twitter:image', content: page.value.featured_image || `${siteUrl}/twitter-image.jpg` },
    ],
    link: [
      { rel: 'canonical', href: currentUrl }
    ]
  }
}))
</script>

<style scoped>
.dynamic-page-view {
  min-height: 50vh;
}

.loading-container {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 400px;
  padding: 2rem;
}

.loading-spinner {
  text-align: center;
  color: #6c757d;
}

.loading-spinner i {
  font-size: 2rem;
  margin-bottom: 1rem;
  color: #007bff;
}

.loading-spinner p {
  margin: 0;
  font-size: 1rem;
}

.error-container {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 400px;
  padding: 2rem;
}

.error-content {
  text-align: center;
  max-width: 500px;
  padding: 2rem;
  border-radius: 12px;
  background: #f8f9fa;
  border: 1px solid #e9ecef;
}

.error-content i {
  font-size: 3rem;
  color: #dc3545;
  margin-bottom: 1rem;
}

.error-content h2 {
  color: #495057;
  margin-bottom: 1rem;
  font-size: 1.5rem;
}

.error-content p {
  color: #6c757d;
  margin-bottom: 2rem;
  line-height: 1.6;
}

.btn-primary {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  background: #007bff;
  color: white;
  text-decoration: none;
  padding: 0.75rem 1.5rem;
  border-radius: 8px;
  font-weight: 600;
  transition: all 0.3s ease;
}

.btn-primary:hover {
  background: #0056b3;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
}

@media (max-width: 768px) {
  .loading-container,
  .error-container {
    min-height: 300px;
    padding: 1rem;
  }
  
  .error-content {
    padding: 1.5rem;
  }
  
  .error-content i {
    font-size: 2rem;
  }
  
  .error-content h2 {
    font-size: 1.25rem;
  }
}
</style>