<template>
  <div
    class="contact-block"
    :class="[`padding-${block.padding}`]"
    :style="blockStyles"
  >
    <!-- Título de la Sección -->
    <div v-if="block.title" class="contact-header">
      <h2 class="contact-title">{{ block.title }}</h2>
      <p v-if="block.subtitle" class="contact-subtitle">{{ block.subtitle }}</p>
    </div>

    <!-- Grid de Información de Contacto -->
    <div class="contact-grid">
      <!-- Tarjetas de Contacto -->
      <div v-for="(item, index) in block.contactItems" :key="index" class="contact-card">
        <div class="card-icon" :style="{ color: block.iconColor || '#0C6444' }">
          <i :class="item.icon"></i>
        </div>
        <h3 class="card-title">{{ item.title }}</h3>
        <div class="card-content">
          <template v-if="item.type === 'address'">
            <p>{{ item.value }}</p>
          </template>
          <template v-else-if="item.type === 'phone'">
            <a :href="`tel:${item.value}`" class="contact-link">{{ item.value }}</a>
          </template>
          <template v-else-if="item.type === 'email'">
            <a :href="`mailto:${item.value}`" class="contact-link">{{ item.value }}</a>
          </template>
          <template v-else-if="item.type === 'hours'">
            <p v-for="(hour, idx) in item.hours" :key="idx" class="hours-item">{{ hour }}</p>
          </template>
          <template v-else-if="item.type === 'social'">
            <div class="social-links">
              <a
                v-for="(social, idx) in item.socials"
                :key="idx"
                :href="social.url"
                target="_blank"
                :aria-label="social.name"
                class="social-link"
              >
                <i :class="social.icon"></i>
              </a>
            </div>
          </template>
          <template v-else>
            <p>{{ item.value }}</p>
          </template>
        </div>
      </div>
    </div>

    <!-- Mapa (opcional) -->
    <div v-if="block.showMap" class="map-container" :style="{ height: `${block.mapHeight}px` }">
      <iframe
        :src="googleMapsEmbedUrl"
        :style="{ height: `${block.mapHeight}px` }"
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
import type { ContactBlock as ContactBlockType } from '@/types/blocks'

interface Props {
  block: ContactBlockType
  isEditing?: boolean
}

const props = withDefaults(defineProps<Props>(), {
  isEditing: false
})

const blockStyles = computed(() => ({
  backgroundColor: props.block.backgroundColor || 'transparent',
  color: props.block.textColor || '#333'
}))

const googleMapsEmbedUrl = computed(() => {
  if (!props.block.mapAddress) return ''
  const encodedAddress = encodeURIComponent(props.block.mapAddress)
  const zoom = props.block.mapZoom || 15
  return `https://www.google.com/maps?q=${encodedAddress}&t=m&z=${zoom}&output=embed&iwloc=near`
})
</script>

<style scoped>
.contact-block {
  width: 100%;
  max-width: 1400px;
  margin: 0 auto;
}

.contact-block.padding-small {
  padding: 2rem 1rem;
}

.contact-block.padding-medium {
  padding: 4rem 2rem;
}

.contact-block.padding-large {
  padding: 6rem 2rem;
}

/* Header */
.contact-header {
  text-align: center;
  margin-bottom: 3rem;
}

.contact-title {
  font-size: 2.5rem;
  font-weight: 700;
  margin: 0 0 1rem 0;
  line-height: 1.2;
}

.contact-subtitle {
  font-size: 1.1rem;
  color: #666;
  margin: 0;
  max-width: 600px;
  margin: 0 auto;
}

/* Grid */
.contact-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 2rem;
  margin-bottom: 3rem;
}

/* Tarjetas */
.contact-card {
  background: white;
  border-radius: 12px;
  padding: 2rem;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  transition: all 0.3s ease;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.contact-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
}

.card-icon {
  width: 70px;
  height: 70px;
  border-radius: 50%;
  background: rgba(12, 100, 68, 0.1);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1.5rem;
  font-size: 2rem;
}

.card-title {
  font-size: 1.25rem;
  font-weight: 600;
  margin: 0 0 1rem 0;
  color: #333;
}

.card-content {
  font-size: 1rem;
  line-height: 1.6;
  color: #666;
}

.card-content p {
  margin: 0.25rem 0;
}

.contact-link {
  color: #0C6444;
  text-decoration: none;
  font-weight: 500;
  transition: color 0.3s ease;
}

.contact-link:hover {
  color: #094d32;
  text-decoration: underline;
}

.hours-item {
  margin: 0.5rem 0;
  padding: 0.5rem;
  background: #f8f9fa;
  border-radius: 6px;
}

/* Social Links */
.social-links {
  display: flex;
  gap: 1rem;
  justify-content: center;
  flex-wrap: wrap;
}

.social-link {
  width: 45px;
  height: 45px;
  border-radius: 50%;
  background: #0C6444;
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  font-size: 1.2rem;
  transition: all 0.3s ease;
}

.social-link:hover {
  background: #094d32;
  transform: translateY(-3px);
  box-shadow: 0 4px 12px rgba(12, 100, 68, 0.3);
}

/* Mapa */
.map-container {
  margin-top: 3rem;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.google-map {
  width: 100%;
  border: 0;
}

/* Responsive */
@media (max-width: 768px) {
  .contact-title {
    font-size: 2rem;
  }

  .contact-grid {
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }

  .contact-block.padding-medium {
    padding: 3rem 1rem;
  }

  .contact-block.padding-large {
    padding: 4rem 1rem;
  }
}
</style>
