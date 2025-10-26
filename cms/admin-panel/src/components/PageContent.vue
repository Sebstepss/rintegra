<template>
  <!-- Renderizar bloques personalizados full width -->
  <div v-if="hasBlocks" class="page-blocks-fullwidth">
    <BlockRenderer 
      v-for="block in sortedBlocks" 
      :key="block.id"
      :block="block"
      :is-editing="false"
    />
  </div>
  
  <!-- Fallback: mostrar contenido TipTap legacy si no hay bloques -->
  <div v-else-if="hasLegacyContent" class="page-content">
    <div class="page-header">
      <h1 class="page-title">{{ page.title }}</h1>
      <p v-if="page.meta_description" class="page-description">{{ page.meta_description }}</p>
    </div>
    
    <div class="content-sections">
      <div
        v-for="content in sortedContents"
        :key="content.id"
        class="content-section"
        :class="`content-${content.content_type}`"
      >
        <div v-if="content.content_type === 'text'" v-html="content.content_data.html"></div>
        <div v-else-if="content.content_type === 'hero'" class="hero-section">
          <div class="hero-content">
            <h2 v-if="content.content_data.title">{{ content.content_data.title }}</h2>
            <p v-if="content.content_data.subtitle">{{ content.content_data.subtitle }}</p>
            <div v-if="content.content_data.html" v-html="content.content_data.html"></div>
          </div>
        </div>
        <div v-else>
          <pre>{{ content.content_data }}</pre>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Página sin contenido -->
  <div v-else class="page-content">
    <div class="empty-content">
      <div class="empty-icon">
        <i class="fas fa-file-alt"></i>
      </div>
      <h3>Página en construcción</h3>
      <p>Esta página aún no tiene contenido. Ve al panel de administración para agregar bloques de contenido.</p>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import BlockRenderer from '@/components/blocks/BlockRenderer.vue'

const props = defineProps({
  page: {
    type: Object,
    required: true
  }
})

// Función para sanitizar bloques
const sanitizeBlock = (block) => {
  if (block.type === 'lead-converter') {
    // Asegurar que los arrays existan
    block.valueStackItems = block.valueStackItems || []
    block.urgencyItems = block.urgencyItems || []
    block.trustItems = block.trustItems || []
    block.situationOptions = block.situationOptions || []
    block.urgencyOptions = block.urgencyOptions || []
    
    // Asegurar que los valores numéricos existan
    block.progressBarCurrent = block.progressBarCurrent || 0
    block.progressBarTotal = block.progressBarTotal || 1
    block.countdownHours = block.countdownHours || 24
  }
  return block
}

// Bloques del nuevo sistema
const sortedBlocks = computed(() => {
  if (!props.page.pagecontent || !Array.isArray(props.page.pagecontent)) return []
  return [...props.page.pagecontent]
    .map(block => sanitizeBlock(block))
    .sort((a, b) => a.order - b.order)
})

const hasBlocks = computed(() => sortedBlocks.value.length > 0)

// Contenido legacy de TipTap
const sortedContents = computed(() => {
  if (!props.page.contents) return []
  return [...props.page.contents].sort((a, b) => a.order - b.order)
})

const hasLegacyContent = computed(() => sortedContents.value.length > 0)

// No se usa más el showPageHeader, los bloques son siempre full width
</script>

<style scoped>
/* Bloques full width sin restricciones */
.page-blocks-fullwidth {
  width: 100%;
  margin: 0;
  padding: 0;
}

/* Estilos para contenido legacy con contenedor */
.page-content {
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem;
}

.page-header {
  text-align: center;
  margin-bottom: 3rem;
  padding-bottom: 2rem;
  border-bottom: 1px solid #e9ecef;
}

.page-title {
  font-size: 3rem;
  font-weight: 700;
  color: #2c3e50;
  margin-bottom: 1rem;
  background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.page-description {
  font-size: 1.2rem;
  color: #6c757d;
  max-width: 600px;
  margin: 0 auto;
  line-height: 1.6;
}

.content-sections {
  display: flex;
  flex-direction: column;
  gap: 3rem;
}

.content-section {
  background: #ffffff;
  border-radius: 12px;
  overflow: hidden;
}

.content-text {
  padding: 2rem;
}

.hero-section {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  padding: 4rem 2rem;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.hero-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
  opacity: 0.3;
}

.hero-content {
  position: relative;
  z-index: 1;
}

.hero-content h2 {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 1rem;
}

.hero-content p {
  font-size: 1.3rem;
  margin-bottom: 2rem;
  opacity: 0.9;
}


.empty-content {
  text-align: center;
  padding: 6rem 2rem;
  color: #6c757d;
}

.empty-icon {
  font-size: 4rem;
  color: #dee2e6;
  margin-bottom: 1.5rem;
}

.empty-content h3 {
  font-size: 1.5rem;
  color: #495057;
  margin-bottom: 1rem;
  font-weight: 600;
}

.empty-content p {
  font-size: 1rem;
  line-height: 1.6;
  max-width: 500px;
  margin: 0 auto;
}

/* Estilos para contenido HTML renderizado */
.content-section :deep(h1),
.content-section :deep(h2),
.content-section :deep(h3),
.content-section :deep(h4),
.content-section :deep(h5),
.content-section :deep(h6) {
  color: #2c3e50;
  margin-top: 2rem;
  margin-bottom: 1rem;
  line-height: 1.3;
}

.content-section :deep(h1) { font-size: 2.5rem; }
.content-section :deep(h2) { font-size: 2rem; }
.content-section :deep(h3) { font-size: 1.75rem; }
.content-section :deep(h4) { font-size: 1.5rem; }
.content-section :deep(h5) { font-size: 1.25rem; }
.content-section :deep(h6) { font-size: 1.1rem; }

.content-section :deep(p) {
  margin-bottom: 1rem;
  line-height: 1.7;
  color: #495057;
}

.content-section :deep(ul),
.content-section :deep(ol) {
  margin-bottom: 1rem;
  padding-left: 2rem;
}

.content-section :deep(li) {
  margin-bottom: 0.5rem;
  line-height: 1.6;
}

.content-section :deep(blockquote) {
  border-left: 4px solid #007bff;
  padding-left: 1rem;
  margin: 1.5rem 0;
  font-style: italic;
  color: #6c757d;
}

.content-section :deep(strong) {
  color: #2c3e50;
}

@media (max-width: 768px) {
  .page-content {
    padding: 1rem;
  }
  
  .page-title {
    font-size: 2rem;
  }
  
  .page-description {
    font-size: 1rem;
  }
  
  .hero-content h2 {
    font-size: 2rem;
  }
  
  .hero-content p {
    font-size: 1.1rem;
  }
  
  .content-sections {
    gap: 2rem;
  }
}

@media (max-width: 480px) {
  .page-title {
    font-size: 1.75rem;
  }
  
  .hero-section {
    padding: 3rem 1rem;
  }
  
  .hero-content h2 {
    font-size: 1.75rem;
  }
}
</style>