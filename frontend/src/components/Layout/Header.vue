<template>
  <header class="header" :class="{ 'sticky': isSticky }" :style="headerStyles">
    <nav class="navbar">
      <div class="nav-container">
        <div class="nav-brand">
          <router-link to="/" class="brand-link">
            <img v-if="logoUrl" :src="logoUrl" alt="Logo" class="logo-image">
            <h1 v-else class="logo-text" :style="logoTextStyles">RIntegra</h1>
          </router-link>
        </div>
        
        <div class="nav-menu" :class="{ 'active': isMenuOpen }">
          <template v-for="page in navigationPages" :key="page.id">
            <!-- Nav item wrapper -->
            <div class="nav-item-wrapper" :class="{ 'has-dropdown': page.published_children && page.published_children.length > 0 }">
              <!-- Main page link -->
              <router-link 
                :to="`/${page.slug}`" 
                class="nav-link"
                :class="{
                  'featured-link': page.featured,
                  'has-children': page.published_children && page.published_children.length > 0
                }"
                @click="closeMenu" 
                :style="getNavLinkStyle(page)"
              >
                {{ page.title }}
                <span v-if="page.published_children && page.published_children.length > 0" class="dropdown-arrow">▼</span>
              </router-link>
              
              <!-- Subpages dropdown -->
              <div v-if="page.published_children && page.published_children.length > 0" class="dropdown-menu">
                <router-link 
                  v-for="child in page.published_children"
                  :key="`child-${child.id}`"
                  :to="`/${child.slug}`" 
                  class="nav-link dropdown-link"
                  :class="{ 'featured-link': child.featured }"
                  @click="closeMenu"
                  :style="getNavLinkStyle(child)"
                >
                  {{ child.title }}
                </router-link>
              </div>
            </div>
          </template>
          <router-link to="/admin" class="nav-link admin-link" @click="closeMenu">Admin</router-link>
        </div>
        
        <div class="nav-toggle" @click="toggleMenu">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </nav>
  </header>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, watch } from 'vue'
import { pagesApi, configsApi } from '@/services/api'

const isMenuOpen = ref(false)
const isSticky = ref(false)
const logoUrl = ref('')
const navigationPages = ref([])
const headerConfig = ref({
  logoUrl: '',
  backgroundNormal: 'transparent',
  backgroundSticky: '#0a5a39',
  textColor: '#ffffff',
  textHoverColor: '#ffffff'
})

const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value
}

const closeMenu = () => {
  isMenuOpen.value = false
}

const handleScroll = () => {
  isSticky.value = window.scrollY > 0
}

const loadHeaderConfig = async () => {
  try {
    console.log('🌐 Header: Cargando configuración desde API...')
    const response = await configsApi.getActive('header')
    
    if (response.data && response.data.data && response.data.data.config_data) {
      const config = response.data.data.config_data
      console.log('✅ Header: Configuración cargada desde API:', config)
      headerConfig.value = { ...headerConfig.value, ...config }
      logoUrl.value = config.logoUrl || ''
    } else {
      console.log('⚠️ Header: No hay configuración activa, usando valores por defecto')
    }
  } catch (error) {
    console.error('❌ Header: Error al cargar desde API, usando localStorage como fallback:', error)
    
    // Fallback a localStorage solo en caso de error
    const saved = localStorage.getItem('headerConfig')
    if (saved) {
      try {
        const config = JSON.parse(saved)
        headerConfig.value = { ...headerConfig.value, ...config }
        logoUrl.value = config.logoUrl || ''
        console.log('💾 Header: Configuración cargada desde localStorage como fallback')
      } catch (parseError) {
        console.error('Error parsing localStorage config:', parseError)
      }
    }
  }
}

// Estilos dinámicos basados en la configuración
const headerStyles = computed(() => {
  if (isSticky.value) {
    return {
      backgroundColor: headerConfig.value.backgroundSticky,
      color: headerConfig.value.textColor
    }
  } else {
    return {
      backgroundColor: headerConfig.value.backgroundNormal,
      color: headerConfig.value.textColor
    }
  }
})

const getNavLinkStyle = (page) => {
  const baseStyle = {
    color: headerConfig.value.textColor
  }
  
  if (page.featured) {
    return {
      ...baseStyle,
      background: 'linear-gradient(135deg, #c0894f, #ffffaa, #fdfab2, #cb9452)',
      color: '#0C6444',
      fontWeight: 'bold'
    }
  }
  
  return baseStyle
}

const logoTextStyles = computed(() => ({
  color: headerConfig.value.textColor
}))

// Escuchar cambios en localStorage desde el admin
const handleStorageChange = (event) => {
  if (event.key === 'headerConfig') {
    loadHeaderConfig()
  }
}

// Escuchar evento personalizado para cambios inmediatos
const handleHeaderConfigChange = (event) => {
  const config = event.detail
  headerConfig.value = { ...headerConfig.value, ...config }
  logoUrl.value = config.logoUrl || ''
}

const loadPages = async () => {
  try {
    const response = await pagesApi.getNavigation()
    navigationPages.value = response.data
  } catch (error) {
    console.error('Error loading navigation pages:', error)
  }
}

onMounted(async () => {
  window.addEventListener('scroll', handleScroll)
  window.addEventListener('storage', handleStorageChange)
  window.addEventListener('headerConfigChanged', handleHeaderConfigChange)
  await loadHeaderConfig()
  loadPages()
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
  window.removeEventListener('storage', handleStorageChange)
  window.removeEventListener('headerConfigChanged', handleHeaderConfigChange)
})
</script>

<style scoped>
.header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  width: 100%;
  z-index: 1000;
  transition: all 0.3s ease;
  font-family: 'Lato', sans-serif;
}

.header.sticky {
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.navbar {
  padding: 0;
}

.nav-container {
  width: 100%;
  margin: 0 auto;
  padding: 1rem 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.nav-brand {
  flex: 0 0 auto;
}

.brand-link {
  text-decoration: none;
  display: flex;
  align-items: center;
}

.logo-image {
  height: 50px;
  width: auto;
  object-fit: contain;
}

.logo-text {
  margin: 0;
  font-size: var(--font-size-h2, 2rem);
  font-weight: var(--font-weight-h2, 700);
  font-family: var(--font-family-h2, var(--base-font-family, 'Lato', sans-serif));
  letter-spacing: var(--letter-spacing-h2, 0px);
  transition: color 0.3s ease;
}

.nav-menu {
  display: flex;
  align-items: center;
  gap: 2rem;
  list-style: none;
  margin: 0;
  padding: 0;
  position: relative;
}

.nav-item-wrapper {
  position: relative;
  display: flex;
  align-items: center;
}

.nav-link {
  text-decoration: none;
  font-weight: var(--font-weight-p, 500);
  font-family: var(--font-family-p, var(--base-font-family, 'Lato', sans-serif));
  font-size: var(--font-size-p, 1rem);
  letter-spacing: var(--letter-spacing-p, 0px);
  padding: 0.5rem 1rem;
  border-radius: 6px;
  transition: all 0.3s ease;
  position: relative;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.nav-link:hover {
  background-color: rgba(255, 255, 255, 0.1);
  opacity: 0.8;
}

.nav-link.router-link-active {
  background-color: rgba(255, 255, 255, 0.2);
  opacity: 0.9;
}

.nav-link.featured-link {
  background: linear-gradient(135deg, #c0894f, #ffffaa, #fdfab2, #cb9452) !important;
  color: #0C6444 !important;
  font-weight: bold;
  text-shadow: none;
  box-shadow: 0 2px 8px rgba(192, 137, 79, 0.3);
}

.nav-link.featured-link:hover {
  background: linear-gradient(135deg, #b07a42, #f5f59d, #f0f3a5, #b8854a) !important;
  color: #0C6444 !important;
  opacity: 1;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(192, 137, 79, 0.4);
}

.dropdown-arrow {
  font-size: 0.75rem;
  transition: transform 0.3s ease;
}

.nav-item-wrapper.has-dropdown:hover .dropdown-arrow,
.has-children:hover .dropdown-arrow {
  transform: rotate(180deg);
}

.dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  background: white;
  min-width: 200px;
  border-radius: 8px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  opacity: 0;
  visibility: hidden;
  transform: translateY(-10px);
  transition: all 0.3s ease;
  z-index: 1000;
  padding: 0.5rem 0;
}

.nav-item-wrapper:hover .dropdown-menu,
.nav-item-wrapper.has-dropdown:hover .dropdown-menu,
.has-children:hover .dropdown-menu,
.dropdown-menu:hover {
  opacity: 1;
  visibility: visible;
  transform: translateY(0);
}

.dropdown-link {
  display: block;
  padding: 0.75rem 1rem !important;
  color: #2c3e50 !important;
  font-size: 0.9rem;
  border-radius: 0;
  transition: all 0.2s ease;
}

.dropdown-link:hover {
  background-color: #f8f9fa !important;
  color: #007bff !important;
}

.dropdown-link.featured-link {
  background: linear-gradient(135deg, #c0894f, #ffffaa, #fdfab2, #cb9452) !important;
  color: #0C6444 !important;
  font-weight: bold;
}

.dropdown-link.featured-link:hover {
  background: linear-gradient(135deg, #b07a42, #f5f59d, #f0f3a5, #b8854a) !important;
}

.admin-link {
  background-color: #28a745;
  color: white !important;
}

.admin-link:hover {
  background-color: #218838;
  color: white !important;
}

.nav-toggle {
  display: none;
  flex-direction: column;
  cursor: pointer;
  padding: 0.5rem;
}

.nav-toggle span {
  width: 25px;
  height: 3px;
  background-color: #2c3e50;
  margin: 3px 0;
  transition: 0.3s;
  border-radius: 2px;
}

@media (max-width: 768px) {
  .nav-container {
    padding: 1rem;
  }
  
  .nav-toggle {
    display: flex;
  }
  
  .nav-menu {
    position: fixed;
    top: 70px;
    left: -100%;
    width: 100%;
    height: calc(100vh - 70px);
    background-color: #ffffff;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;
    padding-top: 2rem;
    gap: 1rem;
    transition: left 0.3s ease;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }
  
  .nav-menu.active {
    left: 0;
  }
  
  .nav-link {
    font-size: 1.2rem;
    padding: 1rem 2rem;
    width: 80%;
    text-align: center;
  }
  
  .brand-link h1 {
    font-size: 1.5rem;
  }
}

@media (max-width: 480px) {
  .nav-container {
    padding: 0.5rem 1rem;
  }
  
  .brand-link h1 {
    font-size: 1.3rem;
  }
}
</style>