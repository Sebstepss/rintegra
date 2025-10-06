<template>
  <div class="backups-manager">
    <!-- Header -->
    <div class="backups-header">
      <h2>Gestión de Backups</h2>
      <div class="header-actions">
        <button @click="importBackup" class="btn-secondary">
          <Icon name="upload" />
          Importar Backup
        </button>
        <button @click="createBackup" class="btn-primary" :disabled="creatingBackup">
          <Icon name="plus" />
          {{ creatingBackup ? 'Creando...' : 'Crear Backup' }}
        </button>
        <!-- Input oculto para seleccionar archivo -->
        <input 
          ref="fileInput" 
          type="file" 
          accept=".zip,.sql" 
          @change="handleFileSelect" 
          style="display: none"
        />
      </div>
    </div>

    <!-- Stats Cards -->
    <div class="backup-stats">
      <div class="stat-card">
        <div class="stat-icon">
          <Icon name="server" />
        </div>
        <div class="stat-content">
          <h3>{{ backups.length }}</h3>
          <p>Backups Totales</p>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">
          <Icon name="clock" />
        </div>
        <div class="stat-content">
          <h3>{{ formatFileSize(totalBackupSize) }}</h3>
          <p>Espacio Usado</p>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">
          <Icon name="calendar" />
        </div>
        <div class="stat-content">
          <h3>{{ lastBackupDate }}</h3>
          <p>Último Backup</p>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">
          <Icon name="cog" />
        </div>
        <div class="stat-content">
          <h3>{{ autoBackupEnabled ? 'Activo' : 'Inactivo' }}</h3>
          <p>Backup Automático</p>
        </div>
      </div>
    </div>

    <!-- Backup Configuration -->
    <div class="backup-config">
      <div class="config-card">
        <div class="config-header">
          <h3>Configuración de Backups</h3>
        </div>
        <div class="config-content">
          <div class="config-row">
            <div class="config-group">
              <label class="checkbox-label">
                <input type="checkbox" v-model="autoBackupEnabled">
                <span class="checkmark"></span>
                Habilitar backups automáticos
              </label>
            </div>
            <div class="config-group" v-if="autoBackupEnabled">
              <label for="backup-frequency">Frecuencia de backup automático</label>
              <select id="backup-frequency" v-model="autoBackupFrequency" class="form-input">
                <option value="daily">Diario</option>
                <option value="weekly">Semanal</option>
                <option value="monthly">Mensual</option>
              </select>
            </div>
          </div>
          
          <div class="config-row">
            <div class="config-group">
              <label for="retention-policy">Política de retención</label>
              <select id="retention-policy" v-model="retentionPolicy" class="form-input">
                <option value="7">Conservar 7 días</option>
                <option value="30">Conservar 30 días</option>
                <option value="90">Conservar 90 días</option>
                <option value="365">Conservar 1 año</option>
                <option value="0">Conservar todo</option>
              </select>
            </div>
            <div class="config-group">
              <label for="max-backups">Máximo número de backups</label>
              <input 
                type="number" 
                id="max-backups" 
                v-model.number="maxBackups" 
                min="1" 
                max="100" 
                class="form-input"
              >
            </div>
          </div>
          
          <button @click="saveBackupConfig" class="btn-primary">
            <Icon name="save" />
            Guardar Configuración
          </button>
        </div>
      </div>
    </div>


    <!-- Backups List -->
    <div class="backups-list-section">
      <div class="backups-card">
        <div class="backups-card-header">
          <h3>Historial de Backups</h3>
          <div class="list-actions">
            <input 
              type="text" 
              v-model="searchQuery" 
              placeholder="Buscar backups..." 
              class="search-input"
            >
            <select v-model="filterType" class="filter-select">
              <option value="all">Todos los tipos</option>
              <option value="auto">Automático</option>
              <option value="manual">Manual</option>
              <option value="scheduled">Programado</option>
            </select>
          </div>
        </div>

        <div v-if="filteredBackups.length === 0" class="empty-state">
          <Icon name="server" />
          <h3>No hay backups</h3>
          <p>Los backups creados aparecerán aquí</p>
        </div>

        <div v-else class="backups-table-container">
          <table class="backups-table">
            <thead>
              <tr>
                <th>Nombre del Backup</th>
                <th>Tipo</th>
                <th>Tamaño</th>
                <th>Fecha de Creación</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="backup in paginatedBackups" :key="backup.id" class="backup-row">
                <td>
                  <div class="backup-name">
                    <Icon name="document" />
                    <span v-if="editingBackup?.id !== backup.id">{{ backup.name }}</span>
                    <input 
                      v-else 
                      v-model="editingBackupName" 
                      @keyup.enter="saveBackupName(backup)" 
                      @keyup.escape="cancelEditName" 
                      class="backup-name-input"
                      @blur="saveBackupName(backup)"
                    />
                  </div>
                </td>
                <td>
                  <span class="backup-type" :class="backup.type">
                    {{ getBackupTypeLabel(backup.type) }}
                  </span>
                </td>
                <td>{{ backup.size_formatted || formatFileSize(backup.size) }}</td>
                <td>{{ formatDateTime(backup.created_at) }}</td>
                <td>
                  <span class="status-badge" :class="backup.status">
                    {{ getStatusLabel(backup.status) }}
                  </span>
                </td>
                <td>
                  <div class="backup-actions">
                    <button 
                      @click="editBackupName(backup)" 
                      class="btn-icon" 
                      title="Editar nombre"
                    >
                      <Icon name="edit" />
                    </button>
                    <button 
                      @click="downloadBackup(backup)" 
                      class="btn-icon" 
                      title="Descargar"
                      :disabled="backup.status !== 'completed'"
                    >
                      <Icon name="download" />
                    </button>
                    <button 
                      @click="restoreBackup(backup)" 
                      class="btn-icon" 
                      title="Restaurar"
                      :disabled="backup.status !== 'completed'"
                    >
                      <Icon name="reload" />
                    </button>
                    <button 
                      @click="viewBackupDetails(backup)" 
                      class="btn-icon" 
                      title="Ver detalles"
                    >
                      <Icon name="eye" />
                    </button>
                    <button 
                      @click="deleteBackup(backup)" 
                      class="btn-icon btn-danger" 
                      title="Eliminar"
                    >
                      <Icon name="delete" />
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="pagination" v-if="totalPages > 1">
          <button 
            @click="currentPage--" 
            :disabled="currentPage === 1"
            class="btn-pagination"
          >
            <Icon name="arrow-left" />
            Anterior
          </button>
          
          <span class="pagination-info">
            Página {{ currentPage }} de {{ totalPages }} 
            ({{ filteredBackups.length }} backups)
          </span>
          
          <button 
            @click="currentPage++" 
            :disabled="currentPage === totalPages"
            class="btn-pagination"
          >
            Siguiente
            <Icon name="arrow-right" />
          </button>
        </div>
      </div>
    </div>

    <!-- Backup Details Modal -->
    <div v-if="showDetailsModal" class="modal-overlay" @click="closeDetailsModal">
      <div class="modal-content" @click.stop>
        <div class="modal-header">
          <h3>Detalles del Backup</h3>
          <button @click="closeDetailsModal" class="btn-close">
            <Icon name="close" />
          </button>
        </div>
        
        <div class="modal-body" v-if="selectedBackup">
          <div class="detail-section">
            <h4>Información General</h4>
            <div class="detail-grid">
              <div class="detail-item">
                <label>Nombre:</label>
                <span>{{ selectedBackup.name }}</span>
              </div>
              <div class="detail-item">
                <label>Tipo:</label>
                <span>{{ getBackupTypeLabel(selectedBackup.type) }}</span>
              </div>
              <div class="detail-item">
                <label>Tamaño:</label>
                <span>{{ formatFileSize(selectedBackup.size) }}</span>
              </div>
              <div class="detail-item">
                <label>Estado:</label>
                <span class="status-badge" :class="selectedBackup.status">
                  {{ getStatusLabel(selectedBackup.status) }}
                </span>
              </div>
              <div class="detail-item">
                <label>Fecha de creación:</label>
                <span>{{ formatDateTime(selectedBackup.created_at) }}</span>
              </div>
              <div class="detail-item" v-if="selectedBackup.description">
                <label>Descripción:</label>
                <span>{{ selectedBackup.description }}</span>
              </div>
            </div>
          </div>

          <div class="detail-section" v-if="selectedBackup.contents">
            <h4>Contenido del Backup</h4>
            <div class="backup-contents">
              <div v-for="item in selectedBackup.contents" :key="item.type" class="content-item">
                <Icon :name="getContentIcon(item.type)" />
                <span class="content-type">{{ item.type }}</span>
                <span class="content-count">{{ item.count }} elementos</span>
                <span class="content-size">{{ formatFileSize(item.size) }}</span>
              </div>
            </div>
          </div>

          <div class="detail-section" v-if="selectedBackup.metadata">
            <h4>Metadatos</h4>
            <div class="metadata-list">
              <div v-for="(value, key) in selectedBackup.metadata" :key="key" class="metadata-item">
                <label>{{ formatMetadataKey(key) }}:</label>
                <span>{{ value }}</span>
              </div>
            </div>
          </div>
        </div>
        
        <div class="modal-footer">
          <button @click="closeDetailsModal" class="btn-secondary">
            <Icon name="close" />
            Cerrar
          </button>
          <button @click="downloadBackup(selectedBackup)" class="btn-primary" v-if="selectedBackup?.status === 'completed'">
            <Icon name="download" />
            Descargar
          </button>
        </div>
      </div>
    </div>

    <!-- Restore Confirmation Modal -->
    <div v-if="showRestoreModal" class="modal-overlay" @click="closeRestoreModal">
      <div class="modal-content" @click.stop>
        <div class="modal-header">
          <h3>Confirmar Restauración</h3>
          <button @click="closeRestoreModal" class="btn-close">
            <Icon name="close" />
          </button>
        </div>
        
        <div class="modal-body">
          <div class="warning-message">
            <Icon name="warning" />
            <div>
              <h4>¡Atención!</h4>
              <p>Esta acción reemplazará todos los datos actuales del sistema con el contenido del backup seleccionado.</p>
              <p><strong>Backup a restaurar:</strong> {{ backupToRestore?.name }}</p>
              <p><strong>Fecha del backup:</strong> {{ formatDateTime(backupToRestore?.created_at) }}</p>
            </div>
          </div>
          
          <div class="restore-options">
            <label class="checkbox-label">
              <input type="checkbox" v-model="restoreOptions.createBackupBefore">
              <span class="checkmark"></span>
              Crear backup automático antes de restaurar
            </label>
            <label class="checkbox-label">
              <input type="checkbox" v-model="restoreOptions.notifyUsers">
              <span class="checkmark"></span>
              Notificar a usuarios sobre la restauración
            </label>
          </div>
        </div>
        
        <div class="modal-footer">
          <button @click="closeRestoreModal" class="btn-secondary">
            <Icon name="close" />
            Cancelar
          </button>
          <button @click="confirmRestore" class="btn-danger">
            <Icon name="reload" />
            Confirmar Restauración
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import Icon from '@/components/global/Icon.vue'
import { backupsApi } from '@/services/api'

// Estado reactivo
const backups = ref([])
const loading = ref(false)
const pagination = ref({
  current_page: 1,
  last_page: 1,
  per_page: 10,
  total: 0
})
const backupStats = ref({})
const searchQuery = ref('')
const filterType = ref('all')
const currentPage = ref(1)
const itemsPerPage = ref(10)
const creatingBackup = ref(false)
const showDetailsModal = ref(false)
const showRestoreModal = ref(false)
const selectedBackup = ref(null)
const backupToRestore = ref(null)
const editingBackup = ref(null)
const editingBackupName = ref('')
const fileInput = ref(null)

// Configuración
const autoBackupEnabled = ref(true)
const autoBackupFrequency = ref('weekly')
const retentionPolicy = ref('30')
const maxBackups = ref(50)

const restoreOptions = ref({
  createBackupBefore: true,
  notifyUsers: false
})

// Cargar datos reales
onMounted(() => {
  loadBackups()
  loadBackupStats()
  loadBackupConfig()
})

const loadBackups = async (page = 1) => {
  try {
    loading.value = true
    const filters = {
      page,
      search: searchQuery.value || undefined,
      type: filterType.value !== 'all' ? filterType.value : undefined
    }
    
    const response = await backupsApi.getAll(filters)
    
    if (response.data.success) {
      backups.value = response.data.data
      pagination.value = response.data.pagination
    } else {
      console.error('Error al cargar backups:', response.data.message)
    }
  } catch (error) {
    console.error('Error al cargar backups:', error)
    alert('Error al cargar los backups')
  } finally {
    loading.value = false
  }
}

const loadBackupStats = async () => {
  try {
    const response = await backupsApi.getStats()
    
    if (response.data.success) {
      backupStats.value = response.data.data
    }
  } catch (error) {
    console.error('Error al cargar estadísticas:', error)
  }
}

const loadBackupConfig = () => {
  // En implementación real, cargar desde API
  const savedConfig = localStorage.getItem('backup-config')
  if (savedConfig) {
    const config = JSON.parse(savedConfig)
    autoBackupEnabled.value = config.autoBackupEnabled
    autoBackupFrequency.value = config.autoBackupFrequency
    retentionPolicy.value = config.retentionPolicy
    maxBackups.value = config.maxBackups
  }
}

// Computed properties
const totalBackupSize = computed(() => 
  backupStats.value.total_size || 0
)

const lastBackupDate = computed(() => {
  if (backupStats.value.last_backup) {
    return formatDate(backupStats.value.last_backup.created_at)
  }
  return 'Nunca'
})

const filteredBackups = computed(() => {
  let filtered = backups.value

  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase()
    filtered = filtered.filter(backup =>
      backup.name.toLowerCase().includes(query) ||
      backup.description?.toLowerCase().includes(query)
    )
  }

  if (filterType.value !== 'all') {
    filtered = filtered.filter(backup => backup.type === filterType.value)
  }

  return filtered.sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
})

const totalPages = computed(() => 
  Math.ceil(filteredBackups.value.length / itemsPerPage.value)
)

const paginatedBackups = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value
  const end = start + itemsPerPage.value
  return filteredBackups.value.slice(start, end)
})

// Métodos
const createBackup = async () => {
  try {
    creatingBackup.value = true
    
    const backupData = {
      description: 'Backup manual creado desde el panel de administración',
      include_database: true,
      include_files: true,
      include_media: true
    }
    
    const response = await backupsApi.create(backupData)
    
    if (response.data.success) {
      alert(response.data.message || 'Backup iniciado exitosamente')
      await loadBackups()
      await loadBackupStats()
    } else {
      alert(response.data.message || 'Error al crear backup')
    }
  } catch (error) {
    console.error('Error al crear backup:', error)
    alert('Error al crear el backup')
  } finally {
    creatingBackup.value = false
  }
}

const saveBackupConfig = () => {
  const config = {
    autoBackupEnabled: autoBackupEnabled.value,
    autoBackupFrequency: autoBackupFrequency.value,
    retentionPolicy: retentionPolicy.value,
    maxBackups: maxBackups.value
  }
  
  // En implementación real, enviar a API
  localStorage.setItem('backup-config', JSON.stringify(config))
  alert('Configuración de backups guardada correctamente')
}

const downloadBackup = async (backup) => {
  try {
    const response = await backupsApi.download(backup.id)
    
    // Crear URL del blob y descarga automática
    const url = window.URL.createObjectURL(new Blob([response.data]))
    const link = document.createElement('a')
    link.href = url
    link.download = backup.filename || backup.name + '.zip'
    document.body.appendChild(link)
    link.click()
    document.body.removeChild(link)
    window.URL.revokeObjectURL(url)
    
    alert(`Descarga iniciada: ${backup.name}`)
  } catch (error) {
    console.error('Error al descargar backup:', error)
    alert('Error al descargar el backup')
  }
}

const restoreBackup = (backup) => {
  backupToRestore.value = backup
  showRestoreModal.value = true
}

const confirmRestore = async () => {
  try {
    const restoreData = {
      create_backup_before: restoreOptions.value.createBackupBefore,
      notify_users: restoreOptions.value.notifyUsers
    }
    const response = await backupsApi.restore(backupToRestore.value.id, restoreData)
    
    if (response.data.success) {
      alert(response.data.message || `Restauración iniciada: ${backupToRestore.value.name}`)
      await loadBackups()
    } else {
      alert(response.data.message || 'Error al restaurar backup')
    }
  } catch (error) {
    console.error('Error al restaurar backup:', error)
    alert('Error al restaurar el backup')
  } finally {
    closeRestoreModal()
  }
}

const viewBackupDetails = (backup) => {
  selectedBackup.value = backup
  showDetailsModal.value = true
}

const deleteBackup = async (backup) => {
  if (confirm(`¿Estás seguro de eliminar el backup "${backup.name}"?`)) {
    try {
      const response = await backupsApi.delete(backup.id)
      
      if (response.data.success) {
        alert(response.data.message || 'Backup eliminado correctamente')
        await loadBackups()
        await loadBackupStats()
      } else {
        alert(response.data.message || 'Error al eliminar backup')
      }
    } catch (error) {
      console.error('Error al eliminar backup:', error)
      alert('Error al eliminar el backup')
    }
  }
}

const closeDetailsModal = () => {
  showDetailsModal.value = false
  selectedBackup.value = null
}

const closeRestoreModal = () => {
  showRestoreModal.value = false
  backupToRestore.value = null
  restoreOptions.value = {
    createBackupBefore: true,
    notifyUsers: false
  }
}

// Edit backup name functions
const editBackupName = (backup) => {
  editingBackup.value = backup
  editingBackupName.value = backup.name
}

const saveBackupName = async (backup) => {
  if (!editingBackupName.value.trim()) {
    cancelEditName()
    return
  }
  
  try {
    const response = await backupsApi.update(backup.id, { 
      name: editingBackupName.value.trim() 
    })
    
    if (response.data.success) {
      backup.name = editingBackupName.value.trim()
      alert('Nombre del backup actualizado correctamente')
    } else {
      alert(response.data.message || 'Error al actualizar el nombre')
    }
  } catch (error) {
    console.error('Error al actualizar nombre:', error)
    alert('Error al actualizar el nombre del backup')
  } finally {
    cancelEditName()
  }
}

const cancelEditName = () => {
  editingBackup.value = null
  editingBackupName.value = ''
}

// Import backup functions
const importBackup = () => {
  fileInput.value?.click()
}

const handleFileSelect = async (event) => {
  const file = event.target.files[0]
  if (!file) return
  
  const formData = new FormData()
  formData.append('backup_file', file)
  formData.append('description', `Backup importado: ${file.name}`)
  
  try {
    const baseUrl = import.meta.env.DEV 
      ? 'http://localhost/rintegra/backend/public/api'  // Local XAMPP
      : 'https://r-integra.com/api'                     // Producción
    const response = await fetch(`${baseUrl}/backups/import`, {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`,
      },
      body: formData
    })
    
    const result = await response.json()
    
    if (result.success) {
      alert(`Backup importado correctamente: ${file.name}`)
      await loadBackups()
      await loadBackupStats()
    } else {
      alert(result.message || 'Error al importar el backup')
    }
  } catch (error) {
    console.error('Error al importar backup:', error)
    alert('Error al importar el backup')
  }
  
  // Limpiar el input
  event.target.value = ''
}

// Utility functions
const formatFileSize = (bytes) => {
  if (!bytes || bytes === 0) return '0 B'
  const k = 1024
  const sizes = ['B', 'KB', 'MB', 'GB']
  const i = Math.floor(Math.log(bytes) / Math.log(k))
  return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i]
}

const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString('es-ES')
}

const formatDateTime = (dateString) => {
  return new Date(dateString).toLocaleString('es-ES')
}

const getBackupTypeLabel = (type) => {
  const labels = {
    auto: 'Automático',
    manual: 'Manual',
    scheduled: 'Programado'
  }
  return labels[type] || type
}

const getStatusLabel = (status) => {
  const labels = {
    completed: 'Completado',
    in_progress: 'En progreso',
    failed: 'Fallido',
    cancelled: 'Cancelado'
  }
  return labels[status] || status
}

const getContentIcon = (type) => {
  const icons = {
    'Páginas': 'document-text',
    'Medios': 'photo',
    'CRM': 'envelope',
    'Configuración': 'cog'
  }
  return icons[type] || 'document'
}

const formatMetadataKey = (key) => {
  return key.replace(/([A-Z])/g, ' $1').replace(/^./, str => str.toUpperCase())
}
</script>

<style scoped>
.backups-manager {
  padding: 0;
}

.backups-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}

.backups-header h2 {
  margin: 0;
  color: #2c3e50;
}

.header-actions {
  display: flex;
  gap: 1rem;
  align-items: center;
}

.backup-stats {
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

.backup-config,
.backups-list-section {
  margin-bottom: 2rem;
}

.config-card,
.backups-card {
  background: white;
  border-radius: 8px;
  border: 1px solid #e9ecef;
  overflow: hidden;
}

.config-header,
.backups-card-header {
  padding: 1.5rem;
  border-bottom: 1px solid #e9ecef;
  background: #f8f9fa;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.config-header h3,
.backups-card-header h3 {
  margin: 0;
  color: #2c3e50;
}

.config-content {
  padding: 1.5rem;
}

.config-row {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.5rem;
  margin-bottom: 1.5rem;
}

.config-group {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
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


.list-actions {
  display: flex;
  gap: 1rem;
  align-items: center;
}

.search-input,
.filter-select {
  padding: 0.5rem;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 0.9rem;
}

.search-input {
  min-width: 200px;
}

.empty-state {
  text-align: center;
  padding: 3rem;
  color: #6c757d;
}

.empty-state h3 {
  margin: 1rem 0 0.5rem 0;
  color: #495057;
}

.backups-table-container {
  overflow-x: auto;
}

.backups-table {
  width: 100%;
  border-collapse: collapse;
}

.backups-table th,
.backups-table td {
  padding: 1rem;
  text-align: left;
  border-bottom: 1px solid #e9ecef;
}

.backups-table th {
  background: #f8f9fa;
  font-weight: 600;
  color: #495057;
}

.backup-name {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.backup-name-input {
  padding: 0.25rem 0.5rem;
  border: 1px solid #d1d5db;
  border-radius: 4px;
  font-size: 0.875rem;
  background: #ffffff;
  min-width: 200px;
}

.backup-name-input:focus {
  outline: none;
  border-color: #3b82f6;
  box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
}

.backup-type {
  padding: 0.25rem 0.5rem;
  border-radius: 12px;
  font-size: 0.75rem;
  font-weight: 500;
}

.backup-type.auto {
  background: #d1ecf1;
  color: #0c5460;
}

.backup-type.manual {
  background: #d4edda;
  color: #155724;
}

.backup-type.scheduled {
  background: #fff3cd;
  color: #856404;
}

.status-badge {
  padding: 0.25rem 0.5rem;
  border-radius: 12px;
  font-size: 0.75rem;
  font-weight: 500;
}

.status-badge.completed {
  background: #d4edda;
  color: #155724;
}

.status-badge.in_progress {
  background: #cce5ff;
  color: #0056b3;
}

.status-badge.failed {
  background: #f8d7da;
  color: #721c24;
}

.backup-actions {
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

.btn-icon:hover:not(:disabled) {
  background: #e9ecef;
  color: #495057;
}

.btn-icon:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.btn-icon.btn-danger:hover:not(:disabled) {
  background: #f8d7da;
  color: #721c24;
}

.pagination {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  border-top: 1px solid #e9ecef;
}

.btn-pagination {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  border: 1px solid #dee2e6;
  background: white;
  border-radius: 4px;
  cursor: pointer;
  color: #495057;
  transition: all 0.2s;
}

.btn-pagination:hover:not(:disabled) {
  background: #f8f9fa;
  border-color: #adb5bd;
}

.btn-pagination:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.pagination-info {
  color: #6c757d;
  font-size: 0.9rem;
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
  max-width: 700px;
  max-height: 90vh;
  overflow-y: auto;
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.5rem;
  border-bottom: 1px solid #e9ecef;
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
  background: #f8f9fa;
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

.detail-section {
  margin-bottom: 1.5rem;
}

.detail-section h4 {
  margin: 0 0 1rem 0;
  color: #2c3e50;
  font-size: 1rem;
}

.detail-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1rem;
}

.detail-item {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}

.detail-item label {
  font-weight: 600;
  color: #495057;
  font-size: 0.85rem;
}

.detail-item span {
  color: #6c757d;
  font-size: 0.9rem;
}

.backup-contents {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.content-item {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 0.75rem;
  background: #f8f9fa;
  border-radius: 4px;
}

.content-type {
  font-weight: 500;
  color: #2c3e50;
  flex: 1;
}

.content-count,
.content-size {
  color: #6c757d;
  font-size: 0.9rem;
}

.metadata-list {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.metadata-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.5rem;
  background: #f8f9fa;
  border-radius: 4px;
}

.metadata-item label {
  font-weight: 500;
  color: #495057;
}

.metadata-item span {
  color: #6c757d;
  font-family: monospace;
  font-size: 0.85rem;
}

.warning-message {
  display: flex;
  gap: 1rem;
  padding: 1rem;
  background: #fff3cd;
  border: 1px solid #ffeaa7;
  border-radius: 6px;
  margin-bottom: 1.5rem;
}

.warning-message h4 {
  margin: 0 0 0.5rem 0;
  color: #856404;
}

.warning-message p {
  margin: 0.25rem 0;
  color: #856404;
}

.restore-options {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
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

.btn-primary,
.btn-secondary,
.btn-danger {
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

.btn-primary {
  background: #007bff;
  color: white;
}

.btn-primary:hover {
  background: #0056b3;
}

.btn-primary:disabled {
  background: #6c757d;
  cursor: not-allowed;
}

.btn-secondary {
  background: #6c757d;
  color: white;
}

.btn-secondary:hover {
  background: #545b62;
}

.btn-danger {
  background: #dc3545;
  color: white;
}

.btn-danger:hover {
  background: #c82333;
}

/* Responsive */
@media (max-width: 1024px) {
  .config-row {
    grid-template-columns: 1fr;
  }
  
  .export-options {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 768px) {
  .backups-header {
    flex-direction: column;
    gap: 1rem;
    align-items: stretch;
  }
  
  .backup-stats {
    grid-template-columns: 1fr;
  }
  
  .list-actions {
    flex-direction: column;
    align-items: stretch;
  }
  
  .search-input {
    min-width: auto;
  }
  
  .detail-grid {
    grid-template-columns: 1fr;
  }
  
  .pagination {
    flex-direction: column;
    gap: 1rem;
  }
  
}
</style>