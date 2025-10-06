<template>
  <div 
    class="image-gallery-block"
    :class="[
      `columns-${block.columnsCount}`,
      `gap-${block.gap}`,
      `padding-${block.padding}`,
      `align-${block.alignment}`,
      `hover-${block.hoverEffect}`
    ]"
    :style="{ backgroundColor: block.backgroundColor || 'transparent' }"
  >
    <div class="gallery-container">
      <div class="gallery-grid" :class="`columns-${block.columnsCount}`">
        <div 
          v-for="item in block.items"
          :key="item.id"
          class="gallery-item"
          :class="[
            `aspect-${block.aspectRatio}`,
            `mask-${block.maskType}`
          ]"
          :style="getMaskStyles()"
        >
          <component
            :is="item.link ? 'a' : 'div'"
            :href="item.link || undefined"
            :target="item.linkTarget || '_self'"
            class="image-wrapper"
          >
            <img 
              :src="buildMediaUrl(item.src)" 
              :alt="item.alt"
              class="gallery-image"
              loading="lazy"
              @error="handleImageError"
            />
            <div v-if="item.caption" class="image-caption">
              {{ item.caption }}
            </div>
          </component>
        </div>
      </div>
      
      <!-- Estado vacío -->
      <div v-if="block.items.length === 0" class="gallery-empty">
        <div class="empty-state">
          <i class="fas fa-images"></i>
          <h4>Galería Vacía</h4>
          <p>Esta galería no tiene imágenes aún</p>
          <p v-if="isEditing" class="empty-help">
            <i class="fas fa-info-circle"></i>
            Usa el editor para agregar imágenes
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import type { ImageGalleryBlock } from '@/types/blocks'
import { buildMediaUrl } from '@/utils/mediaUtils'

interface Props {
  block: ImageGalleryBlock
  isEditing?: boolean
}

const props = defineProps<Props>()

const getMaskStyles = () => {
  const styles: Record<string, string> = {}
  
  switch (props.block.maskType) {
    case 'circle':
      styles.clipPath = 'circle(50%)'
      break
    case 'rounded':
      styles.borderRadius = `${props.block.borderRadius || 12}px`
      break
    case 'custom':
      if (props.block.customMask) {
        styles.clipPath = `path('${props.block.customMask}')`
      }
      break
    default:
      // 'none' - sin máscara
      break
  }
  
  return styles
}

const handleImageError = (event: Event) => {
  const img = event.target as HTMLImageElement
  img.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZGRkIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxNiIgZmlsbD0iIzk5OSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9IjAuM2VtIj5JbWFnZW4gbm8gZGlzcG9uaWJsZTwvdGV4dD48L3N2Zz4='
}
</script>

<style scoped>
.image-gallery-block {
  width: 100%;
  overflow: visible;
}

.gallery-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1rem;
}

.gallery-grid {
  display: grid;
  width: 100%;
  gap: var(--gallery-gap);
}

/* Configuración de columnas */
.gallery-grid.columns-1 {
  grid-template-columns: 1fr;
}

.gallery-grid.columns-2 {
  grid-template-columns: repeat(2, 1fr);
}

.gallery-grid.columns-3 {
  grid-template-columns: repeat(3, 1fr);
}

.gallery-grid.columns-4 {
  grid-template-columns: repeat(4, 1fr);
}

.gallery-grid.columns-5 {
  grid-template-columns: repeat(5, 1fr);
}

.gallery-grid.columns-6 {
  grid-template-columns: repeat(6, 1fr);
}

/* Gap entre elementos */
.gap-none {
  --gallery-gap: 0;
}

.gap-small {
  --gallery-gap: 0.5rem;
}

.gap-medium {
  --gallery-gap: 1rem;
}

.gap-large {
  --gallery-gap: 2rem;
}

/* Padding del bloque */
.padding-none {
  padding: 0;
}

.padding-small {
  padding: 1rem 0;
}

.padding-medium {
  padding: 2rem 0;
}

.padding-large {
  padding: 3rem 0;
}

/* Alineación */
.align-left .gallery-container {
  margin-left: 0;
  margin-right: auto;
}

.align-center .gallery-container {
  margin-left: auto;
  margin-right: auto;
}

.align-right .gallery-container {
  margin-left: auto;
  margin-right: 0;
}

/* Elementos de la galería */
.gallery-item {
  position: relative;
  overflow: hidden;
  background: #f8f9fa;
  border-radius: 4px;
}

.image-wrapper {
  display: block;
  width: 100%;
  height: 100%;
  position: relative;
  text-decoration: none;
  color: inherit;
}

.gallery-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
  display: block;
}

/* Relaciones de aspecto */
.aspect-square {
  aspect-ratio: 1 / 1;
}

.aspect-4\:3 {
  aspect-ratio: 4 / 3;
}

.aspect-16\:9 {
  aspect-ratio: 16 / 9;
}

.aspect-3\:4 {
  aspect-ratio: 3 / 4;
}

.aspect-9\:16 {
  aspect-ratio: 9 / 16;
}

.aspect-auto {
  aspect-ratio: auto;
  height: auto;
}

/* Máscaras */
.mask-circle .gallery-image {
  clip-path: circle(50%);
}

.mask-rounded .gallery-image {
  border-radius: inherit;
}

.mask-custom .gallery-image {
  clip-path: inherit;
}

/* Efectos hover */
.hover-zoom .gallery-item:hover .gallery-image {
  transform: scale(1.05);
}

.hover-fade .gallery-item:hover .gallery-image {
  opacity: 0.8;
}

.hover-lift .gallery-item:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* Caption */
.image-caption {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
  color: white;
  padding: 2rem 1rem 1rem;
  font-size: 0.9rem;
  text-align: center;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.gallery-item:hover .image-caption {
  opacity: 1;
}

/* Estado vacío */
.gallery-empty {
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

/* Responsive */
@media (max-width: 1024px) {
  .gallery-grid.columns-6 {
    grid-template-columns: repeat(3, 1fr);
  }
  
  .gallery-grid.columns-5 {
    grid-template-columns: repeat(3, 1fr);
  }
  
  .gallery-grid.columns-4 {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px) {
  .gallery-grid.columns-6,
  .gallery-grid.columns-5,
  .gallery-grid.columns-4,
  .gallery-grid.columns-3 {
    grid-template-columns: repeat(2, 1fr);
  }
  
  .gap-large {
    --gallery-gap: 1rem;
  }
  
  .gap-medium {
    --gallery-gap: 0.75rem;
  }
}

@media (max-width: 480px) {
  .gallery-grid {
    grid-template-columns: 1fr !important;
  }
  
  .gallery-container {
    padding: 0 0.5rem;
  }
  
  .gap-large,
  .gap-medium {
    --gallery-gap: 0.5rem;
  }
}
</style>