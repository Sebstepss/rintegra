# Implementar Preview Estilo Elementor

## Objetivo
Eliminar duplicación de bloques usando iframe preview como Elementor.

## Paso 1: Ruta de Preview en Laravel

```php
// backend/routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::get('/preview/{page}', [PageController::class, 'preview'])
        ->name('page.preview');
});
```

```php
// backend/app/Http/Controllers/PageController.php
public function preview($id)
{
    $page = Page::find($id);

    // Obtener contenido desde la sesión (para cambios no guardados)
    $previewContent = session("preview_content_{$id}");
    if ($previewContent) {
        $page->pagecontent = json_decode($previewContent, true);
    }

    return view('pages.show', [
        'page' => $page,
        'isPreview' => true
    ]);
}
```

## Paso 2: Endpoint para Actualizar Preview

```php
// backend/routes/api.php
Route::middleware(['auth'])->group(function () {
    Route::post('/preview/{page}/update', function ($id, Request $request) {
        session(["preview_content_{$id}" => json_encode($request->blocks)]);
        return response()->json(['success' => true]);
    });
});
```

## Paso 3: Actualizar PageEditor.vue

```vue
<!-- frontend/src/components/admin/PageEditor.vue -->
<template>
  <div class="page-editor">
    <div class="editor-sidebar">
      <!-- Formularios de configuración -->
      <BlockConfigPanel
        :block="selectedBlock"
        @update="handleBlockUpdate"
      />
    </div>

    <div class="editor-canvas">
      <iframe
        ref="previewIframe"
        :src="previewUrl"
        @load="onIframeLoad"
        class="preview-frame"
      />
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'

const route = useRoute()
const pageId = computed(() => route.params.id)
const previewIframe = ref(null)
const blocks = ref([])

// URL del iframe
const previewUrl = computed(() => {
  return `/preview/${pageId.value}?t=${Date.now()}`
})

// Actualizar preview cuando cambian los bloques
watch(blocks, async (newBlocks) => {
  await axios.post(`/api/preview/${pageId.value}/update`, {
    blocks: newBlocks
  })

  // Recargar iframe
  if (previewIframe.value) {
    previewIframe.value.contentWindow.location.reload()
  }
}, { deep: true })

// Comunicación con iframe (opcional)
const onIframeLoad = () => {
  const iframe = previewIframe.value

  // Agregar estilos de edición al iframe
  iframe.contentWindow.addEventListener('click', (e) => {
    // Manejar clicks en bloques
    const blockEl = e.target.closest('[data-block-id]')
    if (blockEl) {
      const blockId = blockEl.dataset.blockId
      selectBlock(blockId)
    }
  })
}

function handleBlockUpdate(blockId, newData) {
  const index = blocks.value.findIndex(b => b.id === blockId)
  if (index !== -1) {
    blocks.value[index] = { ...blocks.value[index], ...newData }
  }
}
</script>

<style scoped>
.page-editor {
  display: flex;
  height: 100vh;
}

.editor-sidebar {
  width: 400px;
  background: white;
  border-right: 1px solid #ddd;
  overflow-y: auto;
}

.editor-canvas {
  flex: 1;
  background: #f5f5f5;
  padding: 20px;
}

.preview-frame {
  width: 100%;
  height: 100%;
  border: 1px solid #ddd;
  background: white;
  border-radius: 8px;
}
</style>
```

## Paso 4: Agregar data-block-id a Bloques Blade

```blade
{{-- backend/resources/views/components/blocks/text-block.blade.php --}}
<div class="text-block-content"
     data-block-id="{{ $block['id'] ?? '' }}"
     @if(isset($isPreview) && $isPreview)
         style="cursor: pointer; position: relative;"
     @endif
     ...>
```

## Paso 5: Opcional - Estilos de Edición en Preview

```blade
{{-- backend/resources/views/pages/show.blade.php --}}
@if(isset($isPreview) && $isPreview)
<style>
    [data-block-id]:hover {
        outline: 2px solid #0a5a39;
        outline-offset: 2px;
    }

    [data-block-id].selected {
        outline: 3px solid #0a5a39;
        outline-offset: 2px;
    }
</style>

<script>
    // Comunicación con el editor padre
    window.addEventListener('message', (event) => {
        if (event.data.type === 'selectBlock') {
            document.querySelectorAll('[data-block-id]').forEach(el => {
                el.classList.remove('selected')
            })

            const block = document.querySelector(`[data-block-id="${event.data.blockId}"]`)
            if (block) {
                block.classList.add('selected')
                block.scrollIntoView({ behavior: 'smooth', block: 'center' })
            }
        }
    })
</script>
@endif
```

## Paso 6: Borrar Bloques Vue (AHORA SÍ)

```bash
# Ya no necesitas estos archivos
rm -rf frontend/src/components/blocks/TextBlock.vue
rm -rf frontend/src/components/blocks/BannerIntegraBlock.vue
rm -rf frontend/src/components/blocks/ContainerBlock.vue
# ... etc
```

## Ventajas de este Enfoque

✅ Sin duplicación de código (como Elementor)
✅ Preview EXACTO al resultado final
✅ Solo mantienes bloques Blade
✅ Cambios se reflejan en tiempo real
✅ Puedes hacer click en bloques para editarlos

## Desventajas

⚠️ Iframe puede ser un poco más lento
⚠️ No hay drag & drop visual (pero puedes agregar botones arriba/abajo)
⚠️ Requiere comunicación postMessage para interactividad

## Resultado Final

**Editor:**
- Sidebar con formularios
- Canvas con iframe mostrando página real Blade
- Click en bloque → Se selecciona en sidebar
- Editas en sidebar → Se actualiza iframe

**Sitio Público:**
- Usa los mismos bloques Blade
- Sin código duplicado
- SSR perfecto para SEO y PageSpeed
