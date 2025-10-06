<template>
  <div class="icon-picker">
    <div class="selected-icon" @click="togglePicker">
      <component 
        :is="getSelectedIconComponent()" 
        v-bind="getSelectedIconProps()" 
        v-if="selectedIcon" 
        class="selected-icon-display" 
      />
      <span v-if="!selectedIcon" class="placeholder">Seleccionar icono</span>
      <Icon name="chevron-down" class="dropdown-arrow" :class="{ 'rotated': isOpen }" />
    </div>
    
    <div v-if="isOpen" class="icon-dropdown">
      <div class="search-box">
        <input 
          type="text" 
          v-model="searchTerm" 
          placeholder="Buscar icono..."
          class="search-input"
        >
      </div>
      
      <div class="icons-grid">
        <div 
          v-for="icon in filteredIcons" 
          :key="icon.name"
          class="icon-option"
          :class="{ 'selected': icon.name === selectedIcon }"
          @click="selectIcon(icon.name)"
        >
          <FontAwesomeIcon 
            v-if="icon.type === 'fontawesome'"
            :icon="[icon.prefix, icon.name]" 
            class="icon-display"
          />
          <Icon 
            v-else 
            :name="icon.name" 
            class="icon-display" 
          />
          <span class="icon-name">{{ icon.label }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import Icon from '@/components/global/Icon.vue'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

const props = defineProps({
  modelValue: {
    type: String,
    default: ''
  },
  placeholder: {
    type: String,
    default: 'Seleccionar icono'
  }
})

const emit = defineEmits(['update:modelValue'])

const isOpen = ref(false)
const searchTerm = ref('')
const selectedIcon = ref(props.modelValue)

// Lista de 10 iconos esenciales - híbrido de Heroicons y FontAwesome
const commonIcons = [
  // Contacto (FontAwesome sólidos)
  { name: 'envelope', label: 'Email', type: 'fontawesome', prefix: 'fas', category: 'contact' },
  { name: 'phone', label: 'Teléfono', type: 'fontawesome', prefix: 'fas', category: 'contact' },
  { name: 'map-marker-alt', label: 'Ubicación', type: 'fontawesome', prefix: 'fas', category: 'contact' },
  { name: 'globe', label: 'Sitio Web', type: 'fontawesome', prefix: 'fas', category: 'contact' },
  { name: 'clock', label: 'Horario', type: 'fontawesome', prefix: 'fas', category: 'contact' },
  
  // Redes sociales (FontAwesome brands)
  { name: 'facebook-f', label: 'Facebook', type: 'fontawesome', prefix: 'fab', category: 'social' },
  { name: 'instagram', label: 'Instagram', type: 'fontawesome', prefix: 'fab', category: 'social' },
  { name: 'twitter', label: 'Twitter', type: 'fontawesome', prefix: 'fab', category: 'social' },
  { name: 'linkedin-in', label: 'LinkedIn', type: 'fontawesome', prefix: 'fab', category: 'social' },
  { name: 'whatsapp', label: 'WhatsApp', type: 'fontawesome', prefix: 'fab', category: 'social' }
]

const filteredIcons = computed(() => {
  if (!searchTerm.value) return commonIcons
  return commonIcons.filter(icon => 
    icon.name.toLowerCase().includes(searchTerm.value.toLowerCase()) ||
    icon.label.toLowerCase().includes(searchTerm.value.toLowerCase())
  )
})

const togglePicker = () => {
  isOpen.value = !isOpen.value
}

const selectIcon = (icon) => {
  selectedIcon.value = icon
  emit('update:modelValue', icon)
  isOpen.value = false
  searchTerm.value = ''
}

const handleClickOutside = (event) => {
  if (!event.target.closest('.icon-picker')) {
    isOpen.value = false
  }
}

onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside)
})

// Actualizar cuando cambie el prop
const updateSelectedIcon = () => {
  selectedIcon.value = props.modelValue
}

// Funciones para manejar el icono seleccionado
const getSelectedIconComponent = () => {
  if (!selectedIcon.value) return null
  const iconData = commonIcons.find(icon => icon.name === selectedIcon.value)
  return iconData?.type === 'fontawesome' ? 'FontAwesomeIcon' : 'Icon'
}

const getSelectedIconProps = () => {
  if (!selectedIcon.value) return {}
  const iconData = commonIcons.find(icon => icon.name === selectedIcon.value)
  
  if (iconData?.type === 'fontawesome') {
    return { icon: [iconData.prefix, iconData.name] }
  } else {
    return { name: selectedIcon.value }
  }
}

// Watch para cambios en modelValue
onMounted(() => {
  updateSelectedIcon()
})
</script>

<style scoped>
.icon-picker {
  position: relative;
  width: 100%;
}

.selected-icon {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.75rem;
  border: 1px solid #dee2e6;
  border-radius: 6px;
  background: white;
  cursor: pointer;
  transition: all 0.2s ease;
  font-size: 0.95rem;
}

.selected-icon:hover {
  border-color: #007bff;
}

.selected-icon.open {
  border-color: #007bff;
  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
}

.placeholder {
  color: #6c757d;
  flex: 1;
}

.dropdown-arrow {
  margin-left: auto;
  width: 14px;
  height: 14px;
  color: #6c757d;
  transition: transform 0.2s ease;
  flex-shrink: 0;
}

.dropdown-arrow.rotated {
  transform: rotate(180deg);
}

.icon-dropdown {
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  background: white;
  border: 1px solid #dee2e6;
  border-radius: 6px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
  z-index: 1000;
  max-height: 400px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
}

.search-box {
  padding: 1rem;
  border-bottom: 1px solid #e9ecef;
}

.search-input {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid #dee2e6;
  border-radius: 4px;
  font-size: 0.9rem;
}

.search-input:focus {
  outline: none;
  border-color: #007bff;
  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
}

.icons-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
  gap: 0.5rem;
  padding: 1rem;
  max-height: 300px;
  overflow-y: auto;
}

.icon-option {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 0.5rem;
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.2s ease;
  text-align: center;
}

.icon-option:hover {
  background-color: #f8f9fa;
}

.icon-option.selected {
  background-color: #007bff;
  color: white;
}

.icon-display,
.selected-icon-display {
  width: 20px;
  height: 20px;
  flex-shrink: 0;
}

.selected-icon-display {
  width: 16px;
  height: 16px;
}

.icon-name {
  font-size: 0.75rem;
  font-weight: 500;
  word-break: break-word;
  line-height: 1.2;
}

/* Scrollbar styling */
.icons-grid::-webkit-scrollbar {
  width: 6px;
}

.icons-grid::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 3px;
}

.icons-grid::-webkit-scrollbar-thumb {
  background: #c1c1c1;
  border-radius: 3px;
}

.icons-grid::-webkit-scrollbar-thumb:hover {
  background: #a8a8a8;
}
</style>