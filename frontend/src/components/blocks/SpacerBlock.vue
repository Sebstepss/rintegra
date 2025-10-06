<template>
  <div 
    class="spacer-block"
    :style="spacerStyles"
  >
    <div v-if="isEditing" class="spacer-indicator">
      <span class="spacer-height">{{ block.height }}px</span>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import type { SpacerBlock } from '@/types/blocks'

interface Props {
  block: SpacerBlock
  isEditing?: boolean
}

const props = defineProps<Props>()

const spacerStyles = computed(() => ({
  height: `${props.block.height}px`,
  backgroundColor: props.block.backgroundColor || 'transparent'
}))
</script>

<style scoped>
.spacer-block {
  width: 100%;
  position: relative;
  min-height: 20px;
}

.spacer-indicator {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: rgba(0, 123, 255, 0.1);
  border: 2px dashed #007bff;
  border-radius: 4px;
  padding: 0.5rem 1rem;
  font-size: 0.875rem;
  color: #007bff;
  pointer-events: none;
}

.spacer-height {
  font-weight: 600;
}
</style>