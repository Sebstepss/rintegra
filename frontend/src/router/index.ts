import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

// Layouts
import MainLayout from '@/components/Layout/MainLayout.vue'

// Dynamic Page
import DynamicPageView from '@/views/DynamicPageView.vue'

// Auth Pages
import LoginView from '@/views/auth/LoginView.vue'
import RegisterView from '@/views/auth/RegisterView.vue'

// Admin Pages
import AdminDashboard from '@/views/admin/AdminDashboard.vue'
import BlockEditorPage from '@/views/admin/BlockEditorPage.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      component: MainLayout,
      children: [
        {
          path: '',
          name: 'home',
          component: DynamicPageView,
          props: { defaultSlug: 'inicio' }
        },
        {
          path: '/:slug',
          name: 'page',
          component: DynamicPageView,
          props: true
        }
      ]
    },
    // Auth Routes (sin layout)
    {
      path: '/login',
      name: 'login',
      component: LoginView,
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView,
    },
    // Admin Routes (protegidas)
    {
      path: '/admin',
      name: 'admin',
      component: AdminDashboard,
      meta: { requiresAuth: true }
    },
    {
      path: '/admin/pages/:id/blocks',
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
