<template>
  <div 
    class="block-renderer"
    :id="block.customId || undefined"
    :class="[
      block.customClass || '', 
      `block-${block.type}`, 
      { 
        'has-custom-css': !!block.customCSS, 
        'is-nested': isNested,
        'nested-in-container': isNested
      }
    ]"
    :data-block-id="block.id"
    :data-block-type="block.type"
    :data-custom-id="block.customId || null"
    :data-custom-class="block.customClass || null"
  >
    <!-- Controles para bloques anidados en modo edición -->
    <div v-if="isEditing && isNested" class="nested-block-controls">
      <div class="block-actions">
        <button 
          v-if="block.type === 'container'" 
          @click="handleAddBlock" 
          class="btn-add-nested"
          title="Agregar bloque al contenedor"
        >
          <Icon name="plus" />
        </button>
        <button @click="handleEditChild" class="btn-edit" title="Editar bloque">
          <Icon name="edit" />
        </button>
        <button @click="handleDuplicateChild" class="btn-duplicate" title="Duplicar bloque">
          <Icon name="copy" />
        </button>
        <button @click="handleDeleteChild" class="btn-delete" title="Eliminar bloque">
          <Icon name="delete" />
        </button>
      </div>
    </div>
    
    <component 
      :is="getBlockComponent(block.type)"
      :block="block"
      :is-editing="isEditing"
      :key="block.id"
      @add-block="$emit('add-block', $event)"
      @edit-child="handleChildEdit"
      @duplicate-child="handleChildDuplicate"
      @delete-child="handleChildDelete"
    />
  </div>
</template>

<script setup lang="ts">
import { markRaw, onMounted, onUnmounted, watch } from 'vue'
import type { Block } from '@/types/blocks'
import TextBlock from './TextBlock.vue'
import SpacerBlock from './SpacerBlock.vue'
import BannerIntegraBlock from './BannerIntegraBlock.vue'
import CualidadesBlock from './CualidadesBlock.vue'
import TextoyVideoBlock from './TextoyVideoBlock.vue'
import ContainerBlock from './ContainerBlock.vue'
import ImageGalleryBlock from './ImageGalleryBlock.vue'
import TeamBlock from './TeamBlock.vue'
import ServicesBlock from './ServicesBlock.vue'
import MapBlock from './MapBlock.vue'
import LeadConverterBlock from './LeadConverterBlock.vue'

interface Props {
  block: Block
  isEditing?: boolean
  isNested?: boolean
}

interface Emits {
  (e: 'add-block', containerId: string): void
  (e: 'edit-child', block: Block): void
  (e: 'duplicate-child', block: Block): void
  (e: 'delete-child', block: Block): void
}

const props = withDefaults(defineProps<Props>(), {
  isNested: false
})
const emit = defineEmits<Emits>()

const blockComponents = {
  text: markRaw(TextBlock),
  spacer: markRaw(SpacerBlock),
  'banner-integra': markRaw(BannerIntegraBlock),
  'cualidades': markRaw(CualidadesBlock),
  'textoy-video': markRaw(TextoyVideoBlock),
  'container': markRaw(ContainerBlock),
  'image-gallery': markRaw(ImageGalleryBlock),
  'team': markRaw(TeamBlock),
  'services': markRaw(ServicesBlock),
  'map': markRaw(MapBlock),
  'lead-converter': markRaw(LeadConverterBlock)
}

const getBlockComponent = (type: string) => {
  return blockComponents[type as keyof typeof blockComponents] || markRaw(TextBlock)
}

const getBlockTypeName = (type: string): string => {
  const typeNames: Record<string, string> = {
    'text': 'Texto',
    'spacer': 'Espaciador',
    'banner-integra': 'Banner R-Integra',
    'cualidades': 'Cualidades',
    'textoy-video': 'Texto y Video',
    'container': 'Contenedor',
    'image-gallery': 'Galería de Imágenes',
    'team': 'Equipo de Trabajo',
    'services': 'Servicios',
    'map': 'Mapa de Google',
    'lead-converter': 'Conversor de Leads'
  }
  return typeNames[type] || 'Bloque'
}

const getBlockTitle = (block: Block): string => {
  switch (block.type) {
    case 'text':
      const textBlock = block as any
      if (textBlock.columns && textBlock.columns.length > 0) {
        const firstColumn = textBlock.columns[0]
        if (firstColumn.texts && firstColumn.texts.length > 0) {
          const firstText = firstColumn.texts[0].content?.replace(/<[^>]*>/g, '') || ''
          return firstText.substring(0, 30) + (firstText.length > 30 ? '...' : '')
        }
      }
      return 'Bloque de texto vacío'
    case 'spacer':
      return `Espaciador ${(block as any).height}px`
    case 'banner-integra':
      return (block as any).title || 'Banner R-Integra'
    case 'cualidades':
      return (block as any).title || 'Cualidades'
    case 'textoy-video':
      return (block as any).title || 'Texto y Video'
    case 'container':
      const childCount = (block as any).children?.length || 0
      return `Contenedor (${childCount} bloques)`
    case 'image-gallery':
      const imageCount = (block as any).items?.length || 0
      const columns = (block as any).columnsCount || 1
      return `Galería (${imageCount} imágenes, ${columns} columnas)`
    case 'team':
      const memberCount = (block as any).members?.length || 0
      const teamColumns = (block as any).columnsCount || 1
      return `Equipo (${memberCount} miembros, ${teamColumns} columnas)`
    case 'services':
      const servicesCount = (block as any).services?.length || 0
      const displayMode = (block as any).displayMode || 'tabs'
      return `Servicios (${servicesCount} servicios, ${displayMode})`
    case 'map':
      const mapBlock = block as any
      return mapBlock.title || mapBlock.address || 'Mapa de Google'
    case 'lead-converter':
      const leadBlock = block as any
      return leadBlock.headline ? leadBlock.headline.substring(0, 50) + '...' : 'Conversor de Leads'
    default:
      return 'Bloque personalizado'
  }
}

const handleEditChild = () => {
  console.log('Edit child clicked:', props.block)
  emit('edit-child', props.block)
}

const handleDuplicateChild = () => {
  console.log('Duplicate child clicked:', props.block)
  emit('duplicate-child', props.block)
}

const handleDeleteChild = () => {
  console.log('Delete child clicked:', props.block)
  emit('delete-child', props.block)
}

const handleAddBlock = () => {
  console.log('Add block clicked for container:', props.block.id)
  emit('add-block', props.block.id)
}

// Funciones para reenviar eventos desde componentes hijos
const handleChildEdit = (childBlock: any) => {
  console.log('BlockRenderer - forwarding edit-child:', childBlock)
  emit('edit-child', childBlock)
}

const handleChildDuplicate = (childBlock: any) => {
  console.log('BlockRenderer - forwarding duplicate-child:', childBlock)
  emit('duplicate-child', childBlock)
}

const handleChildDelete = (childBlock: any) => {
  console.log('BlockRenderer - forwarding delete-child:', childBlock)
  emit('delete-child', childBlock)
}

// Manejo de CSS personalizado
let styleElement: HTMLStyleElement | null = null

const applyCustomCSS = () => {
  // Remover estilos anteriores si existen
  if (styleElement) {
    styleElement.remove()
    styleElement = null
  }

  // Aplicar nuevos estilos si hay CSS personalizado
  if (props.block.customCSS && props.block.customCSS.trim()) {
    styleElement = document.createElement('style')
    styleElement.type = 'text/css'
    styleElement.setAttribute('data-block-id', props.block.id)
    styleElement.setAttribute('data-custom-css', 'true')
    
    const blockSelector = `[data-block-id="${props.block.id}"]`
    let css = props.block.customCSS
    
    // Procesar cada regla CSS individualmente
    const processedRules: string[] = []
    
    // Regex mejorado para encontrar reglas CSS
    const cssRuleRegex = /([^{}]+)\s*\{([^{}]*)\}/g
    let match
    
    while ((match = cssRuleRegex.exec(css)) !== null) {
      let selector = match[1].trim()
      const properties = match[2].trim()
      
      if (selector && properties) {
        // Limpiar comentarios del selector
        selector = selector.replace(/\/\*.*?\*\//g, '').trim()
        
        if (selector) {
          // Si el selector ya tiene nuestro data-block-id, no lo modificamos
          if (selector.includes(`[data-block-id="${props.block.id}"]`)) {
            processedRules.push(`${selector} { ${properties} !important }`)
          } else {
            // Múltiples variantes para máxima compatibilidad
            
            // 1. Selector directo en el bloque
            processedRules.push(`${blockSelector} ${selector} { ${properties} !important }`)
            
            // 2. Si es un selector de clase, también aplicarlo al contenedor
            if (selector.match(/^\.[a-zA-Z][\w-]*$/)) {
              processedRules.push(`${blockSelector}${selector} { ${properties} !important }`)
            }
            
            // 3. Si es un selector de ID, también aplicarlo al contenedor
            if (selector.match(/^#[a-zA-Z][\w-]*$/)) {
              processedRules.push(`${blockSelector}${selector} { ${properties} !important }`)
            }
            
            // 4. Para bloques anidados en contenedores, agregar especificidad extra
            processedRules.push(`.container-block ${blockSelector} ${selector} { ${properties} !important }`)
            
            // 5. Para elementos globales, usar body como prefijo para máxima especificidad
            processedRules.push(`body ${blockSelector} ${selector} { ${properties} !important }`)
            
            // 6. Para selectores de etiquetas HTML simples, agregar todas las variaciones
            if (selector.match(/^[a-zA-Z][a-zA-Z0-9]*$/)) {
              processedRules.push(`body .container-block ${blockSelector} ${selector} { ${properties} !important }`)
              processedRules.push(`html body ${blockSelector} ${selector} { ${properties} !important }`)
            }
          }
        }
      }
    }
    
    const scopedCSS = processedRules.join('\n')
    styleElement.textContent = scopedCSS
    document.head.appendChild(styleElement)
    
    console.log('🎨 CSS aplicado para bloque:', props.block.id)
    console.log('📝 CSS original:', css)
    console.log('🔧 CSS procesado:', scopedCSS)
  }
}

const removeCustomCSS = () => {
  if (styleElement) {
    styleElement.remove()
    styleElement = null
  }
}

// Aplicar CSS cuando el componente se monta
onMounted(() => {
  applyCustomCSS()
})

// Limpiar CSS cuando el componente se desmonta
onUnmounted(() => {
  removeCustomCSS()
})

// Reactivo a cambios en el CSS personalizado
watch(() => props.block.customCSS, () => {
  applyCustomCSS()
})
</script>

<style scoped>
.block-renderer {
  width: 100%;
}

.is-nested {
  position: relative;
  margin-bottom: 1rem;
}

.nested-block-controls {
  position: absolute;
  top: 8px;
  right: 8px;
  z-index: 1500;
  background: rgba(248, 249, 250, 0.98);
  border: 1px solid #dee2e6;
  border-radius: 6px;
  opacity: 1;
  transform: translateY(0);
  transition: all 0.3s ease;
  pointer-events: all;
  width: fit-content;
  backdrop-filter: blur(4px);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}


.block-actions {
  display: flex;
  gap: 0.25rem;
  padding: 0.5rem;
}

.btn-add-nested,
.btn-edit,
.btn-duplicate,
.btn-delete {
  padding: 0.25rem 0.5rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 0.75rem;
  transition: all 0.2s ease;
}

.btn-add-nested {
  background: transparent;
  color: #007bff;
  border: 1px solid #007bff;
}

.btn-edit {
  background: transparent;
  color: #17a2b8;
  border: 1px solid #17a2b8;
}

.btn-duplicate {
  background: transparent;
  color: #28a745;
  border: 1px solid #28a745;
}

.btn-delete {
  background: transparent;
  color: #dc3545;
  border: 1px solid #dc3545;
}

.btn-add-nested:hover {
  background: #007bff;
  color: white;
}

.btn-edit:hover {
  background: #17a2b8;
  color: white;
}

.btn-duplicate:hover {
  background: #28a745;
  color: white;
}

.btn-delete:hover {
  background: #dc3545;
  color: white;
}
</style>