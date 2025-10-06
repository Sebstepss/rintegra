<template>
  <div class="analytics-manager">
    <!-- Header -->
    <div class="analytics-header">
      <h2>Analíticas y Rendimiento</h2>
      <div class="header-actions">
        <select v-model="selectedPeriod" class="period-select">
          <option value="7">Últimos 7 días</option>
          <option value="30">Últimos 30 días</option>
          <option value="90">Últimos 90 días</option>
          <option value="365">Último año</option>
        </select>
        <button @click="refreshData" class="btn-primary">
          <Icon name="refresh" />
          Actualizar
        </button>
      </div>
    </div>

    <!-- Configuración de Google Analytics -->
    <div class="config-section">
      <div class="config-card">
        <div class="config-header">
          <h3>Configuración de Google Analytics</h3>
          <div class="status-indicator" :class="{ connected: gaConnected }">
            <span class="status-dot"></span>
            {{ gaConnected ? 'Conectado' : 'Desconectado' }}
          </div>
        </div>
        
        <div class="config-content">
          <div class="form-group">
            <label for="ga-tracking-id">ID de seguimiento de Google Analytics</label>
            <div class="input-group">
              <input 
                type="text" 
                id="ga-tracking-id"
                v-model="gaTrackingId"
                placeholder="G-XXXXXXXXXX o UA-XXXXXXXXX-X"
                class="form-input"
              >
              <button @click="saveGaConfig" class="btn-secondary">
                <Icon name="save" />
                Guardar
              </button>
            </div>
          </div>
          
          <div class="config-help">
            <p><strong>¿Cómo obtener tu ID de Google Analytics?</strong></p>
            <ol>
              <li>Ve a <a href="https://analytics.google.com" target="_blank">Google Analytics</a></li>
              <li>Selecciona tu propiedad</li>
              <li>Ve a Administrador > Información de seguimiento > Código de seguimiento</li>
              <li>Copia el ID que aparece (GA4: G-XXXXXXXXXX, Universal: UA-XXXXXXXXX-X)</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Estadísticas principales -->
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-icon">
          <Icon name="eye" />
        </div>
        <div class="stat-content">
          <h3>{{ formatNumber(analytics.pageViews) }}</h3>
          <p>Vistas de página</p>
          <span class="stat-change" :class="analytics.pageViewsChange >= 0 ? 'positive' : 'negative'">
            {{ analytics.pageViewsChange >= 0 ? '+' : '' }}{{ analytics.pageViewsChange }}%
          </span>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-icon">
          <Icon name="globe" />
        </div>
        <div class="stat-content">
          <h3>{{ formatNumber(analytics.sessions) }}</h3>
          <p>Sesiones</p>
          <span class="stat-change" :class="analytics.sessionsChange >= 0 ? 'positive' : 'negative'">
            {{ analytics.sessionsChange >= 0 ? '+' : '' }}{{ analytics.sessionsChange }}%
          </span>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-icon">
          <Icon name="clock" />
        </div>
        <div class="stat-content">
          <h3>{{ formatTime(analytics.avgSessionDuration) }}</h3>
          <p>Duración promedio</p>
          <span class="stat-change" :class="analytics.durationChange >= 0 ? 'positive' : 'negative'">
            {{ analytics.durationChange >= 0 ? '+' : '' }}{{ analytics.durationChange }}%
          </span>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-icon">
          <Icon name="arrow-path" />
        </div>
        <div class="stat-content">
          <h3>{{ analytics.bounceRate }}%</h3>
          <p>Tasa de rebote</p>
          <span class="stat-change" :class="analytics.bounceRateChange <= 0 ? 'positive' : 'negative'">
            {{ analytics.bounceRateChange >= 0 ? '+' : '' }}{{ analytics.bounceRateChange }}%
          </span>
        </div>
      </div>
    </div>

    <!-- Gráficos y tablas -->
    <div class="analytics-content">
      <div class="analytics-row">
        <!-- Gráfico de visitas -->
        <div class="chart-card">
          <h3>Visitas en el tiempo</h3>
          <div class="chart-placeholder">
            <div class="chart-mock">
              <div class="chart-bars">
                <div class="bar" style="height: 60%"></div>
                <div class="bar" style="height: 80%"></div>
                <div class="bar" style="height: 45%"></div>
                <div class="bar" style="height: 90%"></div>
                <div class="bar" style="height: 75%"></div>
                <div class="bar" style="height: 85%"></div>
                <div class="bar" style="height: 70%"></div>
              </div>
              <p class="chart-note">Integración con Chart.js en desarrollo</p>
            </div>
          </div>
        </div>

        <!-- Fuentes de tráfico -->
        <div class="table-card">
          <h3>Fuentes de tráfico</h3>
          <div class="traffic-sources">
            <div class="source-item">
              <div class="source-info">
                <span class="source-name">Búsqueda orgánica</span>
                <span class="source-percentage">45%</span>
              </div>
              <div class="progress-bar">
                <div class="progress-fill" style="width: 45%"></div>
              </div>
            </div>
            <div class="source-item">
              <div class="source-info">
                <span class="source-name">Directo</span>
                <span class="source-percentage">30%</span>
              </div>
              <div class="progress-bar">
                <div class="progress-fill" style="width: 30%"></div>
              </div>
            </div>
            <div class="source-item">
              <div class="source-info">
                <span class="source-name">Redes sociales</span>
                <span class="source-percentage">15%</span>
              </div>
              <div class="progress-bar">
                <div class="progress-fill" style="width: 15%"></div>
              </div>
            </div>
            <div class="source-item">
              <div class="source-info">
                <span class="source-name">Referencias</span>
                <span class="source-percentage">10%</span>
              </div>
              <div class="progress-bar">
                <div class="progress-fill" style="width: 10%"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="analytics-row">
        <!-- Páginas más visitadas -->
        <div class="table-card">
          <h3>Páginas más visitadas</h3>
          <div class="table-responsive">
            <table class="analytics-table">
              <thead>
                <tr>
                  <th>Página</th>
                  <th>Visitas</th>
                  <th>% del total</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="page in topPages" :key="page.path">
                  <td>
                    <div class="page-info">
                      <span class="page-path">{{ page.path }}</span>
                      <small class="page-title">{{ page.title }}</small>
                    </div>
                  </td>
                  <td>{{ formatNumber(page.views) }}</td>
                  <td>{{ page.percentage }}%</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- PageSpeed Insights -->
        <div class="pagespeed-card">
          <h3>PageSpeed Insights</h3>
          <div class="pagespeed-content">
            <div class="speed-test">
              <button @click="runPageSpeedTest" class="btn-secondary" :disabled="loadingPageSpeed">
                <Icon name="refresh" />
                {{ loadingPageSpeed ? 'Analizando...' : 'Analizar velocidad' }}
              </button>
            </div>
            
            <div v-if="pageSpeedData" class="speed-results">
              <div class="speed-scores">
                <div class="score-item">
                  <div class="score-circle" :class="getScoreClass(pageSpeedData.performance)">
                    {{ pageSpeedData.performance }}
                  </div>
                  <span>Rendimiento</span>
                </div>
                <div class="score-item">
                  <div class="score-circle" :class="getScoreClass(pageSpeedData.accessibility)">
                    {{ pageSpeedData.accessibility }}
                  </div>
                  <span>Accesibilidad</span>
                </div>
                <div class="score-item">
                  <div class="score-circle" :class="getScoreClass(pageSpeedData.bestPractices)">
                    {{ pageSpeedData.bestPractices }}
                  </div>
                  <span>Mejores prácticas</span>
                </div>
                <div class="score-item">
                  <div class="score-circle" :class="getScoreClass(pageSpeedData.seo)">
                    {{ pageSpeedData.seo }}
                  </div>
                  <span>SEO</span>
                </div>
              </div>
              
              <div class="speed-metrics">
                <div class="metric">
                  <label>First Contentful Paint</label>
                  <span>{{ pageSpeedData.fcp }}s</span>
                </div>
                <div class="metric">
                  <label>Largest Contentful Paint</label>
                  <span>{{ pageSpeedData.lcp }}s</span>
                </div>
                <div class="metric">
                  <label>Time to Interactive</label>
                  <span>{{ pageSpeedData.tti }}s</span>
                </div>
                <div class="metric">
                  <label>Total Blocking Time</label>
                  <span>{{ pageSpeedData.tbt }}ms</span>
                </div>
              </div>

              <div class="recommendations">
                <h4>Recomendaciones principales</h4>
                <ul>
                  <li v-for="rec in pageSpeedData.recommendations" :key="rec">
                    {{ rec }}
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Configuración adicional -->
    <div class="additional-config">
      <div class="config-card">
        <h3>Configuración adicional</h3>
        <div class="config-options">
          <div class="option-group">
            <label class="checkbox-label">
              <input type="checkbox" v-model="settings.trackOutboundLinks">
              <span class="checkmark"></span>
              Rastrear clics en enlaces externos
            </label>
          </div>
          <div class="option-group">
            <label class="checkbox-label">
              <input type="checkbox" v-model="settings.trackFileDownloads">
              <span class="checkmark"></span>
              Rastrear descargas de archivos
            </label>
          </div>
          <div class="option-group">
            <label class="checkbox-label">
              <input type="checkbox" v-model="settings.trackScrollDepth">
              <span class="checkmark"></span>
              Rastrear profundidad de scroll
            </label>
          </div>
          <div class="option-group">
            <label class="checkbox-label">
              <input type="checkbox" v-model="settings.anonymizeIP">
              <span class="checkmark"></span>
              Anonimizar direcciones IP (GDPR)
            </label>
          </div>
        </div>
        <button @click="saveSettings" class="btn-primary">
          <Icon name="save" />
          Guardar configuración
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import Icon from '@/components/global/Icon.vue'

// Estado reactivo
const selectedPeriod = ref('30')
const gaTrackingId = ref('')
const gaConnected = ref(false)
const loadingPageSpeed = ref(false)
const pageSpeedData = ref(null)

const analytics = ref({
  pageViews: 12450,
  pageViewsChange: 12.5,
  sessions: 8920,
  sessionsChange: 8.3,
  avgSessionDuration: 142, // en segundos
  durationChange: -2.1,
  bounceRate: 45.2,
  bounceRateChange: -3.2
})

const topPages = ref([
  {
    path: '/',
    title: 'Página de inicio',
    views: 4521,
    percentage: 36.3
  },
  {
    path: '/servicios',
    title: 'Servicios',
    views: 2103,
    percentage: 16.9
  },
  {
    path: '/contacto',
    title: 'Contacto',
    views: 1876,
    percentage: 15.1
  },
  {
    path: '/about',
    title: 'Acerca de nosotros',
    views: 1204,
    percentage: 9.7
  },
  {
    path: '/blog',
    title: 'Blog',
    views: 956,
    percentage: 7.7
  }
])

const settings = ref({
  trackOutboundLinks: true,
  trackFileDownloads: true,
  trackScrollDepth: false,
  anonymizeIP: true
})

// Métodos
onMounted(() => {
  loadAnalyticsConfig()
})

const loadAnalyticsConfig = () => {
  // En implementación real, cargar desde API
  const saved = localStorage.getItem('ga-tracking-id')
  if (saved) {
    gaTrackingId.value = saved
    gaConnected.value = true
  }
}

const saveGaConfig = () => {
  if (!gaTrackingId.value) {
    alert('Por favor ingresa un ID de seguimiento válido')
    return
  }
  
  // En implementación real, enviar a API
  localStorage.setItem('ga-tracking-id', gaTrackingId.value)
  gaConnected.value = true
  
  alert('Configuración de Google Analytics guardada correctamente')
}

const refreshData = () => {
  // En implementación real, hacer llamada a API de Google Analytics
  console.log(`Refreshing analytics data for ${selectedPeriod.value} days`)
  alert('Datos actualizados (simulación)')
}

const runPageSpeedTest = async () => {
  loadingPageSpeed.value = true
  
  // Simular llamada a PageSpeed Insights API
  await new Promise(resolve => setTimeout(resolve, 3000))
  
  // Datos simulados
  pageSpeedData.value = {
    performance: 85,
    accessibility: 92,
    bestPractices: 88,
    seo: 95,
    fcp: 1.2,
    lcp: 2.4,
    tti: 3.1,
    tbt: 45,
    recommendations: [
      'Optimizar imágenes para reducir el tiempo de carga',
      'Minimizar CSS y JavaScript no utilizados',
      'Implementar lazy loading para imágenes',
      'Usar un CDN para servir recursos estáticos'
    ]
  }
  
  loadingPageSpeed.value = false
}

const saveSettings = () => {
  // En implementación real, enviar a API
  localStorage.setItem('analytics-settings', JSON.stringify(settings.value))
  alert('Configuración guardada correctamente')
}

const formatNumber = (num) => {
  return num.toLocaleString('es-ES')
}

const formatTime = (seconds) => {
  const minutes = Math.floor(seconds / 60)
  const remainingSeconds = seconds % 60
  return `${minutes}:${remainingSeconds.toString().padStart(2, '0')}`
}

const getScoreClass = (score) => {
  if (score >= 90) return 'excellent'
  if (score >= 70) return 'good'
  if (score >= 50) return 'fair'
  return 'poor'
}
</script>

<style scoped>
.analytics-manager {
  padding: 0;
}

.analytics-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}

.analytics-header h2 {
  margin: 0;
  color: #2c3e50;
}

.header-actions {
  display: flex;
  gap: 1rem;
  align-items: center;
}

.period-select {
  padding: 0.5rem;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 0.9rem;
}

.config-section {
  margin-bottom: 2rem;
}

.config-card {
  background: white;
  border-radius: 8px;
  border: 1px solid #e9ecef;
  overflow: hidden;
}

.config-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.5rem;
  border-bottom: 1px solid #e9ecef;
  background: #f8f9fa;
}

.config-header h3 {
  margin: 0;
  color: #2c3e50;
}

.status-indicator {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.9rem;
  color: #dc3545;
}

.status-indicator.connected {
  color: #28a745;
}

.status-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: currentColor;
}

.config-content {
  padding: 1.5rem;
}

.input-group {
  display: flex;
  gap: 0.5rem;
}

.input-group .form-input {
  flex: 1;
}

.config-help {
  margin-top: 1rem;
  padding: 1rem;
  background: #f8f9fa;
  border-radius: 4px;
  font-size: 0.9rem;
}

.config-help a {
  color: #007bff;
  text-decoration: none;
}

.config-help a:hover {
  text-decoration: underline;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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

.stat-change {
  font-size: 0.8rem;
  font-weight: 600;
  margin-top: 0.25rem;
}

.stat-change.positive {
  color: #28a745;
}

.stat-change.negative {
  color: #dc3545;
}

.analytics-content {
  display: flex;
  flex-direction: column;
  gap: 2rem;
}

.analytics-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2rem;
}

.chart-card,
.table-card,
.pagespeed-card {
  background: white;
  border-radius: 8px;
  border: 1px solid #e9ecef;
  overflow: hidden;
}

.chart-card h3,
.table-card h3,
.pagespeed-card h3 {
  margin: 0;
  padding: 1.5rem;
  border-bottom: 1px solid #e9ecef;
  color: #2c3e50;
  background: #f8f9fa;
}

.chart-placeholder {
  padding: 2rem;
  height: 250px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.chart-mock {
  text-align: center;
  width: 100%;
}

.chart-bars {
  display: flex;
  align-items: end;
  justify-content: space-around;
  height: 150px;
  margin-bottom: 1rem;
}

.bar {
  width: 30px;
  background: linear-gradient(to top, #007bff, #0056b3);
  border-radius: 2px 2px 0 0;
  min-height: 20px;
}

.chart-note {
  color: #6c757d;
  font-style: italic;
  margin: 0;
}

.traffic-sources {
  padding: 1.5rem;
}

.source-item {
  margin-bottom: 1rem;
}

.source-item:last-child {
  margin-bottom: 0;
}

.source-info {
  display: flex;
  justify-content: space-between;
  margin-bottom: 0.5rem;
}

.source-name {
  color: #495057;
}

.source-percentage {
  font-weight: 600;
  color: #2c3e50;
}

.progress-bar {
  height: 6px;
  background: #e9ecef;
  border-radius: 3px;
  overflow: hidden;
}

.progress-fill {
  height: 100%;
  background: linear-gradient(to right, #007bff, #0056b3);
  transition: width 0.3s ease;
}

.table-responsive {
  overflow-x: auto;
}

.analytics-table {
  width: 100%;
  border-collapse: collapse;
}

.analytics-table th,
.analytics-table td {
  padding: 1rem;
  text-align: left;
  border-bottom: 1px solid #e9ecef;
}

.analytics-table th {
  background: #f8f9fa;
  font-weight: 600;
  color: #495057;
}

.page-info {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}

.page-path {
  color: #007bff;
  font-weight: 500;
}

.page-title {
  color: #6c757d;
  font-size: 0.8rem;
}

.pagespeed-content {
  padding: 1.5rem;
}

.speed-test {
  margin-bottom: 1.5rem;
}

.speed-results {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.speed-scores {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
  gap: 1rem;
}

.score-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
}

.score-circle {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  color: white;
  font-size: 1.1rem;
}

.score-circle.excellent {
  background: #28a745;
}

.score-circle.good {
  background: #ffc107;
  color: #212529;
}

.score-circle.fair {
  background: #fd7e14;
}

.score-circle.poor {
  background: #dc3545;
}

.score-item span {
  font-size: 0.8rem;
  color: #6c757d;
  text-align: center;
}

.speed-metrics {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
  gap: 1rem;
}

.metric {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}

.metric label {
  font-size: 0.85rem;
  color: #6c757d;
}

.metric span {
  font-weight: 600;
  color: #2c3e50;
}

.recommendations h4 {
  margin: 0 0 0.5rem 0;
  color: #2c3e50;
  font-size: 1rem;
}

.recommendations ul {
  margin: 0;
  padding-left: 1.5rem;
}

.recommendations li {
  margin-bottom: 0.5rem;
  color: #495057;
  font-size: 0.9rem;
}

.additional-config {
  margin-top: 2rem;
}

.config-options {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  margin-bottom: 1.5rem;
}

.option-group {
  display: flex;
  align-items: center;
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

.btn-secondary:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

/* Responsive */
@media (max-width: 1024px) {
  .analytics-row {
    grid-template-columns: 1fr;
  }
  
  .speed-scores {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px) {
  .analytics-header {
    flex-direction: column;
    gap: 1rem;
    align-items: stretch;
  }
  
  .stats-grid {
    grid-template-columns: 1fr;
  }
  
  .speed-metrics {
    grid-template-columns: 1fr;
  }
  
  .config-options {
    gap: 0.75rem;
  }
}
</style>