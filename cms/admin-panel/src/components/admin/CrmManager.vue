<template>
  <div class="crm-manager">
    <!-- Header con estadísticas -->
    <div class="crm-header">
      <h2>CRM - Gestión de Formularios</h2>
      <div class="crm-stats">
        <div class="stat-card">
          <div class="stat-icon">
            <Icon name="envelope" />
          </div>
          <div class="stat-content">
            <h3>{{ submissions?.length || 0 }}</h3>
            <p>Formularios Recibidos</p>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">
            <Icon name="check" />
          </div>
          <div class="stat-content">
            <h3>{{ readSubmissions }}</h3>
            <p>Leídos</p>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">
            <Icon name="clock" />
          </div>
          <div class="stat-content">
            <h3>{{ unreadSubmissions }}</h3>
            <p>Sin Leer</p>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">
            <Icon name="calendar" />
          </div>
          <div class="stat-content">
            <h3>{{ todaySubmissions }}</h3>
            <p>Hoy</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Filtros y acciones -->
    <div class="crm-controls">
      <div class="filters">
        <select v-model="selectedStatus" class="filter-select">
          <option value="all">Todos los estados</option>
          <option value="unread">Sin leer</option>
          <option value="read">Leídos</option>
          <option value="replied">Respondidos</option>
          <option value="archived">Archivados</option>
        </select>
        
        <select v-model="selectedForm" class="filter-select">
          <option value="all">Todos los formularios</option>
          <option value="contact">Formulario de Contacto</option>
          <option value="lead_converter">Generador de Leads</option>
        </select>

        <input 
          type="date" 
          v-model="dateFilter" 
          class="filter-date"
          placeholder="Filtrar por fecha"
        >
      </div>

      <div class="actions">
        <button @click="exportCsv" class="btn-secondary">
          <Icon name="document" />
          Exportar CSV
        </button>
        <button @click="markAllAsRead" class="btn-primary">
          <Icon name="check" />
          Marcar Todo Como Leído
        </button>
        <button 
          @click="deleteSelectedSubmissions" 
          class="btn-secondary"
          v-if="(selectedSubmissions?.length || 0) > 0"
        >
          <Icon name="trash" />
          Eliminar Seleccionados ({{ selectedSubmissions?.length || 0 }})
        </button>
      </div>
    </div>

    <!-- Lista de formularios -->
    <div class="submissions-container">
      <div v-if="(filteredSubmissions?.length || 0) === 0" class="empty-state">
        <Icon name="envelope" />
        <h3>No hay formularios</h3>
        <p>Los formularios enviados desde el sitio web aparecerán aquí</p>
      </div>

      <div v-else class="submissions-list">
        <!-- Header con checkbox maestro -->
        <div class="submissions-header">
          <div class="select-all-row">
            <input 
              type="checkbox" 
              :checked="allSubmissionsSelected"
              @change="toggleAllSubmissions"
              class="submission-checkbox"
            >
            <span class="select-all-text">
              {{ (selectedSubmissions?.length || 0) > 0 
                ? `${selectedSubmissions?.length || 0} de ${filteredSubmissions?.length || 0} seleccionados` 
                : 'Seleccionar todos' 
              }}
            </span>
          </div>
        </div>
        <div 
          v-for="(submission, index) in paginatedSubmissions" 
          :key="submission.id"
          class="submission-card"
          @click="console.log(`🔍 DEBUG: Clicked submission ${index}:`, submission)"
          :class="{ 
            unread: submission.status === 'unread',
            read: submission.status === 'read',
            replied: submission.status === 'replied',
            archived: submission.status === 'archived'
          }"
        >
          <div class="submission-header">
            <div class="submission-info">
              <div class="submission-title-row">
                <input 
                  type="checkbox" 
                  :value="submission.id"
                  v-model="selectedSubmissions"
                  class="submission-checkbox"
                >
                <h4>{{ submission.name }}</h4>
              </div>
              <div class="submission-meta">
                <span class="form-type">{{ getFormTypeLabel(submission.form_type) }}</span>
                <span class="submission-date">{{ formatDate(submission.created_at) }}</span>
                <span class="status-badge" :class="submission.status">
                  {{ getStatusLabel(submission.status) }}
                </span>
              </div>
            </div>
            <div class="submission-actions">
              <button 
                @click="toggleSubmissionDetails(submission.id)"
                class="btn-icon"
                :title="submission.expanded ? 'Ocultar detalles' : 'Ver detalles'"
              >
                <Icon :name="submission.expanded ? 'chevron-up' : 'chevron-down'" />
              </button>
              <button 
                @click="updateSubmissionStatus(submission, 'read')"
                class="btn-icon"
                v-if="submission.status === 'unread'"
                title="Marcar como leído"
              >
                <Icon name="eye" />
              </button>
              <button 
                @click="replyToSubmission(submission)"
                class="btn-icon"
                title="Responder"
              >
                <Icon name="envelope" />
              </button>
              <button 
                @click="archiveSubmission(submission)"
                class="btn-icon"
                title="Archivar"
              >
                <Icon name="archive" />
              </button>
              <button 
                @click="deleteSubmission(submission)"
                class="btn-icon"
                title="Eliminar"
              >
                <Icon name="trash" />
              </button>
            </div>
          </div>

          <div class="submission-summary">
            <p><strong>Email:</strong> {{ submission.email }}</p>
            <p v-if="submission.phone"><strong>Teléfono:</strong> {{ submission.phone }}</p>
            <p v-if="submission.message"><strong>Mensaje:</strong> {{ truncateText(submission.message, 100) }}</p>
            
            <!-- Mostrar campos específicos según tipo de formulario -->
            <div v-if="submission.form_type === 'lead_converter' && submission.additional_fields">
              <p v-if="submission.additional_fields.situation">
                <strong>Situación:</strong> {{ submission.additional_fields.situation }}
              </p>
              <p v-if="submission.additional_fields.urgency">
                <strong>Urgencia:</strong> {{ submission.additional_fields.urgency }}
              </p>
            </div>
          </div>

          <!-- Detalles expandidos -->
          <div v-if="submission.expanded" class="submission-details">
            <div class="detail-section">
              <h5>Información Completa</h5>
              <div class="detail-grid">
                <div class="detail-item">
                  <label>Nombre:</label>
                  <span>{{ submission.name }}</span>
                </div>
                <div class="detail-item">
                  <label>Email:</label>
                  <span>{{ submission.email }}</span>
                </div>
                <div class="detail-item" v-if="submission.phone">
                  <label>Teléfono:</label>
                  <span>{{ submission.phone }}</span>
                </div>
                <div class="detail-item" v-if="submission.company">
                  <label>Empresa:</label>
                  <span>{{ submission.company }}</span>
                </div>
                <div class="detail-item">
                  <label>Formulario:</label>
                  <span>{{ getFormTypeLabel(submission.form_type) }}</span>
                </div>
                <div class="detail-item">
                  <label>Fecha:</label>
                  <span>{{ formatDateTime(submission.created_at) }}</span>
                </div>
                <div class="detail-item" v-if="submission.ip">
                  <label>IP:</label>
                  <span>{{ submission.ip }}</span>
                </div>
                <div class="detail-item" v-if="submission.user_agent">
                  <label>Navegador:</label>
                  <span>{{ submission.user_agent }}</span>
                </div>
              </div>
            </div>

            <div class="detail-section" v-if="submission.message">
              <h5>Mensaje Completo</h5>
              <div class="message-content">
                {{ submission.message }}
              </div>
            </div>

            <!-- Campos adicionales -->
            <div class="detail-section" v-if="submission.additional_fields && typeof submission.additional_fields === 'object'">
              <h5>Campos Adicionales</h5>
              <div class="additional-fields">
                <div 
                  v-for="(value, key) in (submission.additional_fields || {})" 
                  :key="key"
                  class="field-item"
                >
                  <label>{{ formatFieldName(key) }}:</label>
                  <span>{{ value }}</span>
                </div>
              </div>
            </div>

            <!-- Historial de acciones -->
            <div class="detail-section" v-if="submission.history && Array.isArray(submission.history) && submission.history.length > 0">
              <h5>Historial</h5>
              <div class="history-list">
                <div 
                  v-for="event in (submission.history || [])" 
                  :key="event.id"
                  class="history-item"
                >
                  <span class="history-date">{{ formatDateTime(event.created_at) }}</span>
                  <span class="history-action">{{ event.action }}</span>
                  <span class="history-user" v-if="event.user">por {{ event.user }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Paginación -->
      <div class="pagination" v-if="totalPages > 1">
        <button 
          @click="currentPage--" 
          :disabled="currentPage === 1"
          class="btn-pagination"
        >
          <Icon name="chevron-left" />
          Anterior
        </button>
        
        <span class="pagination-info">
          Página {{ currentPage }} de {{ totalPages }} 
          ({{ filteredSubmissions?.length || 0 }} resultados)
        </span>
        
        <button 
          @click="currentPage++" 
          :disabled="currentPage === totalPages"
          class="btn-pagination"
        >
          Siguiente
          <Icon name="chevron-right" />
        </button>
      </div>
    </div>

    <!-- Modal de respuesta -->
    <div v-if="showReplyModal" class="modal-overlay" @click="closeReplyModal">
      <div class="modal-content" @click.stop>
        <div class="modal-header">
          <h3>Responder a {{ replyingTo?.name }}</h3>
          <button @click="closeReplyModal" class="btn-close">
            <Icon name="close" />
          </button>
        </div>
        
        <div class="modal-body">
          <div class="form-group">
            <label>Para:</label>
            <input type="email" v-model="replyForm.to" class="form-input" readonly>
          </div>
          
          <div class="form-group">
            <label>Asunto:</label>
            <input type="text" v-model="replyForm.subject" class="form-input">
          </div>
          
          <div class="form-group">
            <label>Mensaje:</label>
            <textarea v-model="replyForm.message" rows="8" class="form-input"></textarea>
          </div>
        </div>
        
        <div class="modal-footer">
          <button @click="closeReplyModal" class="btn-secondary">
            <Icon name="close" />
            Cancelar
          </button>
          <button @click="sendReply" class="btn-primary">
            <Icon name="envelope" />
            Enviar Respuesta
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import Icon from '@/components/global/Icon.vue'
import { formsApi } from '@/services/api'

// Estado reactivo con inicialización defensiva
const submissions = ref([])
const selectedStatus = ref('all')
const selectedForm = ref('all')
const dateFilter = ref('')
const currentPage = ref(1)
const itemsPerPage = ref(10)
const selectedSubmissions = ref([])
const showReplyModal = ref(false)
const replyingTo = ref(null)
const replyForm = ref({
  to: '',
  subject: '',
  message: ''
})

// Asegurar que submissions nunca sea null
submissions.value = submissions.value || []
selectedSubmissions.value = selectedSubmissions.value || []

// Datos de ejemplo (reemplazar con llamada a API)
// Watchers para recargar datos cuando cambien los filtros
watch([selectedStatus, selectedForm, dateFilter], () => {
  selectedSubmissions.value = [] // Limpiar selección al filtrar
  loadSubmissions()
}, { immediate: false })

onMounted(() => {
  console.log('🔍 DEBUG: CrmManager mounted, loading submissions...')
  
  // Agregar handler global de errores para capturar el error exacto
  const originalError = window.onerror
  window.onerror = function(message, source, lineno, colno, error) {
    if (message.includes('Cannot read properties of null')) {
      console.error('🔍 DEBUG: Captured null error:', {
        message,
        source,
        lineno,
        colno,
        error,
        stack: error?.stack
      })
      debugger // Esto pausará el debugger cuando ocurra el error
    }
    if (originalError) originalError.call(this, message, source, lineno, colno, error)
  }
  
  loadSubmissions()
})

// Debug helper para rastrear errores
const debugData = () => {
  console.log('🔍 DEBUG: Current component state:')
  console.log('  submissions:', submissions.value)
  console.log('  filteredSubmissions:', filteredSubmissions.value)
  console.log('  selectedStatus:', selectedStatus.value)
  console.log('  selectedForm:', selectedForm.value)
}

const loadSubmissions = async () => {
  try {
    const filters = {
      status: selectedStatus.value !== 'all' ? selectedStatus.value : undefined,
      form_type: selectedForm.value !== 'all' ? selectedForm.value : undefined,
      date: dateFilter.value || undefined
    }
    
    const response = await formsApi.getAll(filters)
    
    if (response.data && response.data.data) {
      console.log('🔍 DEBUG: Raw response data:', response.data.data)
      
      submissions.value = response.data.data.map((submission, index) => {
        console.log(`🔍 DEBUG: Processing submission ${index}:`, submission)
        console.log(`🔍 DEBUG: additional_fields type:`, typeof submission.additional_fields, submission.additional_fields)
        console.log(`🔍 DEBUG: history type:`, typeof submission.history, submission.history)
        
        // Convertir history a array si no lo es
        let cleanHistory = []
        if (submission.history) {
          if (Array.isArray(submission.history)) {
            cleanHistory = submission.history
          } else if (typeof submission.history === 'object' && Object.keys(submission.history).length === 0) {
            // Es un objeto vacío que debería ser un array vacío
            cleanHistory = []
          } else {
            // Intentar convertir objeto a array
            cleanHistory = Object.values(submission.history)
          }
        }
        console.log(`🔍 DEBUG: cleanHistory for submission ${index}:`, cleanHistory)

        const sanitized = {
          ...submission,
          expanded: false,
          // Sanitizar additional_fields para evitar errores
          additional_fields: submission.additional_fields && typeof submission.additional_fields === 'object' 
            ? submission.additional_fields 
            : {},
          // Sanitizar history para evitar errores
          history: cleanHistory
        }
        
        console.log(`🔍 DEBUG: Sanitized submission ${index}:`, sanitized)
        return sanitized
      })
      
      console.log('🔍 DEBUG: Final submissions array:', submissions.value)
    }
  } catch (error) {
    console.error('Error loading submissions:', error)
    // Mostrar mensaje de error si no se pueden cargar los datos
    submissions.value = []
  }
}

// Computed properties
const readSubmissions = computed(() => {
  console.log('🔍 DEBUG: Computing readSubmissions, submissions:', submissions.value)
  const result = submissions.value.filter(s => ['read', 'replied', 'archived'].includes(s.status)).length
  console.log('🔍 DEBUG: readSubmissions result:', result)
  return result
})

const unreadSubmissions = computed(() => {
  console.log('🔍 DEBUG: Computing unreadSubmissions, submissions:', submissions.value)
  const result = submissions.value.filter(s => s.status === 'unread').length
  console.log('🔍 DEBUG: unreadSubmissions result:', result)
  return result
})

const todaySubmissions = computed(() => {
  const today = new Date().toDateString()
  return submissions.value.filter(s => 
    new Date(s.created_at).toDateString() === today
  ).length
})

const filteredSubmissions = computed(() => {
  console.log('🔍 DEBUG: Computing filteredSubmissions, submissions.value:', submissions.value)
  
  // Protección ultra-defensiva
  let filtered = Array.isArray(submissions.value) ? [...submissions.value] : []

  if (selectedStatus.value !== 'all') {
    console.log('🔍 DEBUG: Filtering by status:', selectedStatus.value)
    filtered = filtered.filter(s => s && s.status === selectedStatus.value)
  }

  if (selectedForm.value !== 'all') {
    console.log('🔍 DEBUG: Filtering by form:', selectedForm.value)
    filtered = filtered.filter(s => s && s.form_type === selectedForm.value)
  }

  if (dateFilter.value) {
    console.log('🔍 DEBUG: Filtering by date:', dateFilter.value)
    const filterDate = new Date(dateFilter.value).toDateString()
    filtered = filtered.filter(s => 
      s && s.created_at && new Date(s.created_at).toDateString() === filterDate
    )
  }

  console.log('🔍 DEBUG: filteredSubmissions result:', filtered)
  return Array.isArray(filtered) ? filtered : []
})

const totalPages = computed(() => 
  Math.ceil(filteredSubmissions.value.length / itemsPerPage.value)
)

const paginatedSubmissions = computed(() => {
  console.log('🔍 DEBUG: Computing paginatedSubmissions')
  console.log('  currentPage:', currentPage.value)
  console.log('  itemsPerPage:', itemsPerPage.value)
  console.log('  filteredSubmissions:', filteredSubmissions.value)
  
  const start = (currentPage.value - 1) * itemsPerPage.value
  const end = start + itemsPerPage.value
  
  console.log('  start:', start, 'end:', end)
  
  const result = filteredSubmissions.value.slice(start, end)
  console.log('🔍 DEBUG: paginatedSubmissions result:', result)
  
  return result
})

const allSubmissionsSelected = computed(() => {
  console.log('🔍 DEBUG: Computing allSubmissionsSelected')
  console.log('  filteredSubmissions.value:', filteredSubmissions.value)
  console.log('  selectedSubmissions.value:', selectedSubmissions.value)
  
  const result = filteredSubmissions.value.length > 0 && 
    selectedSubmissions.value.length === filteredSubmissions.value.length
  
  console.log('🔍 DEBUG: allSubmissionsSelected result:', result)
  return result
})

// Métodos
const getFormTypeLabel = (type) => {
  const labels = {
    contact: 'Contacto',
    lead_converter: 'Generador de Leads'
  }
  return labels[type] || type
}

const getStatusLabel = (status) => {
  const labels = {
    unread: 'Sin leer',
    read: 'Leído',
    replied: 'Respondido',
    archived: 'Archivado'
  }
  return labels[status] || status
}

const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString('es-ES')
}

const formatDateTime = (dateString) => {
  return new Date(dateString).toLocaleString('es-ES')
}

const formatFieldName = (fieldName) => {
  return fieldName.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase())
}

const truncateText = (text, maxLength) => {
  console.log('🔍 DEBUG: truncateText called with:', { text, maxLength, type: typeof text })
  
  // Protección contra null, undefined, o tipos no string
  if (!text || typeof text !== 'string') {
    console.log('🔍 DEBUG: text is null/undefined or not string, returning empty')
    return ''
  }
  
  if (text.length <= maxLength) return text
  return text.substr(0, maxLength) + '...'
}

const toggleSubmissionDetails = (id) => {
  const submission = submissions.value.find(s => s.id === id)
  if (submission) {
    submission.expanded = !submission.expanded
  }
}

const updateSubmissionStatus = async (submission, status) => {
  try {
    await formsApi.updateStatus(submission.id, status)
    submission.status = status
    
    // Agregar evento al historial
    if (!submission.history) {
      submission.history = []
    }
    submission.history.unshift({
      id: Date.now(),
      action: `Marcado como ${getStatusLabel(status).toLowerCase()}`,
      user: 'Admin',
      created_at: new Date().toISOString()
    })
    
    console.log(`✅ Updated submission ${submission.id} to status: ${status}`)
  } catch (error) {
    console.error('❌ Error updating submission status:', error)
    alert('Error al actualizar el estado del formulario')
  }
}

const markAllAsRead = async () => {
  try {
    console.log('🔍 DEBUG: markAllAsRead called', submissions.value)
    await formsApi.markAllAsRead()
    
    // Protección ultra-defensiva
    if (submissions.value && Array.isArray(submissions.value)) {
      submissions.value.forEach(submission => {
        if (submission && submission.status === 'unread') {
          submission.status = 'read'
          
          // Agregar evento al historial con protección
          if (!submission.history || !Array.isArray(submission.history)) {
            submission.history = []
          }
          submission.history.unshift({
            id: Date.now(),
            action: 'Marcado como leído (acción masiva)',
            user: 'Admin',
            created_at: new Date().toISOString()
          })
        }
      })
    } else {
      console.log('🔍 DEBUG: submissions.value is not a valid array:', submissions.value)
    }
    
    console.log('✅ Marked all submissions as read')
    alert('Todos los formularios han sido marcados como leídos')
  } catch (error) {
    console.error('❌ Error marking all as read:', error)
    alert('Error al marcar todos como leídos')
  }
}

const archiveSubmission = (submission) => {
  if (confirm('¿Estás seguro de archivar este formulario?')) {
    updateSubmissionStatus(submission, 'archived')
  }
}

const deleteSubmission = async (submission) => {
  if (confirm('¿Estás seguro de eliminar este formulario? Esta acción no se puede deshacer.')) {
    try {
      await formsApi.delete(submission.id)
      
      // Remover de la lista local
      const index = submissions.value.findIndex(s => s.id === submission.id)
      if (index !== -1) {
        submissions.value.splice(index, 1)
      }
      
      console.log(`✅ Deleted submission ${submission.id}`)
      alert('Formulario eliminado exitosamente')
    } catch (error) {
      console.error('❌ Error deleting submission:', error)
      alert('Error al eliminar el formulario')
    }
  }
}

const deleteSelectedSubmissions = async () => {
  console.log('🔍 DEBUG: deleteSelectedSubmissions called', selectedSubmissions.value)
  
  // Protección ultra-defensiva
  if (!selectedSubmissions.value || !Array.isArray(selectedSubmissions.value) || selectedSubmissions.value.length === 0) {
    console.log('🔍 DEBUG: No submissions selected or invalid array')
    return
  }
  
  const count = selectedSubmissions.value.length
  if (confirm(`¿Estás seguro de eliminar ${count} formulario(s)? Esta acción no se puede deshacer.`)) {
    try {
      console.log('🔍 DEBUG: Starting deletion process')
      
      // Eliminar cada formulario seleccionado con protección
      const safeSelectedSubmissions = Array.isArray(selectedSubmissions.value) ? selectedSubmissions.value : []
      const deletePromises = safeSelectedSubmissions.map(id => formsApi.delete(id))
      await Promise.all(deletePromises)
      
      console.log('🔍 DEBUG: Deletion completed, updating local arrays')
      
      // Remover de la lista local con protección
      if (submissions.value && Array.isArray(submissions.value)) {
        submissions.value = submissions.value.filter(s => !safeSelectedSubmissions.includes(s.id))
      }
      
      // Limpiar selección
      selectedSubmissions.value = []
      
      console.log(`✅ Deleted ${count} submissions`)
      alert(`${count} formulario(s) eliminado(s) exitosamente`)
    } catch (error) {
      console.error('❌ Error deleting selected submissions:', error)
      alert('Error al eliminar los formularios seleccionados')
    }
  }
}

const toggleAllSubmissions = () => {
  if (allSubmissionsSelected.value) {
    selectedSubmissions.value = []
  } else {
    selectedSubmissions.value = filteredSubmissions.value.map(s => s.id)
  }
}

const replyToSubmission = (submission) => {
  replyingTo.value = submission
  replyForm.value = {
    to: submission.email,
    subject: `Re: ${getFormTypeLabel(submission.form_type)} - ${submission.name}`,
    message: `Hola ${submission.name},\n\nGracias por contactarnos. \n\nSaludos cordiales,\nEquipo R-Integra`
  }
  showReplyModal.value = true
}

const closeReplyModal = () => {
  showReplyModal.value = false
  replyingTo.value = null
  replyForm.value = { to: '', subject: '', message: '' }
}

const sendReply = async () => {
  try {
    if (!replyingTo.value) return
    
    await formsApi.reply(replyingTo.value.id, replyForm.value)
    
    // Marcar como respondido
    await updateSubmissionStatus(replyingTo.value, 'replied')
    
    // Agregar evento específico de respuesta al historial
    if (!replyingTo.value.history) {
      replyingTo.value.history = []
    }
    replyingTo.value.history.unshift({
      id: Date.now(),
      action: `Respuesta enviada: "${replyForm.value.subject}"`,
      user: 'Admin',
      created_at: new Date().toISOString()
    })
    
    console.log('✅ Reply sent successfully')
    alert('Respuesta enviada correctamente')
    closeReplyModal()
  } catch (error) {
    console.error('❌ Error sending reply:', error)
    alert('Error al enviar la respuesta')
  }
}

const exportCsv = async () => {
  try {
    const filters = {
      status: selectedStatus.value !== 'all' ? selectedStatus.value : undefined,
      form_type: selectedForm.value !== 'all' ? selectedForm.value : undefined,
      date: dateFilter.value || undefined
    }
    
    const response = await formsApi.exportCsv(filters)
    
    // Crear blob y descargar archivo
    const blob = new Blob([response.data], { type: 'text/csv' })
    const url = window.URL.createObjectURL(blob)
    const link = document.createElement('a')
    link.href = url
    link.download = `formularios_crm_${new Date().toISOString().split('T')[0]}.csv`
    document.body.appendChild(link)
    link.click()
    document.body.removeChild(link)
    window.URL.revokeObjectURL(url)
    
    console.log('✅ CSV exported successfully')
    alert('Archivo CSV descargado correctamente')
  } catch (error) {
    console.error('❌ Error exporting CSV:', error)
    alert('Error al exportar el archivo CSV')
  }
}
</script>

<style scoped>
.crm-manager {
  padding: 0;
}

.crm-header {
  margin-bottom: 2rem;
}

.crm-header h2 {
  margin: 0 0 1.5rem 0;
  color: #2c3e50;
}

.crm-stats {
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

.crm-controls {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 1rem;
  margin-bottom: 2rem;
  padding: 1.5rem;
  background: white;
  border-radius: 8px;
  border: 1px solid #e9ecef;
}

.filters {
  display: flex;
  gap: 1rem;
  align-items: center;
}

.filter-select,
.filter-date {
  padding: 0.5rem;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 0.9rem;
}

.actions {
  display: flex;
  gap: 0.5rem;
}

.submissions-container {
  background: white;
  border-radius: 8px;
  border: 1px solid #e9ecef;
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

.submissions-list {
  padding: 0;
}

.submissions-header {
  padding: 1rem 1.5rem;
  background: #f8f9fa;
  border-bottom: 1px solid #e9ecef;
}

.select-all-row {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.select-all-text {
  font-size: 0.9rem;
  color: #495057;
  font-weight: 500;
}

.submission-card {
  border-bottom: 1px solid #e9ecef;
  padding: 1.5rem;
  transition: background-color 0.2s;
}

.submission-card:last-child {
  border-bottom: none;
}

.submission-card.unread {
  background-color: #f8f9ff;
  border-left: 4px solid #007bff;
}

.submission-card:hover {
  background-color: #f8f9fa;
}

.submission-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 1rem;
}

.submission-title-row {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  margin-bottom: 0.5rem;
}

.submission-checkbox {
  margin: 0;
  transform: scale(1.1);
  accent-color: #007bff;
}

.submission-info h4 {
  margin: 0;
  color: #2c3e50;
  font-size: 1.1rem;
}

.submission-meta {
  display: flex;
  gap: 1rem;
  align-items: center;
  font-size: 0.85rem;
  color: #6c757d;
}

.form-type {
  background: #e9ecef;
  padding: 0.25rem 0.5rem;
  border-radius: 12px;
  color: #495057;
}

.status-badge {
  padding: 0.25rem 0.5rem;
  border-radius: 12px;
  font-size: 0.75rem;
  font-weight: 500;
}

.status-badge.unread {
  background: #cce5ff;
  color: #0056b3;
}

.status-badge.read {
  background: #d4edda;
  color: #155724;
}

.status-badge.replied {
  background: #d1ecf1;
  color: #0c5460;
}

.status-badge.archived {
  background: #f8d7da;
  color: #721c24;
}

.submission-actions {
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


.submission-summary p {
  margin: 0.25rem 0;
  font-size: 0.9rem;
  color: #495057;
}

.submission-details {
  margin-top: 1.5rem;
  padding-top: 1.5rem;
  border-top: 1px solid #e9ecef;
}

.detail-section {
  margin-bottom: 1.5rem;
}

.detail-section h5 {
  margin: 0 0 1rem 0;
  color: #2c3e50;
  font-size: 1rem;
}

.detail-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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

.message-content {
  background: #f8f9fa;
  padding: 1rem;
  border-radius: 4px;
  white-space: pre-wrap;
  line-height: 1.5;
  color: #495057;
}

.additional-fields {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1rem;
}

.field-item {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}

.field-item label {
  font-weight: 600;
  color: #495057;
  font-size: 0.85rem;
}

.field-item span {
  color: #6c757d;
  font-size: 0.9rem;
}

.history-list {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.history-item {
  display: flex;
  gap: 1rem;
  align-items: center;
  font-size: 0.85rem;
  color: #6c757d;
}

.history-date {
  font-weight: 500;
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
  max-width: 600px;
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

/* Responsive */
@media (max-width: 768px) {
  .crm-controls {
    flex-direction: column;
    align-items: stretch;
  }
  
  .filters {
    flex-wrap: wrap;
  }
  
  .submission-header {
    flex-direction: column;
    gap: 1rem;
  }
  
  .submission-meta {
    flex-wrap: wrap;
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