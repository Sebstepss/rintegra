<template>
  <div class="users-manager">
    <!-- Header -->
    <div class="users-header">
      <h2>Usuarios y Roles</h2>
      <div class="header-actions">
        <button @click="showCreateUser = true" class="btn-primary">
          <Icon name="plus" />
          Nuevo Usuario
        </button>
        <button @click="showRoleModal = true" class="btn-secondary">
          <Icon name="cog" />
          Gestionar Roles
        </button>
      </div>
    </div>

    <!-- Estadísticas -->
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-icon">
          <Icon name="cube" />
        </div>
        <div class="stat-content">
          <h3>{{ users.length }}</h3>
          <p>Total Usuarios</p>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">
          <Icon name="check" />
        </div>
        <div class="stat-content">
          <h3>{{ users.filter(u => u.role?.name === 'admin').length }}</h3>
          <p>Administradores</p>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">
          <Icon name="clock" />
        </div>
        <div class="stat-content">
          <h3>{{ users.filter(u => u.role?.name === 'editor').length }}</h3>
          <p>Editores</p>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">
          <Icon name="globe" />
        </div>
        <div class="stat-content">
          <h3>{{ roles.length }}</h3>
          <p>Roles Definidos</p>
        </div>
      </div>
    </div>

    <!-- Filtros y búsqueda -->
    <div class="users-controls">
      <div class="search-filters">
        <div class="search-box">
          <Icon name="search" />
          <input 
            type="text" 
            v-model="searchTerm" 
            placeholder="Buscar usuarios..."
            class="search-input"
            @keyup.enter="loadUsers()"
          >
        </div>
        <select v-model="roleFilter" @change="loadUsers()" class="filter-select">
          <option value="all">Todos los roles</option>
          <option v-for="role in roles" :key="role.id" :value="role.name">
            {{ role.name }}
          </option>
        </select>
      </div>
    </div>

    <!-- Lista de usuarios -->
    <div class="users-container">
      <div class="users-table-container">
        <table class="users-table">
          <thead>
            <tr>
              <th>Usuario</th>
              <th>Email</th>
              <th>Rol</th>
              <th>Fecha registro</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in filteredUsers" :key="user.id" class="user-row">
              <td>
                <div class="user-info">
                  <div class="user-avatar">
                    <img v-if="user.avatar" :src="user.avatar" :alt="user.name">
                    <span v-else class="avatar-placeholder">
                      {{ getInitials(user.name) }}
                    </span>
                  </div>
                  <div class="user-details">
                    <span class="user-name">{{ user.name }}</span>
                    <small class="user-meta">{{ user.title || 'Sin título' }}</small>
                  </div>
                </div>
              </td>
              <td>
                <span class="user-email">{{ user.email }}</span>
              </td>
              <td>
                <span class="role-badge" :class="getRoleBadgeClass(user)">
                  {{ getRoleName(user) }}
                </span>
              </td>
              <td>
                <span class="created-date">
                  {{ formatDate(user.created_at) }}
                </span>
              </td>
              <td>
                <div class="user-actions">
                  <button 
                    @click="editUser(user)" 
                    class="btn-icon" 
                    title="Editar usuario"
                  >
                    <Icon name="edit" />
                  </button>
                  <button 
                    @click="deleteUser(user)" 
                    class="btn-icon danger" 
                    title="Eliminar usuario"
                    v-if="user.id !== currentUserId"
                  >
                    <Icon name="trash" />
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Modal Crear/Editar Usuario -->
    <div v-if="showCreateUser || showEditUser" class="modal-overlay" @click="closeUserModal">
      <div class="modal-content" @click.stop>
        <div class="modal-header">
          <h3>{{ showEditUser ? 'Editar Usuario' : 'Nuevo Usuario' }}</h3>
          <button @click="closeUserModal" class="btn-close">
            <Icon name="close" />
          </button>
        </div>
        
        <div class="modal-body">
          <form @submit.prevent="saveUser">
            <div class="form-row">
              <div class="form-group">
                <label for="user-name">Nombre completo</label>
                <input 
                  type="text" 
                  id="user-name" 
                  v-model="userForm.name" 
                  class="form-input"
                  required
                >
              </div>
              <div class="form-group">
                <label for="user-email">Email</label>
                <input 
                  type="email" 
                  id="user-email" 
                  v-model="userForm.email" 
                  class="form-input"
                  required
                >
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="user-title">Título/Cargo</label>
                <input 
                  type="text" 
                  id="user-title" 
                  v-model="userForm.title" 
                  class="form-input"
                  placeholder="Ej: Administrador, Editor"
                >
              </div>
              <div class="form-group">
                <label for="user-role">Rol</label>
                <select id="user-role" v-model="userForm.role_id" class="form-input" required>
                  <option value="">Seleccionar rol</option>
                  <option v-for="role in roles" :key="role.id" :value="role.id">
                    {{ role.name }}
                  </option>
                </select>
              </div>
            </div>

            <div class="form-group" v-if="!showEditUser">
              <label for="user-password">Contraseña</label>
              <input 
                type="password" 
                id="user-password" 
                v-model="userForm.password" 
                class="form-input"
                required
                minlength="8"
              >
              <small class="form-help">Mínimo 8 caracteres</small>
            </div>

            <div class="form-group">
              <label for="user-phone">Teléfono</label>
              <input 
                type="tel" 
                id="user-phone" 
                v-model="userForm.phone" 
                class="form-input"
              >
            </div>

            <div class="form-group">
              <label class="checkbox-label">
                <input type="checkbox" v-model="userForm.send_welcome_email">
                <span class="checkmark"></span>
                Enviar email de bienvenida
              </label>
            </div>
          </form>
        </div>
        
        <div class="modal-footer">
          <button @click="closeUserModal" class="btn-secondary">
            <Icon name="close" />
            Cancelar
          </button>
          <button @click="saveUser" class="btn-primary">
            <Icon name="save" />
            {{ showEditUser ? 'Actualizar' : 'Crear' }} Usuario
          </button>
        </div>
      </div>
    </div>

    <!-- Modal Gestión de Roles -->
    <div v-if="showRoleModal" class="modal-overlay" @click="closeRoleModal">
      <div class="modal-content large" @click.stop>
        <div class="modal-header">
          <h3>Gestión de Roles</h3>
          <button @click="closeRoleModal" class="btn-close">
            <Icon name="close" />
          </button>
        </div>
        
        <div class="modal-body">
          <div class="roles-section">
            <div class="section-header">
              <h4>Roles Existentes</h4>
              <button @click="addNewRole" class="btn-primary btn-sm">
                <Icon name="plus" />
                Nuevo Rol
              </button>
            </div>

            <div class="roles-list">
              <div v-for="role in roles" :key="role.id" class="role-card">
                <div class="role-header">
                  <div class="role-info">
                    <h5>{{ role.name }}</h5>
                    <p>{{ role.description }}</p>
                  </div>
                  <div class="role-actions">
                    <button @click="editRole(role)" class="btn-icon">
                      <Icon name="edit" />
                    </button>
                    <button 
                      @click="deleteRole(role)" 
                      class="btn-icon danger"
                      v-if="!role.system_role"
                    >
                      <Icon name="trash" />
                    </button>
                  </div>
                </div>

                <div class="role-permissions">
                  <h6>Permisos:</h6>
                  <div class="permissions-grid">
                    <div 
                      v-for="permission in role.permissions" 
                      :key="permission"
                      class="permission-tag"
                    >
                      {{ getPermissionLabel(permission) }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Editor de rol -->
          <div v-if="editingRole" class="role-editor">
            <h4>{{ editingRole.id ? 'Editar Rol' : 'Nuevo Rol' }}</h4>
            <form @submit.prevent="saveRole">
              <div class="form-group">
                <label for="role-name">Nombre del rol</label>
                <input 
                  type="text" 
                  id="role-name" 
                  v-model="editingRole.name" 
                  class="form-input"
                  required
                >
              </div>
              
              <div class="form-group">
                <label for="role-description">Descripción</label>
                <textarea 
                  id="role-description" 
                  v-model="editingRole.description" 
                  class="form-input"
                  rows="3"
                ></textarea>
              </div>

              <div class="form-group">
                <label>Permisos</label>
                <div class="permissions-selector">
                  <div 
                    v-for="permission in availablePermissions" 
                    :key="permission.key"
                    class="permission-item"
                  >
                    <label class="checkbox-label">
                      <input 
                        type="checkbox" 
                        :value="permission.key"
                        v-model="editingRole.permissions"
                      >
                      <span class="checkmark"></span>
                      <div class="permission-details">
                        <span class="permission-name">{{ permission.name }}</span>
                        <small class="permission-description">{{ permission.description }}</small>
                      </div>
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-actions">
                <button type="button" @click="cancelRoleEdit" class="btn-secondary">
                  Cancelar
                </button>
                <button type="submit" class="btn-primary">
                  {{ editingRole.id ? 'Actualizar' : 'Crear' }} Rol
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import Icon from '@/components/global/Icon.vue'
import { usersApi } from '@/services/api'

// Estado reactivo
const users = ref([])
const roles = ref([])
const loading = ref(false)
const pagination = ref({
  current_page: 1,
  last_page: 1,
  per_page: 10,
  total: 0
})
const searchTerm = ref('')
const statusFilter = ref('all')
const roleFilter = ref('all')
const showCreateUser = ref(false)
const showEditUser = ref(false)
const showRoleModal = ref(false)
const currentUserId = ref(1) // ID del usuario actual
const editingRole = ref(null)

const userForm = ref({
  name: '',
  email: '',
  title: '',
  role_id: '',
  password: '',
  phone: '',
  send_welcome_email: true
})

const availablePermissions = ref([
  {
    key: 'pages.create',
    name: 'Crear páginas',
    description: 'Permitir crear nuevas páginas'
  },
  {
    key: 'pages.edit',
    name: 'Editar páginas',
    description: 'Permitir modificar páginas existentes'
  },
  {
    key: 'pages.delete',
    name: 'Eliminar páginas',
    description: 'Permitir eliminar páginas'
  },
  {
    key: 'pages.publish',
    name: 'Publicar páginas',
    description: 'Permitir cambiar estado de publicación'
  },
  {
    key: 'media.upload',
    name: 'Subir medios',
    description: 'Permitir subir archivos multimedia'
  },
  {
    key: 'media.delete',
    name: 'Eliminar medios',
    description: 'Permitir eliminar archivos multimedia'
  },
  {
    key: 'users.view',
    name: 'Ver usuarios',
    description: 'Permitir ver lista de usuarios'
  },
  {
    key: 'users.create',
    name: 'Crear usuarios',
    description: 'Permitir crear nuevos usuarios'
  },
  {
    key: 'users.edit',
    name: 'Editar usuarios',
    description: 'Permitir modificar usuarios existentes'
  },
  {
    key: 'users.delete',
    name: 'Eliminar usuarios',
    description: 'Permitir eliminar usuarios'
  },
  {
    key: 'analytics.view',
    name: 'Ver analíticas',
    description: 'Permitir acceso a datos de analíticas'
  },
  {
    key: 'settings.edit',
    name: 'Editar configuración',
    description: 'Permitir modificar configuración del sistema'
  },
  {
    key: 'backups.create',
    name: 'Crear backups',
    description: 'Permitir generar respaldos'
  },
  {
    key: 'backups.restore',
    name: 'Restaurar backups',
    description: 'Permitir restaurar desde respaldos'
  }
])

// Cargar datos iniciales
onMounted(() => {
  loadUsers()
  loadRoles()
})

const loadUsers = async (page = 1) => {
  try {
    loading.value = true
    const filters = {
      page,
      search: searchTerm.value || undefined,
      role: roleFilter.value !== 'all' ? roleFilter.value : undefined
    }
    
    const response = await usersApi.getAll(filters)
    
    if (response.data.success) {
      users.value = response.data.data
      pagination.value = response.data.pagination
    } else {
      console.error('Error al cargar usuarios:', response.data.message)
    }
  } catch (error) {
    console.error('Error al cargar usuarios:', error)
    alert('Error al cargar los usuarios')
  } finally {
    loading.value = false
  }
}

const loadRoles = async () => {
  try {
    const response = await usersApi.getRoles()
    
    if (response.data.success) {
      roles.value = response.data.data
    } else {
      console.error('Error al cargar roles:', response.data.message)
    }
  } catch (error) {
    console.error('Error al cargar roles:', error)
  }
}

// Computed properties
const activeUsers = computed(() => 
  users.value.filter(u => u.status === 'active').length
)

const pendingUsers = computed(() => 
  users.value.filter(u => u.status === 'pending').length
)

const filteredUsers = computed(() => {
  let filtered = users.value

  if (searchTerm.value) {
    const term = searchTerm.value.toLowerCase()
    filtered = filtered.filter(u => 
      u.name.toLowerCase().includes(term) ||
      u.email.toLowerCase().includes(term)
    )
  }

  if (statusFilter.value !== 'all') {
    filtered = filtered.filter(u => u.status === statusFilter.value)
  }

  if (roleFilter.value !== 'all') {
    filtered = filtered.filter(u => u.role_id == roleFilter.value)
  }

  return filtered
})

// Métodos
const getInitials = (name) => {
  return name.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase()
}

const getRoleName = (user) => {
  return user.role ? user.role.name : 'Sin rol'
}

const getRoleBadgeClass = (user) => {
  if (!user.role) return 'role-none'
  
  switch (user.role.name.toLowerCase()) {
    case 'admin':
      return 'role-admin'
    case 'editor':
      return 'role-editor'
    default:
      return 'role-user'
  }
}

const getStatusLabel = (status) => {
  const labels = {
    active: 'Activo',
    inactive: 'Inactivo',
    pending: 'Pendiente'
  }
  return labels[status] || status
}

const getPermissionLabel = (permission) => {
  const perm = availablePermissions.value.find(p => p.key === permission)
  return perm ? perm.name : permission
}

const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString('es-ES')
}

const editUser = (user) => {
  userForm.value = {
    ...user,
    password: '', // No mostrar contraseña actual
    send_welcome_email: false
  }
  showEditUser.value = true
}

const closeUserModal = () => {
  showCreateUser.value = false
  showEditUser.value = false
  userForm.value = {
    name: '',
    email: '',
    title: '',
    role_id: '',
    password: '',
    phone: '',
    send_welcome_email: true
  }
}

const saveUser = async () => {
  try {
    loading.value = true
    
    const userData = {
      name: userForm.value.name,
      email: userForm.value.email,
      role_id: parseInt(userForm.value.role_id)
    }
    
    if (!showEditUser.value && userForm.value.password) {
      userData.password = userForm.value.password
      userData.password_confirmation = userForm.value.password
    }
    
    let response
    if (showEditUser.value) {
      response = await usersApi.update(userForm.value.id, userData)
    } else {
      response = await usersApi.create(userData)
    }
    
    if (response.data.success) {
      closeUserModal()
      alert(response.data.message || `Usuario ${showEditUser.value ? 'actualizado' : 'creado'} correctamente`)
      await loadUsers()
    } else {
      alert(response.data.message || 'Error al guardar usuario')
    }
  } catch (error) {
    console.error('Error al guardar usuario:', error)
    alert('Error al guardar el usuario')
  } finally {
    loading.value = false
  }
}

const toggleUserStatus = (user) => {
  const newStatus = user.status === 'active' ? 'inactive' : 'active'
  user.status = newStatus
  // En implementación real, enviar a API
  console.log(`User ${user.id} status changed to: ${newStatus}`)
}

const resetPassword = (user) => {
  if (confirm(`¿Resetear la contraseña de ${user.name}?`)) {
    // En implementación real, enviar a API
    console.log(`Password reset for user: ${user.id}`)
    alert('Email de restablecimiento enviado al usuario')
  }
}

const deleteUser = async (user) => {
  if (confirm(`¿Estás seguro de eliminar a ${user.name}? Esta acción no se puede deshacer.`)) {
    try {
      loading.value = true
      const response = await usersApi.delete(user.id)
      
      if (response.data.success) {
        alert(response.data.message || 'Usuario eliminado correctamente')
        await loadUsers()
      } else {
        alert(response.data.message || 'Error al eliminar usuario')
      }
    } catch (error) {
      console.error('Error al eliminar usuario:', error)
      alert('Error al eliminar el usuario')
    } finally {
      loading.value = false
    }
  }
}

// Gestión de roles
const closeRoleModal = () => {
  showRoleModal.value = false
  editingRole.value = null
}

const addNewRole = () => {
  editingRole.value = {
    name: '',
    description: '',
    permissions: []
  }
}

const editRole = (role) => {
  editingRole.value = { ...role }
}

const cancelRoleEdit = () => {
  editingRole.value = null
}

const saveRole = () => {
  // En implementación real, enviar a API
  console.log('Saving role:', editingRole.value)
  
  if (editingRole.value.id) {
    // Actualizar rol existente
    const index = roles.value.findIndex(r => r.id === editingRole.value.id)
    if (index !== -1) {
      roles.value[index] = { ...editingRole.value }
    }
  } else {
    // Crear nuevo rol
    const newRole = {
      ...editingRole.value,
      id: Date.now(),
      system_role: false
    }
    roles.value.push(newRole)
  }
  
  editingRole.value = null
  alert(`Rol ${editingRole.value?.id ? 'actualizado' : 'creado'} correctamente`)
}

const deleteRole = (role) => {
  if (confirm(`¿Estás seguro de eliminar el rol "${role.name}"?`)) {
    const index = roles.value.findIndex(r => r.id === role.id)
    if (index !== -1) {
      roles.value.splice(index, 1)
    }
    // En implementación real, enviar a API
    console.log(`Role deleted: ${role.id}`)
  }
}
</script>

<style scoped>
.users-manager {
  padding: 0;
}

.users-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}

.users-header h2 {
  margin: 0;
  color: #2c3e50;
}

.header-actions {
  display: flex;
  gap: 0.5rem;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1rem;
  margin-bottom: 2rem;
}

.stat-card {
  background: white;
  border-radius: 8px;
  padding: 1.5rem;
  display: flex;
  align-items: center;
  gap: 1rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  border: 1px solid #e9ecef;
}

.stat-icon {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background: linear-gradient(135deg, #007bff, #0056b3);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
}

.stat-content h3 {
  font-size: 1.8rem;
  font-weight: 700;
  margin: 0;
  color: #2c3e50;
}

.stat-content p {
  margin: 0;
  color: #6c757d;
  font-size: 0.9rem;
}

.users-controls {
  background: white;
  border-radius: 8px;
  border: 1px solid #e9ecef;
  padding: 1.5rem;
  margin-bottom: 2rem;
}

.search-filters {
  display: flex;
  gap: 1rem;
  align-items: center;
}

.search-box {
  position: relative;
  flex: 1;
}

.search-box .w-4 {
  position: absolute;
  left: 1rem;
  top: 50%;
  transform: translateY(-50%);
  color: #6c757d;
  width: 16px;
}

.search-input {
  width: 100%;
  padding: 0.75rem 0.75rem 0.75rem 2.5rem;
  border: 1px solid #dee2e6;
  border-radius: 4px;
  font-size: 0.9rem;
}

.filter-select {
  padding: 0.75rem;
  border: 1px solid #dee2e6;
  border-radius: 4px;
  font-size: 0.9rem;
  min-width: 150px;
}

.users-container {
  background: white;
  border-radius: 8px;
  border: 1px solid #e9ecef;
  overflow: hidden;
}

.users-table-container {
  overflow-x: auto;
}

.users-table {
  width: 100%;
  border-collapse: collapse;
}

.users-table th,
.users-table td {
  padding: 1rem;
  text-align: left;
  border-bottom: 1px solid #e9ecef;
}

.users-table th {
  background: #f8f9fa;
  font-weight: 600;
  color: #495057;
}

.user-row:hover {
  background: #f8f9fa;
}

.user-info {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.user-avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #e9ecef;
}

.user-avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.avatar-placeholder {
  font-weight: 600;
  color: #6c757d;
  font-size: 0.9rem;
}

.user-details {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}

.user-name {
  font-weight: 600;
  color: #2c3e50;
}

.user-meta {
  color: #6c757d;
  font-size: 0.8rem;
}

.user-email {
  color: #007bff;
}

.role-badge {
  padding: 0.25rem 0.75rem;
  border-radius: 12px;
  font-size: 0.75rem;
  font-weight: 500;
}

.role-admin {
  background: #d4edda;
  color: #155724;
}

.role-editor {
  background: #d1ecf1;
  color: #0c5460;
}

.role-user {
  background: #fff3cd;
  color: #856404;
}

.role-none {
  background: #f8d7da;
  color: #721c24;
}

.status-badge {
  padding: 0.25rem 0.75rem;
  border-radius: 12px;
  font-size: 0.75rem;
  font-weight: 500;
}

.status-badge.active {
  background: #d4edda;
  color: #155724;
}

.status-badge.inactive {
  background: #f8d7da;
  color: #721c24;
}

.status-badge.pending {
  background: #fff3cd;
  color: #856404;
}

.user-actions {
  display: flex;
  gap: 0.25rem;
}

.btn-icon {
  padding: 0.5rem;
  border: none;
  background: transparent;
  border-radius: 4px;
  cursor: pointer;
  color: #6c757d;
  transition: all 0.2s;
}

.btn-icon:hover {
  background: #e9ecef;
  color: #495057;
}

.btn-icon.danger:hover {
  background: #f8d7da;
  color: #721c24;
}

.btn-icon.active {
  color: #28a745;
}

/* Modal styles */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
}

.modal-content {
  background: white;
  border-radius: 8px;
  width: 90%;
  max-width: 600px;
  max-height: 90vh;
  overflow-y: auto;
}

.modal-content.large {
  max-width: 900px;
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.5rem;
  border-bottom: 1px solid #e9ecef;
  background: #f8f9fa;
}

.modal-header h3 {
  margin: 0;
  color: #2c3e50;
}

.btn-close {
  background: none;
  border: none;
  font-size: 1.2rem;
  cursor: pointer;
  color: #6c757d;
  padding: 0.5rem;
  border-radius: 4px;
}

.btn-close:hover {
  background: #e9ecef;
}

.modal-body {
  padding: 1.5rem;
}

.modal-footer {
  display: flex;
  justify-content: flex-end;
  gap: 1rem;
  padding: 1.5rem;
  border-top: 1px solid #e9ecef;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
}

.form-group {
  margin-bottom: 1rem;
}

.form-group label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 600;
  color: #495057;
}

.form-input {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #dee2e6;
  border-radius: 4px;
  font-size: 0.9rem;
}

.form-input:focus {
  outline: none;
  border-color: #007bff;
  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
}

.form-help {
  display: block;
  margin-top: 0.25rem;
  font-size: 0.8rem;
  color: #6c757d;
}

.checkbox-label {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  cursor: pointer;
  color: #495057;
}

.checkbox-label input[type="checkbox"] {
  width: 18px;
  height: 18px;
  margin: 0;
}

.btn-primary,
.btn-secondary {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-weight: 600;
  transition: all 0.2s;
}

.btn-sm {
  padding: 0.5rem 1rem;
  font-size: 0.8rem;
}

.btn-primary {
  background: #007bff;
  color: white;
}

.btn-primary:hover {
  background: #0056b3;
}

.btn-secondary {
  background: #6c757d;
  color: white;
}

.btn-secondary:hover {
  background: #545b62;
}

/* Roles management */
.roles-section {
  margin-bottom: 2rem;
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.section-header h4 {
  margin: 0;
  color: #2c3e50;
}

.roles-list {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.role-card {
  border: 1px solid #e9ecef;
  border-radius: 8px;
  padding: 1.5rem;
  background: #f8f9fa;
}

.role-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 1rem;
}

.role-info h5 {
  margin: 0 0 0.5rem 0;
  color: #2c3e50;
}

.role-info p {
  margin: 0;
  color: #6c757d;
  font-size: 0.9rem;
}

.role-actions {
  display: flex;
  gap: 0.25rem;
}

.role-permissions h6 {
  margin: 0 0 0.5rem 0;
  color: #495057;
  font-size: 0.9rem;
}

.permissions-grid {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
}

.permission-tag {
  background: #e9ecef;
  color: #495057;
  padding: 0.25rem 0.5rem;
  border-radius: 12px;
  font-size: 0.75rem;
}

.role-editor {
  background: rgb(171, 205, 255);
  border-radius: 12px;
}

.role-editor h4 {
  margin: 0 0 1.5rem 0;
  color: #ffffff;
}

.permissions-selector {
  max-height: 300px;
  overflow-y: auto;
  border: 1px solid #dee2e6;
  border-radius: 4px;
  padding: 1rem;
}

.permission-item {
  margin-bottom: 0.75rem;
}

.permission-item:last-child {
  margin-bottom: 0;
}

.permission-item .checkbox-label {
  align-items: flex-start;
}

.permission-details {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}

.permission-name {
  font-weight: 500;
  color: #2c3e50;
}

.permission-description {
  color: #6c757d;
  font-size: 0.8rem;
}

.form-actions {
  display: flex;
  justify-content: flex-end;
  gap: 1rem;
  margin-top: 1.5rem;
  padding-top: 1.5rem;
  border-top: 1px solid #e9ecef;
}

/* Responsive */
@media (max-width: 768px) {
  .users-header {
    flex-direction: column;
    gap: 1rem;
    align-items: stretch;
  }
  
  .search-filters {
    flex-direction: column;
  }
  
  .form-row {
    grid-template-columns: 1fr;
  }
  
  .stats-grid {
    grid-template-columns: 1fr;
  }
  
  .modal-content {
    width: 95%;
    margin: 1rem;
  }
  
  .users-table-container {
    font-size: 0.8rem;
  }

  .user-info {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.5rem;
  }
}
</style>