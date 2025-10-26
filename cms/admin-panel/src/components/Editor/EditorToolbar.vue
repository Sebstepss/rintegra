<template>
  <div class="toolbar">
    <button
      @click="editor.chain().focus().toggleBold().run()"
      :class="{ 'is-active': editor.isActive('bold') }"
    >
      <strong>B</strong>
    </button>
    
    <button
      @click="editor.chain().focus().toggleItalic().run()"
      :class="{ 'is-active': editor.isActive('italic') }"
    >
      <em>I</em>
    </button>
    
    <button
      @click="editor.chain().focus().toggleStrike().run()"
      :class="{ 'is-active': editor.isActive('strike') }"
    >
      <s>S</s>
    </button>
    
    <div class="divider"></div>
    
    <button
      @click="editor.chain().focus().toggleHeading({ level: 1 }).run()"
      :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }"
    >
      H1
    </button>
    
    <button
      @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
      :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }"
    >
      H2
    </button>
    
    <button
      @click="editor.chain().focus().toggleHeading({ level: 3 }).run()"
      :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }"
    >
      H3
    </button>
    
    <div class="divider"></div>
    
    <button
      @click="editor.chain().focus().toggleBulletList().run()"
      :class="{ 'is-active': editor.isActive('bulletList') }"
    >
      •
    </button>
    
    <button
      @click="editor.chain().focus().toggleOrderedList().run()"
      :class="{ 'is-active': editor.isActive('orderedList') }"
    >
      1.
    </button>
    
    <div class="divider"></div>
    
    <button @click="editor.chain().focus().undo().run()">
      ↶
    </button>
    
    <button @click="editor.chain().focus().redo().run()">
      ↷
    </button>
  </div>
</template>

<script setup>
const props = defineProps({
  editor: {
    type: Object,
    required: true
  }
})
</script>

<style scoped>
.toolbar {
  display: flex;
  align-items: center;
  gap: 0.25rem;
  padding: 0.5rem;
  background-color: #f8f9fa;
  border-bottom: 1px solid #e1e5e9;
}

button {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 32px;
  height: 32px;
  border: 1px solid transparent;
  border-radius: 4px;
  background: white;
  color: #495057;
  cursor: pointer;
  font-size: 14px;
  font-weight: 500;
}

button:hover {
  background-color: #e9ecef;
}

button.is-active {
  background-color: #007bff;
  color: white;
}

.divider {
  width: 1px;
  height: 20px;
  background-color: #dee2e6;
  margin: 0 0.5rem;
}
</style>