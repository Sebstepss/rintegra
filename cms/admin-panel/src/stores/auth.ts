import { defineStore } from 'pinia'
import axios from 'axios'
import api from '@/services/api'

interface Role {
  id: number
  name: string
  description: string
  permissions: string[]
}

interface User {
  id: number
  name: string
  email: string
  role?: Role
  created_at: string
  updated_at: string
}

interface LoginCredentials {
  email: string
  password: string
}

interface RegisterData {
  name: string
  email: string
  password: string
  password_confirmation: string
}

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null as User | null,
    token: localStorage.getItem('token') || null,
    loading: false,
    error: null as string | null
  }),

  getters: {
    isAuthenticated: (state) => !!state.token,
    isLoggedIn: (state) => !!state.user && !!state.token
  },

  actions: {
    async login(credentials: LoginCredentials) {
      this.loading = true
      this.error = null

      try {
        const response = await api.post('/login', credentials)
        
        this.user = response.data.user
        this.token = response.data.token
        
        // Guardar token en localStorage
        localStorage.setItem('token', this.token)
        
        // El token se agregará automáticamente por el interceptor
        
        return response.data
      } catch (error) {
        this.error = error.response?.data?.message || 'Error al iniciar sesión'
        throw error
      } finally {
        this.loading = false
      }
    },

    async register(userData: RegisterData) {
      this.loading = true
      this.error = null

      try {
        const response = await api.post('/register', userData)
        
        this.user = response.data.user
        this.token = response.data.token
        
        // Guardar token en localStorage
        localStorage.setItem('token', this.token)
        
        // El token se agregará automáticamente por el interceptor
        
        return response.data
      } catch (error) {
        this.error = error.response?.data?.message || 'Error al registrarse'
        throw error
      } finally {
        this.loading = false
      }
    },

    async logout() {
      try {
        if (this.token) {
          await api.post('/logout')
        }
      } catch (error) {
        console.error('Error logging out:', error)
      } finally {
        this.user = null
        this.token = null
        this.error = null
        
        // Remover token del localStorage
        localStorage.removeItem('token')
        
        // El interceptor no agregará más el token
      }
    },

    async fetchUser() {
      if (!this.token) return

      try {
        const response = await api.get('/user')
        this.user = response.data
        console.log('User loaded with role:', this.user)
      } catch (error) {
        console.error('Error fetching user:', error)
        // Si el token no es válido, limpiar el estado
        if (error.response?.status === 401) {
          this.logout()
        }
      }
    },

    async refreshToken() {
      if (!this.token) return

      try {
        const response = await api.post('/refresh')
        
        this.user = response.data.user
        this.token = response.data.token
        
        // Actualizar token en localStorage
        localStorage.setItem('token', this.token)
        
        // El token se agregará automáticamente por el interceptor
        
        return response.data
      } catch (error) {
        console.error('Error refreshing token:', error)
        this.logout()
        throw error
      }
    },

    initializeAuth() {
      // Configurar axios con token si existe
      if (this.token) {
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        this.fetchUser()
      }
    },

    clearError() {
      this.error = null
    }
  }
})