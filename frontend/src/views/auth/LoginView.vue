<template>
  <div class="auth-container">
    <div class="auth-card">
      <div class="auth-header">
        <h1>Iniciar Sesión</h1>
        <p>Accede al panel de administración</p>
      </div>

      <form @submit.prevent="handleLogin" class="auth-form">
        <div class="form-group">
          <label for="email">Correo Electrónico</label>
          <input
            id="email"
            v-model="form.email"
            type="email"
            required
            :disabled="loading"
            placeholder="tu@email.com"
          />
        </div>

        <div class="form-group">
          <label for="password">Contraseña</label>
          <input
            id="password"
            v-model="form.password"
            type="password"
            required
            :disabled="loading"
            placeholder="••••••••"
          />
        </div>

        <div v-if="error" class="error-message">
          <i class="fas fa-exclamation-triangle"></i>
          {{ error }}
        </div>

        <button type="submit" class="btn-primary btn-full" :disabled="loading">
          <i v-if="loading" class="fas fa-spinner fa-spin"></i>
          <i v-else class="fas fa-sign-in-alt"></i>
          {{ loading ? 'Iniciando...' : 'Iniciar Sesión' }}
        </button>
      </form>

      <div class="auth-footer">
        <p>
          ¿No tienes cuenta?
          <router-link to="/register" class="auth-link">Regístrate aquí</router-link>
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const router = useRouter()
const authStore = useAuthStore()

const form = ref({
  email: '',
  password: ''
})

const loading = computed(() => authStore.loading)
const error = computed(() => authStore.error)

const handleLogin = async () => {
  authStore.clearError()
  
  try {
    await authStore.login(form.value)
    router.push('/admin')
  } catch (error) {
    console.error('Login failed:', error)
  }
}
</script>

<style scoped>
.auth-container {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  padding: 2rem;
}

.auth-card {
  background: white;
  border-radius: 16px;
  padding: 3rem;
  width: 100%;
  max-width: 400px;
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  position: relative;
  overflow: hidden;
}

.auth-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #007bff, #0056b3);
}

.auth-header {
  text-align: center;
  margin-bottom: 2rem;
}

.auth-header h1 {
  color: #2c3e50;
  margin-bottom: 0.5rem;
  font-size: 2rem;
  font-weight: 700;
}

.auth-header p {
  color: #6c757d;
  margin: 0;
}

.auth-form {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.form-group {
  display: flex;
  flex-direction: column;
}

.form-group label {
  margin-bottom: 0.5rem;
  font-weight: 600;
  color: #2c3e50;
}

.form-group input {
  padding: 0.875rem 1rem;
  border: 2px solid #e9ecef;
  border-radius: 8px;
  font-size: 1rem;
  transition: all 0.3s ease;
  background: #f8f9fa;
}

.form-group input:focus {
  outline: none;
  border-color: #007bff;
  box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
  background: white;
}

.form-group input:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.error-message {
  background: #f8d7da;
  color: #721c24;
  padding: 0.75rem 1rem;
  border-radius: 8px;
  border: 1px solid #f5c6cb;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.btn-primary {
  background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
  color: white;
  border: none;
  padding: 1rem 2rem;
  border-radius: 8px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  text-decoration: none;
}

.btn-full {
  width: 100%;
}

.btn-primary:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px -5px rgba(0, 123, 255, 0.4);
}

.btn-primary:active:not(:disabled) {
  transform: translateY(0);
}

.btn-primary:disabled {
  opacity: 0.6;
  cursor: not-allowed;
  transform: none;
}

.auth-footer {
  margin-top: 2rem;
  text-align: center;
  padding-top: 1.5rem;
  border-top: 1px solid #e9ecef;
}

.auth-footer p {
  color: #6c757d;
  margin: 0;
}

.auth-link {
  color: #007bff;
  text-decoration: none;
  font-weight: 600;
  transition: color 0.3s ease;
}

.auth-link:hover {
  color: #0056b3;
  text-decoration: underline;
}

@media (max-width: 480px) {
  .auth-container {
    padding: 1rem;
  }
  
  .auth-card {
    padding: 2rem;
  }
  
  .auth-header h1 {
    font-size: 1.75rem;
  }
}
</style>