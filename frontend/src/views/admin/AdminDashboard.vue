<template>
  <div class="admin-dashboard">
    <div class="admin-layout">
      <!-- Sidebar -->
      <div class="sidebar">
        <div class="sidebar-header">
          <h2>Tulbrand cms</h2>
          <a href="/" target="_blank" class="view-site-btn" title="Ver sitio público">
            <Icon name="arrow-top-right-on-square" />
            <span>Ver Sitio</span>
          </a>
        </div>
        <nav class="sidebar-nav">
          <div class="nav-section" v-if="canViewPages || canViewConfig || canViewMedia">
            <h3 class="nav-title">Sitio Web</h3>
            <a v-if="canViewPages" href="#" class="nav-item" :class="{ active: activeSection === 'pages' }" @click="setActiveSection('pages')">
              <Icon name="document-text" />
              <span>Páginas</span>
            </a>
             <a v-if="canViewConfig" href="#" class="nav-item" :class="{ active: activeSection === 'global-config' }" @click="setActiveSection('global-config')">
              <Icon name="cog" />
              <span>Configuración Global</span>
            </a>
            <a v-if="canViewMedia" href="#" class="nav-item" :class="{ active: activeSection === 'media' }" @click="setActiveSection('media')">
              <Icon name="photo" />
              <span>Medios</span>
            </a>
          </div>
          
          <div class="nav-section" v-if="canViewCrm || canViewAnalytics">
            <h3 class="nav-title">Marketing</h3>
            <a v-if="canViewCrm" href="#" class="nav-item" :class="{ active: activeSection === 'crm' }" @click="setActiveSection('crm')">
              <Icon name="envelope" />
              <span>CRM</span>
            </a>
            <a v-if="canViewAnalytics" href="#" class="nav-item" :class="{ active: activeSection === 'analytics' }" @click="setActiveSection('analytics')">
              <Icon name="magnifying-glass" />
              <span>Analíticas</span>
            </a>
          </div>
          
          <div class="nav-section" v-if="canViewUsers || canViewBackups">
            <h3 class="nav-title">Administración</h3>
            <a v-if="canViewUsers" href="#" class="nav-item" :class="{ active: activeSection === 'users' }" @click="setActiveSection('users')">
              <Icon name="cube" />
              <span>Usuarios y Roles</span>
            </a>
            <a v-if="canViewBackups" href="#" class="nav-item" :class="{ active: activeSection === 'backups' }" @click="setActiveSection('backups')">
              <Icon name="cloud-arrow-up" />
              <span>Backups y Exportar</span>
            </a>
          </div>
          
          <div class="nav-section" v-if="canViewNotes">
            <h3 class="nav-title">Utilidades</h3>
            <a v-if="canViewNotes" href="#" class="nav-item" :class="{ active: activeSection === 'notes' }" @click="setActiveSection('notes')">
              <Icon name="document-text" />
              <span>Notas</span>
            </a>
          </div>
        </nav>
        
        <div class="sidebar-footer">
          <button @click="logout" class="btn-danger btn-logout">
            <Icon name="logout" />
            Cerrar Sesión
          </button>
        </div>
      </div>
      
      <!-- Main Content -->
      <div class="main-content">
        <div class="dashboard-header">
         
          <div class="header-actions">
            <a href="/" target="_blank" class="btn-visit-site">
              <Icon name="external-link" />
              Visitar Sitio Web
            </a>
            <button @click="refreshData" class="btn-secondary" v-if="activeSection === 'pages'">
              <Icon name="refresh" />
              Actualizar
            </button>
          </div>
        </div>

        <!-- Dashboard Stats para páginas -->
        <div class="dashboard-stats" v-if="activeSection === 'pages'">
      <div class="stat-card">
        <div class="stat-icon">
          <Icon name="document-text" />
        </div>
        <div class="stat-content">
          <h3>{{ pages.length }}</h3>
          <p>Páginas Totales</p>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">
          <Icon name="eye" />
        </div>
        <div class="stat-content">
          <h3>{{ publishedPages }}</h3>
          <p>Páginas Publicadas</p>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">
          <Icon name="edit" />
        </div>
        <div class="stat-content">
          <h3>{{ draftPages }}</h3>
          <p>Borradores</p>
        </div>
      </div>
    </div>

        <!-- Pages Section -->
        <div class="dashboard-content" v-if="activeSection === 'pages' && canViewPages">
          <div class="pages-section">
            <div class="section-header">
              <h2>Gestionar Páginas</h2>
              <button @click="showCreatePage = true" class="btn-primary">
                <Icon name="plus" />
                Nueva Página
              </button>
            </div>

            <!-- Pages table for better ordering management -->
            <div class="pages-table-container">
              <table class="pages-table">
                <thead>
                  <tr>
                    <th>Orden</th>
                    <th>Título</th>
                    <th>Slug</th>
                    <th>Estado</th>
                    <th>Padre</th>
                    <th>Principal</th>
                    <th>Destacado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <template v-for="page in sortedPages" :key="page.id">
                    <!-- Main page row -->
                    <tr class="page-row" :class="{ featured: page.featured }">
                      <td class="sort-order">
                        <div class="order-controls">
                          <div class="move-buttons">
                            <button 
                              @click="movePageUp(page)" 
                              :disabled="isFirstInGroup(page)"
                              class="btn-move btn-up"
                              title="Mover arriba"
                            >
                              ↑
                            </button>
                            <button 
                              @click="movePageDown(page)" 
                              :disabled="isLastInGroup(page)"
                              class="btn-move btn-down"
                              title="Mover abajo"
                            >
                              ↓
                            </button>
                          </div>
                        </div>
                      </td>
                      <td class="page-title">
                        <div class="title-wrapper">
                          <Icon name="document-text" />
                          {{ page.title }}
                        </div>
                      </td>
                      <td class="page-slug">/{{ page.slug }}</td>
                      <td>
                        <span class="status-badge" :class="page.status">
                          {{ page.status === 'published' ? 'Publicado' : 'Borrador' }}
                        </span>
                      </td>
                      <td class="parent-info">
                        {{ page.parent ? page.parent.title : '-' }}
                      </td>
                      <td class="main-page-info">
                        <span v-if="page.is_main_page === true" class="main-page-badge">✓ Principal</span>
                        <span v-else>-</span>
                      </td>
                      <td class="featured-info">
                        <span v-if="page.featured" class="featured-badge">★ Destacado</span>
                        <span v-else>-</span>
                      </td>
                      <td class="page-actions">
                        <button @click="editPage(page)" class="btn-primary btn-sm">
                          <Icon name="edit" />
                          Editar
                        </button>
                        <button @click="editContent(page)" class="btn-secondary btn-sm">
                          <Icon name="document-text" />
                          Contenido
                        </button>
                        <button @click="deletePage(page)" class="btn-danger btn-sm">
                          <Icon name="delete" />
                          Eliminar
                        </button>
                      </td>
                    </tr>
                    
                    <!-- Subpages rows -->
                    <tr v-for="child in page.children" :key="`child-${child.id}`" class="subpage-row">
                      <td class="sort-order">
                        <div class="order-controls subpage-order">
                          <div class="move-buttons">
                            <button 
                              @click="moveSubpageUp(page, child)" 
                              :disabled="isFirstSubpage(page, child)"
                              class="btn-move btn-up"
                              title="Mover arriba"
                            >
                              ↑
                            </button>
                            <button 
                              @click="moveSubpageDown(page, child)" 
                              :disabled="isLastSubpage(page, child)"
                              class="btn-move btn-down"
                              title="Mover abajo"
                            >
                              ↓
                            </button>
                          </div>
                        </div>
                      </td>
                      <td class="page-title">
                        <div class="title-wrapper subpage-title">
                          <Icon name="arrow-right" />
                          <Icon name="document-text" />
                          {{ child.title }}
                        </div>
                      </td>
                      <td class="page-slug">/{{ child.slug }}</td>
                      <td>
                        <span class="status-badge" :class="child.status">
                          {{ child.status === 'published' ? 'Publicado' : 'Borrador' }}
                        </span>
                      </td>
                      <td class="parent-info">{{ page.title }}</td>
                      <td class="main-page-info">
                        <span v-if="child.is_main_page === true" class="main-page-badge">✓ Principal</span>
                        <span v-else>-</span>
                      </td>
                      <td class="featured-info">
                        <span v-if="child.featured" class="featured-badge">★ Destacado</span>
                        <span v-else>-</span>
                      </td>
                      <td class="page-actions">
                        <button @click="editPage(child)" class="btn-primary btn-sm">
                          <Icon name="edit" />
                          Editar
                        </button>
                        <button @click="editContent(child)" class="btn-secondary btn-sm">
                          <Icon name="document-text" />
                          Contenido
                        </button>
                        <button @click="deletePage(child)" class="btn-danger btn-sm">
                          <Icon name="delete" />
                          Eliminar
                        </button>
                      </td>
                    </tr>
                  </template>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        
        
        <!-- Global Configuration Section -->
        <div class="dashboard-content" v-if="activeSection === 'global-config' && canViewConfig">
          <GlobalConfigContent />
        </div>
        
        <!-- Media Management Section -->
        <div class="dashboard-content" v-if="activeSection === 'media' && canViewMedia">
          <MediaManager />
        </div>
        
        <!-- CRM Section -->
        <div class="dashboard-content" v-if="activeSection === 'crm' && canViewCrm">
          <CrmManager />
        </div>
        
        <!-- Analytics Section -->
        <div class="dashboard-content" v-if="activeSection === 'analytics' && canViewAnalytics">
          <AnalyticsManager />
        </div>
        
        <!-- Users Section -->
        <div class="dashboard-content" v-if="activeSection === 'users' && canViewUsers">
          <UsersManager />
        </div>
        
        <!-- Backups Section -->
        <div class="dashboard-content" v-if="activeSection === 'backups' && canViewBackups">
          <BackupsManager />
        </div>
        
        <!-- Notes Section -->
        <div class="dashboard-content" v-if="activeSection === 'notes' && canViewNotes">
          <NotesManager /> 
        </div>
      </div>
    </div>

    <!-- Modal Crear/Editar Página -->
    <PageModal
      v-if="(showCreatePage || showEditPage) && activeSection === 'pages'"
      :page="currentPage"
      :is-editing="showEditPage"
      @save="handlePageSave"
      @close="closePageModal"
    />

  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import { useRouter } from 'vue-router'
import { useContentStore } from '@/stores/content'
import { useAuthStore } from '@/stores/auth'
import { usePermissions } from '@/composables/usePermissions'
import { pagesApi } from '@/services/api'
import PageModal from '@/components/admin/PageModal.vue'
import MediaManager from '@/components/admin/MediaManager.vue'
import GlobalConfigContent from '@/components/admin/GlobalConfigContent.vue'
import CrmManager from '@/components/admin/CrmManager.vue'
import AnalyticsManager from '@/components/admin/AnalyticsManager.vue'
import UsersManager from '@/components/admin/UsersManager.vue'
import BackupsManager from '@/components/admin/BackupsManager.vue'
import NotesManager from '@/components/admin/NotesManager.vue'

const router = useRouter()
const contentStore = useContentStore()
const authStore = useAuthStore()
const {
  canViewPages,
  canViewConfig,
  canViewMedia,
  canViewUsers,
  canViewCrm,
  canViewAnalytics,
  canViewNotes,
  canViewBackups,
  canViewSeo,
  isEditor
} = usePermissions()

const showCreatePage = ref(false)
const showEditPage = ref(false)
const currentPage = ref(null)
const activeSection = ref('pages')

const pages = computed(() => contentStore.pages)

// Sorted pages for display (main pages first, then ordered by sort_order)
const sortedPages = computed(() => {
  const mainPages = pages.value
    .filter(page => !page.parent_id)
    .sort((a, b) => (a.sort_order || 0) - (b.sort_order || 0))
    .map(page => ({
      ...page,
      children: pages.value
        .filter(child => child.parent_id === page.id)
        .sort((a, b) => (a.sort_order || 0) - (b.sort_order || 0))
    }))
  
  return mainPages
})

const publishedPages = computed(() => 
  pages.value.filter(page => page.status === 'published').length
)

const draftPages = computed(() => 
  pages.value.filter(page => page.status === 'draft').length
)

// Refresh data function
const refreshData = () => {
  contentStore.fetchPages()
}

// Verificar acceso a sección actual
const canAccessCurrentSection = () => {
  switch (activeSection.value) {
    case 'pages':
      return canViewPages.value
    case 'global-config':
      return canViewConfig.value
    case 'media':
      return canViewMedia.value
    case 'crm':
      return canViewCrm.value
    case 'analytics':
      return canViewAnalytics.value
    case 'users':
      return canViewUsers.value
    case 'backups':
      return canViewBackups.value
    case 'notes':
      return canViewNotes.value
    default:
      return false
  }
}

// Establecer sección por defecto según permisos
const setDefaultSection = () => {
  console.log('Setting default section. Current user:', authStore.user)
  console.log('Permission checks:', {
    canViewPages: canViewPages.value,
    canViewConfig: canViewConfig.value,
    canViewMedia: canViewMedia.value,
    canViewCrm: canViewCrm.value,
    canViewAnalytics: canViewAnalytics.value,
    canViewUsers: canViewUsers.value,
    canViewBackups: canViewBackups.value,
    canViewNotes: canViewNotes.value
  })
  
  // Si el usuario no puede ver la sección actual, cambiar a una permitida
  if (!canAccessCurrentSection()) {
    console.log('Cannot access current section, finding alternative')
    if (canViewPages.value) {
      console.log('Setting section to pages')
      activeSection.value = 'pages'
    } else if (canViewConfig.value) {
      console.log('Setting section to global-config')
      activeSection.value = 'global-config'
    } else if (canViewMedia.value) {
      console.log('Setting section to media')
      activeSection.value = 'media'
    } else if (canViewCrm.value) {
      console.log('Setting section to crm')
      activeSection.value = 'crm'
    } else if (canViewAnalytics.value) {
      console.log('Setting section to analytics')
      activeSection.value = 'analytics'
    } else if (canViewUsers.value) {
      console.log('Setting section to users')
      activeSection.value = 'users'
    } else if (canViewBackups.value) {
      console.log('Setting section to backups')
      activeSection.value = 'backups'
    } else if (canViewNotes.value) {
      console.log('Setting section to notes')
      activeSection.value = 'notes'
    }
  } else {
    console.log('Can access current section:', activeSection.value)
  }
}

onMounted(async () => {
  // Asegurarse de que el usuario esté cargado
  if (!authStore.user && authStore.token) {
    await authStore.fetchUser()
  }
  
  refreshData()
  setDefaultSection()
})

// Watch para reactivar secciones cuando el usuario se carga
watch(() => authStore.user, (newUser) => {
  if (newUser) {
    console.log('User loaded in AdminDashboard, setting default section')
    setDefaultSection()
  }
}, { immediate: true })

const editPage = (page) => {
  currentPage.value = { ...page }
  showEditPage.value = true
}

const editContent = (page) => {
  router.push(`/admin/pages/${page.id}/blocks`)
}

const deletePage = async (page) => {
  if (confirm(`¿Estás seguro de eliminar la página "${page.title}"?`)) {
    try {
      await contentStore.deletePage(page.id)
    } catch (error) {
      alert('Error al eliminar la página')
    }
  }
}

const handlePageSave = async (pageData) => {
  try {
    if (showEditPage.value) {
      await contentStore.updatePage(currentPage.value.id, pageData)
    } else {
      await contentStore.createPage(pageData)
    }
    closePageModal()
  } catch (error) {
    alert('Error al guardar la página')
  }
}

const closePageModal = () => {
  showCreatePage.value = false
  showEditPage.value = false
  currentPage.value = null
}

const setActiveSection = (section) => {
  // Verificar si el usuario tiene permisos para acceder a esta sección
  const tempSection = activeSection.value
  activeSection.value = section
  
  if (canAccessCurrentSection()) {
    // El usuario puede acceder a esta sección
    return
  } else {
    // Revertir a la sección anterior
    activeSection.value = tempSection
    alert('No tienes permisos para acceder a esta sección')
  }
}

const getSectionTitle = () => {
  switch (activeSection.value) {
    case 'pages': return 'Gestión de Páginas'
    case 'media': return 'Gestión de Medios'
    case 'global-config': return 'Configuración Global'
    case 'crm': return 'CRM - Gestión de Formularios'
    case 'analytics': return 'Analíticas y Rendimiento'
    case 'users': return 'Usuarios y Roles'
    case 'backups': return 'Backups y Exportación'
    case 'notes': return 'Gestión de Notas'
    default: return 'Panel de Administración'
  }
}


// Page ordering functions
const updatePageOrder = async (pageId, newOrder) => {
  try {
    const orderData = {
      pages: [{ id: pageId, sort_order: parseInt(newOrder) }]
    }
    await pagesApi.updateOrder(orderData)
    await refreshData()
  } catch (error) {
    console.error('Error updating page order:', error)
    alert('Error al actualizar el orden')
  }
}

const movePageUp = async (page) => {
  const siblings = sortedPages.value.filter(p => !p.parent_id)
  const currentIndex = siblings.findIndex(p => p.id === page.id)
  if (currentIndex > 0) {
    // Reorganizar todos los elementos para mantener orden secuencial
    const reorderedPages = []
    siblings.forEach((sibling, index) => {
      let newOrder
      if (index === currentIndex - 1) {
        // La página anterior toma el orden actual
        newOrder = currentIndex
      } else if (index === currentIndex) {
        // La página actual toma el orden anterior
        newOrder = currentIndex - 1
      } else {
        // Las demás mantienen su posición
        newOrder = index
      }
      reorderedPages.push({ id: sibling.id, sort_order: newOrder })
    })
    
    await pagesApi.updateOrder({ pages: reorderedPages })
    await refreshData()
  }
}

const movePageDown = async (page) => {
  const siblings = sortedPages.value.filter(p => !p.parent_id)
  const currentIndex = siblings.findIndex(p => p.id === page.id)
  if (currentIndex < siblings.length - 1) {
    // Reorganizar todos los elementos para mantener orden secuencial
    const reorderedPages = []
    siblings.forEach((sibling, index) => {
      let newOrder
      if (index === currentIndex) {
        // La página actual toma el orden siguiente
        newOrder = currentIndex + 1
      } else if (index === currentIndex + 1) {
        // La página siguiente toma el orden actual
        newOrder = currentIndex
      } else {
        // Las demás mantienen su posición
        newOrder = index
      }
      reorderedPages.push({ id: sibling.id, sort_order: newOrder })
    })
    
    await pagesApi.updateOrder({ pages: reorderedPages })
    await refreshData()
  }
}

const isFirstInGroup = (page) => {
  const siblings = sortedPages.value.filter(p => !p.parent_id)
  return siblings.findIndex(p => p.id === page.id) === 0
}

const isLastInGroup = (page) => {
  const siblings = sortedPages.value.filter(p => !p.parent_id)
  return siblings.findIndex(p => p.id === page.id) === siblings.length - 1
}

// Subpage ordering functions
const moveSubpageUp = async (parentPage, subpage) => {
  const siblings = parentPage.children
  const currentIndex = siblings.findIndex(child => child.id === subpage.id)
  if (currentIndex > 0) {
    // Reorganizar todos los elementos para mantener orden secuencial
    const reorderedPages = []
    siblings.forEach((sibling, index) => {
      let newOrder
      if (index === currentIndex - 1) {
        // La subpágina anterior toma el orden actual
        newOrder = currentIndex
      } else if (index === currentIndex) {
        // La subpágina actual toma el orden anterior
        newOrder = currentIndex - 1
      } else {
        // Las demás mantienen su posición
        newOrder = index
      }
      reorderedPages.push({ id: sibling.id, sort_order: newOrder })
    })
    
    await pagesApi.updateOrder({ pages: reorderedPages })
    await refreshData()
  }
}

const moveSubpageDown = async (parentPage, subpage) => {
  const siblings = parentPage.children
  const currentIndex = siblings.findIndex(child => child.id === subpage.id)
  if (currentIndex < siblings.length - 1) {
    // Reorganizar todos los elementos para mantener orden secuencial
    const reorderedPages = []
    siblings.forEach((sibling, index) => {
      let newOrder
      if (index === currentIndex) {
        // La subpágina actual toma el orden siguiente
        newOrder = currentIndex + 1
      } else if (index === currentIndex + 1) {
        // La subpágina siguiente toma el orden actual
        newOrder = currentIndex
      } else {
        // Las demás mantienen su posición
        newOrder = index
      }
      reorderedPages.push({ id: sibling.id, sort_order: newOrder })
    })
    
    await pagesApi.updateOrder({ pages: reorderedPages })
    await refreshData()
  }
}

const isFirstSubpage = (parentPage, subpage) => {
  const siblings = parentPage.children
  return siblings.findIndex(child => child.id === subpage.id) === 0
}

const isLastSubpage = (parentPage, subpage) => {
  const siblings = parentPage.children
  return siblings.findIndex(child => child.id === subpage.id) === siblings.length - 1
}

const logout = () => {
  // Implementar logout cuando tengamos autenticación
  router.push('/login')
}
</script>

<style scoped>
.admin-dashboard {
  min-height: 100vh;
  background-color: #f8f9fa;
}

.admin-layout {
  display: flex;
  min-height: 100vh;
}

.sidebar {
  width: 280px;
  background: #ffffff;
  color: rgb(0, 0, 0);
  display: flex;
  flex-direction: column;
  position: fixed;
  left: 0;
  top: 0;
  height: 100vh;
  overflow-y: auto;
  z-index: 1000;
}

.sidebar-header {
  padding: 2rem 1.5rem 1rem;
  border-bottom: 1px solid #e2edf7;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 1rem;
}

.sidebar-header h2 {
  margin: 0;
  font-size: 1.5rem;
  color: rgb(0, 0, 0);
  font-family: 'Lato', sans-serif;
}

.view-site-btn {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  background: linear-gradient(135deg, #c0894f, #ffffaa, #fdfab2, #cb9452);
  color: #0C6444;
  text-decoration: none;
  border-radius: 6px;
  font-weight: 600;
  font-size: 0.85rem;
  transition: all 0.3s ease;
  box-shadow: 0 2px 8px rgba(192, 137, 79, 0.3);
}

.view-site-btn:hover {
  background: linear-gradient(135deg, #b07a42, #f5f59d, #f0f3a5, #b8854a);
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(192, 137, 79, 0.4);
}

.view-site-btn span {
  white-space: nowrap;
}

.sidebar-nav {
  flex: 1;
  padding: 10px;
}

.nav-section {
  margin-bottom: 2rem;
}

.nav-title {
  padding: 0 1.5rem;
  margin: 0 0 1rem 0;
  font-size: 0.875rem;
  text-transform: uppercase;
  color: #cccccc;
  font-weight: 600;
  letter-spacing: 0.05em;
}

.nav-item {
  display: flex;
  align-items: center;
  padding: 0.75rem 1.5rem;
  color: #000000;
  text-decoration: none;
  transition: all 0.3s ease;
  border-radius: 10px;
  cursor: pointer;
}

.nav-item:hover {
  background-color: #e1eefc;
  color: rgb(67, 75, 122);
}

.nav-item.active {
  background-color: #000000;
  color: white;
}

.nav-item .w-4 {
  margin-right: 0.75rem;
  width: 16px;
  text-align: center;
}

.sidebar-footer {
  padding: 1rem 1.5rem;
  border-top: 1px solid #34495e;
}

.btn-logout {
  width: 100%;
  justify-content: center;
}

.main-content {
  background-color: #eaf0fd;
  flex: 1;
  margin-left: 280px;
  padding: 2rem;
}

.dashboard-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
  padding-bottom: 1rem;
  border-bottom: 2px solid #e9ecef;
}

.dashboard-header h1 {
  color: #2c3e50;
  margin: 0;
}

.header-actions {
  display: flex;
  gap: 1rem;
  align-items: center;
}

.btn-visit-site {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  background: #28a745;
  color: white;
  text-decoration: none;
  padding: 0.5rem 1rem;
  border-radius: 6px;
  font-weight: 600;
  font-size: 0.875rem;
  transition: all 0.3s ease;
}

.btn-visit-site:hover {
  background: #218838;
  transform: translateY(-1px);
  text-decoration: none;
  color: white;
}

.dashboard-stats {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1.5rem;
  margin-bottom: 3rem;
}

.stat-card {
  background: white;
  border-radius: 12px;
  padding: 1.5rem;
  display: flex;
  align-items: center;
  gap: 1rem;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.stat-icon {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: linear-gradient(135deg, #007bff, #0056b3);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 1.2rem;
}

.stat-content h3 {
  font-size: 2rem;
  font-weight: 700;
  margin: 0;
  color: #2c3e50;
}

.stat-content p {
  margin: 0;
  color: #6c757d;
  font-size: 0.9rem;
}

.dashboard-content {
  background: white;
  border-radius: 12px;
  padding: 2rem;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}

.section-header h2 {
  color: #2c3e50;
  margin: 0;
}

/* Pages Table Styles */
.pages-table-container {
  overflow-x: auto;
  border-radius: 8px;
  border: 1px solid #e9ecef;
}

.pages-table {
  width: 100%;
  border-collapse: collapse;
  background: white;
}

.pages-table thead th {
  background: #f8f9fa;
  padding: 1rem;
  text-align: left;
  font-weight: 600;
  color: #495057;
  border-bottom: 2px solid #dee2e6;
  font-size: 0.9rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.pages-table tbody tr {
  transition: all 0.2s ease;
}

.pages-table tbody tr:hover {
  background-color: #f8f9fa;
}

.pages-table tbody tr.featured {
  background: linear-gradient(135deg, rgba(192, 137, 79, 0.1), rgba(255, 255, 170, 0.1), rgba(253, 250, 178, 0.1), rgba(203, 148, 82, 0.1));
  border-left: 4px solid #c0894f;
}

.pages-table tbody tr.subpage-row {
  background-color: #f8f9fa;
  border-left: 3px solid #007bff;
}

.pages-table tbody tr.subpage-row:hover {
  background-color: #e9f4ff;
}

.pages-table td {
  padding: 1rem;
  vertical-align: middle;
  border-bottom: none;
}

.pages-table tbody tr {
  border-bottom: 1px solid #e9ecef;
}

.sort-order {
  width: 120px;
}

.order-controls {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.order-display {
  min-width: 30px;
  padding: 0.25rem 0.5rem;
  background: #f8f9fa;
  border: 1px solid #e9ecef;
  border-radius: 4px;
  font-size: 0.875rem;
  text-align: center;
  font-weight: 600;
  color: #495057;
}

.move-buttons {
  display: flex;
  flex-direction: column;
  gap: 2px;
}

.btn-move {
  width: 20px;
  height: 20px;
  border: none;
  background: #6c757d;
  color: white;
  border-radius: 3px;
  cursor: pointer;
  font-size: 0.75rem;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s;
}

.btn-move:hover:not(:disabled) {
  background: #495057;
}

.btn-move:disabled {
  opacity: 0.4;
  cursor: not-allowed;
}

.subpage-order {
  margin-left: 1rem;
  padding-left: 1rem;
  border-left: 2px solid #007bff;
}

.title-wrapper {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-weight: 500;
}

.subpage-title {
  margin-left: 1rem;
  color: #6c757d;
  font-size: 0.9rem;
}

.page-slug {
  color: #007bff;
  font-family: monospace;
  font-size: 0.85rem;
}

.parent-info {
  color: #6c757d;
  font-size: 0.9rem;
}

.featured-badge {
  background: linear-gradient(135deg, #c0894f, #ffffaa, #fdfab2, #cb9452);
  color: #0c6a44;
  padding: 0.25rem 0.5rem;
  border-radius: 15px;
  font-size: 0.75rem;
  font-weight: bold;
  text-transform: uppercase;
}

.main-page-badge {
  background: linear-gradient(135deg, #007bff, #0056b3);
  color: white;
  padding: 0.25rem 0.5rem;
  border-radius: 15px;
  font-size: 0.75rem;
  font-weight: bold;
  text-transform: uppercase;
}

.main-page-info,
.featured-info {
  text-align: center;
}

.status-badge {
  padding: 0.25rem 0.75rem;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 500;
}

.status-badge.published {
  background-color: #d4edda;
  color: #155724;
}

.status-badge.draft {
  background-color: #fff3cd;
  color: #856404;
}

.page-slug {
  color: #007bff;
  font-size: 0.9rem;
  margin: 0.5rem 0;
}

.page-meta {
  color: #6c757d;
  font-size: 0.85rem;
  margin-bottom: 1rem;
  line-height: 1.4;
}

.page-actions {
  display: flex;
  gap: 0.5rem;
  flex-wrap: wrap;
}

.btn-primary, .btn-secondary, .btn-danger {
  padding: 0.5rem 1rem;
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

.btn-sm {
  padding: 0.375rem 0.75rem;
  font-size: 0.75rem;
}

.btn-primary {
  background-color: #000000;
  color: white;
}

.btn-primary:hover {
  background-color: #0056b3;
}

.btn-secondary {
  background-color: #6c757d;
  color: white;
}

.btn-secondary:hover {
  background-color: #545b62;
}

.btn-danger {
  background-color: #dc3545;
  color: white;
}

.btn-danger:hover {
  background-color: #c82333;
}

@media (max-width: 768px) {
  .admin-dashboard {
    padding: 1rem;
  }
  
  .dashboard-header {
    flex-direction: column;
    gap: 1rem;
    align-items: flex-start;
  }
  
  .header-actions {
    width: 100%;
    justify-content: flex-end;
  }
  
  .dashboard-stats {
    grid-template-columns: 1fr;
  }
  
  .section-header {
    flex-direction: column;
    gap: 1rem;
    align-items: flex-start;
  }
  
  .pages-grid {
    grid-template-columns: 1fr;
  }
}
</style>