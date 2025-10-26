<template>
  <div 
    class="team-block"
    :class="[
      `columns-${block.columnsCount}`,
      `gap-${block.gap}`,
      `padding-${block.padding}`,
      `align-${block.alignment}`,
      `hover-${block.hoverEffect}`
    ]"
    :style="{ backgroundColor: block.backgroundColor || 'transparent' }"
  >
    <div class="team-container">
      <div class="team-grid" :class="`columns-${block.columnsCount}`">
        <div 
          v-for="member in block.members"
          :key="member.id"
          class="team-member"
          :class="[
            `aspect-${block.aspectRatio}`,
            `mask-${block.maskType}`
          ]"
          :style="getMaskStyles()"
        >
          <div class="member-card">
            <div class="member-photo-container">
              <img 
                v-if="member.photo"
                :src="buildMediaUrl(member.photo)" 
                :alt="member.name"
                class="member-photo"
                loading="lazy"
                @error="handleImageError"
                @load="() => console.log('TeamBlock - Image loaded:', member.name, member.photo, buildMediaUrl(member.photo))"
              />
              <div v-else class="member-photo-placeholder">
                <Icon name="photo" />
                <span>Sin foto</span>
              </div>
              
              <!-- Overlay con información básica -->
              <div class="member-overlay">
                <h3 class="member-name">{{ member.name }}</h3>
                <p class="member-position">{{ member.position }}</p>
                
                <!-- Redes sociales en overlay -->
                <div v-if="member.socials.length > 0" class="member-socials">
                  <a 
                    v-for="social in member.socials"
                    :key="social.platform"
                    :href="getSocialUrl(social)"
                    :title="`${member.name} en ${getSocialLabel(social.platform)}`"
                    class="social-link"
                    :class="`social-${social.platform}`"
                    target="_blank"
                    rel="noopener noreferrer"
                    @click.stop
                  >
                    <span v-if="social.platform === 'facebook'" class="social-symbol">f</span>
                    <span v-else-if="social.platform === 'twitter'" class="social-symbol">𝕏</span>
                    <span v-else-if="social.platform === 'instagram'" class="social-symbol">📷</span>
                    <span v-else-if="social.platform === 'linkedin'" class="social-symbol">in</span>
                    <span v-else-if="social.platform === 'github'" class="social-symbol">🐙</span>
                    <Icon v-else :name="getSocialIcon(social.platform)" />
                  </a>
                </div>
              </div>
            </div>
            
            <!-- Descripción que aparece en hover -->
            <div v-if="member.description && member.description.trim()" class="member-description">
              <div class="description-content">
                <p>{{ member.description }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Estado vacío -->
      <div v-if="block.members.length === 0" class="team-empty">
        <div class="empty-state">
          <i class="fas fa-users"></i>
          <h4>Equipo Vacío</h4>
          <p>Este equipo no tiene miembros aún</p>
          <p v-if="isEditing" class="empty-help">
            <i class="fas fa-info-circle"></i>
            Usa el editor para agregar miembros del equipo
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import Icon from '@/components/global/Icon.vue'
import type { TeamBlock, TeamMemberSocial } from '@/types/blocks'
import { buildMediaUrl } from '@/utils/mediaUtils'

interface Props {
  block: TeamBlock
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

const getSocialUrl = (social: TeamMemberSocial) => {
  if (social.platform === 'email') {
    return social.url.startsWith('mailto:') ? social.url : `mailto:${social.url}`
  }
  return social.url
}

const getSocialLabel = (platform: string) => {
  const labels = {
    facebook: 'Facebook',
    twitter: 'Twitter',
    instagram: 'Instagram',
    linkedin: 'LinkedIn',
    github: 'GitHub',
    email: 'Email',
    website: 'Sitio Web'
  }
  return labels[platform as keyof typeof labels] || platform
}

const getSocialIcon = (platform: string) => {
  const icons = {
    facebook: 'globe',
    twitter: 'globe', 
    instagram: 'globe',
    linkedin: 'globe',
    github: 'globe',
    email: 'envelope',
    website: 'link'
  }
  return icons[platform as keyof typeof icons] || 'link'
}

const handleImageError = (event: Event) => {
  const img = event.target as HTMLImageElement
  console.error('TeamBlock - Image error:', img.src)
  img.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjQwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZGRkIi8+PHRleHQgeD0iNTAlIiB5PSI0NSUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxNiIgZmlsbD0iIzk5OSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9IjAuM2VtIj5Gb3RvIG5vPC90ZXh0Pjx0ZXh0IHg9IjUwJSIgeT0iNTUlIiBmb250LWZhbWlseT0iQXJpYWwsIHNhbnMtc2VyaWYiIGZvbnQtc2l6ZT0iMTYiIGZpbGw9IiM5OTkiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIwLjNlbSI+ZGlzcG9uaWJsZTwvdGV4dD48L3N2Zz4='
}
</script>

<style scoped>
.team-block {
  width: 100%;
  overflow: visible;
}

.team-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1rem;
}

.team-grid {
  display: grid;
  width: 100%;
  gap: var(--team-gap);
}

/* Configuración de columnas */
.team-grid.columns-1 {
  grid-template-columns: 1fr;
}

.team-grid.columns-2 {
  grid-template-columns: repeat(2, 1fr);
}

.team-grid.columns-3 {
  grid-template-columns: repeat(3, 1fr);
}

.team-grid.columns-4 {
  grid-template-columns: repeat(4, 1fr);
}

.team-grid.columns-5 {
  grid-template-columns: repeat(5, 1fr);
}

.team-grid.columns-6 {
  grid-template-columns: repeat(6, 1fr);
}

/* Gap entre elementos */
.gap-none {
  --team-gap: 0;
}

.gap-small {
  --team-gap: 0.5rem;
}

.gap-medium {
  --team-gap: 1rem;
}

.gap-large {
  --team-gap: 2rem;
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
.align-left .team-container {
  margin-left: 0;
  margin-right: auto;
}

.align-center .team-container {
  margin-left: auto;
  margin-right: auto;
}

.align-right .team-container {
  margin-left: auto;
  margin-right: 0;
}

/* Elementos del equipo */
.team-member {
  position: relative;
  overflow: hidden;
  background: #f8f9fa;
  border-radius: 8px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.member-card {
  position: relative;
  width: 100%;
  height: 100%;
}

.member-photo-container {
  position: relative;
  width: 100%;
  height: 100%;
  overflow: hidden;
  border-radius: inherit;
}

.member-photo {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease, filter 0.3s ease;
  display: block;
}

.member-photo-placeholder {
  width: 100%;
  height: 100%;
  background: #f8f9fa;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  color: #6c757d;
  text-align: center;
  border-radius: inherit;
}

.member-photo-placeholder span {
  font-size: 0.8rem;
  margin-top: 0.5rem;
}

/* Overlay con información básica */
.member-overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
  color: white;
  padding: 2rem 1rem 1rem;
  text-align: center;
  transform: translateY(0);
  transition: all 0.3s ease;
}

.member-name {
  margin: 0 0 0.25rem 0;
  font-size: 1.1rem;
  font-weight: 600;
  text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
}

.member-position {
  margin: 0 0 0.75rem 0;
  font-size: 0.9rem;
  opacity: 0.9;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
}

.member-socials {
  display: flex;
  justify-content: center;
  gap: 0.75rem;
  flex-wrap: wrap;
}

.social-link {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 50%;
  color: white;
  text-decoration: none;
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.3);
}

.social-link:hover {
  background: rgba(255, 255, 255, 0.3);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.social-symbol {
  font-weight: bold;
  font-size: 1rem;
  color: inherit;
}

/* Estilos específicos por plataforma */
.social-facebook:hover {
  background: rgba(24, 119, 242, 0.8);
}

.social-twitter:hover {
  background: rgba(0, 0, 0, 0.8);
}

.social-instagram:hover {
  background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
}

.social-linkedin:hover {
  background: rgba(0, 119, 181, 0.8);
}

.social-github:hover {
  background: rgba(51, 51, 51, 0.8);
}

/* Descripción que aparece en hover */
.member-description {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.9);
  color: white;
  padding: 1.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  opacity: 0;
  visibility: hidden;
  transform: translateY(20px);
  transition: all 0.3s ease;
  backdrop-filter: blur(5px);
  border-radius: inherit;
  z-index: 10;
}

.description-content {
  max-width: 100%;
  max-height: 100%;
  overflow-y: auto;
}

.member-description p {
  margin: 0;
  font-size: 0.95rem;
  line-height: 1.5;
  text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
}

/* Hover effects */
.team-member:hover .member-description {
  opacity: 1;
  transform: translateY(0);
  visibility: visible;
}

.team-member:hover .member-photo {
  transform: scale(1.05);
}

.hover-zoom .team-member:hover .member-photo {
  transform: scale(1.1);
}

.hover-fade .team-member:hover .member-photo {
  filter: brightness(0.7);
}

.hover-lift .team-member:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
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
  min-height: 300px;
}

/* Máscaras */
.mask-circle .member-photo {
  clip-path: circle(50%);
}

.mask-circle .member-photo-container {
  border-radius: 50%;
}

.mask-rounded .member-photo {
  border-radius: inherit;
}

.mask-custom .member-photo {
  clip-path: inherit;
}

/* Estado vacío */
.team-empty {
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
  .team-grid.columns-6 {
    grid-template-columns: repeat(3, 1fr);
  }
  
  .team-grid.columns-5 {
    grid-template-columns: repeat(3, 1fr);
  }
  
  .team-grid.columns-4 {
    grid-template-columns: repeat(2, 1fr);
  }
  
  .member-overlay {
    padding: 1.5rem 0.75rem 0.75rem;
  }
  
  .member-name {
    font-size: 1rem;
  }
  
  .member-position {
    font-size: 0.85rem;
  }
  
  .social-link {
    width: 32px;
    height: 32px;
  }
}

@media (max-width: 768px) {
  .team-grid.columns-6,
  .team-grid.columns-5,
  .team-grid.columns-4,
  .team-grid.columns-3 {
    grid-template-columns: repeat(2, 1fr);
  }
  
  .gap-large {
    --team-gap: 1rem;
  }
  
  .gap-medium {
    --team-gap: 0.75rem;
  }
  
  .member-overlay {
    padding: 1rem 0.5rem 0.5rem;
  }
  
  .member-name {
    font-size: 0.95rem;
  }
  
  .member-position {
    font-size: 0.8rem;
    margin-bottom: 0.5rem;
  }
  
  .member-socials {
    gap: 0.5rem;
  }
  
  .social-link {
    width: 28px;
    height: 28px;
  }
  
  .member-description {
    padding: 1rem;
  }
  
  .member-description p {
    font-size: 0.9rem;
  }
}

@media (max-width: 480px) {
  .team-grid {
    grid-template-columns: 1fr !important;
  }
  
  .team-container {
    padding: 0 0.5rem;
  }
  
  .gap-large,
  .gap-medium {
    --team-gap: 0.5rem;
  }
  
  .member-overlay {
    padding: 0.75rem 0.5rem 0.5rem;
  }
  
  .member-name {
    font-size: 0.9rem;
  }
  
  .member-position {
    font-size: 0.75rem;
  }
  
  .social-link {
    width: 26px;
    height: 26px;
  }
  
  .member-description {
    padding: 0.75rem;
  }
  
  .member-description p {
    font-size: 0.85rem;
  }
  
  .aspect-auto {
    min-height: 250px;
  }
}

/* Touch devices */
@media (hover: none) {
  .member-description {
    position: static;
    opacity: 1;
    transform: none;
    background: rgba(0, 0, 0, 0.8);
    margin-top: -60px;
    z-index: 1;
    border-radius: 0 0 8px 8px;
  }
  
  .member-overlay {
    position: static;
    background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.8));
    padding: 1rem;
  }
}
</style>