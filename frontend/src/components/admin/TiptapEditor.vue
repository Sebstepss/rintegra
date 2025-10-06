<template>
  <div class="tiptap-editor-container">
    <div class="editor-toolbar" v-if="editor">
      <!-- Fila 1: Selector de tipo de texto -->
      <div class="toolbar-row">
        <div class="toolbar-group">
          <select 
            @change="changeTextType($event)"
            class="text-type-select"
            :value="getActiveTextType()"
          >
            <option value="paragraph">Párrafo</option>
            <option value="heading" data-level="1">Título H1</option>
            <option value="heading" data-level="2">Título H2</option>
            <option value="heading" data-level="3">Título H3</option>
            <option value="heading" data-level="4">Título H4</option>
            <option value="heading" data-level="5">Título H5</option>
            <option value="heading" data-level="6">Título H6</option>
          </select>
        </div>
        
        <div class="toolbar-separator"></div>
        
        <div class="toolbar-group">
          <button 
            @click="editor.chain().focus().toggleBold().run()"
            :class="{ active: editor.isActive('bold') }"
            class="toolbar-btn"
            title="Negrita (Ctrl+B)"
          >
            <strong>B</strong>
          </button>
          <button 
            @click="editor.chain().focus().toggleItalic().run()"
            :class="{ active: editor.isActive('italic') }"
            class="toolbar-btn"
            title="Cursiva (Ctrl+I)"
          >
            <em>I</em>
          </button>
          <button 
            @click="editor.chain().focus().toggleUnderline().run()"
            :class="{ active: editor.isActive('underline') }"
            class="toolbar-btn"
            title="Subrayado (Ctrl+U)"
          >
            <span style="text-decoration: underline">U</span>
          </button>
          <button 
            @click="editor.chain().focus().toggleStrike().run()"
            :class="{ active: editor.isActive('strike') }"
            class="toolbar-btn"
            title="Tachado"
          >
            <span style="text-decoration: line-through">S</span>
          </button>
        </div>
        
        <div class="toolbar-separator"></div>
        
        <div class="toolbar-group">
          <button 
            @click="editor.chain().focus().setTextAlign('left').run()"
            :class="{ active: editor.isActive({ textAlign: 'left' }) }"
            class="toolbar-btn"
            title="Alinear izquierda"
          >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M3 4H21V6H3V4ZM3 19H17V21H3V19ZM3 14H21V16H3V14ZM3 9H17V11H3V9Z"></path></svg>

          </button>
          <button 
            @click="editor.chain().focus().setTextAlign('center').run()"
            :class="{ active: editor.isActive({ textAlign: 'center' }) }"
            class="toolbar-btn"
            title="Centrar"
          >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M3 4H21V6H3V4ZM5 19H19V21H5V19ZM3 14H21V16H3V14ZM5 9H19V11H5V9Z"></path></svg>
          </button>
          <button 
            @click="editor.chain().focus().setTextAlign('right').run()"
            :class="{ active: editor.isActive({ textAlign: 'right' }) }"
            class="toolbar-btn"
            title="Alinear derecha"
          >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M3 4H21V6H3V4ZM3 19H17V21H3V19ZM3 14H21V16H3V14ZM3 9H17V11H3V9Z"></path></svg>
          </button>
          <button 
            @click="editor.chain().focus().setTextAlign('justify').run()"
            :class="{ active: editor.isActive({ textAlign: 'justify' }) }"
            class="toolbar-btn"
            title="Justificar"
          >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M3 4H21V6H3V4ZM3 19H21V21H3V19ZM3 14H21V16H3V14ZM3 9H21V11H3V9Z"></path></svg>
          </button>
        </div>
      </div>

      <!-- Fila 3: Listas y formato avanzado -->
      <div class="toolbar-row">
        <div class="toolbar-group">
          <button 
            @click="editor.chain().focus().toggleBulletList().run()"
            :class="{ active: editor.isActive('bulletList') }"
            class="toolbar-btn"
            title="Lista con viñetas"
          >
            •
          </button>
          <button 
            @click="editor.chain().focus().toggleOrderedList().run()"
            :class="{ active: editor.isActive('orderedList') }"
            class="toolbar-btn"
            title="Lista numerada"
          >
            1.
          </button>
          <button 
            @click="editor.chain().focus().toggleBlockquote().run()"
            :class="{ active: editor.isActive('blockquote') }"
            class="toolbar-btn"
            title="Cita"
          >
            "
          </button>
          <button 
            @click="editor.chain().focus().toggleCode().run()"
            :class="{ active: editor.isActive('code') }"
            class="toolbar-btn"
            title="Código inline"
          >
            &lt;/&gt;
          </button>
        </div>
        
        <div class="toolbar-separator"></div>
        
        <div class="toolbar-group">
          <button 
            @click="toggleLink()"
            :class="{ active: editor.isActive('link') }"
            class="toolbar-btn"
            title="Enlace"
          >
            <Icon name="link" />
          </button>
          <button 
            @click="editor.chain().focus().unsetLink().run()"
            class="toolbar-btn"
            title="Quitar enlace"
            :disabled="!editor.isActive('link')"
          >
            🔗⛔
          </button>
          <button 
            @click="editor.chain().focus().clearNodes().unsetAllMarks().run()"
            class="toolbar-btn"
            title="Limpiar formato"
          >
            ✗
          </button>
          <button 
            @click="toggleRawHTML"
            :class="{ active: showRawHTML, 'has-custom': hasCustomHTML }"
            class="toolbar-btn"
            :title="hasCustomHTML ? 'HTML personalizado detectado - Click para editar' : 'Editar HTML directo'"
          >
            &lt;/&gt;
            <span v-if="hasCustomHTML" class="custom-indicator">●</span>
          </button>
        </div>
      </div>
    </div>
    
    <!-- Área de edición principal -->
    <div class="tiptap-editor-area">
      <!-- Editor Tiptap (siempre disponible cuando no está en modo raw) -->
      <EditorContent 
        v-if="!showRawHTML"
        :editor="editor" 
        class="tiptap-editor"
      />
      
      <!-- Editor HTML raw -->
      <textarea
        v-if="showRawHTML"
        v-model="rawHTML"
        @input="updateFromRawHTML"
        class="raw-html-editor"
        placeholder="Ingresa tu HTML personalizado aquí..."
      ></textarea>
    </div>
  </div>
</template>

<script setup lang="ts">
import { watch, ref } from 'vue'
import { useEditor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import TextStyle from '@tiptap/extension-text-style'
import Color from '@tiptap/extension-color'
import Highlight from '@tiptap/extension-highlight'
import TextAlign from '@tiptap/extension-text-align'
import Underline from '@tiptap/extension-underline'
import Link from '@tiptap/extension-link'
import Blockquote from '@tiptap/extension-blockquote'
import Code from '@tiptap/extension-code'
import CodeBlock from '@tiptap/extension-code-block'
import { Node } from '@tiptap/core'
import Icon from '@/components/global/Icon.vue'


interface Props {
  modelValue: string
}

interface Emits {
  (e: 'update:modelValue', value: string): void
}

const props = defineProps<Props>()
const emit = defineEmits<Emits>()

// Estado para el modo HTML raw
const showRawHTML = ref(false)
const rawHTML = ref(props.modelValue || '<p>Escribe tu texto aquí...</p>')

// Estado para rastrear si el contenido tiene HTML personalizado
const hasCustomHTML = ref(false)

// Función para detectar si el HTML contiene elementos personalizados
const detectCustomHTML = (html: string) => {
  // Detectar si hay divs con style, o elementos con atributos personalizados
  const hasStyleAttributes = /<[^>]+style\s*=\s*["'][^"']*["'][^>]*>/i.test(html)
  const hasCustomDivs = /<div[^>]*>/i.test(html)
  const hasCustomClasses = /<[^>]+class\s*=\s*["'][^"']*["'][^>]*>/i.test(html)
  
  return hasStyleAttributes || hasCustomDivs || hasCustomClasses
}

// Extensión personalizada para divs con estilos
const CustomDiv = Node.create({
  name: 'customDiv',
  
  group: 'block',
  
  content: 'block*',
  
  parseHTML() {
    return [
      {
        tag: 'div',
        getAttrs: (element) => {
          if (element instanceof HTMLElement && (element.hasAttribute('style') || element.hasAttribute('class'))) {
            return {}
          }
          return false
        }
      }
    ]
  },
  
  renderHTML({ HTMLAttributes }) {
    return ['div', HTMLAttributes, 0]
  },
  
  addAttributes() {
    return {
      style: {
        default: null,
        parseHTML: element => element.getAttribute('style'),
        renderHTML: attributes => {
          if (!attributes.style) return {}
          return { style: attributes.style }
        }
      },
      class: {
        default: null,
        parseHTML: element => element.getAttribute('class'),
        renderHTML: attributes => {
          if (!attributes.class) return {}
          return { class: attributes.class }
        }
      }
    }
  }
})

const editor = useEditor({
  content: props.modelValue || '<p>Escribe tu texto aquí...</p>',
  extensions: [
    StarterKit.configure({
      // Configurar el HTML para permitir más elementos
      dropcursor: {
        color: '#DBEAFE',
        width: 4,
      },
      // Deshabilitar extensiones que vamos a reconfigurar
      blockquote: false,
      code: false,
      codeBlock: false,
    }),
    CustomDiv, // Extensión para manejar divs con estilos
    TextStyle,
    Color.configure({
      types: ['textStyle'],
    }),
    Highlight.configure({ 
      multicolor: true 
    }),
    TextAlign.configure({
      types: ['heading', 'paragraph', 'customDiv'],
    }),
    Underline,
    Link.configure({
      openOnClick: false,
      HTMLAttributes: {
        class: 'custom-link',
      },
    }),
    Blockquote,
    Code,
    CodeBlock.configure({
      HTMLAttributes: {
        class: 'custom-code-block',
      },
    })
  ],
  editorProps: {
    attributes: {
      class: 'prose prose-sm focus:outline-none min-h-[200px] p-4 tiptap-content'
    }
  },
  parseOptions: {
    preserveWhitespace: 'full',
  },
  // Configurar para permitir HTML personalizado
  enableInputRules: true,
  enablePasteRules: true,
  onUpdate: ({ editor }) => {
    if (editor) {
      const html = editor.getHTML()
      rawHTML.value = html
      hasCustomHTML.value = detectCustomHTML(html)
      emit('update:modelValue', html)
    }
  }
})

// Función para cambiar tipo de texto
const changeTextType = (event: Event) => {
  if (!editor.value) return
  
  const target = event.target as HTMLSelectElement
  const value = target.value
  const option = target.selectedOptions[0]
  
  if (value === 'paragraph') {
    editor.value.chain().focus().setParagraph().run()
  } else if (value === 'heading') {
    const level = parseInt(option.dataset.level || '1')
    editor.value.chain().focus().toggleHeading({ level: level as 1 | 2 | 3 | 4 | 5 | 6 }).run()
  }
}

// Función para obtener el tipo de texto activo
const getActiveTextType = () => {
  if (!editor.value) return 'paragraph'
  
  if (editor.value.isActive('paragraph')) return 'paragraph'
  
  // Verificar si está activo algún heading
  if (editor.value.isActive('heading')) {
    return 'heading'
  }
  
  return 'paragraph'
}

// Función para añadir enlace
const toggleLink = () => {
  if (!editor.value) return

  const previousUrl = editor.value.getAttributes('link').href
  const url = window.prompt('URL del enlace:', previousUrl)

  if (url === null) {
    return
  }

  if (url === '') {
    editor.value.chain().focus().extendMarkRange('link').unsetLink().run()
    return
  }

  editor.value.chain().focus().extendMarkRange('link').setLink({ href: url }).run()
}

// Función para alternar entre modo visual y HTML raw
const toggleRawHTML = () => {
  if (!editor.value) return
  
  if (showRawHTML.value) {
    // Cambiar de HTML raw a visual
    hasCustomHTML.value = detectCustomHTML(rawHTML.value)
    
    // Siempre actualizar el contenido del editor, sin importar si es HTML personalizado
    editor.value.commands.setContent(rawHTML.value)
    emit('update:modelValue', rawHTML.value)
    
    showRawHTML.value = false
  } else {
    // Cambiar de visual a HTML raw
    rawHTML.value = editor.value.getHTML()
    showRawHTML.value = true
  }
}

// Función para actualizar desde el HTML raw
const updateFromRawHTML = () => {
  hasCustomHTML.value = detectCustomHTML(rawHTML.value)
  emit('update:modelValue', rawHTML.value)
}

// Sincronizar con props
watch(() => props.modelValue, (newValue) => {
  try {
    const htmlContent = newValue || '<p>Escribe tu texto aquí...</p>'
    rawHTML.value = htmlContent
    hasCustomHTML.value = detectCustomHTML(htmlContent)
    
    // Siempre sincronizar con el editor, independientemente del tipo de HTML
    if (editor.value && !editor.value.isDestroyed && newValue !== editor.value.getHTML()) {
      editor.value.commands.setContent(htmlContent)
    }
  } catch (error) {
    console.error('Error syncing editor content:', error)
  }
})

// Inicializar el estado al montar
const initializeContent = () => {
  const initialContent = props.modelValue || '<p>Escribe tu texto aquí...</p>'
  rawHTML.value = initialContent
  hasCustomHTML.value = detectCustomHTML(initialContent)
}

// Llamar inicialización
initializeContent()
</script>

<style scoped>
.tiptap-editor-container {
  background: white;
  border: 1px solid #e9ecef;
  border-radius: 8px;
  overflow: hidden;
}

.editor-toolbar {
  background: #f8f9fa;
  border-bottom: 1px solid #e9ecef;
  padding: 0.75rem;
}

.toolbar-row {
  display: flex;
  align-items: center;
  gap: 0.25rem;
  margin-bottom: 0.5rem;
  flex-wrap: wrap;
}

.toolbar-row:last-child {
  margin-bottom: 0;
}

.toolbar-group {
  display: flex;
  align-items: center;
  gap: 0.25rem;
  padding: 0.25rem;
  background: white;
  border-radius: 6px;
  border: 1px solid #dee2e6;
}

.text-type-select {
  padding: 0.5rem;
  border: 1px solid #dee2e6;
  border-radius: 4px;
  background: white;
  font-size: 0.875rem;
  color: #495057;
  cursor: pointer;
  min-width: 120px;
}

.text-type-select:focus {
  outline: none;
  border-color: #007bff;
}

.align-icon {
  font-size: 16px;
  font-weight: bold;
  line-height: 1;
}

.toolbar-separator {
  width: 1px;
  height: 24px;
  background: #dee2e6;
  margin: 0 0.5rem;
}

.toolbar-btn {
  padding: 0.5rem;
  border: none;
  background: transparent;
  border-radius: 4px;
  cursor: pointer;
  font-size: 0.875rem;
  transition: all 0.2s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  min-width: 32px;
  height: 32px;
  color: #495057;
}

.toolbar-btn:hover {
  background: #e9ecef;
  transform: translateY(-1px);
}

.toolbar-btn.active {
  background: #007bff;
  color: white;
  box-shadow: 0 2px 4px rgba(0, 123, 255, 0.25);
}

.toolbar-btn:disabled {
  opacity: 0.4;
  cursor: not-allowed;
  background: transparent;
  color: #6c757d;
}

.toolbar-btn:disabled:hover {
  background: transparent;
  transform: none;
}

.toolbar-btn.has-custom {
  background: #28a745;
  color: white;
  position: relative;
}

.toolbar-btn.has-custom:hover {
  background: #218838;
}

.custom-indicator {
  position: absolute;
  top: 2px;
  right: 2px;
  font-size: 8px;
  color: #ffc107;
}

.tiptap-editor-area {
  background: white;
  min-height: 200px;
}

.tiptap-editor {
  border: none;
  background: white;
}

.raw-html-editor {
  width: 100%;
  min-height: 200px;
  padding: 1.5rem;
  border: none;
  background: white;
  font-family: 'Courier New', Monaco, monospace;
  font-size: 0.9rem;
  line-height: 1.4;
  resize: vertical;
  outline: none;
}

.custom-html-preview {
  width: 100%;
  min-height: 200px;
  padding: 1.5rem;
  border: none;
  background: white;
  overflow: auto;
}


/* Estilos para el contenido del editor Tiptap */
:deep(.ProseMirror) {
  outline: none;
  padding: 1.5rem;
  min-height: 200px;
  font-family: 'Lato', sans-serif;
  line-height: 1.6;
  background: white;
  border: none;
}

:deep(.tiptap-content) {
  min-height: 200px;
  max-height: 400px;
  overflow-y: auto;
  border: 1px solid #e9ecef;
  border-radius: 0 0 8px 8px;
}

:deep(.ProseMirror p) {
  margin: 0.5rem 0;
}

:deep(.ProseMirror h1) {
  font-size: 1.8rem;
  font-weight: 700;
  margin: 1rem 0 0.5rem 0;
}

:deep(.ProseMirror h2) {
  font-size: 1.5rem;
  font-weight: 600;
  margin: 1rem 0 0.5rem 0;
}

:deep(.ProseMirror h3) {
  font-size: 1.3rem;
  font-weight: 600;
  margin: 1rem 0 0.5rem 0;
}

:deep(.ProseMirror h4) {
  font-size: 1.1rem;
  font-weight: 600;
  margin: 1rem 0 0.5rem 0;
}

:deep(.ProseMirror h5) {
  font-size: 1rem;
  font-weight: 600;
  margin: 1rem 0 0.5rem 0;
}

:deep(.ProseMirror h6) {
  font-size: 0.9rem;
  font-weight: 600;
  margin: 1rem 0 0.5rem 0;
}

:deep(.ProseMirror strong) {
  font-weight: bold;
}

:deep(.ProseMirror em) {
  font-style: italic;
}

:deep(.ProseMirror ul, .ProseMirror ol) {
  padding-left: 1.5rem;
  margin: 0.5rem 0;
}

:deep(.ProseMirror blockquote) {
  border-left: 4px solid #007bff;
  padding: 0.5rem 1rem;
  margin: 1rem 0;
  font-style: italic;
  background: rgba(0, 123, 255, 0.05);
  border-radius: 0 6px 6px 0;
  opacity: 0.9;
}

:deep(.ProseMirror code) {
  background: #f8f9fa;
  border: 1px solid #e9ecef;
  padding: 0.2rem 0.4rem;
  border-radius: 4px;
  font-family: 'Courier New', Monaco, monospace;
  font-size: 0.9em;
  color: #e83e8c;
}

:deep(.ProseMirror pre) {
  background: #f8f9fa;
  border: 1px solid #e9ecef;
  border-radius: 6px;
  padding: 1rem;
  margin: 1rem 0;
  overflow-x: auto;
  font-family: 'Courier New', Monaco, monospace;
  font-size: 0.9em;
}

:deep(.ProseMirror pre code) {
  background: none;
  border: none;
  padding: 0;
  color: #212529;
  font-size: inherit;
}

:deep(.ProseMirror a) {
  color: #007bff;
  text-decoration: underline;
  cursor: pointer;
  transition: color 0.2s ease;
}

:deep(.ProseMirror a:hover) {
  color: #0056b3;
  text-decoration: none;
}

:deep(.ProseMirror mark) {
  background: yellow;
  padding: 0.1rem 0.2rem;
  border-radius: 2px;
}



/* Responsive */
@media (max-width: 768px) {
  .toolbar-row {
    gap: 0.5rem;
  }
  
  .toolbar-group {
    gap: 0.125rem;
  }
  
  .toolbar-btn {
    min-width: 28px;
    height: 28px;
    padding: 0.25rem;
    font-size: 0.75rem;
  }
  
  .text-type-select {
    min-width: 100px;
    font-size: 0.75rem;
    padding: 0.4rem;
  }
}
</style>