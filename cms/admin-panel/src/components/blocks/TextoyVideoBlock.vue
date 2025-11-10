<template>
  <section class="textoy-video-block" :style="sectionStyles">
    <div class="container">
      <!-- Layout: Dos Columnas (Texto + Video) -->
      <div v-if="block.layoutMode === 'two-column'" class="textoy-video-content">
        <!-- Columna de Texto -->
        <div class="text-column">
          <h1 class="title" :style="titleStyles" v-html="block.title"></h1>
          <p class="description" :style="descriptionStyles" v-html="block.description"></p>
          <button
            class="cta-button"
            :style="buttonStyles"
            @click="handleButtonClick"
            type="button"
          >
            {{ block.buttonText }}
          </button>
        </div>

        <!-- Columna de Video -->
        <div class="video-column">
          <VideoComponent
            :videoType="block.videoType"
            :videoUrl="block.videoUrl"
            :aspectRatio="block.aspectRatio"
          />
        </div>
      </div>

      <!-- Layout: Múltiples Columnas -->
      <div v-else class="multi-column-videos" :style="multiColumnStyle">
        <div v-for="(col, idx) in block.columns" :key="col.id" class="video-card">
          <VideoComponent
            :videoType="col.videoType"
            :videoUrl="col.videoUrl"
            :aspectRatio="block.aspectRatio"
            class="video-card-video"
          />
          <div class="video-card-content">
            <h3 class="video-card-title">{{ col.title }}</h3>
            <p class="video-card-description">{{ col.description }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import type { TextoyVideoBlock } from '@/types/blocks'
import VideoComponent from './VideoComponent.vue'

interface Props {
  block: TextoyVideoBlock
  isEditing?: boolean
}

const props = withDefaults(defineProps<Props>(), {
  isEditing: false
})

const sectionStyles = computed(() => ({
  backgroundColor: props.block.backgroundColor
}))

const titleStyles = computed(() => ({
  color: props.block.titleColor,
  fontSize: 'var(--font-size-h1, 3rem)',
  fontWeight: 'var(--font-weight-h1, 700)',
  fontFamily: 'var(--font-family-h1, var(--base-font-family, "Lato", sans-serif))',
  letterSpacing: 'var(--letter-spacing-h1, 0px)'
}))

const descriptionStyles = computed(() => ({
  color: props.block.descriptionColor,
  fontSize: 'var(--font-size-p, 1.1rem)',
  fontFamily: 'var(--font-family-p, var(--base-font-family, "Lato", sans-serif))',
  fontWeight: 'var(--font-weight-p, 400)',
  letterSpacing: 'var(--letter-spacing-p, 0px)'
}))

const buttonStyles = computed(() => ({
  backgroundColor: props.block.buttonColor,
  color: props.block.buttonTextColor,
  borderRadius: 'var(--btn-flat-border-radius, 8px)',
  fontSize: 'var(--font-size-p, 1rem)',
  fontFamily: 'var(--font-family-p, var(--base-font-family, "Lato", sans-serif))',
  fontWeight: 'var(--font-weight-p, 600)',
  letterSpacing: 'var(--letter-spacing-p, 0px)'
}))

const multiColumnStyle = computed(() => {
  const gapMap = {
    small: '1rem',
    medium: '2rem',
    large: '3rem'
  }

  return {
    display: 'grid',
    gridTemplateColumns: `repeat(${props.block.columnsCount}, 1fr)`,
    gap: gapMap[props.block.gap || 'medium']
  }
})

const handleButtonClick = () => {
  if (props.isEditing) return

  if (props.block.buttonLink) {
    if (props.block.buttonLink.startsWith('http')) {
      window.open(props.block.buttonLink, '_blank')
    } else {
      window.location.href = props.block.buttonLink
    }
  }
}
</script>

<style scoped>
.textoy-video-block {
  padding: 4rem 0;
  font-family: 'Lato', sans-serif;
}

.container {
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 2rem;
}

.textoy-video-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 4rem;
  align-items: center;
}

.text-column {
  display: flex;
  flex-direction: column;
  gap: 2rem;
}

.title {
  margin: 0;
  line-height: 1.2;
}

.description {
  margin: 0;
  line-height: 1.6;
}

.cta-button {
  align-self: flex-start;
  padding: 1rem 2rem;
  border: none;
  cursor: pointer;
  transition: all 0.3s ease;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 200px;
}

.cta-button:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.video-column {
  display: flex;
  justify-content: center;
  align-items: center;
}

.video-container {
  width: 100%;
  max-width: 500px;
  aspect-ratio: 4/5;
  border-radius: 9px;
  overflow: hidden;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
  background: #f8f9fa;
}

.video-iframe,
.video-element {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 9px;
}

.video-placeholder {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  color: #6c757d;
  background: #f8f9fa;
}

.video-placeholder i {
  font-size: 3rem;
  margin-bottom: 1rem;
  opacity: 0.5;
}

.video-placeholder span {
  font-size: 1rem;
  font-weight: 500;
}

/* Multi-column layout styles */
.multi-column-videos {
  width: 100%;
}

.video-card {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.video-card-video {
  width: 100%;
  border-radius: 9px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.video-card-content {
  padding: 0 0.5rem;
}

.video-card-title {
  margin: 0 0 0.5rem 0;
  font-size: 1.1rem;
  font-weight: 600;
  line-height: 1.3;
}

.video-card-description {
  margin: 0;
  font-size: 0.95rem;
  color: #6c757d;
  line-height: 1.5;
}

/* Responsive Design */
@media (max-width: 1024px) {
  .textoy-video-content {
    gap: 3rem;
  }
}

@media (max-width: 768px) {
  .textoy-video-block {
    padding: 3rem 0;
  }

  .container {
    padding: 0 1rem;
  }

  .textoy-video-content {
    grid-template-columns: 1fr;
    gap: 2rem;
    text-align: center;
  }

  .text-column {
    gap: 1.5rem;
  }

  .cta-button {
    align-self: center;
    width: 100%;
    max-width: 300px;
  }

  .multi-column-videos {
    grid-template-columns: 1fr !important;
  }
}

@media (max-width: 480px) {
  .textoy-video-block {
    padding: 2rem 0;
  }

  .textoy-video-content {
    gap: 1.5rem;
  }

  .text-column {
    gap: 1rem;
  }

  .cta-button {
    padding: 0.75rem 1.5rem;
    font-size: 0.9rem;
  }

  .multi-column-videos {
    grid-template-columns: 1fr !important;
    gap: 1rem !important;
  }
}
</style>