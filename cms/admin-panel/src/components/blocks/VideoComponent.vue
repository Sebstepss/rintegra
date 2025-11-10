<template>
  <div class="video-container" :style="containerStyle">
    <!-- Video de YouTube -->
    <iframe
      v-if="videoType === 'youtube' && youtubeUrl"
      :src="youtubeUrl"
      class="video-iframe"
      frameborder="0"
      allowfullscreen
      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
    ></iframe>

    <!-- Video de Vimeo -->
    <iframe
      v-else-if="videoType === 'vimeo' && vimeoUrl"
      :src="vimeoUrl"
      class="video-iframe"
      frameborder="0"
      allowfullscreen
      allow="autoplay; fullscreen; picture-in-picture"
    ></iframe>

    <!-- Video local (media) -->
    <video
      v-else-if="videoType === 'media' && videoUrl"
      :src="videoUrl"
      class="video-element"
      controls
      preload="metadata"
    >
      Tu navegador no soporta el elemento de video.
    </video>

    <!-- Placeholder -->
    <div v-else class="video-placeholder">
      <i class="fas fa-video"></i>
      <span>Video no disponible</span>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'

interface Props {
  videoType: 'youtube' | 'vimeo' | 'media'
  videoUrl: string
  aspectRatio?: '4:5' | '16:9' | '9:16' | '1:1'
}

const props = withDefaults(defineProps<Props>(), {
  aspectRatio: '16:9'
})

const aspectRatioMap = {
  '4:5': '4 / 5',
  '16:9': '16 / 9',
  '9:16': '9 / 16',
  '1:1': '1 / 1'
}

const containerStyle = computed(() => ({
  aspectRatio: aspectRatioMap[props.aspectRatio]
}))

// Extraer URL de embed de YouTube desde diferentes formatos
const youtubeUrl = computed(() => {
  if (props.videoType !== 'youtube' || !props.videoUrl) return null

  let videoId = ''
  const url = props.videoUrl

  // Detectar si es YouTube Shorts (youtube.com/shorts/ID)
  if (url.includes('youtube.com/shorts/')) {
    videoId = url.split('youtube.com/shorts/')[1].split('?')[0]
  } else if (url.includes('youtube.com/watch?v=')) {
    videoId = url.split('watch?v=')[1].split('&')[0]
  } else if (url.includes('youtu.be/')) {
    videoId = url.split('youtu.be/')[1].split('?')[0]
  } else if (url.includes('youtube.com/embed/')) {
    videoId = url.split('embed/')[1].split('?')[0]
  } else {
    // Asumir que es solo el ID
    videoId = url
  }

  // Para shorts, usar embedded con parámetros especiales
  if (url.includes('youtube.com/shorts/')) {
    return videoId ? `https://www.youtube.com/embed/${videoId}?rel=0` : null
  }

  return videoId ? `https://www.youtube.com/embed/${videoId}?rel=0` : null
})

// Extraer URL de embed de Vimeo
const vimeoUrl = computed(() => {
  if (props.videoType !== 'vimeo' || !props.videoUrl) return null

  let videoId = ''
  const url = props.videoUrl

  if (url.includes('vimeo.com/')) {
    // Extraer del URL de Vimeo
    const parts = url.split('vimeo.com/')
    videoId = parts[parts.length - 1].split('?')[0].split('#')[0]
  } else {
    // Asumir que es solo el ID
    videoId = url
  }

  return videoId ? `https://player.vimeo.com/video/${videoId}` : null
})
</script>

<style scoped>
.video-container {
  width: 100%;
  border-radius: 9px;
  overflow: hidden;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
  background: #f8f9fa;
  position: relative;
}

.video-iframe,
.video-element {
  width: 100%;
  height: 100%;
  border: none;
  border-radius: 9px;
}

.video-element {
  object-fit: cover;
  display: block;
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
  min-height: 300px;
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
</style>
