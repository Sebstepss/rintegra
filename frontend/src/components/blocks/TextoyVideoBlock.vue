<template>
  <section class="textoy-video-block" :style="sectionStyles">
    <div class="container">
      <div class="textoy-video-content">
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
          <div class="video-container">
            <!-- Video de YouTube -->
            <iframe 
              v-if="block.videoType === 'youtube' && youtubeEmbedUrl"
              :src="youtubeEmbedUrl"
              class="video-iframe"
              frameborder="0"
              allowfullscreen
            ></iframe>
            
            <!-- Video de Media -->
            <video 
              v-else-if="block.videoType === 'media' && block.videoUrl"
              :src="block.videoUrl"
              class="video-element"
              controls
              preload="metadata"
            >
              Tu navegador no soporta el elemento de video.
            </video>
            
            <!-- Placeholder cuando no hay video -->
            <div v-else class="video-placeholder">
              <i class="fas fa-video"></i>
              <span>Video no disponible</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import type { TextoyVideoBlock } from '@/types/blocks'

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

const youtubeEmbedUrl = computed(() => {
  if (props.block.videoType !== 'youtube' || !props.block.videoUrl) {
    return null
  }
  
  // Extraer ID del video de YouTube desde diferentes formatos de URL
  let videoId = ''
  const url = props.block.videoUrl
  
  if (url.includes('youtube.com/watch?v=')) {
    videoId = url.split('watch?v=')[1].split('&')[0]
  } else if (url.includes('youtu.be/')) {
    videoId = url.split('youtu.be/')[1].split('?')[0]
  } else if (url.includes('youtube.com/embed/')) {
    videoId = url.split('embed/')[1].split('?')[0]
  } else {
    // Asumir que es solo el ID
    videoId = url
  }
  
  return videoId ? `https://www.youtube.com/embed/${videoId}` : null
})

const handleButtonClick = () => {
  if (props.isEditing) return
  
  if (props.block.buttonLink) {
    if (props.block.buttonLink.startsWith('http')) {
      window.open(props.block.buttonLink, '_blank')
    } else {
      // Para rutas internas, usar el router si está disponible
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

/* Responsive Design */
@media (max-width: 1024px) {
  .textoy-video-content {
    gap: 3rem;
  }
  
  .video-container {
    max-width: 400px;
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
  
  .video-container {
    max-width: 100%;
    aspect-ratio: 16/9;
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
}
</style>