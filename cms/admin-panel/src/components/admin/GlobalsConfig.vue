<template>
  <div class="globals-config">
    <div class="config-section">
      <h3>Configuración Global</h3>
      <p class="section-desc">Personaliza la tipografía, colores y estilos globales del sitio web</p>
    </div>

    <div class="config-form">
      <!-- Tipografías -->
      <div class="form-section">
        <h4>Tipografías</h4>
        
        <!-- Selector de fuente base por defecto -->
        <div class="form-group">
          <label for="base-font-family">Fuente base del sitio</label>
          <div class="font-selector">
            <select v-model="globalsConfig.baseFontFamily" class="font-select" @change="updatePreview">
              <optgroup label="Google Fonts Sans-Serif">
                <option value="'Lato', sans-serif">Lato</option>
                <option value="'Open Sans', sans-serif">Open Sans</option>
                <option value="'Roboto', sans-serif">Roboto</option>
                <option value="'Montserrat', sans-serif">Montserrat</option>
                <option value="'Poppins', sans-serif">Poppins</option>
                <option value="'Nunito', sans-serif">Nunito</option>
                <option value="'Inter', sans-serif">Inter</option>
                <option value="'Work Sans', sans-serif">Work Sans</option>
                <option value="'Source Sans Pro', sans-serif">Source Sans Pro</option>
              </optgroup>
              <optgroup label="Google Fonts Serif">
                <option value="'PT Serif', serif">PT Serif</option>
                <option value="'Playfair Display', serif">Playfair Display</option>
                <option value="Georgia, serif">Georgia</option>
                <option value="'Times New Roman', serif">Times New Roman</option>
              </optgroup>
              <optgroup label="Fuentes del Sistema">
                <option value="Arial, sans-serif">Arial</option>
                <option value="Helvetica, sans-serif">Helvetica</option>
                <option value="'Courier New', monospace">Courier New</option>
              </optgroup>
            </select>
            <div class="font-preview" :style="{ fontFamily: globalsConfig.baseFontFamily }">
              Fuente base para el cuerpo del sitio web
            </div>
          </div>
        </div>

        <!-- Configuración individual por elemento -->
        <div class="typography-elements">
          <h5>Configuración Individual de Elementos</h5>
          <div class="elements-grid">
            <div 
              class="element-config" 
              v-for="(config, element) in globalsConfig.typography" 
              :key="element"
            >
              <h6>{{ getElementLabel(element) }}</h6>
              
              <!-- Selector de fuente -->
              <div class="form-group">
                <label :for="`font-${element}`">Fuente</label>
                <select 
                  :id="`font-${element}`"
                  v-model="globalsConfig.typography[element].fontFamily" 
                  class="font-select-small"
                  @change="updatePreview"
                >
                  <option value="inherit">Heredar de la base</option>
                  <optgroup label="Google Fonts Sans-Serif">
                    <option value="'Lato', sans-serif">Lato</option>
                    <option value="'Open Sans', sans-serif">Open Sans</option>
                    <option value="'Roboto', sans-serif">Roboto</option>
                    <option value="'Montserrat', sans-serif">Montserrat</option>
                    <option value="'Poppins', sans-serif">Poppins</option>
                    <option value="'Nunito', sans-serif">Nunito</option>
                    <option value="'Inter', sans-serif">Inter</option>
                    <option value="'Work Sans', sans-serif">Work Sans</option>
                    <option value="'Source Sans Pro', sans-serif">Source Sans Pro</option>
                  </optgroup>
                  <optgroup label="Google Fonts Serif">
                    <option value="'PT Serif', serif">PT Serif</option>
                    <option value="'Playfair Display', serif">Playfair Display</option>
                    <option value="Georgia, serif">Georgia</option>
                    <option value="'Times New Roman', serif">Times New Roman</option>
                  </optgroup>
                  <optgroup label="Fuentes del Sistema">
                    <option value="Arial, sans-serif">Arial</option>
                    <option value="Helvetica, sans-serif">Helvetica</option>
                    <option value="'Courier New', monospace">Courier New</option>
                  </optgroup>
                </select>
              </div>
              
              <!-- Tamaño de fuente -->
              <div class="form-group">
                <label :for="`size-${element}`">Tamaño</label>
                <div class="size-input-group">
                  <input 
                    type="range" 
                    :id="`size-${element}`"
                    v-model.number="globalsConfig.typography[element].fontSize" 
                    min="12" 
                    max="72" 
                    step="2"
                    class="size-range"
                    @input="updatePreview"
                  >
                  <input 
                    type="number" 
                    v-model.number="globalsConfig.typography[element].fontSize" 
                    min="12" 
                    max="72"
                    class="size-number"
                    @input="updatePreview"
                  >
                  <span class="size-unit">px</span>
                </div>
              </div>
              
              <!-- Peso de fuente -->
              <div class="form-group">
                <label :for="`weight-${element}`">Peso</label>
                <select 
                  :id="`weight-${element}`"
                  v-model="globalsConfig.typography[element].fontWeight" 
                  class="font-select-small"
                  @change="updatePreview"
                >
                  <option value="inherit">Heredar</option>
                  <option value="100">Thin (100)</option>
                  <option value="200">Extra Light (200)</option>
                  <option value="300">Light (300)</option>
                  <option value="400">Normal (400)</option>
                  <option value="500">Medium (500)</option>
                  <option value="600">Semi Bold (600)</option>
                  <option value="700">Bold (700)</option>
                  <option value="800">Extra Bold (800)</option>
                  <option value="900">Black (900)</option>
                </select>
              </div>
              
              <!-- Tracking (Letter Spacing) -->
              <div class="form-group">
                <label :for="`tracking-${element}`">Tracking</label>
                <div class="size-input-group">
                  <input 
                    type="range" 
                    :id="`tracking-${element}`"
                    v-model.number="globalsConfig.typography[element].letterSpacing" 
                    min="-2" 
                    max="5" 
                    step="0.1"
                    class="size-range"
                    @input="updatePreview"
                  >
                  <input 
                    type="number" 
                    v-model.number="globalsConfig.typography[element].letterSpacing" 
                    min="-2" 
                    max="5"
                    step="0.1"
                    class="size-number"
                    @input="updatePreview"
                  >
                  <span class="size-unit">px</span>
                </div>
              </div>
              
              <!-- Vista previa -->
              <div class="element-preview">
                <component 
                  :is="element === 'p' ? 'p' : element"
                  class="preview-text"
                  :style="{
                    fontSize: globalsConfig.typography[element].fontSize + 'px',
                    fontFamily: globalsConfig.typography[element].fontFamily === 'inherit' 
                      ? globalsConfig.baseFontFamily 
                      : globalsConfig.typography[element].fontFamily,
                    fontWeight: globalsConfig.typography[element].fontWeight === 'inherit'
                      ? 'normal'
                      : globalsConfig.typography[element].fontWeight,
                    letterSpacing: globalsConfig.typography[element].letterSpacing + 'px'
                  }"
                >
                  {{ getPreviewText(element) }}
                </component>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Paleta de Colores -->
      <div class="form-section">
        <h4>Paleta de Colores</h4>
        <p class="section-desc">Define los 7 colores principales del sitio</p>
        
        <div class="color-palette">
          <div 
            v-for="(color, index) in globalsConfig.colorPalette" 
            :key="index" 
            class="color-item"
          >
            <label :for="`color-${index}`">Color {{ index + 1 }}</label>
            <div class="color-input-group">
              <input 
                type="color" 
                :id="`color-${index}`"
                v-model="globalsConfig.colorPalette[index]" 
                class="color-picker-large"
                @input="updatePreview"
              >
              <input 
                type="text" 
                v-model="globalsConfig.colorPalette[index]" 
                class="color-text"
                @input="updatePreview"
              >
            </div>
            <div class="color-usage">
              <span class="usage-label">{{ getColorUsage(index) }}</span>
            </div>
          </div>
        </div>
      </div>


      <!-- Estilos de Botones -->
      <div class="form-section">
        <h4>Estilos de Botones</h4>
        <p class="section-desc">Configura los 3 tipos de botones principales</p>
        
        <div class="button-styles">
          <!-- Botón Outline -->
          <div class="button-config">
            <h5>Botón Outline</h5>
            <div class="button-options">
              <div class="form-row">
                <div class="form-group">
                  <label>Color del borde</label>
                  <div class="color-input-group">
                    <input 
                      type="color" 
                      v-model="globalsConfig.buttons.outline.borderColor" 
                      class="color-picker"
                      @input="updatePreview"
                    >
                    <input 
                      type="text" 
                      v-model="globalsConfig.buttons.outline.borderColor" 
                      class="color-text"
                    >
                  </div>
                </div>
                <div class="form-group">
                  <label>Color del texto</label>
                  <div class="color-input-group">
                    <input 
                      type="color" 
                      v-model="globalsConfig.buttons.outline.textColor" 
                      class="color-picker"
                      @input="updatePreview"
                    >
                    <input 
                      type="text" 
                      v-model="globalsConfig.buttons.outline.textColor" 
                      class="color-text"
                    >
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label>Border radius (px)</label>
                  <input 
                    type="range" 
                    v-model.number="globalsConfig.buttons.outline.borderRadius" 
                    min="0" 
                    max="50"
                    class="range-input"
                    @input="updatePreview"
                  >
                  <span>{{ globalsConfig.buttons.outline.borderRadius }}px</span>
                </div>
                <div class="form-group">
                  <label>Grosor del borde (px)</label>
                  <input 
                    type="range" 
                    v-model.number="globalsConfig.buttons.outline.borderWidth" 
                    min="1" 
                    max="5"
                    class="range-input"
                    @input="updatePreview"
                  >
                  <span>{{ globalsConfig.buttons.outline.borderWidth }}px</span>
                </div>
              </div>
            </div>
            <div class="button-preview">
              <button 
                class="preview-btn outline-btn" 
                :style="getOutlineButtonStyle()"
              >
                Botón Outline
              </button>
            </div>
          </div>

          <!-- Botón Plano -->
          <div class="button-config">
            <h5>Botón Plano</h5>
            <div class="button-options">
              <div class="form-row">
                <div class="form-group">
                  <label>Color de fondo</label>
                  <div class="color-input-group">
                    <input 
                      type="color" 
                      v-model="globalsConfig.buttons.flat.backgroundColor" 
                      class="color-picker"
                      @input="updatePreview"
                    >
                    <input 
                      type="text" 
                      v-model="globalsConfig.buttons.flat.backgroundColor" 
                      class="color-text"
                    >
                  </div>
                </div>
                <div class="form-group">
                  <label>Color del texto</label>
                  <div class="color-input-group">
                    <input 
                      type="color" 
                      v-model="globalsConfig.buttons.flat.textColor" 
                      class="color-picker"
                      @input="updatePreview"
                    >
                    <input 
                      type="text" 
                      v-model="globalsConfig.buttons.flat.textColor" 
                      class="color-text"
                    >
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Border radius (px)</label>
                <input 
                  type="range" 
                  v-model.number="globalsConfig.buttons.flat.borderRadius" 
                  min="0" 
                  max="50"
                  class="range-input"
                  @input="updatePreview"
                >
                <span>{{ globalsConfig.buttons.flat.borderRadius }}px</span>
              </div>
            </div>
            <div class="button-preview">
              <button 
                class="preview-btn flat-btn" 
                :style="getFlatButtonStyle()"
              >
                Botón Plano
              </button>
            </div>
          </div>

          <!-- Botón Degradado -->
          <div class="button-config">
            <h5>Botón Degradado</h5>
            <div class="button-options">
              <div class="form-row">
                <div class="form-group">
                  <label>Color 1</label>
                  <div class="color-input-group">
                    <input 
                      type="color" 
                      v-model="globalsConfig.buttons.gradient.color1" 
                      class="color-picker"
                      @input="updatePreview"
                    >
                    <input 
                      type="text" 
                      v-model="globalsConfig.buttons.gradient.color1" 
                      class="color-text"
                    >
                  </div>
                </div>
                <div class="form-group">
                  <label>Color 2</label>
                  <div class="color-input-group">
                    <input 
                      type="color" 
                      v-model="globalsConfig.buttons.gradient.color2" 
                      class="color-picker"
                      @input="updatePreview"
                    >
                    <input 
                      type="text" 
                      v-model="globalsConfig.buttons.gradient.color2" 
                      class="color-text"
                    >
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label>Color 3</label>
                  <div class="color-input-group">
                    <input 
                      type="color" 
                      v-model="globalsConfig.buttons.gradient.color3" 
                      class="color-picker"
                      @input="updatePreview"
                    >
                    <input 
                      type="text" 
                      v-model="globalsConfig.buttons.gradient.color3" 
                      class="color-text"
                    >
                  </div>
                </div>
                <div class="form-group">
                  <label>Color del texto</label>
                  <div class="color-input-group">
                    <input 
                      type="color" 
                      v-model="globalsConfig.buttons.gradient.textColor" 
                      class="color-picker"
                      @input="updatePreview"
                    >
                    <input 
                      type="text" 
                      v-model="globalsConfig.buttons.gradient.textColor" 
                      class="color-text"
                    >
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Border radius (px)</label>
                <input 
                  type="range" 
                  v-model.number="globalsConfig.buttons.gradient.borderRadius" 
                  min="0" 
                  max="50"
                  class="range-input"
                  @input="updatePreview"
                >
                <span>{{ globalsConfig.buttons.gradient.borderRadius }}px</span>
              </div>
            </div>
            <div class="button-preview">
              <button 
                class="preview-btn gradient-btn" 
                :style="getGradientButtonStyle()"
              >
                Botón Degradado
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Acciones -->
      <div class="form-actions">
        <button @click="previewChanges" class="btn-info" type="button">
          <i class="fas fa-eye"></i>
          Vista Previa
        </button>
        <button @click="saveConfig" class="btn-primary" :disabled="saving">
          <i class="fas fa-save"></i>
          {{ saving ? 'Guardando...' : 'Guardar Cambios' }}
        </button>
        <button @click="resetConfig" class="btn-secondary" type="button">
          <i class="fas fa-undo"></i>
          Restaurar Defaults
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useGlobals } from '@/composables/useGlobals'

const saving = ref(false)
const { globalsConfig, saveGlobalsConfig, loadGlobalsConfig, updateGlobalsConfig } = useGlobals()


const getColorUsage = (index) => {
  const usages = [
    'Primario',
    'Secundario', 
    'Éxito',
    'Peligro',
    'Advertencia',
    'Info',
    'Oscuro'
  ]
  return usages[index] || `Color ${index + 1}`
}

const getOutlineButtonStyle = () => ({
  border: `${globalsConfig.value.buttons.outline.borderWidth}px solid ${globalsConfig.value.buttons.outline.borderColor}`,
  color: globalsConfig.value.buttons.outline.textColor,
  backgroundColor: 'transparent',
  borderRadius: `${globalsConfig.value.buttons.outline.borderRadius}px`,
  padding: '0.75rem 1.5rem',
  fontFamily: globalsConfig.value.fontFamily,
  cursor: 'pointer',
  transition: 'all 0.3s ease'
})

const getFlatButtonStyle = () => ({
  backgroundColor: globalsConfig.value.buttons.flat.backgroundColor,
  color: globalsConfig.value.buttons.flat.textColor,
  border: 'none',
  borderRadius: `${globalsConfig.value.buttons.flat.borderRadius}px`,
  padding: '0.75rem 1.5rem',
  fontFamily: globalsConfig.value.fontFamily,
  cursor: 'pointer',
  transition: 'all 0.3s ease'
})

const getGradientButtonStyle = () => ({
  background: `linear-gradient(135deg, ${globalsConfig.value.buttons.gradient.color1} 0%, ${globalsConfig.value.buttons.gradient.color2} 50%, ${globalsConfig.value.buttons.gradient.color3} 100%)`,
  color: globalsConfig.value.buttons.gradient.textColor,
  border: 'none',
  borderRadius: `${globalsConfig.value.buttons.gradient.borderRadius}px`,
  padding: '0.75rem 1.5rem',
  fontFamily: globalsConfig.value.fontFamily,
  cursor: 'pointer',
  transition: 'all 0.3s ease'
})

const getElementLabel = (element) => {
  const labels = {
    h1: 'Título H1',
    h2: 'Título H2', 
    h3: 'Título H3',
    h4: 'Título H4',
    h5: 'Título H5',
    h6: 'Título H6',
    p: 'Párrafo'
  }
  return labels[element] || element.toUpperCase()
}

const getPreviewText = (element) => {
  const texts = {
    h1: 'Título Principal H1',
    h2: 'Subtítulo H2',
    h3: 'Encabezado H3',
    h4: 'Título H4',
    h5: 'Subtítulo H5',
    h6: 'Encabezado H6',
    p: 'Este es un párrafo de ejemplo que muestra cómo se ve el texto con la configuración aplicada.'
  }
  return texts[element] || `Texto ${element.toUpperCase()}`
}

const updatePreview = () => {
  // Actualizar fuente base
  document.documentElement.style.setProperty('--base-font-family', globalsConfig.value.baseFontFamily)
  
  // Actualizar estilos individuales de elementos
  Object.entries(globalsConfig.value.typography).forEach(([element, config]) => {
    const fontFamily = config.fontFamily === 'inherit' ? globalsConfig.value.baseFontFamily : config.fontFamily
    const fontWeight = config.fontWeight === 'inherit' ? 'normal' : config.fontWeight
    
    document.documentElement.style.setProperty(`--font-family-${element}`, fontFamily)
    document.documentElement.style.setProperty(`--font-size-${element}`, `${config.fontSize}px`)
    document.documentElement.style.setProperty(`--font-weight-${element}`, fontWeight)
    document.documentElement.style.setProperty(`--letter-spacing-${element}`, `${config.letterSpacing}px`)
  })
  
  // Actualizar colores
  globalsConfig.value.colorPalette.forEach((color, index) => {
    document.documentElement.style.setProperty(`--color-${index + 1}`, color)
  })
}

const previewChanges = () => {
  updatePreview()
  
  window.dispatchEvent(new CustomEvent('globalsConfigChanged', { 
    detail: globalsConfig.value 
  }))
}

const saveConfig = async () => {
  saving.value = true
  try {
    const success = await saveGlobalsConfig(
      globalsConfig.value, 
      'Configuración guardada desde panel admin'
    )
    
    if (success) {
      window.dispatchEvent(new CustomEvent('globalsConfigChanged', { 
        detail: globalsConfig.value 
      }))
      alert('Configuración global guardada exitosamente en la base de datos')
    } else {
      alert('Error al guardar la configuración en la base de datos')
    }
  } catch (error) {
    console.error('Error saving config:', error)
    alert('Error al guardar la configuración global')
  } finally {
    saving.value = false
  }
}


const resetConfig = () => {
  globalsConfig.value = {
    baseFontFamily: "'Lato', sans-serif",
    typography: {
      h1: {
        fontFamily: 'inherit',
        fontSize: 48,
        fontWeight: '700',
        letterSpacing: 0
      },
      h2: {
        fontFamily: 'inherit',
        fontSize: 36,
        fontWeight: '600',
        letterSpacing: 0
      },
      h3: {
        fontFamily: 'inherit',
        fontSize: 28,
        fontWeight: '600',
        letterSpacing: 0
      },
      h4: {
        fontFamily: 'inherit',
        fontSize: 24,
        fontWeight: '600',
        letterSpacing: 0
      },
      h5: {
        fontFamily: 'inherit',
        fontSize: 20,
        fontWeight: '600',
        letterSpacing: 0
      },
      h6: {
        fontFamily: 'inherit',
        fontSize: 18,
        fontWeight: '600',
        letterSpacing: 0
      },
      p: {
        fontFamily: 'inherit',
        fontSize: 16,
        fontWeight: '400',
        letterSpacing: 0
      }
    },
    colorPalette: [
      '#007bff',
      '#17a2b8',
      '#28a745',
      '#dc3545',
      '#ffc107',
      '#6c757d',
      '#343a40'
    ],
    buttons: {
      outline: {
        borderColor: '#007bff',
        textColor: '#007bff',
        borderRadius: 8,
        borderWidth: 2
      },
      flat: {
        backgroundColor: '#007bff',
        textColor: '#ffffff',
        borderRadius: 8
      },
      gradient: {
        color1: '#007bff',
        color2: '#0056b3',
        color3: '#004085',
        textColor: '#ffffff',
        borderRadius: 8
      }
    }
  }
}

onMounted(async () => {
  await loadGlobalsConfig()
  updatePreview()
})
</script>

<style scoped>
.globals-config {
  max-width: auto;
}

.config-section {
  margin-bottom: 2rem;
}

.config-section h3 {
  color: #2c3e50;
  margin: 0 0 0.5rem 0;
  font-size: 1.5rem;
  font-family: 'Lato', sans-serif;
}

.section-desc {
  color: #6c757d;
  margin: 0;
  font-size: 0.95rem;
}

.config-form {
  background: white;
  border-radius: 12px;
  padding: 2rem;
}

.form-section {
  margin-bottom: 3rem;
  padding-bottom: 2rem;
  border-bottom: 1px solid #e9ecef;
}

.form-section:last-of-type {
  border-bottom: none;
  margin-bottom: 0;
}

.form-section h4 {
  color: #2c3e50;
  margin: 0 0 1.5rem 0;
  font-size: 1.2rem;
  font-weight: 600;
  font-family: 'Lato', sans-serif;
}

.form-section h5 {
  color: #2c3e50;
  margin: 0 0 1rem 0;
  font-size: 1rem;
  font-weight: 600;
  font-family: 'Lato', sans-serif;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.5rem;
  margin-bottom: 1rem;
}

.form-group {
  margin-bottom: 1rem;
}

.form-group label {
  display: block;
  font-weight: 600;
  color: #2c3e50;
  margin-bottom: 0.5rem;
  font-family: 'Lato', sans-serif;
  font-size: 0.9rem;
}

.font-select, .font-select-small {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #dee2e6;
  border-radius: 6px;
  font-size: 0.95rem;
  margin-bottom: 1rem;
}

.font-select-small {
  padding: 0.5rem;
  font-size: 0.85rem;
  margin-bottom: 0.5rem;
}

.font-preview {
  padding: 1rem;
  background: #f8f9fa;
  border: 1px solid #dee2e6;
  border-radius: 6px;
  font-size: 1.1rem;
  color: #2c3e50;
}

.typography-elements {
  margin-top: 2rem;
}

.elements-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 1.5rem;
}

.element-config {
  background: #f8f9fa;
  padding: 1.5rem;
  border-radius: 12px;
  border: 1px solid #dee2e6;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.element-config h6 {
  color: #2c3e50;
  margin: 0 0 1rem 0;
  font-size: 1rem;
  font-weight: 600;
  text-align: center;
  padding-bottom: 0.5rem;
  border-bottom: 2px solid #007bff;
}

.size-input-group {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  margin: 0.5rem 0;
}

.size-range {
  flex: 1;
}

.size-number {
  width: 60px;
  padding: 0.25rem;
  border: 1px solid #dee2e6;
  border-radius: 4px;
  text-align: center;
}

.size-unit {
  font-size: 0.85rem;
  color: #6c757d;
  font-weight: 500;
}

.element-preview {
  margin-top: 1rem;
  padding: 1rem;
  background: white;
  border-radius: 6px;
  border: 1px solid #e9ecef;
}

.preview-text {
  margin: 0;
  color: #2c3e50;
  line-height: 1.4;
}

.color-palette {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1.5rem;
}

.color-item {
  background: #f8f9fa;
  padding: 1rem;
  border-radius: 8px;
  border: 1px solid #dee2e6;
  text-align: center;
}

.color-input-group {
  display: flex;
  gap: 0.5rem;
  align-items: center;
  margin: 0.5rem 0;
}

.color-picker, .color-picker-large {
  width: 50px;
  height: 40px;
  border: 1px solid #dee2e6;
  border-radius: 6px;
  cursor: pointer;
  padding: 0;
}

.color-picker-large {
  width: 80px;
  height: 60px;
}

.color-text {
  width: 100%;
  flex: 1;
  padding: 0.5rem;
  border: 1px solid #dee2e6;
  border-radius: 6px;
  font-family: monospace;
}

.color-usage {
  margin-top: 0.5rem;
}

.usage-label {
  display: inline-block;
  padding: 0.25rem 0.75rem;
  background: #007bff;
  color: white;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 500;
}

.button-styles {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 2rem;
}

.button-config {
  background: #f8f9fa;
  padding: 1.5rem;
  border-radius: 8px;
  border: 1px solid #dee2e6;
}

.button-options {
  margin: 1rem 0;
}

.range-input {
  flex: 1;
  margin-right: 1rem;
}

.button-preview {
  margin-top: 1rem;
  text-align: center;
}

.preview-btn {
  font-size: 0.95rem;
  font-weight: 500;
}

.preview-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.form-actions {
  margin-top: 3rem;
  padding-top: 2rem;
  border-top: 1px solid #e9ecef;
  display: flex;
  gap: 1rem;
  justify-content: flex-end;
}

.btn-primary, .btn-secondary, .btn-info {
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.875rem;
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  transition: all 0.2s;
}

.btn-primary {
  background-color: #007bff;
  color: white;
}

.btn-primary:hover:not(:disabled) {
  background-color: #0056b3;
}

.btn-primary:disabled {
  background-color: #6c757d;
  cursor: not-allowed;
}

.btn-secondary {
  background-color: #6c757d;
  color: white;
}

.btn-secondary:hover {
  background-color: #545b62;
}

.btn-info {
  background-color: #17a2b8;
  color: white;
}

.btn-info:hover {
  background-color: #138496;
}


@media (max-width: 768px) {
  .config-form {
    padding: 1rem;
  }
  
  .form-row {
    grid-template-columns: 1fr;
    gap: 1rem;
  }
  
  .elements-grid {
    grid-template-columns: 1fr;
  }
  
  .element-config {
    padding: 1rem;
  }
  
  .color-palette {
    grid-template-columns: 1fr;
  }
  
  .button-styles {
    grid-template-columns: 1fr;
  }
  
  .form-actions {
    flex-direction: column;
  }
  
  .form-actions button {
    width: 100%;
    justify-content: center;
  }
}
</style>