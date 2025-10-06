<template>
  <div class="editor">
    <EditorToolbar v-if="editor" :editor="editor" />
    <div class="editor-content">
      <EditorContent :editor="editor" />
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, watch } from 'vue'
import { Editor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import EditorToolbar from './EditorToolbar.vue'

const props = defineProps({
  modelValue: {
    type: String,
    default: ''
  },
  editable: {
    type: Boolean,
    default: true
  }
})

const emit = defineEmits(['update:modelValue'])

const editor = ref(null)

onMounted(() => {
  editor.value = new Editor({
    content: props.modelValue,
    editable: props.editable,
    extensions: [StarterKit],
    onUpdate: ({ editor }) => {
      emit('update:modelValue', editor.getHTML())
    }
  })
})

onBeforeUnmount(() => {
  if (editor.value) {
    editor.value.destroy()
  }
})

watch(
  () => props.modelValue,
  (newValue) => {
    if (editor.value && editor.value.getHTML() !== newValue) {
      editor.value.commands.setContent(newValue, false)
    }
  }
)

watch(
  () => props.editable,
  (newValue) => {
    if (editor.value) {
      editor.value.setEditable(newValue)
    }
  }
)
</script>

<style scoped>
.editor {
  border: 1px solid #e1e5e9;
  border-radius: 8px;
  overflow: hidden;
}

.editor-content {
  min-height: 200px;
  padding: 1rem;
}

.editor-content :deep(.ProseMirror) {
  outline: none;
  min-height: 200px;
}

.editor-content :deep(.ProseMirror p.is-editor-empty:first-child::before) {
  content: attr(data-placeholder);
  float: left;
  color: #adb5bd;
  pointer-events: none;
  height: 0;
}
</style>