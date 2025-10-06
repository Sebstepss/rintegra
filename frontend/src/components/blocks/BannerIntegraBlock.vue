<template>
  <div class="banner-integra-block" :style="bannerStyles">
    <!-- Imagen de fondo con overlay -->
    <div 
      v-if="block.backgroundImage" 
      class="background-image"
      :style="backgroundImageStyles"
    ></div>
    
    <!-- Contenido principal -->
    <div class="banner-container">
      <div class="banner-content">
        <!-- Primera columna: Contenido de texto -->
        <div class="content-column">
          <h1 class="banner-title" :style="{ color: block.titleColor }">
            {{ block.title }}
          </h1>
          <p class="banner-description" :style="{ color: block.descriptionColor }">
            {{ block.description }}
          </p>
          <button 
            v-if="block.buttonText" 
            class="banner-button btn-gradient"
            @click="handleButtonClick"
          >
            {{ block.buttonText }}
          </button>
        </div>
        
        <!-- Segunda columna: Imagen de persona -->
        <div class="image-column">
          <div class="person-image-container">
            <img 
              v-if="block.personImage"
              :src="block.personImage" 
              :alt="block.title"
              class="person-image"
            />
            <div v-else class="person-placeholder">
              <i class="fas fa-user"></i>
              <span>Imagen de persona</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import type { BannerIntegraBlock } from '@/types/blocks'

interface Props {
  block: BannerIntegraBlock
  isEditing?: boolean
}

const props = defineProps<Props>()

const bannerStyles = computed(() => ({
  background: `radial-gradient(circle at center, ${props.block.backgroundGradient.colorStart}, ${props.block.backgroundGradient.colorEnd})`
}))

const backgroundImageStyles = computed(() => ({
  backgroundImage: `url(${props.block.backgroundImage})`,
  opacity: props.block.backgroundImageOpacity / 100
}))

const handleButtonClick = () => {
  if (props.block.buttonLink && !props.isEditing) {
    if (props.block.buttonLink.startsWith('http')) {
      window.open(props.block.buttonLink, '_blank')
    } else {
      window.location.href = props.block.buttonLink
    }
  }
}
</script>

<style scoped>
.banner-integra-block {
  position: relative;
  min-height: 500px;
  width: 100%;
  overflow: hidden;
  display: flex;
  align-items: center;
}

.background-image {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  z-index: 1;
}

.banner-container {
  position: relative;
  z-index: 2;
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 4rem 2rem;
}

.banner-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2rem;
  align-items: center;
  min-height: 400px;
}

.content-column {
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.banner-title {
  font-family: var(--font-family-h1, var(--base-font-family));
  font-size: var(--font-size-h1, 3rem);
  font-weight: var(--font-weight-h1, 700);
  letter-spacing: var(--letter-spacing-h1, 0px);
  line-height: 1.2;
  margin-bottom: 1.5rem;
}

.banner-description {
  font-family: var(--font-family-p, var(--base-font-family));
  font-size: var(--font-size-p, 1.125rem);
  font-weight: var(--font-weight-p, 400);
  letter-spacing: var(--letter-spacing-p, 0px);
  line-height: 1.6;
  margin-bottom: 2rem;
  opacity: 0.95;
}

.banner-button {
  align-self: flex-start;
  padding: 0.875rem 2rem;
  font-size: 1rem;
  font-weight: 600;
  border: none;
  border-radius: var(--btn-gradient-border-radius, 8px);
  cursor: pointer;
  transition: all 0.3s ease;
  background: linear-gradient(135deg, 
    var(--btn-gradient-color-1, #007bff) 0%, 
    var(--btn-gradient-color-2, #0056b3) 50%, 
    var(--btn-gradient-color-3, #004085) 100%);
  color: var(--btn-gradient-text-color, white);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.banner-button:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 16px rgba(0, 123, 255, 0.3);
}

.image-column {
  display: flex;
  justify-content: center;
  align-items: flex-end;
  height: 100%;
}

.person-image-container {
  position: relative;
  margin-bottom:-80px;
  width: 100%;
  max-width: 450px;
  height: auto;
  display: flex;
  align-items: flex-end;
  justify-content: center;
}

.person-image {
  max-width: 100%;
  max-height: 100%;
  height: auto;
  object-fit: contain;
  object-position: bottom;
  filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.2));
}

.person-placeholder {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 200px;
  height: 200px;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 12px;
  border: 2px dashed rgba(255, 255, 255, 0.3);
  color: rgba(255, 255, 255, 0.6);
  text-align: center;
}

.person-placeholder i {
  font-size: 3rem;
  margin-bottom: 1rem;
}

.person-placeholder span {
  font-size: 0.875rem;
  font-weight: 500;
}

/* Responsive Design */
@media (max-width: 968px) {
  .banner-content {
    grid-template-columns: 1fr;
    gap: 2rem;
    text-align: center;
  }
  
  .banner-container {
    padding: 3rem 1.5rem;
  }
  
  .banner-title {
    font-size: 2.5rem;
  }
  
  .banner-description {
    font-size: 1rem;
  }
  
  .person-image-container {
    max-width: 250px;
    min-height: 200px;
    margin: 0 auto;
  }
}

@media (max-width: 640px) {
  .banner-integra-block {
    min-height: 400px;
  }
  
  .banner-container {
    padding: 2rem 1rem;
  }
  
  .banner-content {
    gap: 1.5rem;
  }
  
  .banner-title {
    font-size: 2rem;
    margin-bottom: 1rem;
  }
  
  .banner-description {
    font-size: 0.9rem;
    margin-bottom: 1.5rem;
  }
  
  .banner-button {
    padding: 0.75rem 1.5rem;
    font-size: 0.9rem;
    align-self: center;
  }
  
  .person-image-container {
    max-width: 200px;
    min-height: 150px;
  }
}

@media (max-width: 480px) {
  .banner-title {
    font-size: 1.75rem;
  }
  
  .banner-container {
    padding: 1.5rem 0.75rem;
  }
  
  .person-placeholder {
    width: 150px;
    height: 150px;
  }
  
  .person-placeholder i {
    font-size: 2rem;
  }
}
</style>