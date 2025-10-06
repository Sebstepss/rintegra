import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import vueDevTools from 'vite-plugin-vue-devtools'

// https://vite.dev/config/
export default defineConfig({
  plugins: [
    vue(),
    vueDevTools(),
  ],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    },
    extensions: ['.js', '.ts', '.jsx', '.tsx', '.json', '.vue']
  },
  build: {
    rollupOptions: {
      output: {
        manualChunks: (id) => {
          if (id.includes('node_modules')) {
            if (id.includes('vue')) {
              return 'vendor-vue'
            }
            if (id.includes('@fortawesome')) {
              return 'vendor-icons'
            }
            if (id.includes('axios')) {
              return 'vendor-http'
            }
            // Don't split TipTap - keep it in main vendor bundle
            return 'vendor'
          }
        }
      },
    },
    cssCodeSplit: true,
    minify: 'esbuild',
    chunkSizeWarningLimit: 500,
    target: 'es2020',
    reportCompressedSize: false, // Faster builds
  },
  server: {
    hmr: {
      overlay: false
    }
  }
})
