<template>
  <div class="global-config-content">
    <div class="config-header">
      <h2>
        <i class="fas fa-cog"></i>
        Configuración Global
      </h2>
      <p>Gestiona la configuración del encabezado, pie de página y elementos globales del sitio</p>
    </div>

    <div class="tabs-container">
      <div class="tabs-nav">
        <button 
          v-for="tab in tabs" 
          :key="tab.id"
          @click="activeTab = tab.id"
          class="tab-button"
          :class="{ active: activeTab === tab.id }"
        >
          <i :class="tab.icon"></i>
          {{ tab.name }}
        </button>
      </div>

      <div class="tab-content">
        <!-- Configuración del Encabezado -->
        <div v-if="activeTab === 'header'" class="tab-pane">
          <HeaderConfig />
        </div>

        <!-- Configuración del Pie de Página -->
        <div v-if="activeTab === 'footer'" class="tab-pane">
          <FooterConfig />
        </div>

        <!-- Configuración del Sitio Web -->
        <div v-if="activeTab === 'site'" class="tab-pane">
          <SiteSettings />
        </div>

        <!-- Configuración SEO -->
        <div v-if="activeTab === 'seo'" class="tab-pane">
          <SeoSettings />
        </div>

        <!-- Diseño Global -->
        <div v-if="activeTab === 'design'" class="tab-pane">
          <GlobalsConfig />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import HeaderConfig from '@/components/admin/HeaderConfig.vue'
import FooterConfig from '@/components/admin/FooterConfig.vue'
import SiteSettings from '@/components/admin/SiteSettings.vue'
import SeoSettings from '@/components/admin/SeoSettings.vue'
import GlobalsConfig from '@/components/admin/GlobalsConfig.vue'

const activeTab = ref('header')

const tabs = [
  {
    id: 'header',
    name: 'Encabezado', 
    icon: 'fas fa-bars'
  },
  {
    id: 'footer',
    name: 'Pie de Página',
    icon: 'fas fa-window-maximize'
  },
  {
    id: 'site',
    name: 'Sitio Web',
    icon: 'fas fa-globe'
  },
  {
    id: 'seo',
    name: 'SEO',
    icon: 'fas fa-search'
  },
  {
    id: 'design',
    name: 'Diseño Global',
    icon: 'fas fa-palette'
  }
]
</script>

<style scoped>
.global-config-content {
  width: 100%;
}

.config-header {
  margin-bottom: 2rem;
}

.config-header h2 {
  color: #2c3e50;
  margin: 0 0 0.5rem 0;
  font-size: 1.75rem;
  font-weight: 700;
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.config-header p {
  color: #6c757d;
  margin: 0;
  font-size: 1rem;
}

.tabs-container {
  background: white;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

.tabs-nav {
  display: flex;
  background: #f8f9fa;
  border-bottom: 1px solid #e9ecef;
}

.tab-button {
  flex: 1;
  padding: 1rem 1.5rem;
  border: none;
  background: transparent;
  color: #6c757d;
  font-size: 0.95rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  position: relative;
}

.tab-button:hover {
  background: rgba(0, 123, 255, 0.1);
  color: #007bff;
}

.tab-button.active {
  background: white;
  color: #007bff;
  border-bottom: 3px solid #007bff;
}

.tab-button.active::after {
  content: '';
  position: absolute;
  bottom: -1px;
  left: 0;
  right: 0;
  height: 1px;
  background: white;
}

.tab-content {
  padding: 0;
}

.tab-pane {
  padding: 1.5rem;
  min-height: 400px;
}

@media (max-width: 768px) {
  .config-header h2 {
    font-size: 1.5rem;
    flex-direction: column;
    gap: 0.5rem;
    text-align: center;
  }
  
  .tabs-nav {
    flex-direction: column;
  }
  
  .tab-button {
    padding: 0.75rem 1rem;
    text-align: left;
    justify-content: flex-start;
  }
  
  .tab-pane {
    padding: 1rem;
  }
}

@media (max-width: 480px) {
  .tab-button {
    flex-direction: column;
    gap: 0.25rem;
    padding: 0.75rem;
  }
}
</style>