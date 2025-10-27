import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

// Auth Pages
import LoginView from '@/views/auth/LoginView.vue'

// Admin Pages
import AdminDashboard from '@/views/admin/AdminDashboard.vue'
import BlockEditorPage from '@/views/admin/BlockEditorPage.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    // Redirect root to dashboard (relative to /admin/ base)
    {
      path: '/',
      redirect: '/dashboard'
    },
    // Auth Routes (sin layout)
    {
      path: '/login',
      name: 'login',
      component: LoginView,
    },
    // Admin Routes (protegidas)
    {
      path: '/dashboard',
      name: 'admin',
      component: AdminDashboard,
      meta: { requiresAuth: true }
    },
    {
      path: '/pages/:id/blocks',
      name: 'block-editor',
      component: BlockEditorPage,
      meta: { requiresAuth: true }
    },
  ],
})

// Navigation guard para rutas protegidas
router.beforeEach((to, from, next) => {
  const authStore = useAuthStore()
  
  if (to.meta.requiresAuth && !authStore.isAuthenticated) {
    next('/login')
  } else {
    next()
  }
})

export default router
