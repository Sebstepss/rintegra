<template>
  <div 
    class="text-block"
    :class="[
      `text-block-${blockId}`,
      `padding-${block.padding}`,
      `gap-${block.gap}`,
      `columns-${actualColumnsCount}`
    ]"
    :style="{ backgroundColor: block.backgroundColor || 'transparent' }"
  >
    <div class="text-block-container">
      <div class="columns-container">
        <div 
          v-for="column in block.columns"
          :key="column.id"
          class="text-column"
          :style="{ 
            backgroundColor: column.backgroundColor || 'transparent',
            color: column.textColor || 'inherit'
          }"
        >
          <div 
            v-for="textItem in column.texts"
            :key="textItem.id"
            class="text-item"
            v-html="textItem.content"
          ></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import type { TextBlock } from '@/types/blocks'

interface Props {
  block: TextBlock
  isEditing?: boolean
}

const props = defineProps<Props>()

// Generar ID único para este bloque para aislar estilos
const blockId = computed(() => props.block.id)

// Usar siempre la longitud real del array de columnas como fuente de verdad
const actualColumnsCount = computed(() => {
  const arrayLength = props.block.columns?.length || 1
  return Math.max(1, Math.min(4, arrayLength)) // Asegurar que esté en rango 1-4
})
</script>

<style>
.text-block {
  width: 100%;
  overflow: visible; /* Permitir controles flotantes visibles */
}

.text-block-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1rem;
  overflow: visible; /* Permitir controles flotantes visibles */
}

.columns-container {
  display: grid;
  width: 100%;
  overflow: visible; /* Permitir controles flotantes visibles */
}

/* Configuración de columnas usando clases específicas con mayor especificidad */
.text-block.columns-1 .columns-container {
  grid-template-columns: 1fr !important;
  display: grid !important;
}

.text-block.columns-2 .columns-container {
  grid-template-columns: 1fr 1fr !important;
  display: grid !important;
}

.text-block.columns-3 .columns-container {
  grid-template-columns: repeat(3, 1fr) !important;
  display: grid !important;
}

.text-block.columns-4 .columns-container {
  grid-template-columns: repeat(4, 1fr) !important;
  display: grid !important;
}

/* Especificidad adicional para bloques dentro de contenedores */
.container-block .text-block.columns-1 .columns-container {
  grid-template-columns: 1fr !important;
  display: grid !important;
}

.container-block .text-block.columns-2 .columns-container {
  grid-template-columns: 1fr 1fr !important;
  display: grid !important;
}

.container-block .text-block.columns-3 .columns-container {
  grid-template-columns: repeat(3, 1fr) !important;
  display: grid !important;
}

.container-block .text-block.columns-4 .columns-container {
  grid-template-columns: repeat(4, 1fr) !important;
  display: grid !important;
}

/* Asegurar que el texto enriquecido funcione dentro de contenedores con máxima especificidad */
.container-block .text-block .text-item :deep(strong),
.container-block .text-block .text-item :deep(b) {
  font-weight: 700 !important;
  font-weight: bold !important;
}

.container-block .text-block .text-item :deep(em),
.container-block .text-block .text-item :deep(i) {
  font-style: italic !important;
}

.container-block .text-block .text-item :deep(u) {
  text-decoration: underline !important;
}

.container-block .text-block .text-item :deep(s),
.container-block .text-block .text-item :deep(strike) {
  text-decoration: line-through !important;
}

.container-block .text-block .text-item :deep(mark) {
  background-color: yellow !important;
  color: black !important;
}

.container-block .text-block .text-item :deep(sub) {
  vertical-align: sub !important;
  font-size: smaller !important;
}

.container-block .text-block .text-item :deep(sup) {
  vertical-align: super !important;
  font-size: smaller !important;
}

.container-block .text-block .text-item :deep(blockquote) {
  border-left: 4px solid var(--color-1, #007bff) !important;
  padding-left: 1rem !important;
  margin: 1rem 0 !important;
  font-style: italic !important;
  opacity: 0.8 !important;
  font-family: var(--font-family-p, var(--base-font-family, inherit)) !important;
}

.container-block .text-block .text-item :deep(code) {
  background: rgba(0, 0, 0, 0.1) !important;
  padding: 0.2rem 0.4rem !important;
  border-radius: 4px !important;
  font-family: 'Courier New', monospace !important;
  font-size: 0.9em !important;
}

.container-block .text-block .text-item :deep(a) {
  color: var(--color-1, #007bff) !important;
  text-decoration: underline !important;
  transition: opacity 0.2s ease !important;
}

.container-block .text-block .text-item :deep(a:hover) {
  opacity: 0.8 !important;
}

/* Espaciado entre columnas */
.gap-none .columns-container {
  gap: 0 !important;
}

.gap-small .columns-container {
  gap: 1rem !important;
}

.gap-medium .columns-container {
  gap: 2rem !important;
}

.gap-large .columns-container {
  gap: 3rem !important;
}

/* Padding del bloque */
.padding-none {
  padding: 0 !important;
}

.padding-small {
  padding: 1rem 0 !important;
}

.padding-medium {
  padding: 2rem 0 !important;
}

.padding-large {
  padding: 3rem 0 !important;
}

/* Columnas */
.text-column {
  padding: 1rem;
  border-radius: 8px;
  min-height: 100px;
  display: flex;
  flex-direction: column;
  gap: 1rem;
  overflow: visible; /* Permitir controles flotantes visibles */
}

.text-item {
  width: 100%;
}

/* Permitir HTML completo con estilos personalizados */
.text-item :deep(*) {
  /* No usar all: revert para evitar anular estilos de texto enriquecido */
  box-sizing: border-box;
}

/* Estilos básicos usando variables globales del sitio */
.text-item :deep(h1) {
  font-size: var(--font-size-h1, 2.25rem);
  font-weight: var(--font-weight-h1, 700);
  font-family: var(--font-family-h1, var(--base-font-family, inherit));
  letter-spacing: var(--letter-spacing-h1, 0px);
  line-height: 1.2;
  margin: 0 0 1rem 0;
}

.text-item :deep(h2) {
  font-size: var(--font-size-h2, 1.875rem);
  font-weight: var(--font-weight-h2, 600);
  font-family: var(--font-family-h2, var(--base-font-family, inherit));
  letter-spacing: var(--letter-spacing-h2, 0px);
  line-height: 1.3;
  margin: 0 0 1rem 0;
}

.text-item :deep(h3) {
  font-size: var(--font-size-h3, 1.5rem);
  font-weight: var(--font-weight-h3, 600);
  font-family: var(--font-family-h3, var(--base-font-family, inherit));
  letter-spacing: var(--letter-spacing-h3, 0px);
  line-height: 1.4;
  margin: 0 0 1rem 0;
}

.text-item :deep(h4) {
  font-size: var(--font-size-h4, 1.25rem);
  font-weight: var(--font-weight-h4, 600);
  font-family: var(--font-family-h4, var(--base-font-family, inherit));
  letter-spacing: var(--letter-spacing-h4, 0px);
  line-height: 1.4;
  margin: 0 0 1rem 0;
}

.text-item :deep(h5) {
  font-size: var(--font-size-h5, 1.125rem);
  font-weight: var(--font-weight-h5, 600);
  font-family: var(--font-family-h5, var(--base-font-family, inherit));
  letter-spacing: var(--letter-spacing-h5, 0px);
  line-height: 1.5;
  margin: 0 0 1rem 0;
}

.text-item :deep(h6) {
  font-size: var(--font-size-h6, 1rem);
  font-weight: var(--font-weight-h6, 600);
  font-family: var(--font-family-h6, var(--base-font-family, inherit));
  letter-spacing: var(--letter-spacing-h6, 0px);
  line-height: 1.5;
  margin: 0 0 1rem 0;
}

.text-item :deep(p) {
  font-size: var(--font-size-p, 1rem);
  font-weight: var(--font-weight-p, 400);
  font-family: var(--font-family-p, var(--base-font-family, inherit));
  letter-spacing: var(--letter-spacing-p, 0px);
  line-height: 1.6;
  margin: 0 0 1rem 0;
}

/* Elementos HTML que no tienen configuración específica heredan estilos base con máxima especificidad */
.text-block .text-item :deep(strong),
.text-block .text-item :deep(b),
[data-block-id] .text-block .text-item :deep(strong),
[data-block-id] .text-block .text-item :deep(b) {
  font-weight: 700 !important;
  font-weight: bold !important;
}

.text-block .text-item :deep(em),
.text-block .text-item :deep(i) {
  font-style: italic !important;
}

.text-block .text-item :deep(u) {
  text-decoration: underline !important;
}

.text-block .text-item :deep(s),
.text-block .text-item :deep(strike) {
  text-decoration: line-through !important;
}

.text-block .text-item :deep(mark) {
  background-color: yellow !important;
  color: black !important;
}

.text-block .text-item :deep(sub) {
  vertical-align: sub !important;
  font-size: smaller !important;
}

.text-block .text-item :deep(sup) {
  vertical-align: super !important;
  font-size: smaller !important;
}

.text-block .text-item :deep(blockquote),
[data-block-id] .text-block .text-item :deep(blockquote) {
  border-left: 4px solid var(--color-1, #007bff) !important;
  padding-left: 1rem !important;
  margin: 1rem 0 !important;
  font-style: italic !important;
  opacity: 0.8 !important;
  font-family: var(--font-family-p, var(--base-font-family, inherit)) !important;
  display: block !important;
}

.text-block .text-item :deep(code),
[data-block-id] .text-block .text-item :deep(code) {
  background: rgba(0, 0, 0, 0.1) !important;
  padding: 0.2rem 0.4rem !important;
  border-radius: 4px !important;
  font-family: 'Courier New', monospace !important;
  font-size: 0.9em !important;
  display: inline !important;
}

.text-item :deep(ul),
.text-item :deep(ol) {
  margin: 1rem 0;
  padding-left: 2rem;
  font-family: var(--font-family-p, var(--base-font-family, inherit));
}

.text-item :deep(li) {
  margin: 0.5rem 0;
  font-size: var(--font-size-p, 1rem);
}

.text-block .text-item :deep(a) {
  color: var(--color-1, #007bff) !important;
  text-decoration: underline !important;
  transition: opacity 0.2s ease !important;
}

.text-block .text-item :deep(a:hover) {
  opacity: 0.8 !important;
}

/* Responsive */
@media (max-width: 1024px) {
  .text-block.columns-4 .columns-container,
  .container-block .text-block.columns-4 .columns-container {
    grid-template-columns: repeat(2, 1fr) !important;
  }
  
  .text-block.columns-3 .columns-container,
  .container-block .text-block.columns-3 .columns-container {
    grid-template-columns: repeat(2, 1fr) !important;
  }
}

@media (max-width: 768px) {
  .text-block.columns-2 .columns-container,
  .text-block.columns-3 .columns-container,
  .text-block.columns-4 .columns-container,
  .container-block .text-block.columns-2 .columns-container,
  .container-block .text-block.columns-3 .columns-container,
  .container-block .text-block.columns-4 .columns-container {
    grid-template-columns: 1fr !important;
  }
  
  .gap-medium .columns-container,
  .gap-large .columns-container {
    gap: 1rem !important;
  }
  
  .text-column {
    padding: 0.75rem;
  }
}

@media (max-width: 480px) {
  .text-block-container {
    padding: 0 0.5rem;
  }
}
</style>

<!-- CSS global para máxima especificidad en casos donde el CSS scoped no funciona -->
<style>
/* Especificidad global máxima para texto enriquecido */
body .text-block .text-item strong,
body .text-block .text-item b,
body [data-block-id] .text-item strong,
body [data-block-id] .text-item b {
  font-weight: 700 !important;
  font-weight: bold !important;
}

body .text-block .text-item blockquote,
body [data-block-id] .text-item blockquote {
  border-left: 4px solid #007bff !important;
  padding-left: 1rem !important;
  margin: 1rem 0 !important;
  font-style: italic !important;
  opacity: 0.8 !important;
  display: block !important;
}

body .text-block .text-item code,
body [data-block-id] .text-item code {
  background: rgba(0, 0, 0, 0.1) !important;
  padding: 0.2rem 0.4rem !important;
  border-radius: 4px !important;
  font-family: 'Courier New', monospace !important;
  font-size: 0.9em !important;
  display: inline !important;
}
</style>