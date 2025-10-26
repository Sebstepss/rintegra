<script setup lang="ts">
import { RouterView } from 'vue-router'
import { useSiteConfig } from '@/composables/useSiteConfig'

// Load site configuration on app mount
const { loadSiteConfig } = useSiteConfig()
loadSiteConfig()
</script>

<template>
  <div id="app">
    <RouterView />
  </div>
</template>

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html, body {
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen',
    'Ubuntu', 'Cantarell', 'Fira Sans', 'Droid Sans', 'Helvetica Neue',
    sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

#app {
  width: 100%;
  display: flex;
  flex-direction: column;
}
</style>
