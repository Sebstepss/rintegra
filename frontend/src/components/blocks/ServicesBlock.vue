<template>
  <div 
    :class="[
      'services-block',
      `display-mode-${block.displayMode}`,
      `icon-size-${block.iconSize}`,
      `align-${block.alignment}`,
      `gap-${block.gap}`,
      `padding-${block.padding}`,
      block.customClass
    ]"
    :id="block.customId"
    :style="blockStyles"
  >
    <!-- Block Title and Subtitle -->
    <div v-if="block.title || block.subtitle" class="services-header">
      <h1 v-if="block.title" class="services-title">{{ block.title }}</h1>
      <p v-if="block.subtitle" class="services-subtitle">{{ block.subtitle }}</p>
    </div>

    <!-- Services Content -->
    <div v-if="block.services && block.services.length > 0" class="services-container">
      
      <!-- Tabs Mode -->
      <div v-if="block.displayMode === 'tabs'" class="services-tabs">
        <!-- Tab Navigation -->
        <div class="tabs-nav">
          <button
            v-for="(service, index) in block.services"
            :key="service.id"
            @click="activeTabIndex = index"
            :class="['tab-button', { active: activeTabIndex === index }]"
          >
            <div v-if="service.icon" class="tab-icon">
              <img :src="buildMediaUrl(service.icon)" :alt="service.title" />
            </div>
            <div class="tab-content">
              <span class="tab-title">{{ service.title }}</span>
              <span class="tab-description">{{ service.shortDescription }}</span>
            </div>
          </button>
        </div>
        
        <!-- Tab Content -->
        <div class="tabs-content">
          <div
            v-for="(service, index) in block.services"
            :key="service.id"
            v-show="activeTabIndex === index"
            class="tab-pane"
          >
            <div class="service-full-content">
              <div class="service-header">
                <div v-if="service.icon" class="service-icon">
                  <img :src="buildMediaUrl(service.icon)" :alt="service.title" />
                </div>
                <h3 class="service-title">{{ service.title }}</h3>
              </div>
              <div class="service-description" v-html="service.longDescription"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Accordion Mode -->
      <div 
        v-else-if="block.displayMode === 'accordion'" 
        class="services-accordion" 
        :class="`accordion-cols-${block.columnsCount || 1}`"
        :style="accordionGridStyles"
      >
        <div
          v-for="(service, index) in block.services"
          :key="service.id"
          class="accordion-item"
        >
          <button
            @click="toggleAccordion(index)"
            :class="['accordion-header', { active: isAccordionOpen(index) }]"
          >
            <div class="accordion-header-content">
              <div v-if="service.icon" class="accordion-icon">
                <img :src="buildMediaUrl(service.icon)" :alt="service.title" />
              </div>
              <div class="accordion-text">
                <span class="accordion-title">{{ service.title }}</span>
                <span class="accordion-description">{{ service.shortDescription }}</span>
              </div>
            </div>
            <div class="accordion-toggle">
              <Icon :name="isAccordionOpen(index) ? 'chevron-up' : 'chevron-down'" />
            </div>
          </button>
          
          <div
            :class="['accordion-content', { open: isAccordionOpen(index) }]"
            :style="{ maxHeight: isAccordionOpen(index) ? accordionHeights[index] + 'px' : '0px' }"
          >
            <div class="accordion-body" :ref="el => setAccordionRef(el, index)">
              <div class="service-full-content">
                <div class="service-description" v-html="service.longDescription"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Cards Mode -->
      <div v-else-if="block.displayMode === 'cards'" class="services-cards" :style="cardsGridStyles">
        <div
          v-for="service in block.services"
          :key="service.id"
          class="service-card"
        >
          <div class="card-header">
            <div v-if="service.icon" class="card-icon">
              <img :src="buildMediaUrl(service.icon)" :alt="service.title" />
            </div>
            <h3 class="card-title">{{ service.title }}</h3>
          </div>
          <div class="card-description-short">{{ service.shortDescription }}</div>
          <div class="card-description-long" v-html="service.longDescription"></div>
        </div>
      </div>
    </div>

    <!-- Empty State -->
    <div v-else class="services-empty">
      <div class="empty-state">
        <Icon name="briefcase" />
        <p>No hay servicios configurados para mostrar</p>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted, onUnmounted, nextTick, watch } from 'vue'
import Icon from '@/components/global/Icon.vue'
import type { ServicesBlock } from '@/types/blocks'
import { buildMediaUrl } from '@/utils/mediaUtils'

interface Props {
  block: ServicesBlock
}

const props = defineProps<Props>()

// State for tabs mode
const activeTabIndex = ref(0)

// State for accordion mode
const openAccordions = ref<Set<number>>(new Set())
const accordionHeights = ref<Record<number, number>>({})
const accordionRefs = ref<Record<number, HTMLElement>>({})

// Toggle accordion
const toggleAccordion = async (index: number) => {
  if (openAccordions.value.has(index)) {
    openAccordions.value.delete(index)
  } else {
    openAccordions.value.add(index)
  }
  
  await nextTick()
  calculateAccordionHeight(index)
}

// Check if accordion is open
const isAccordionOpen = (index: number) => {
  return openAccordions.value.has(index)
}

// Set accordion ref
const setAccordionRef = (el: HTMLElement | null, index: number) => {
  if (el) {
    accordionRefs.value[index] = el
  }
}

// Calculate accordion height
const calculateAccordionHeight = (index: number) => {
  const element = accordionRefs.value[index]
  if (element) {
    accordionHeights.value[index] = element.scrollHeight
  }
}

// Block styles
const blockStyles = computed(() => {
  const styles: Record<string, string> = {}
  
  if (props.block.backgroundColor) {
    styles.backgroundColor = props.block.backgroundColor
  }
  
  return styles
})

// Cards grid styles
const cardsGridStyles = computed(() => {
  const styles: Record<string, string> = {}
  
  if (props.block.displayMode === 'cards') {
    styles.gridTemplateColumns = `repeat(${props.block.columnsCount || 3}, 1fr)`
  }
  
  return styles
})

// Accordion grid styles
const accordionGridStyles = computed(() => {
  const styles: Record<string, string> = {}
  
  if (props.block.displayMode === 'accordion') {
    const columns = props.block.columnsCount || 1
    // Use CSS custom properties to allow responsive overrides
    styles['--accordion-columns'] = columns.toString()
    
    // Set grid template columns with fallback for older browsers
    if (columns === 1) {
      styles.gridTemplateColumns = '1fr'
    } else {
      styles.gridTemplateColumns = `repeat(${columns}, 1fr)`
    }
  }
  
  return styles
})

// Calculate all accordion heights on mount
onMounted(async () => {
  if (props.block.displayMode === 'accordion') {
    await nextTick()
    props.block.services.forEach((_, index) => {
      calculateAccordionHeight(index)
    })
  }
  applyCustomCSS()
})

// Custom CSS injection
let styleElement: HTMLStyleElement | null = null

const applyCustomCSS = () => {
  // Remove previous styles if they exist
  if (styleElement) {
    styleElement.remove()
    styleElement = null
  }

  // Apply new styles if there's custom CSS
  if (props.block.customCSS && props.block.customCSS.trim()) {
    styleElement = document.createElement('style')
    styleElement.type = 'text/css'
    styleElement.setAttribute('data-block-id', props.block.id)
    styleElement.setAttribute('data-custom-css', 'true')
    
    const blockSelector = `[data-block-id="${props.block.id}"]`
    let css = props.block.customCSS
    
    // Process each CSS rule individually
    const processedRules: string[] = []
    
    // Enhanced regex to find CSS rules
    const cssRuleRegex = /([^{}]+)\s*\{([^{}]*)\}/g
    let match
    
    while ((match = cssRuleRegex.exec(css)) !== null) {
      let selector = match[1].trim()
      const properties = match[2].trim()
      
      if (selector && properties) {
        // Clean comments from selector
        selector = selector.replace(/\/\*.*?\*\//g, '').trim()
        
        if (selector) {
          // If selector already has our data-block-id, don't modify it
          if (selector.includes(`[data-block-id="${props.block.id}"]`)) {
            processedRules.push(`${selector} { ${properties} !important }`)
          } else {
            // Multiple variants for maximum compatibility
            
            // 1. Direct selector in the block
            processedRules.push(`${blockSelector} ${selector} { ${properties} !important }`)
            
            // 2. If it's a class selector, also apply it to the container
            if (selector.match(/^\.[a-zA-Z][\w-]*$/)) {
              processedRules.push(`${blockSelector}${selector} { ${properties} !important }`)
            }
            
            // 3. If it's an ID selector, also apply it to the container
            if (selector.match(/^#[a-zA-Z][\w-]*$/)) {
              processedRules.push(`${blockSelector}${selector} { ${properties} !important }`)
            }
            
            // 4. For nested blocks in containers, add extra specificity
            processedRules.push(`.services-block ${blockSelector} ${selector} { ${properties} !important }`)
            
            // 5. For global elements, use body as prefix for maximum specificity
            processedRules.push(`body ${blockSelector} ${selector} { ${properties} !important }`)
          }
        }
      }
    }
    
    const scopedCSS = processedRules.join('\n')
    styleElement.textContent = scopedCSS
    document.head.appendChild(styleElement)
    
    console.log('🎨 CSS applied for services block:', props.block.id)
  }
}

const removeCustomCSS = () => {
  if (styleElement) {
    styleElement.remove()
    styleElement = null
  }
}

// Clean up CSS when component unmounts
onUnmounted(() => {
  removeCustomCSS()
})

// Reactive to changes in custom CSS
watch(() => props.block.customCSS, () => {
  applyCustomCSS()
})
</script>

<style scoped>
.services-block {
  width: 100%;
  padding: 6% 14% !important;
  min-height: 400px;
}

/* Padding */
.padding-small { padding: 1rem; }
.padding-medium { padding: 2rem; }
.padding-large { padding: 3rem; }
.padding-none { padding: 0; }

/* Alignment */
.align-left { text-align: left; }
.align-center { text-align: center; }
.align-right { text-align: right; }

/* Gap */
.gap-none .services-container > * + * { margin-top: 0; }
.gap-small .services-container > * + * { margin-top: 1rem; }
.gap-medium .services-container > * + * { margin-top: 2rem; }
.gap-large .services-container > * + * { margin-top: 3rem; }

/* Header */
.services-header {
  margin-bottom: 2rem;
}

.services-title {
  margin: 0 0 0.5rem 0;
}

.services-subtitle {
  font-size: 1.2rem;
  color: #6c757d;
  margin: 0;
}

/* Icon Sizes */
.icon-size-small .tab-icon img,
.icon-size-small .accordion-icon img,
.icon-size-small .card-icon img,
.icon-size-small .service-icon img {
  width: 32px;
  height: 32px;
}

.icon-size-medium .tab-icon img,
.icon-size-medium .accordion-icon img,
.icon-size-medium .card-icon img,
.icon-size-medium .service-icon img {
  width: 48px;
  height: 48px;
}

.icon-size-large .tab-icon img,
.icon-size-large .accordion-icon img,
.icon-size-large .card-icon img,
.icon-size-large .service-icon img {
  width: 64px;
  height: 64px;
}

/* === TABS MODE === */
.services-tabs {
  width: 100%;
}

.tabs-nav {
  display: flex;
  flex-wrap: wrap;
  border-bottom: 2px solid #e9ecef;
  background: #f8f9fa;
  border-radius: 8px 8px 0 0;
  overflow: hidden;
}

.tab-button {
  flex: 1;
  min-width: 200px;
  padding: 1.5rem;
  border: none;
  background: transparent;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 1rem;
  text-align: left;
  border-bottom: 3px solid transparent;
}

.tab-button:hover {
  background: rgba(0, 123, 255, 0.1);
}

.tab-button.active {
  background: white;
  border-bottom-color: #007bff;
}

.tab-icon {
  flex-shrink: 0;
  display: flex;
  align-items: center;
  justify-content: center;
}

.tab-icon img {
  object-fit: contain;
}

.tab-content {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.tab-title {
  font-weight: 600;
  color: #2c3e50;
  font-size: 1.1rem;
}

.tab-description {
  color: #6c757d;
  font-size: 0.9rem;
}

.tabs-content {
  background: white;
  border-radius: 0 0 8px 8px;
  border: 1px solid #e9ecef;
  border-top: none;
}

.tab-pane {
  padding: 2rem;
}

/* === ACCORDION MODE === */
.services-accordion {
  width: 100%;
  display: grid;
  gap: 2rem;
  grid-template-columns: 1fr;
}

/* Accordion column classes */
.services-accordion.accordion-cols-1 {
  grid-template-columns: 1fr;
}

.services-accordion.accordion-cols-2 {
  grid-template-columns: repeat(2, 1fr);
}

.services-accordion.accordion-cols-3 {
  grid-template-columns: repeat(3, 1fr);
}

.services-accordion.accordion-cols-4 {
  grid-template-columns: repeat(4, 1fr);
}

/* Ensure smooth transitions */
.services-accordion {
  transition: gap 0.3s ease;
}

.accordion-item {
  overflow: hidden;
  margin-bottom: 0;
  transition: all 0.3s ease;
}

.accordion-header {
  background: transparent;
  width: 100%;
  padding: 1.5rem;
  border-top: none;
  border-left: none;
  border-right: none;
  border-bottom: #d1ae6a 2px solid;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: space-between;
  text-align: left;
}

.accordion-header:hover {
  background: transparent;
}

.accordion-header.active {
  color: #d1ae6a;
}

.accordion-header.active .accordion-title,
.accordion-header.active .accordion-description {
  color: #d1ae6a;
}

.accordion-header-content {
  display: flex;
  align-items: center;
  gap: 1rem;
  flex: 1;
}

.accordion-icon {
  flex-shrink: 0;
  display: flex;
  align-items: center;
  justify-content: center;
}

.accordion-icon img {
  object-fit: contain;
}

.accordion-text {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.accordion-title {
  font-weight: 600;
  color: #2c3e50;
  font-size: 1.1rem;
}

.accordion-description {
  color: #6c757d;
  font-size: 0.9rem;
}

.accordion-toggle {
  margin-left: 1rem;
  color: #d1ae6a;
  transition: transform 0.3s ease;
}

.services-accordion .accordion-item .icon-global{
 font-size:8px;
 width:30px;
 border-style:solid;
 height:30px;
 border-top-left-radius:50px;
 border-top-right-radius:50px;
 border-bottom-left-radius:50px;
 border-bottom-right-radius:50px;
 border-width:1px;
}

.accordion-header.active .accordion-toggle {
  color: white;
  transform: rotate(180deg);
}

.accordion-content {
  overflow: hidden;
  transition: max-height 0.3s ease;
  background: transparent;
}

.accordion-body {
  padding: 1.5rem;
  border-top: 1px solid #e9ecef;
}

/* === CARDS MODE === */
.services-cards {
  display: grid;
  gap: 2rem;
  grid-template-columns: repeat(3, 1fr);
}

.service-card {
  background: white;
  border: 1px solid #e9ecef;
  border-radius: 8px;
  padding: 2rem;
  transition: all 0.3s ease;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.service-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 24px rgba(0,0,0,0.15);
}

.card-header {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1rem;
}

.card-icon {
  flex-shrink: 0;
  display: flex;
  align-items: center;
  justify-content: center;
}

.card-icon img {
  object-fit: contain;
}

.card-title {
  font-weight: 600;
  color: #2c3e50;
  margin: 0;
  font-size: 1.25rem;
}

.card-description-short {
  color: #6c757d;
  margin-bottom: 1rem;
  font-size: 0.95rem;
}

.card-description-long {
  color: #495057;
}

/* === SHARED STYLES === */
.service-full-content {
  width: 100%;
}

.service-header {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1rem;
}

.service-icon {
  flex-shrink: 0;
  display: flex;
  align-items: center;
  justify-content: center;
}

.service-icon img {
  object-fit: contain;
}

.service-title {
  font-weight: 600;
  color: #2c3e50;
  margin: 0;
  font-size: 1.5rem;
}

.service-description {
  color: #495057;
  line-height: 1.6;
}

.service-description :deep(h1),
.service-description :deep(h2),
.service-description :deep(h3),
.service-description :deep(h4),
.service-description :deep(h5),
.service-description :deep(h6) {
  color: #2c3e50;
  margin-top: 1.5rem;
  margin-bottom: 0.5rem;
}

.service-description :deep(p) {
  margin-bottom: 1rem;
}

.service-description :deep(ul),
.service-description :deep(ol) {
  margin-bottom: 1rem;
  padding-left: 2rem;
}

.service-description :deep(strong) {
  font-weight: 600;
}

/* Empty State */
.services-empty {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 200px;
  color: #6c757d;
}

.empty-state {
  text-align: center;
}

.empty-state p {
  margin: 1rem 0 0 0;
  font-size: 1.1rem;
}

/* Responsive Accordion Columns */
@media (max-width: 1200px) {
  .services-accordion.accordion-cols-4 {
    grid-template-columns: repeat(3, 1fr) !important;
  }
  
  .services-cards {
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)) !important;
  }
}

@media (max-width: 1024px) {
  .services-accordion.accordion-cols-4,
  .services-accordion.accordion-cols-3 {
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 1.5rem;
  }
  
  .services-cards {
    grid-template-columns: repeat(2, 1fr) !important;
  }
  
  .tab-button {
    min-width: 150px;
    padding: 1rem;
  }
}

@media (max-width: 900px) {
  .services-accordion.accordion-cols-4,
  .services-accordion.accordion-cols-3,
  .services-accordion.accordion-cols-2 {
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 1.25rem;
  }
  
  .services-accordion.accordion-cols-1 {
    gap: 1.5rem;
  }
}

@media (max-width: 768px) {
  .services-cards {
    grid-template-columns: 1fr !important;
  }
  
  .services-accordion.accordion-cols-4,
  .services-accordion.accordion-cols-3,
  .services-accordion.accordion-cols-2,
  .services-accordion.accordion-cols-1 {
    grid-template-columns: 1fr !important;
    gap: 1rem;
  }
  
  .tabs-nav {
    flex-direction: column;
  }
  
  .tab-button {
    min-width: auto;
    width: 100%;
  }
  
  .accordion-header-content {
    gap: 0.75rem;
  }
  
  .service-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.75rem;
  }
  
  .card-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.75rem;
  }
  
  .services-title {
    font-size: 1.75rem;
  }
  
  .services-subtitle {
    font-size: 1.1rem;
  }
}

@media (max-width: 480px) {
  .services-block {
    padding: 8% 6% !important;
  }
  
  .services-accordion {
    gap: 0.75rem;
  }
  
  .accordion-header {
    padding: 1rem;
  }
  
  .accordion-body {
    padding: 1rem;
  }
  
  .padding-small { padding: 0.5rem; }
  .padding-medium { padding: 1rem; }
  .padding-large { padding: 1.5rem; }
  
  .tab-pane {
    padding: 1rem;
  }
  
  .service-card {
    padding: 1.5rem;
  }
}
</style>