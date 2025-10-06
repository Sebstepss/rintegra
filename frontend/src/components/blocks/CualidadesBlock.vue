<template>
  <div class="cualidades-block" :style="containerStyles">
    <div class="cualidades-container">
      <!-- Título principal -->
      <div class="cualidades-header">
        <h1 class="cualidades-title" :style="{ color: block.titleColor || '#ffffff' }">{{ block.title }}</h1>
      </div>
      
      <!-- Grid de cualidades -->
      <div class="cualidades-grid" :style="gridStyles">
        <div 
          v-for="(item, index) in block.items" 
          :key="index"
          class="cualidad-item"
        >
          <div class="cualidad-image">
            <img 
              v-if="item.image"
              :src="item.image" 
              :alt="item.text"
              class="cualidad-img"
            />
            <div v-else class="cualidad-placeholder">
              <i class="fas fa-star"></i>
            </div>
          </div>
          <h3 class="cualidad-text" :style="{ color: item.textColor || block.itemsTextColor || '#ffffff' }">{{ item.text }}</h3>
        </div>
        
        <!-- Placeholder para modo edición cuando no hay items -->
        <div 
          v-if="isEditing && block.items.length === 0" 
          class="cualidad-item cualidad-placeholder-item"
        >
          <div class="cualidad-image">
            <div class="cualidad-placeholder">
              <i class="fas fa-plus"></i>
            </div>
          </div>
          <h3 class="cualidad-text">Agregar cualidad</h3>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import type { CualidadesBlock } from '@/types/blocks'

interface Props {
  block: CualidadesBlock
  isEditing?: boolean
}

const props = defineProps<Props>()

const containerStyles = computed(() => ({
  background: `radial-gradient(circle at center, ${props.block.backgroundGradient.colorStart}, ${props.block.backgroundGradient.colorEnd})`
}))

const gridStyles = computed(() => {
  const itemsLength = props.block.items.length
  if (itemsLength === 0 && props.isEditing) {
    return { gridTemplateColumns: '1fr' }
  }
  
  // Máximo 4 columnas
  const columns = Math.min(4, itemsLength || 1)
  return { 
    gridTemplateColumns: `repeat(${columns}, 1fr)` 
  }
})
</script>

<style scoped>
.cualidades-block {
  width: 100%;
  padding: 4rem 0;
  min-height: 400px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.cualidades-container {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 2rem;
}

.cualidades-header {
  text-align: center;
  margin-bottom: 3rem;
}

.cualidades-title {
  overflow: hidden; /* Ensures the content is not revealed until the animation */
  border-right: 2px solid rgb(0, 46, 32); /* The typwriter cursor */
  white-space: nowrap; /* Keeps the content on a single line */
  margin: 0 auto; /* Gives that scrolling effect as the typing happens */
  letter-spacing: .15em; /* Adjust as needed */
  animation: 
  typing 7.5s steps(40, end) infinite,
  blink-caret .75s step-end infinite;
  font-family: var(--font-family-h1, var(--base-font-family));
  font-size: var(--font-size-h1, 2.5rem);
  font-weight: var(--font-weight-h1, 700);
  letter-spacing: var(--letter-spacing-h1, 0px);
  line-height: 1.2;
  color: #ffffff;
  margin: 0;
}

/* The typing effect */
@keyframes typing {
  0% { width: 0 }
  54% { width: 100% }     /* 3.5s of typing in a 6.5s total */
  100% { width: 100% }
}

/* The typewriter cursor effect */
@keyframes blink-caret {
  from, to { border-color: transparent }
  50% { border-color: rgb(0, 68, 34); }
}


.cualidades-grid {
  display: grid;
  gap: 2rem;
  justify-items: center;
  align-items: start;
}

.cualidad-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  max-width: 250px;
  width: 100%;
}

.cualidad-image {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  overflow: hidden;
  margin-bottom: 1.5rem;
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  border: 2px solid rgba(255, 255, 255, 0.2);
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
}

.cualidad-item:hover .cualidad-image {
  transform: translateY(-5px);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
  border-color: rgba(255, 255, 255, 0.4);
}

.cualidad-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.cualidad-item:hover .cualidad-img {
  transform: scale(1.1);
}

.cualidad-placeholder {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100%;
  color: rgba(255, 255, 255, 0.6);
  font-size: 2.5rem;
}

.cualidad-placeholder-item .cualidad-placeholder {
  color: rgba(255, 255, 255, 0.4);
  font-size: 2rem;
}

.cualidad-text {
  font-family: var(--font-family-h3, var(--base-font-family));
  font-size: var(--font-size-h3, 1.25rem);
  font-weight: var(--font-weight-h3, 600);
  letter-spacing: var(--letter-spacing-h3, 0px);
  line-height: 1.4;
  color: #ffffff;
  margin: 0;
}

.cualidad-placeholder-item .cualidad-text {
  color: rgba(255, 255, 255, 0.5);
  font-style: italic;
}

/* Responsive Design */
@media (max-width: 1024px) {
  .cualidades-grid {
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)) !important;
    gap: 1.5rem;
  }
  
  .cualidades-container {
    padding: 0 1.5rem;
  }
  
  .cualidades-title {
    font-size: 2.25rem;
  }
  
  .cualidad-image {
    width: 100px;
    height: 100px;
  }
}

@media (max-width: 768px) {
  .cualidades-block {
    padding: 3rem 0;
  }
  
  .cualidades-header {
    margin-bottom: 2rem;
  }
  
  .cualidades-title {
    font-size: 2rem;
  }
  
  .cualidades-grid {
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)) !important;
    gap: 1.25rem;
  }
  
  .cualidad-image {
    width: 90px;
    height: 90px;
    margin-bottom: 1rem;
  }
  
  .cualidad-text {
    font-size: 1.125rem;
  }
}

@media (max-width: 640px) {
  .cualidades-container {
    padding: 0 1rem;
  }
  
  .cualidades-title {
    font-size: 1.75rem;
  }
  
  .cualidades-grid {
    grid-template-columns: 1fr 1fr !important;
    gap: 1rem;
  }
  
  .cualidad-item {
    max-width: none;
  }
  
  .cualidad-image {
    width: 80px;
    height: 80px;
  }
  
  .cualidad-text {
    font-size: 1rem;
  }
}

@media (max-width: 480px) {
  .cualidades-block {
    padding: 2rem 0;
  }
  
  .cualidades-title {
    font-size: 1.5rem;
  }
  
  .cualidades-grid {
    grid-template-columns: 1fr !important;
    gap: 1.5rem;
  }
  
  .cualidad-image {
    width: 100px;
    height: 100px;
  }
}

/* Animaciones para el modo edición */
@media (prefers-reduced-motion: no-preference) {
  .cualidad-item {
    transition: all 0.3s ease;
  }
  
  .cualidad-placeholder-item {
    opacity: 0.7;
  }
  
  .cualidad-placeholder-item:hover {
    opacity: 1;
    transform: translateY(-2px);
  }
}
</style>