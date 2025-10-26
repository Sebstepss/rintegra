<template>
  <div 
    class="container-block"
    :class="[`padding-${block.padding}`, { 'is-editing': isEditing }]"
    :style="containerStyle"
  >
    <!-- Overlay para imagen de fondo si tiene opacidad -->
    <div 
      v-if="block.backgroundType === 'image' && block.backgroundImage && block.backgroundImageOpacity !== undefined && block.backgroundImageOpacity < 100"
      class="background-overlay"
      :style="{ backgroundColor: `rgba(0,0,0,${(100 - (block.backgroundImageOpacity || 0)) / 100})` }"
    ></div>
    
    <!-- Contenido del contenedor -->
    <div class="container-content">
      <!-- Bloques hijos - Mostrar siempre dentro del contenedor -->
      <div v-if="block.children && block.children.length > 0" class="container-children">
        <BlockRenderer
          v-for="childBlock in block.children"
          :key="childBlock.id"
          :block="childBlock"
          :is-editing="isEditing"
          :is-nested="true"
          @add-block="handleAddNestedBlock"
          @edit-child="handleEditChild"
          @duplicate-child="handleDuplicateChild"
          @delete-child="handleDeleteChild"
        />
      </div>
      
      <!-- Estado vacío -->
      <div v-else class="container-empty">
        <div class="empty-state">
          <i class="fas fa-cube"></i>
          <h4>Contenedor Vacío</h4>
          <p>Este contenedor no tiene bloques aún</p>
          <p v-if="isEditing" class="empty-help">
            <i class="fas fa-info-circle"></i>
            Usa el botón "+" en el header para agregar bloques
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import BlockRenderer from './BlockRenderer.vue'
import type { ContainerBlock as ContainerBlockType } from '@/types/blocks'

interface Props {
  block: ContainerBlockType
  isEditing?: boolean
}

interface Emits {
  (e: 'add-block', containerId: string): void
  (e: 'edit-child', childBlock: any): void
  (e: 'duplicate-child', childBlock: any): void
  (e: 'delete-child', childBlock: any): void
}

const props = defineProps<Props>()
const emit = defineEmits<Emits>()

const handleAddNestedBlock = (containerId: string) => {
  console.log('ContainerBlock - handleAddNestedBlock:', containerId)
  emit('add-block', containerId)
}

const handleEditChild = (childBlock: any) => {
  console.log('ContainerBlock - handleEditChild:', childBlock)
  emit('edit-child', childBlock)
}

const handleDuplicateChild = (childBlock: any) => {
  console.log('ContainerBlock - handleDuplicateChild:', childBlock)
  emit('duplicate-child', childBlock)
}

const handleDeleteChild = (childBlock: any) => {
  console.log('ContainerBlock - handleDeleteChild:', childBlock)
  emit('delete-child', childBlock)
}

const containerStyle = computed(() => {
  const styles: Record<string, string> = {}
  
  switch (props.block.backgroundType) {
    case 'color':
      if (props.block.backgroundColor) {
        styles.backgroundColor = props.block.backgroundColor
      }
      break
      
    case 'gradient':
      if (props.block.backgroundGradient) {
        const { colorStart, colorEnd, direction } = props.block.backgroundGradient
        styles.background = `linear-gradient(${direction}, ${colorStart}, ${colorEnd})`
      }
      break
      
    case 'image':
      if (props.block.backgroundImage) {
        styles.backgroundImage = `url(${props.block.backgroundImage})`
        styles.backgroundSize = 'cover'
        styles.backgroundPosition = 'center'
        styles.backgroundRepeat = 'no-repeat'
      }
      break
  }
  
  return styles
})
</script>

<style scoped>
.container-block {
  position: relative;
  width: 100%;
  min-height: 100px;
  overflow: visible; /* Permitir que los controles flotantes sean visibles */
}

.background-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 1;
}

.container-content {
  position: relative;
  z-index: 2;
  width: 100%;
}

/* Asegurar que los controles de bloques anidados estén por encima del contenido */
.container-children .nested-block-controls {
  z-index: 1500 !important;
}

.container-children {
  display: block;
  width: 100%;
  overflow: visible; /* Asegurar que los controles flotantes sean visibles */
}

.container-children > .block-renderer {
  display: block;
  width: 100%;
  margin-bottom: 0;
}

/* Asegurar que los bloques mantengan su funcionalidad dentro del contenedor */
.container-children .text-block {
  width: 100%;
}

.container-children .text-block .columns-container {
  width: 100%;
}

.container-empty {
  min-height: 200px;
  display: flex;
  align-items: center;
  justify-content: center;
}


.empty-state {
  text-align: center;
  color: #6c757d;
  padding: 2rem;
}

.empty-state i {
  font-size: 3rem;
  margin-bottom: 1rem;
  opacity: 0.5;
  display: block;
}

.empty-state h4 {
  margin: 0 0 0.5rem 0;
  color: #495057;
  font-size: 1.5rem;
}

.empty-state p {
  margin: 0 0 1rem 0;
  font-size: 1rem;
}

.empty-help {
  font-size: 0.9rem !important;
  color: #007bff !important;
  font-style: italic;
  margin: 1rem 0 0 0 !important;
}

.empty-help i {
  margin-right: 0.5rem;
  font-size: 0.8rem;
  display: inline !important;
  opacity: 1 !important;
}


.is-editing .container-block {
  border: 2px dashed #007bff;
  border-radius: 8px;
}

.is-editing .container-empty {
  background: rgba(0, 123, 255, 0.05);
}

/* Padding classes */
.padding-none {
  padding: 0;
}

.padding-small {
  padding: 1rem;
}

.padding-medium {
  padding: 2rem;
}

.padding-large {
  padding: 3rem;
}

@media (max-width: 768px) {
  .padding-small {
    padding: 0.5rem;
  }
  
  .padding-medium {
    padding: 1rem;
  }
  
  .padding-large {
    padding: 1.5rem;
  }
}
</style>