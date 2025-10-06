<template>
  <div 
    class="map-block" 
    :class="[
      `padding-${block.padding}`,
      { 'has-background': block.backgroundColor }
    ]"
    :style="{ backgroundColor: block.backgroundColor || undefined }"
  >
    <div v-if="block.title" class="map-title">
      <h3>{{ block.title }}</h3>
    </div>
    
    <div class="map-container" :style="{ height: `${block.height}px` }">
      <iframe
        :src="googleMapsEmbedUrl"
        :style="{ height: `${block.height}px` }"
        class="google-map"
        frameborder="0"
        allowfullscreen
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
      ></iframe>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import type { MapBlock as MapBlockType } from '@/types/blocks'

interface Props {
  block: MapBlockType
  isEditing?: boolean
}

const props = withDefaults(defineProps<Props>(), {
  isEditing: false
})

const googleMapsEmbedUrl = computed(() => {
  const encodedAddress = encodeURIComponent(props.block.address)
  const zoom = props.block.zoom || 12
  
  return `https://www.google.com/maps?q=${encodedAddress}&t=m&z=${zoom}&output=embed&iwloc=near`
})
</script>

<style scoped>
.map-block {
  width: 100%;
}

.map-block.padding-small {
  padding: 1rem;
}

.map-block.padding-medium {
  padding: 2rem;
}

.map-block.padding-large {
  padding: 3rem;
}

.map-title {
  margin-bottom: 1rem;
  text-align: center;
}

.map-title h3 {
  margin: 0;
  font-size: 1.5rem;
  font-weight: 600;
  color: #333;
}

.map-container {
  position: relative;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.google-map {
  width: 100%;
  border-radius: 8px;
}

.map-placeholder {
  display: flex;
  align-items: center;
  justify-content: center;
  background: #f8f9fa;
  border: 2px dashed #dee2e6;
  border-radius: 8px;
}

.loading-content {
  text-align: center;
  color: #6c757d;
}

.loading-content i {
  font-size: 2rem;
  margin-bottom: 0.5rem;
  color: #007bff;
}

.loading-content p {
  margin: 0 0 0.25rem 0;
  font-weight: 500;
}

.loading-content small {
  font-size: 0.875rem;
  opacity: 0.8;
}
</style>