<template>
  <div class="block-editor">
    <div class="editor-header">
      <h3>Editor de Bloques</h3>
      <div class="header-actions">
        <button @click="showBlockSelector = true" class="btn-primary">
          <Icon name="plus" />
          Agregar Bloque
        </button>
      </div>
    </div>

    <!-- Vista previa de bloques -->
    <div class="blocks-preview">
      <div v-if="blocks.length === 0" class="empty-state">
        <Icon name="cube" />
        <h4>No hay bloques</h4>
        <p>Comienza agregando tu primer bloque de contenido</p>
        <button @click="showBlockSelector = true" class="btn-primary">
          <Icon name="plus" />
          Agregar Primer Bloque
        </button>
      </div>

      <div v-else class="blocks-list">
        <div 
          v-for="(block, index) in blocks" 
          :key="block.id"
          class="block-item" 
          :class="{ active: selectedBlock?.id === block.id }"
        >
          <div class="block-controls">
            <div class="move-buttons">
              <button 
                @click="moveBlockUp(index)" 
                :disabled="index === 0"
                class="btn-move"
                title="Mover arriba"
              >
                <Icon name="chevron-up" />
              </button>
              <button 
                @click="moveBlockDown(index)" 
                :disabled="index === blocks.length - 1"
                class="btn-move"
                title="Mover abajo"
              >
                <Icon name="chevron-down" />
              </button>
            </div>
            <div class="block-info">
              <span class="block-type">{{ getBlockTypeName(block.type) }}</span>
              <span class="block-title">{{ getBlockTitle(block) }}</span>
            </div>
            <div class="block-actions">
              <!-- Botón para agregar bloque al contenedor -->
              <button 
                v-if="block.type === 'container'" 
                @click="handleAddNestedBlock(block.id)" 
                class="btn-add-nested"
                title="Agregar bloque al contenedor"
              >
                <Icon name="plus" />
              </button>
              <button @click="editBlock(block)" class="btn-edit">
                <Icon name="edit" />
              </button>
              <button @click="duplicateBlock(block)" class="btn-duplicate">
                <Icon name="copy" />
              </button>
              <button @click="deleteBlock(index)" class="btn-delete">
                <Icon name="delete" />
              </button>
            </div>
          </div>
          
          <!-- Preview del bloque -->
          <div class="block-preview">
            <BlockRenderer 
              :block="block" 
              :is-editing="true" 
              @add-block="handleAddNestedBlock"
              @edit-child="editBlock"
              @duplicate-child="handleDuplicateNestedBlock"
              @delete-child="handleDeleteNestedBlock"
            />
          </div>
          
        </div>
      </div>
    </div>

    <!-- Modal selector de bloques -->
    <div v-if="showBlockSelector" class="modal-overlay" @click="cancelBlockSelector">
      <div class="modal-content" @click.stop>
        <div class="modal-header">
          <h4>{{ targetContainerId ? 'Agregar Bloque al Contenedor' : 'Seleccionar Bloque' }}</h4>
          <button @click="cancelBlockSelector" class="btn-close">
            <Icon name="close" />
          </button>
        </div>
        <div v-if="targetContainerId" class="modal-info">
          <i class="fas fa-info-circle"></i>
          Los contenedores no pueden contener otros contenedores anidados
        </div>
        <div class="block-templates">
          <div 
            v-for="template in availableTemplates" 
            :key="template.type"
            class="template-card"
            @click="addBlock(template.type)"
          >
            <div class="template-icon">
              <i :class="template.icon"></i>
            </div>
            <h5>{{ template.name }}</h5>
            <p>{{ template.description }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal editor de bloque -->
    <component 
      :is="getBlockEditorComponent(selectedBlock?.type)"
      v-if="showBlockEditor && selectedBlock"
      :block="selectedBlock as any"
      @update="updateBlock"
      @update-real-time="updateBlockRealTime"
      @close="closeBlockEditor"
    />
  </div>
</template>

<script setup lang="ts">
import { ref, computed, markRaw, watch } from 'vue'
import BlockRenderer from '@/components/blocks/BlockRenderer.vue'
import BannerIntegraEditor from './BannerIntegraEditor.vue'
import CualidadesBlockEditor from './CualidadesBlockEditor.vue'
import TextoyVideoBlockEditor from './TextoyVideoBlockEditor.vue'
import TextBlockEditor from './TextBlockEditor.vue'
import ContainerBlockEditor from './ContainerBlockEditor.vue'
import ImageGalleryBlockEditor from './ImageGalleryBlockEditor.vue'
import TeamBlockEditor from './TeamBlockEditor.vue'
import ServicesBlockEditor from './ServicesBlockEditor.vue'
import MapBlockEditor from './MapBlockEditor.vue'
import ContactBlockEditor from './ContactBlockEditor.vue'
import LeadConverterBlockEditor from './LeadConverterBlockEditor.vue'
import { useBlockTemplates } from '@/composables/useBlockTemplates'
import type { Block } from '@/types/blocks'

interface Props {
  modelValue: Block[]
  pageId?: number
  isFullPage?: boolean
}

interface Emits {
  (e: 'update:modelValue', value: Block[]): void
  (e: 'save', blocks: Block[]): void
}

const props = withDefaults(defineProps<Props>(), {
  isFullPage: false
})
const emit = defineEmits<Emits>()

const { blockTemplates, createBlockFromTemplate, generateId } = useBlockTemplates()

const blocks = ref<Block[]>([])

// Sincronizar con el modelValue
watch(() => props.modelValue, (newValue) => {
  blocks.value = newValue || []
}, { immediate: true })

// Emitir cambios cuando se actualice la lista
watch(blocks, (newBlocks) => {
  emit('update:modelValue', newBlocks)
}, { deep: true })

const saving = ref(false)
const showBlockSelector = ref(false)
const showBlockEditor = ref(false)
const selectedBlock = ref<Block | null>(null)
const targetContainerId = ref<string | null>(null)

// Computed property para filtrar templates disponibles
const availableTemplates = computed(() => {
  // Si estamos agregando a un contenedor específico, excluir el tipo 'container'
  if (targetContainerId.value) {
    return blockTemplates.filter(template => template.type !== 'container')
  }
  // Si es agregar a nivel global, mostrar todos los templates
  return blockTemplates
})

const getBlockTypeName = (type?: string): string => {
  const template = blockTemplates.find(t => t.type === type)
  return template?.name || 'Bloque'
}

const findBlockById = (blockId: string): any => {
  // Buscar en bloques principales
  for (const block of blocks.value) {
    if (block.id === blockId) {
      return block
    }
    // Buscar recursivamente en contenedores
    if (block.type === 'container' && (block as any).children) {
      const found = findBlockInChildren((block as any).children, blockId)
      if (found) return found
    }
  }
  return null
}

const findBlockInChildren = (children: any[], blockId: string): any => {
  for (const child of children) {
    if (child.id === blockId) {
      return child
    }
    if (child.type === 'container' && child.children) {
      const found = findBlockInChildren(child.children, blockId)
      if (found) return found
    }
  }
  return null
}

const getBlockTitle = (block: Block): string => {
  switch (block.type) {
    case 'hero':
      return (block as any).title || 'Hero sin título'
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
    case 'image':
      return (block as any).alt || 'Imagen'
    case 'cta':
      return (block as any).title || 'Call to Action'
    case 'columns':
      const columnCount = (block as any).columnsCount || 0
      return `${columnCount} columnas`
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
    case 'team':
      const memberCount = (block as any).members?.length || 0
      return `Equipo (${memberCount} miembros)`
    case 'image-gallery':
      const imageCount = (block as any).items?.length || 0
      return `Galería (${imageCount} imágenes)`
    case 'services':
      const servicesCount = (block as any).services?.length || 0
      return `Servicios (${servicesCount} servicios)`
    case 'contact':
      const contactBlock = block as any
      const contactItemsCount = contactBlock.contactItems?.length || 0
      return contactBlock.title || `Contacto (${contactItemsCount} tarjetas)`
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

const addBlock = (type: string) => {
  const newBlock = createBlockFromTemplate(type)
  if (newBlock) {
    if (targetContainerId.value) {
      // Agregar bloque a un contenedor específico
      const containerBlock = findBlockById(targetContainerId.value)
      if (containerBlock && containerBlock.type === 'container') {
        if (!containerBlock.children) {
          containerBlock.children = []
        }
        newBlock.order = containerBlock.children.length
        containerBlock.children.push(newBlock)
        console.log('Block added to container:', targetContainerId.value, newBlock)
      }
      targetContainerId.value = null
    } else {
      // Agregar bloque al nivel principal
      newBlock.order = blocks.value.length
      blocks.value.push(newBlock)
    }
    showBlockSelector.value = false
    targetContainerId.value = null // Limpiar siempre al cerrar
  }
}

const editBlock = (block: Block) => {
  console.log('BlockEditor - editBlock:', block)
  selectedBlock.value = { ...block }
  showBlockEditor.value = true
}

const updateBlock = (updatedBlock: Block) => {
  // Primero buscar en el nivel principal
  const index = blocks.value.findIndex(b => b.id === updatedBlock.id)
  if (index !== -1) {
    blocks.value[index] = updatedBlock
    closeBlockEditor()
    return
  }
  
  // Si no se encuentra en el nivel principal, buscar en bloques anidados
  const updateNestedBlock = (blocksList: Block[], targetBlock: Block): boolean => {
    for (let i = 0; i < blocksList.length; i++) {
      const block = blocksList[i]
      
      // Si este bloque es un contenedor, buscar en sus hijos
      if (block.type === 'container' && (block as any).children) {
        const children = (block as any).children as Block[]
        
        // Buscar en los hijos directos
        const childIndex = children.findIndex(child => child.id === targetBlock.id)
        if (childIndex !== -1) {
          children[childIndex] = targetBlock
          console.log('✅ Bloque anidado actualizado:', targetBlock.id, targetBlock)
          return true
        }
        
        // Búsqueda recursiva en hijos anidados
        if (updateNestedBlock(children, targetBlock)) {
          return true
        }
      }
    }
    return false
  }
  
  // Intentar actualizar en bloques anidados
  if (updateNestedBlock(blocks.value, updatedBlock)) {
    console.log('✅ Bloque anidado actualizado exitosamente')
  } else {
    console.warn('❌ No se pudo encontrar el bloque para actualizar:', updatedBlock.id)
  }
  
  closeBlockEditor()
}

// Función para actualizar bloque sin cerrar el editor (para cambios en tiempo real)
const updateBlockRealTime = (updatedBlock: Block) => {
  // Primero buscar en el nivel principal
  const index = blocks.value.findIndex(b => b.id === updatedBlock.id)
  if (index !== -1) {
    blocks.value[index] = updatedBlock
    // También actualizar el selectedBlock para mantener sincronización
    if (selectedBlock.value && selectedBlock.value.id === updatedBlock.id) {
      selectedBlock.value = updatedBlock
    }
    return
  }
  
  // Si no se encuentra en el nivel principal, buscar en bloques anidados
  const updateNestedBlockRealTime = (blocksList: Block[], targetBlock: Block): boolean => {
    for (let i = 0; i < blocksList.length; i++) {
      const block = blocksList[i]
      
      // Si este bloque es un contenedor, buscar en sus hijos
      if (block.type === 'container' && (block as any).children) {
        const children = (block as any).children as Block[]
        
        // Buscar en los hijos directos
        const childIndex = children.findIndex(child => child.id === targetBlock.id)
        if (childIndex !== -1) {
          children[childIndex] = targetBlock
          return true
        }
        
        // Búsqueda recursiva en hijos anidados
        if (updateNestedBlockRealTime(children, targetBlock)) {
          return true
        }
      }
    }
    return false
  }
  
  // Intentar actualizar en bloques anidados
  updateNestedBlockRealTime(blocks.value, updatedBlock)
  
  // También actualizar el selectedBlock para mantener sincronización
  if (selectedBlock.value && selectedBlock.value.id === updatedBlock.id) {
    selectedBlock.value = updatedBlock
  }
}

const duplicateBlock = (block: Block) => {
  const newBlock = {
    ...block,
    id: generateId(),
    order: blocks.value.length
  }
  blocks.value.push(newBlock)
}

const deleteBlock = (index: number) => {
  if (confirm('¿Estás seguro de eliminar este bloque?')) {
    blocks.value.splice(index, 1)
    updateBlockOrder()
  }
}

const updateBlockOrder = () => {
  blocks.value.forEach((block, index) => {
    block.order = index
  })
}

const moveBlockUp = (index: number) => {
  if (index > 0) {
    const temp = blocks.value[index]
    blocks.value[index] = blocks.value[index - 1]
    blocks.value[index - 1] = temp
    updateBlockOrder()
  }
}

const moveBlockDown = (index: number) => {
  if (index < blocks.value.length - 1) {
    const temp = blocks.value[index]
    blocks.value[index] = blocks.value[index + 1]
    blocks.value[index + 1] = temp
    updateBlockOrder()
  }
}

const cancelBlockSelector = () => {
  showBlockSelector.value = false
  targetContainerId.value = null
}

const closeBlockEditor = () => {
  showBlockEditor.value = false
  selectedBlock.value = null
}

const saveBlocks = async () => {
  saving.value = true
  try {
    emit('save', blocks.value)
    await new Promise(resolve => setTimeout(resolve, 500))
  } finally {
    saving.value = false
  }
}

const blockEditorComponents = {
  'banner-integra': markRaw(BannerIntegraEditor),
  'cualidades': markRaw(CualidadesBlockEditor),
  'textoy-video': markRaw(TextoyVideoBlockEditor),
  'text': markRaw(TextBlockEditor),
  'container': markRaw(ContainerBlockEditor),
  'image-gallery': markRaw(ImageGalleryBlockEditor),
  'team': markRaw(TeamBlockEditor),
  'services': markRaw(ServicesBlockEditor),
  'contact': markRaw(ContactBlockEditor),
  'map': markRaw(MapBlockEditor),
  'lead-converter': markRaw(LeadConverterBlockEditor)
  // Aquí se pueden agregar más editores específicos en el futuro
}

const getBlockEditorComponent = (type?: string) => {
  if (!type) return null
  return blockEditorComponents[type as keyof typeof blockEditorComponents] || null
}

const handleAddNestedBlock = (containerId: string) => {
  console.log('BlockEditor - handleAddNestedBlock to container:', containerId)
  targetContainerId.value = containerId
  showBlockSelector.value = true
}

const moveNestedBlockUp = (containerId: string, index: number) => {
  const container = findBlockById(containerId)
  if (container && container.children && index > 0) {
    const temp = container.children[index]
    container.children[index] = container.children[index - 1]
    container.children[index - 1] = temp
    updateNestedBlockOrder(container)
  }
}

const moveNestedBlockDown = (containerId: string, index: number) => {
  const container = findBlockById(containerId)
  if (container && container.children && index < container.children.length - 1) {
    const temp = container.children[index]
    container.children[index] = container.children[index + 1]
    container.children[index + 1] = temp
    updateNestedBlockOrder(container)
  }
}

const duplicateNestedBlock = (containerId: string, block: Block) => {
  const container = findBlockById(containerId)
  if (container && container.children) {
    const newBlock = {
      ...block,
      id: generateId(),
      order: container.children.length
    }
    container.children.push(newBlock)
  }
}

const deleteNestedBlock = (containerId: string, index: number) => {
  if (confirm('¿Estás seguro de eliminar este bloque?')) {
    const container = findBlockById(containerId)
    if (container && container.children) {
      container.children.splice(index, 1)
      updateNestedBlockOrder(container)
    }
  }
}

const updateNestedBlockOrder = (container: any) => {
  if (container.children) {
    container.children.forEach((block: any, index: number) => {
      block.order = index
    })
  }
}

const handleDuplicateNestedBlock = (childBlock: Block) => {
  console.log('BlockEditor - handleDuplicateNestedBlock:', childBlock)
  // Encontrar el contenedor padre del bloque
  const parentContainer = findParentContainer(childBlock.id)
  if (parentContainer && parentContainer.children) {
    const newBlock = {
      ...childBlock,
      id: generateId(),
      order: parentContainer.children.length
    }
    parentContainer.children.push(newBlock)
    console.log('Block duplicated successfully')
  } else {
    console.log('Parent container not found for block:', childBlock.id)
  }
}

const handleDeleteNestedBlock = (childBlock: Block) => {
  console.log('BlockEditor - handleDeleteNestedBlock:', childBlock)
  if (confirm('¿Estás seguro de eliminar este bloque?')) {
    const parentContainer = findParentContainer(childBlock.id)
    if (parentContainer && parentContainer.children) {
      const index = parentContainer.children.findIndex((block: any) => block.id === childBlock.id)
      if (index !== -1) {
        parentContainer.children.splice(index, 1)
        updateNestedBlockOrder(parentContainer)
        console.log('Block deleted successfully')
      }
    } else {
      console.log('Parent container not found for block:', childBlock.id)
    }
  }
}

const findParentContainer = (blockId: string): any => {
  // Buscar en bloques principales
  for (const block of blocks.value) {
    if (block.type === 'container' && (block as any).children) {
      const found = (block as any).children.find((child: any) => child.id === blockId)
      if (found) return block
      
      // Buscar recursivamente en contenedores anidados
      const nestedParent = findParentInChildren((block as any).children, blockId)
      if (nestedParent) return nestedParent
    }
  }
  return null
}

const findParentInChildren = (children: any[], blockId: string): any => {
  for (const child of children) {
    if (child.type === 'container' && child.children) {
      const found = child.children.find((grandChild: any) => grandChild.id === blockId)
      if (found) return child
      
      const nestedParent = findParentInChildren(child.children, blockId)
      if (nestedParent) return nestedParent
    }
  }
  return null
}
</script>

<style scoped>
.block-editor {
  background: white;
  border-radius: 8px;
  overflow: hidden;
  height: 100%;
  display: flex;
  flex-direction: column;
}

.editor-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  border-bottom: 1px solid #e9ecef;
  background: #f8f9fa;
}

.editor-header h3 {
  margin: 0;
  color: #333;
}

.header-actions {
  display: flex;
  gap: 0.5rem;
}

.blocks-preview {
  flex: 1;
  overflow-y: auto;
  min-height: 400px;
}

.empty-state {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 3rem;
  color: #6c757d;
}

.empty-state i {
  font-size: 3rem;
  margin-bottom: 1rem;
  opacity: 0.5;
}

.empty-state h4 {
  margin: 0 0 0.5rem 0;
  color: #495057;
}

.blocks-list {
  padding: 1rem;
}

.block-item {
  border: 2px solid #e9ecef;
  border-radius: 8px;
  margin-bottom: 1rem;
  background: white;
  transition: all 0.3s ease;
}

.block-item:hover {
  border-color: #007bff;
  box-shadow: 0 2px 8px rgba(0, 123, 255, 0.1);
}

.block-item.active {
  border-color: #007bff;
  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
}

.block-controls {
  display: flex;
  align-items: center;
  padding: 0.75rem;
  background: #f8f9fa;
  border-bottom: 1px solid #e9ecef;
}

.move-buttons {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
  margin-right: 0.75rem;
}

.btn-move {
  padding: 0.25rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 0.75rem;
  transition: all 0.2s ease;
  background: #f8f9fa;
  color: #6c757d;
  width: 24px;
  height: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn-move:hover:not(:disabled) {
  background: #e9ecef;
  color: #495057;
}

.btn-move:disabled {
  opacity: 0.4;
  cursor: not-allowed;
}

.block-info {
  flex: 1;
  display: flex;
  flex-direction: column;
}

.block-type {
  font-size: 0.75rem;
  font-weight: 600;
  color: #007bff;
  text-transform: uppercase;
}

.block-title {
  font-size: 0.875rem;
  color: #495057;
}

.block-actions {
  display: flex;
  gap: 0.25rem;
}

.btn-edit,
.btn-duplicate,
.btn-delete,
.btn-add-nested {
  padding: 0.25rem 0.5rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 0.75rem;
  transition: all 0.2s ease;
}

.btn-add-nested {
  background: #007bff;
  color: white;
}

.btn-edit {
  background: #17a2b8;
  color: white;
}

.btn-duplicate {
  background: #28a745;
  color: white;
}

.btn-delete {
  background: #dc3545;
  color: white;
}

.btn-add-nested:hover,
.btn-edit:hover,
.btn-duplicate:hover,
.btn-delete:hover {
  opacity: 0.8;
  transform: translateY(-1px);
}

.block-preview {
  pointer-events: none;
  position: relative;
}

.block-preview::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 123, 255, 0.05);
  pointer-events: none;
}


.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
}

.modal-content {
  background: white;
  border-radius: 8px;
  max-width: 600px;
  width: 90vw;
  display: flex;
  flex-direction: column;
}

.modal-large {
  max-width: 80%;
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  border-bottom: 1px solid #e9ecef;
  background: #f8f9fa;
}

.modal-header h4 {
  margin: 0;
}

.modal-info {
  background: #e3f2fd;
  border: 1px solid #2196f3;
  border-radius: 6px;
  padding: 0.75rem;
  margin: 1rem;
  color: #1976d2;
  font-size: 0.9rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.modal-info i {
  color: #2196f3;
}

.btn-close {
  background: none;
  border: none;
  font-size: 1.25rem;
  cursor: pointer;
  color: #6c757d;
}

.modal-body {
  flex: 1;
  padding: 1rem;
}

.block-templates {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1rem;
  padding: 1rem;
}

.template-card {
  border: 2px solid #e9ecef;
  border-radius: 8px;
  padding: 1rem;
  cursor: pointer;
  transition: all 0.3s ease;
  text-align: center;
}

.template-card:hover {
  border-color: #007bff;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 123, 255, 0.15);
}

.template-icon {
  font-size: 2rem;
  color: #007bff;
  margin-bottom: 0.5rem;
}

.template-card h5 {
  margin: 0 0 0.5rem 0;
  color: #333;
}

.template-card p {
  margin: 0;
  font-size: 0.875rem;
  color: #6c757d;
  line-height: 1.4;
}

.btn-primary {
  background: #007bff;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 600;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.btn-primary:hover {
  background: #0056b3;
  transform: translateY(-1px);
}

.btn-success {
  background: #28a745;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 600;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.btn-success:hover {
  background: #218838;
  transform: translateY(-1px);
}

.btn-success:disabled {
  opacity: 0.6;
  cursor: not-allowed;
  transform: none;
}
</style>