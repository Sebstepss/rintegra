<template>
  <div class="app-layout">
    <Header />
    <main class="main-content">
      <router-view />
    </main>
    <Footer />
  </div>
</template>

<script setup>
import { onMounted, onUnmounted } from 'vue'
import Header from './Header.vue'
import Footer from './Footer.vue'
import { useGlobals } from '@/composables/useGlobals'

const { init, destroy } = useGlobals()

onMounted(() => {
  init()
})

onUnmounted(() => {
  destroy()
})
</script>

<style scoped>
.app-layout {
  width: 100%;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

.main-content {
  flex: 1;
  width: 100%;
  padding-top: 80px; /* Para el header fixed */
}
</style>