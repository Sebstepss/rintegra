<template>
  <div class="modal-overlay">
    <div class="modal-content" @click.stop>
      <!-- Modal Header -->
      <div class="modal-header">
        <h3>Editar Bloque de Texto</h3>
        <button @click="$emit('close')" class="btn-close">
          <Icon name="close" />
        </button>
      </div>
      
      <!-- Modal Body -->
      <div class="modal-body">
        <!-- Tabs Navigation -->
        <div class="tabs-nav">
          <button 
            @click="activeTab = 'general'"
            class="tab-button"
            :class="{ active: activeTab === 'general' }"
          >
            <Icon name="settings" />
            Configuración General
          </button>
          <button 
            @click="activeTab = 'attributes'"
            class="tab-button"
            :class="{ active: activeTab === 'attributes' }"
          >
            <Icon name="code" />
            Atributos
          </button>
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
          <!-- Configuración General Tab -->
          <div v-show="activeTab === 'general'" class="tab-pane">
            <div class="editor-sections">
          <!-- Configuración General -->
          <div class="editor-section">
            <h4>Configuración General</h4>
            
            <div class="form-row">
              <div class="form-group">
                <label>Gestión de columnas</label>
                <div class="columns-management">
                  <span class="columns-info">{{ localBlock.columns.length }} columna{{ localBlock.columns.length !== 1 ? 's' : '' }}</span>
                  <button 
                    @click="addColumn" 
                    class="btn-add-column"
                    :disabled="localBlock.columns.length >= 4"
                  >
                    <Icon name="plus" />
                    Añadir columna
                  </button>
                </div>
              </div>
              
              <div class="form-group">
                <label for="gap">Espaciado entre columnas</label>
                <select id="gap" v-model="localBlock.gap" class="form-input">
                  <option value="none">Sin espaciado</option>
                  <option value="small">Pequeño</option>
                  <option value="medium">Mediano</option>
                  <option value="large">Grande</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="padding">Padding del bloque</label>
                <select id="padding" v-model="localBlock.padding" class="form-input">
                  <option value="none">Sin padding</option>
                  <option value="small">Pequeño</option>
                  <option value="medium">Mediano</option>
                  <option value="large">Grande</option>
                </select>
              </div>
              
              <div class="form-group">
                <label for="bg-color">Color de fondo del bloque</label>
                <div class="color-input-group">
                  <input 
                    type="color" 
                    id="bg-color" 
                    :value="localBlock.backgroundColor || '#ffffff'"
                    @input="localBlock.backgroundColor = ($event.target as HTMLInputElement).value"
                    class="color-picker"
                  >
                  <input 
                    type="text" 
                    v-model="localBlock.backgroundColor" 
                    class="color-text"
                    placeholder="#ffffff"
                  >
                </div>
              </div>
            </div>
          </div>

          <!-- Configuración de Columnas -->
          <div class="editor-section">
            <h4>Configuración de Columnas</h4>
            
            <div class="columns-grid" :class="`columns-${localBlock.columnsCount}`">
              <div 
                v-for="(column, columnIndex) in localBlock.columns" 
                :key="column.id"
                class="column-editor"
              >
                <div class="column-header">
                  <h5>Columna {{ columnIndex + 1 }}</h5>
                  <div class="column-actions">
                    <button 
                      @click="addTextToColumn(columnIndex)" 
                      class="btn-add-text"
                      title="Añadir texto"
                    >
                      <Icon name="plus" />
                    </button>
                    <button 
                      @click="removeColumn(columnIndex)" 
                      class="btn-remove-column"
                      title="Eliminar columna"
                      :disabled="localBlock.columns.length <= 1"
                    >
                      <Icon name="trash" />
                    </button>
                  </div>
                </div>

                <!-- Configuración de colores de la columna -->
                <div class="column-colors">
                  <div class="form-group">
                    <label>Color de fondo</label>
                    <div class="color-input-group">
                      <input 
                        type="color" 
                        :value="column.backgroundColor || '#ffffff'"
                        @input="column.backgroundColor = ($event.target as HTMLInputElement).value"
                        class="color-picker small"
                      >
                      <input 
                        type="text" 
                        v-model="column.backgroundColor" 
                        class="color-text small"
                        placeholder="Transparente"
                      >
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label>Color de texto</label>
                    <div class="color-input-group">
                      <input 
                        type="color" 
                        :value="column.textColor || '#000000'"
                        @input="column.textColor = ($event.target as HTMLInputElement).value"
                        class="color-picker small"
                      >
                      <input 
                        type="text" 
                        v-model="column.textColor" 
                        class="color-text small"
                        placeholder="#000000"
                      >
                    </div>
                  </div>
                </div>

                <!-- Textos de la columna -->
                <div class="column-texts">
                  <div 
                    v-for="(textItem, textIndex) in column.texts"
                    :key="textItem.id"
                    class="text-item"
                  >
                    <div class="text-item-header">
                      <div class="text-item-info">
                        <span class="text-item-title">Texto {{ textIndex + 1 }}</span>
                      </div>
                      
                      <div class="text-item-actions">
                        <button 
                          @click="removeTextFromColumn(columnIndex, textIndex)"
                          class="btn-remove-text"
                          title="Eliminar texto"
                        >
                          <Icon name="trash" />
                        </button>
                      </div>
                    </div>

                    <!-- Editor Tiptap -->
                    <div class="simple-editor-container">
                      <TiptapEditor 
                        v-model="textItem.content"
                        :key="textItem.id"
                      />
                    </div>
                  </div>

                  <div v-if="column.texts.length === 0" class="empty-column">
                    <p>Esta columna está vacía</p>
                    <button @click="addTextToColumn(columnIndex)" class="btn-add-first">
                      <Icon name="plus" />
                      Añadir primer texto
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
            </div>
          </div>

          <!-- Atributos Tab -->
          <div v-show="activeTab === 'attributes'" class="tab-pane">
            <div class="editor-sections">
              <div class="editor-section">
                <h4>Atributos del Bloque</h4>
                
                <div class="form-group">
                  <label for="block-id">ID del bloque</label>
                  <input 
                    type="text" 
                    id="block-id" 
                    v-model="localBlock.customId"
                    class="form-input"
                    placeholder="mi-bloque-unico"
                  >
                  <small class="form-help">ID único para este bloque (opcional)</small>
                </div>

                <div class="form-group">
                  <label for="block-class">Clases CSS</label>
                  <input 
                    type="text" 
                    id="block-class" 
                    v-model="localBlock.customClass"
                    class="form-input"
                    placeholder="mi-clase otra-clase"
                  >
                  <small class="form-help">Clases CSS separadas por espacios (opcional)</small>
                </div>

                <div class="form-group">
                  <label for="custom-css">CSS Personalizado</label>
                  <textarea 
                    id="custom-css" 
                    v-model="localBlock.customCSS"
                    rows="12"
                    class="form-input css-editor"
                    placeholder="/* CSS personalizado para este bloque */
/* Para aplicar al contenedor del bloque */
.mi-clase {
  background: lightblue;
  padding: 20px;
  border-radius: 10px;
}

/* Para elementos dentro del bloque */
h2 {
  color: red;
  font-weight: bold;
}

p {
  color: blue;
  font-size: 18px;
}"
                  ></textarea>
                  <small class="form-help">Este CSS se aplicará únicamente a este bloque</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Modal Footer -->
      <div class="modal-footer">
        <button @click="$emit('close')" class="btn-secondary">
          <Icon name="close" />
          Cancelar
        </button>
        <button @click="applyChanges" class="btn-primary">
          <Icon name="check" />
          Aplicar Cambios
        </button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, watch, onMounted } from 'vue'
import Icon from '@/components/global/Icon.vue'
import TiptapEditor from './TiptapEditor.vue'
import type { TextBlock, TextColumn, TextItem } from '@/types/blocks'

interface Props {
  block: TextBlock
}

interface Emits {
  (e: 'update', block: TextBlock): void
  (e: 'close'): void
}

const props = defineProps<Props>()
const emit = defineEmits<Emits>()

// Estado de las pestañas
const activeTab = ref('general')

// Función de migración para bloques antiguos
const migrateOldTextBlock = (block: any): TextBlock => {
  // Si ya tiene la nueva estructura, no hacer nada
  if (block.columns && Array.isArray(block.columns)) {
    // Asegurar que los campos de atributos existan
    const updatedBlock = { ...block as TextBlock }
    if (!updatedBlock.customId) updatedBlock.customId = ''
    if (!updatedBlock.customClass) updatedBlock.customClass = ''
    if (!updatedBlock.customCSS) updatedBlock.customCSS = ''
    return updatedBlock
  }

  console.info('Migrando bloque de texto del formato antiguo al nuevo:', block)

  // Migrar formato antiguo al nuevo
  const migratedBlock: TextBlock = {
    id: block.id,
    type: 'text',
    order: block.order || 0,
    columnsCount: 1,
    columns: [
      {
        id: generateId(),
        backgroundColor: block.backgroundColor || '',
        textColor: '',
        texts: [
          {
            id: generateId(),
            content: block.content || '<p>Contenido migrado</p>'
          }
        ]
      }
    ],
    gap: 'medium',
    padding: block.padding || 'medium',
    backgroundColor: block.backgroundColor || '',
    customId: block.customId || '',
    customClass: block.customClass || '',
    customCSS: block.customCSS || ''
  }

  console.info('Bloque migrado:', migratedBlock)
  return migratedBlock
}

// Estado local del bloque (con migración automática)
const localBlock = ref<TextBlock>(migrateOldTextBlock(props.block))

// Función para generar ID único
const generateId = () => Math.random().toString(36).substr(2, 9)


// Añadir nueva columna
const addColumn = () => {
  if (localBlock.value.columns.length >= 4) {
    console.warn('Maximum 4 columns allowed')
    return
  }

  localBlock.value.columns.push({
    id: generateId(),
    backgroundColor: '',
    textColor: '',
    texts: []
  })
  
  // Actualizar columnsCount
  localBlock.value.columnsCount = localBlock.value.columns.length as 1 | 2 | 3 | 4
}

// Remover columna
const removeColumn = (columnIndex: number) => {
  if (localBlock.value.columns.length <= 1) {
    console.warn('Cannot remove the last column')
    return
  }

  if (columnIndex < 0 || columnIndex >= localBlock.value.columns.length) {
    console.warn(`Invalid column index: ${columnIndex}`)
    return
  }

  localBlock.value.columns.splice(columnIndex, 1)
  
  // Actualizar columnsCount
  localBlock.value.columnsCount = localBlock.value.columns.length as 1 | 2 | 3 | 4
}

// Añadir texto a una columna
const addTextToColumn = (columnIndex: number) => {
  if (!localBlock.value.columns || !localBlock.value.columns[columnIndex]) {
    console.warn(`Column ${columnIndex} not found`)
    return
  }

  const newText: TextItem = {
    id: generateId(),
    content: '<p>Escribe tu texto aquí...</p>'
  }
  
  if (!localBlock.value.columns[columnIndex].texts) {
    localBlock.value.columns[columnIndex].texts = []
  }
  
  localBlock.value.columns[columnIndex].texts.push(newText)
}

// Remover texto de una columna
const removeTextFromColumn = (columnIndex: number, textIndex: number) => {
  try {
    if (!localBlock.value?.columns?.[columnIndex]?.texts?.[textIndex]) {
      console.warn(`Text at column ${columnIndex}, text ${textIndex} not found`)
      return
    }
    
    // Remover texto (el componente TiptapEditor se encarga de su propia limpieza)
    localBlock.value.columns[columnIndex].texts.splice(textIndex, 1)
  } catch (error) {
    console.error('Error removing text from column:', error)
  }
}



// Aplicar cambios y cerrar modal
const applyChanges = () => {
  emit('update', { ...localBlock.value })
  emit('close')
}

// Sincronizar con props
watch(() => props.block, (newBlock) => {
  // Aplicar migración si es necesario
  localBlock.value = migrateOldTextBlock(newBlock)
}, { deep: true })

onMounted(() => {
  console.info('TextBlockEditor mounted with Tiptap')
})
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.7);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
  padding: 2rem;
}

.modal-content {
  background: white;
  border-radius: 12px;
  width: 90%;
  height: 90%;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.5rem 2rem;
  border-bottom: 1px solid #e9ecef;
  background: #f8f9fa;
  flex-shrink: 0;
}

.modal-header h3 {
  margin: 0;
  color: #2c3e50;
  font-size: 1.25rem;
  font-weight: 600;
}

.btn-close {
  background: none;
  border: none;
  font-size: 1.25rem;
  color: #6c757d;
  cursor: pointer;
  padding: 0.5rem;
  border-radius: 6px;
  transition: all 0.2s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn-close:hover {
  background: #e9ecef;
  color: #495057;
}

.modal-body {
  flex: 1;
  overflow-y: auto;
  padding: 2rem;
}

.editor-sections {
  display: flex;
  flex-direction: column;
  gap: 2rem;
}

.editor-section {
  margin-bottom: 2rem;
  padding: 1.5rem;
  background: #f8f9fa;
  border-radius: 8px;
  border: 1px solid #e9ecef;
}

.editor-section h4 {
  margin: 0 0 1rem 0;
  color: #2c3e50;
  font-size: 1.1rem;
  font-weight: 600;
}

.modal-footer {
  display: flex;
  justify-content: flex-end;
  gap: 1rem;
  padding: 1.5rem 2rem;
  border-top: 1px solid #e9ecef;
  background: #f8f9fa;
  flex-shrink: 0;
}

.btn-primary,
.btn-secondary {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.9rem;
  font-weight: 600;
  transition: all 0.3s ease;
}

.btn-primary {
  background: #007bff;
  color: white;
}

.btn-primary:hover {
  background: #0056b3;
  transform: translateY(-1px);
}

.btn-secondary {
  background: #6c757d;
  color: white;
}

.btn-secondary:hover {
  background: #545b62;
  transform: translateY(-1px);
}

.form-group {
  margin-bottom: 1.5rem;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
  margin-bottom: 1rem;
}

.form-group label {
  display: block;
  font-weight: 600;
  color: #2c3e50;
  margin-bottom: 0.5rem;
  font-size: 0.9rem;
}

.form-input {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #dee2e6;
  border-radius: 6px;
  font-size: 0.95rem;
  transition: border-color 0.3s ease;
}

.form-input:focus {
  outline: none;
  border-color: #007bff;
}

.color-input-group {
  display: flex;
  gap: 0.5rem;
  align-items: center;
}

.color-picker {
  width: 50px;
  height: 40px;
  border: 1px solid #dee2e6;
  border-radius: 6px;
  cursor: pointer;
  padding: 0;
}

.color-picker.small {
  width: 35px;
  height: 30px;
}

.color-text {
  flex: 1;
  padding: 0.5rem;
  border: 1px solid #dee2e6;
  border-radius: 6px;
  font-family: monospace;
}

.color-text.small {
  padding: 0.4rem;
  font-size: 0.8rem;
}

/* Columnas */
.columns-grid {
  display: grid;
  gap: 1.5rem;
}

.columns-grid.columns-1 {
  grid-template-columns: 1fr;
}

.columns-grid.columns-2 {
  grid-template-columns: 1fr 1fr;
}

.columns-grid.columns-3 {
  grid-template-columns: repeat(3, 1fr);
}

.columns-grid.columns-4 {
  grid-template-columns: repeat(4, 1fr);
}

.column-editor {
  border: 1px solid #dee2e6;
  border-radius: 8px;
  padding: 1rem;
  background: white;
}

.column-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
  padding-bottom: 0.5rem;
  border-bottom: 1px solid #e9ecef;
}

.column-header h5 {
  margin: 0;
  color: #495057;
  font-size: 1rem;
  font-weight: 600;
}

.columns-management {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 1rem;
  background: #f8f9fa;
  border-radius: 6px;
  border: 1px solid #e9ecef;
}

.columns-info {
  font-weight: 600;
  color: #495057;
  font-size: 0.9rem;
}

.btn-add-column {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  background: #007bff;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 4px;
  cursor: pointer;
  font-size: 0.8rem;
  transition: all 0.2s ease;
}

.btn-add-column:hover:not(:disabled) {
  background: #0056b3;
  transform: translateY(-1px);
}

.btn-add-column:disabled {
  background: #6c757d;
  cursor: not-allowed;
  transform: none;
}

.column-actions {
  display: flex;
  gap: 0.5rem;
}

.btn-add-text {
  background: #28a745;
  color: white;
  border: none;
  padding: 0.5rem;
  border-radius: 4px;
  cursor: pointer;
  font-size: 0.8rem;
  transition: all 0.2s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn-add-text:hover {
  background: #218838;
  transform: translateY(-1px);
}

.btn-remove-column {
  background: #dc3545;
  color: white;
  border: none;
  padding: 0.5rem;
  border-radius: 4px;
  cursor: pointer;
  font-size: 0.8rem;
  transition: all 0.2s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn-remove-column:hover:not(:disabled) {
  background: #c82333;
  transform: translateY(-1px);
}

.btn-remove-column:disabled {
  background: #6c757d;
  cursor: not-allowed;
  transform: none;
}

.column-colors {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
  margin-bottom: 1rem;
  padding: 1rem;
  background: #f8f9fa;
  border-radius: 6px;
}

.column-colors .form-group {
  margin-bottom: 0;
}

.column-colors label {
  font-size: 0.8rem;
  margin-bottom: 0.3rem;
}

/* Textos */
.column-texts {
  min-height: 100px;
}

.text-item {
  margin-bottom: 1.5rem;
  border: 1px solid #e9ecef;
  border-radius: 8px;
  background: white;
  overflow: hidden;
}

.text-item-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.75rem 1rem;
  background: #f1f3f4;
  border-bottom: 1px solid #e9ecef;
}

.text-item-info {
  display: flex;
  align-items: center;
}

.text-item-title {
  font-weight: 600;
  color: #495057;
  font-size: 0.9rem;
}

.text-item-actions {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.btn-remove-text {
  background: #dc3545;
  color: white;
  border: none;
  padding: 0.4rem;
  border-radius: 4px;
  cursor: pointer;
  font-size: 0.75rem;
  transition: all 0.2s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn-remove-text:hover {
  background: #c82333;
}

/* Contenedor del editor simple */
.simple-editor-container {
  margin-top: 1rem;
}

.empty-column {
  text-align: center;
  padding: 2rem 1rem;
  color: #6c757d;
  border: 2px dashed #dee2e6;
  border-radius: 6px;
  margin: 1rem 0;
}

.empty-column p {
  margin-bottom: 1rem;
  font-style: italic;
}

.btn-add-first {
  background: #007bff;
  color: white;
  border: none;
  padding: 0.75rem 1.5rem;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.9rem;
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  transition: all 0.3s ease;
}

.btn-add-first:hover {
  background: #0056b3;
  transform: translateY(-1px);
}


/* Responsive */
@media (max-width: 1200px) {
  .columns-grid.columns-4 {
    grid-template-columns: repeat(2, 1fr);
  }
  
  .columns-grid.columns-3 {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px) {
  .modal-content {
    width: 95%;
    height: 95%;
  }
  
  .modal-body {
    padding: 1rem;
  }
  
  .columns-grid.columns-2,
  .columns-grid.columns-3,
  .columns-grid.columns-4 {
    grid-template-columns: 1fr;
  }
  
  .form-row {
    grid-template-columns: 1fr;
  }
  
  .column-colors {
    grid-template-columns: 1fr;
  }
  
  .color-input-group {
    flex-direction: column;
    align-items: stretch;
  }
  
  .color-picker {
    align-self: center;
  }
}

/* Tabs */
.tabs-nav {
  display: flex;
  background: #f8f9fa;
  border-bottom: 1px solid #e9ecef;
  margin: -2rem -2rem 2rem -2rem;
}

.tab-button {
  flex: 1;
  padding: 1rem 1.5rem;
  border: none;
  background: transparent;
  color: #6c757d;
  font-size: 0.95rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  position: relative;
}

.tab-button:hover {
  background: rgba(0, 123, 255, 0.1);
  color: #007bff;
}

.tab-button.active {
  background: white;
  color: #007bff;
  border-bottom: 3px solid #007bff;
}

.tab-button.active::after {
  content: '';
  position: absolute;
  bottom: -1px;
  left: 0;
  right: 0;
  height: 1px;
  background: white;
}

.tab-content {
  position: relative;
}

.tab-pane {
  display: block;
}

.form-help {
  display: block;
  font-size: 0.8rem;
  color: #6c757d;
  margin-top: 0.25rem;
  font-style: italic;
}

.css-editor {
  font-family: 'Courier New', monospace;
  font-size: 0.9rem;
  line-height: 1.5;
  resize: vertical;
  min-height: 200px;
}
</style>