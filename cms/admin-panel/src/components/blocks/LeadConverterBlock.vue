<template>
  <div 
    class="lead-converter-block" 
    :class="[`padding-${block.padding}`]"
    :style="blockStyles"
  >
    <!-- Header Section -->
    <div class="lead-header">
      <h1 class="headline">{{ block.headline }}</h1>
      <p class="subheadline">{{ block.subheadline }}</p>
    </div>

    <!-- Main Content Layout -->
    <div class="main-content">
      <!-- Left Column: Form -->
      <div class="form-section" id="form-section">
        <!-- Countdown Header -->
        <div v-if="block.showCountdown" class="countdown-header">
          <div class="countdown-label">{{ block.countdownLabel }}</div>
          <div class="countdown-timer">
            <div class="time-unit">
              <span class="time-value">{{ timeLeft.hours }}</span>
              <span class="time-label">H</span>
            </div>
            <div class="time-separator">:</div>
            <div class="time-unit">
              <span class="time-value">{{ timeLeft.minutes }}</span>
              <span class="time-label">M</span>
            </div>
            <div class="time-separator">:</div>
            <div class="time-unit">
              <span class="time-value">{{ timeLeft.seconds }}</span>
              <span class="time-label">S</span>
            </div>
          </div>
        </div>

        <form @submit.prevent="submitForm" class="lead-form">
          <div class="form-group">
            <input
              v-model="formData.name"
              type="text"
              :placeholder="block.nameLabel"
              required
              class="form-input"
              :class="{ 'error': errors.name }"
            />
            <span v-if="errors.name" class="error-message">{{ errors.name }}</span>
          </div>

          <div class="form-group">
            <div class="phone-input-group">
              <select
                v-model="formData.countryCode"
                class="country-code-select"
                :class="{ 'error': errors.phone }"
              >
                <option value="+57">🇨🇴 +57</option>
                <option value="+1">🇺🇸 +1</option>
                <option value="+52">🇲🇽 +52</option>
                <option value="+54">🇦🇷 +54</option>
                <option value="+56">🇨🇱 +56</option>
                <option value="+51">🇵🇪 +51</option>
                <option value="+593">🇪🇨 +593</option>
                <option value="+58">🇻🇪 +58</option>
                <option value="+507">🇵🇦 +507</option>
                <option value="+506">🇨🇷 +506</option>
                <option value="+34">🇪🇸 +34</option>
              </select>
              <input
                v-model="formData.phone"
                type="tel"
                :placeholder="block.phoneLabel"
                required
                class="form-input phone-number-input"
                :class="{ 'error': errors.phone }"
              />
            </div>
            <span v-if="errors.phone" class="error-message">{{ errors.phone }}</span>
          </div>

          <div class="form-group">
            <input
              v-model="formData.email"
              type="email"
              :placeholder="block.emailLabel"
              required
              class="form-input"
              :class="{ 'error': errors.email }"
            />
            <span v-if="errors.email" class="error-message">{{ errors.email }}</span>
          </div>

          <div class="form-group">
            <select
              v-model="formData.situation"
              required
              class="form-select"
              :class="{ 'error': errors.situation }"
            >
              <option value="">{{ block.situationLabel }}</option>
              <option 
                v-for="option in (block.situationOptions || [])" 
                :key="option" 
                :value="option"
              >
                {{ option }}
              </option>
            </select>
            <span v-if="errors.situation" class="error-message">{{ errors.situation }}</span>
          </div>

          <div class="form-group">
            <select
              v-model="formData.urgency"
              required
              class="form-select"
              :class="{ 'error': errors.urgency }"
            >
              <option value="">{{ block.urgencyLabel }}</option>
              <option 
                v-for="option in (block.urgencyOptions || [])" 
                :key="option" 
                :value="option"
              >
                {{ option }}
              </option>
            </select>
            <span v-if="errors.urgency" class="error-message">{{ errors.urgency }}</span>
          </div>

          <button 
            type="submit" 
            class="cta-button"
            :disabled="isSubmitting"
          >
            {{ isSubmitting ? 'ENVIANDO...' : block.ctaButtonText }}
          </button>
        </form>
      </div>

      <!-- Right Column: Value Stack & Trust Elements -->
      <div class="content-section">
        <!-- Value Stack -->
        <div v-if="block.showValueStack" class="value-stack">
          <h3 class="value-title">{{ block.valueStackTitle }}</h3>
          <div class="value-items">
            <div 
              v-for="item in enabledValueItems" 
              :key="item.id"
              class="value-item"
            >
              <span class="checkmark">✅</span>
              <span class="item-text">{{ item.text }}</span>
              <span class="item-value">(Valor: {{ item.value }})</span>
            </div>
          </div>
          <div class="value-total">
            <div class="total-line">VALOR TOTAL: {{ block.totalValue }}</div>
            <div class="today-price">HOY: {{ block.todayPrice }}</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Urgency Elements - Full Width -->
    <div v-if="block.showUrgencyElements" class="urgency-section">
      <div class="urgency-container">
        <div 
          v-for="item in enabledUrgencyItems" 
          :key="item.id"
          class="urgency-item"
          :class="{ 'animated': item.animated }"
        >
          {{ item.text }}
        </div>
        
        <!-- Progress Bar -->
        <div class="progress-section">
          <div class="progress-text">{{ block.progressBarText }}</div>
          <div class="progress-bar">
            <div 
              class="progress-fill"
              :style="{ width: progressPercentage + '%' }"
            ></div>
          </div>
          <div class="progress-numbers">
            {{ block.progressBarCurrent }}/{{ block.progressBarTotal }} espacios restantes
          </div>
        </div>
      </div>
    </div>

    <!-- Trust Elements - Full Width -->
    <div v-if="block.showTrustElements" class="trust-section">
      <div 
        v-for="item in enabledTrustItems" 
        :key="item.id"
        class="trust-card"
      >
        <div class="trust-icon" v-html="item.icon"></div>
        <div class="trust-text">{{ item.text }}</div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted, onUnmounted } from 'vue'
import type { LeadConverterBlock as LeadConverterBlockType } from '@/types/blocks'
import { formsApi } from '@/services/api'

interface Props {
  block: LeadConverterBlockType
  isEditing?: boolean
}

const props = withDefaults(defineProps<Props>(), {
  isEditing: false
})

// Form data
const formData = ref({
  name: '',
  countryCode: '+57',
  phone: '',
  email: '',
  situation: '',
  urgency: ''
})

// Form validation
const errors = ref({
  name: '',
  phone: '',
  email: '',
  situation: '',
  urgency: ''
})

const isSubmitting = ref(false)

// Countdown timer
const timeLeft = ref({
  hours: 0,
  minutes: 0,
  seconds: 0
})

let countdownInterval: ReturnType<typeof setInterval> | null = null

// Computed properties
const blockStyles = computed(() => {
  const styles: Record<string, string> = {}
  
  if (props.block.backgroundColor) {
    styles.backgroundColor = props.block.backgroundColor
  }
  
  return styles
})

const enabledValueItems = computed(() => {
  return (props.block.valueStackItems || []).filter(item => item.enabled)
})

const enabledUrgencyItems = computed(() => {
  return (props.block.urgencyItems || []).filter(item => item.enabled)
})

const enabledTrustItems = computed(() => {
  return (props.block.trustItems || []).filter(item => item.enabled)
})

const progressPercentage = computed(() => {
  if (!props.block.progressBarTotal || props.block.progressBarTotal === 0) return 0
  if (!props.block.progressBarCurrent && props.block.progressBarCurrent !== 0) return 0
  return (props.block.progressBarCurrent / props.block.progressBarTotal) * 100
})

const brandColors = computed(() => {
  if (props.block.useCustomColors) {
    return {
      primaryGreen: props.block.primaryGreen || '#0C6444',
      primaryGold: props.block.primaryGold || '#D1AE6A',
      beige: props.block.beige || '#EFE3D5',
      terracotta: props.block.terracotta || '#B86C55',
      white: props.block.white || '#FFFEF9'
    }
  }
  return {
    primaryGreen: '#0C6444',
    primaryGold: '#D1AE6A',
    beige: '#EFE3D5',
    terracotta: '#B86C55',
    white: '#FFFEF9'
  }
})

// Methods
const initCountdown = () => {
  if (!props.block.showCountdown) return
  
  const endTime = Date.now() + (props.block.countdownHours * 60 * 60 * 1000)
  
  const updateCountdown = () => {
    const now = Date.now()
    const timeRemaining = Math.max(0, endTime - now)
    
    const hours = Math.floor(timeRemaining / (1000 * 60 * 60))
    const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60))
    const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000)
    
    timeLeft.value = {
      hours: hours,
      minutes: minutes,
      seconds: seconds
    }
  }
  
  updateCountdown()
  countdownInterval = setInterval(updateCountdown, 1000)
}

const validateForm = () => {
  const newErrors = {
    name: '',
    phone: '',
    email: '',
    situation: '',
    urgency: ''
  }
  
  if (!formData.value.name.trim()) {
    newErrors.name = 'El nombre es requerido'
  }
  
  if (!formData.value.phone.trim()) {
    newErrors.phone = 'El WhatsApp es requerido'
  } else if (!/^[\d\s-()]+$/.test(formData.value.phone)) {
    newErrors.phone = 'Formato de teléfono inválido'
  }
  
  if (!formData.value.email.trim()) {
    newErrors.email = 'El email es requerido'
  } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.value.email)) {
    newErrors.email = 'Email inválido'
  }
  
  if (!formData.value.situation) {
    newErrors.situation = 'Selecciona tu situación actual'
  }
  
  if (!formData.value.urgency) {
    newErrors.urgency = 'Selecciona la urgencia'
  }
  
  errors.value = newErrors
  return !Object.values(newErrors).some(error => error !== '')
}

const submitForm = async () => {
  if (!validateForm() || isSubmitting.value) return
  
  isSubmitting.value = true
  
  try {
    const submitData = {
      name: formData.value.name,
      phone: formData.value.countryCode + formData.value.phone,
      email: formData.value.email,
      situation: formData.value.situation,
      urgency: formData.value.urgency,
      // Campos adicionales para el CRM
      additional_fields: {
        situation: formData.value.situation,
        urgency: formData.value.urgency,
        country_code: formData.value.countryCode,
        source: 'Lead Converter Block'
      }
    }
    
    const response = await formsApi.submitForm('lead_converter', submitData)
    
    if (response.data) {
      // Reset form
      formData.value = {
        name: '',
        countryCode: '+57',
        phone: '',
        email: '',
        situation: '',
        urgency: ''
      }
      alert('¡Formulario enviado exitosamente! Te contactaremos pronto.')
    }
  } catch (error) {
    console.error('Error submitting form:', error)
    alert('Error al enviar el formulario. Intenta nuevamente.')
  } finally {
    isSubmitting.value = false
  }
}

// Lifecycle
onMounted(() => {
  if (!props.isEditing) {
    initCountdown()
  }
})

onUnmounted(() => {
  if (countdownInterval) {
    clearInterval(countdownInterval)
  }
})
</script>

<style scoped>
.lead-converter-block {
  max-width: 1200px;
  margin: 0 auto;
  font-family: 'Lato', sans-serif;
  line-height: 1.6;
}

.lead-converter-block.padding-small { padding: 1rem; }
.lead-converter-block.padding-medium { padding: 2rem; }
.lead-converter-block.padding-large { padding: 3rem; }

/* Header */
.lead-header {
  text-align: center;
  margin-bottom: 2rem;
}

.headline {
  font-family: 'PT Serif', serif;
  font-size: 2.5rem;
  font-weight: normal;
  color: v-bind('brandColors.primaryGreen');
  margin: 0 0 1rem 0;
  line-height: 1.2;
}

.subheadline {
  font-size: 1.25rem;
  color: #333;
  margin: 0;
  max-width: 800px;
  margin-left: auto;
  margin-right: auto;
}

/* Countdown Header */
.countdown-header {
  background: linear-gradient(135deg, #c0894f, #ffffaa, #fdfab2, #cb9452);
  padding: 1.5rem;
  border-radius: 12px 12px 0 0;
  margin: -2rem -2rem 2rem -2rem;
  text-align: center;
}

.countdown-label {
  font-size: 0.9rem;
  font-weight: bold;
  color: v-bind('brandColors.primaryGreen');
  margin-bottom: 0.75rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.countdown-timer {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 0.75rem;
}

.time-unit {
  display: flex;
  flex-direction: column;
  align-items: center;
  background: v-bind('brandColors.white');
  padding: 0.75rem 0.5rem;
  border-radius: 8px;
  min-width: 60px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.time-value {
  font-size: 1.75rem;
  font-weight: bold;
  color: v-bind('brandColors.primaryGreen');
  line-height: 1;
}

.time-label {
  font-size: 0.7rem;
  font-weight: bold;
  color: v-bind('brandColors.primaryGreen');
  margin-top: 0.25rem;
}

.time-separator {
  font-size: 1.5rem;
  font-weight: bold;
  color: v-bind('brandColors.primaryGreen');
}

/* Main Content */
.main-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 3rem;
  align-items: stretch;
}

/* Form Section */
.form-section {
  background: v-bind('brandColors.white');
  padding: 2rem;
  border-radius: 15px;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
  border: 2px solid v-bind('brandColors.beige');
  height: fit-content;
}

.lead-form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.form-input,
.form-select {
  width: 100%;
  padding: 0.875rem 1rem;
  border: 2px solid v-bind('brandColors.beige');
  border-radius: 8px;
  font-size: 0.95rem;
  transition: all 0.3s ease;
  background: v-bind('brandColors.white');
  margin-bottom: 0;
}

.phone-input-group {
  display: flex;
  gap: 0.5rem;
  align-items: stretch;
}

.country-code-select {
  flex: 0 0 120px;
  padding: 0.875rem 0.5rem;
  border: 2px solid v-bind('brandColors.beige');
  border-radius: 8px;
  font-size: 0.9rem;
  transition: all 0.3s ease;
  background: v-bind('brandColors.white');
  cursor: pointer;
}

.phone-number-input {
  flex: 1;
  margin: 0;
}

.form-input:focus,
.form-select:focus,
.country-code-select:focus {
  outline: none;
  border-color: v-bind('brandColors.primaryGreen');
  box-shadow: 0 0 0 3px rgba(12, 100, 68, 0.1);
}

.form-input.error,
.form-select.error,
.country-code-select.error {
  border-color: #dc3545;
}

.error-message {
  color: #dc3545;
  font-size: 0.8rem;
  margin-top: 0.25rem;
  margin-bottom: 0.5rem;
  display: block;
}

.cta-button {
  background: linear-gradient(135deg, v-bind('brandColors.primaryGreen'), #0A5A39);
  color: white;
  border: none;
  padding: 1.25rem 2.5rem;
  border-radius: 12px;
  font-size: 1.1rem;
  font-weight: bold;
  cursor: pointer;
  text-transform: uppercase;
  transition: all 0.3s ease;
  letter-spacing: 0.5px;
  box-shadow: 0 6px 20px rgba(12, 100, 68, 0.3);
  width: 100%;
}

.cta-button:hover:not(:disabled) {
  background: linear-gradient(135deg, #0A5A39, v-bind('brandColors.primaryGreen'));
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(12, 100, 68, 0.4);
}

.cta-button:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

/* Content Section */
.content-section {
  display: flex;
  flex-direction: column;
  gap: 2rem;
  height: fit-content;
}

/* Value Stack */
.value-stack {
  background: v-bind('brandColors.white');
  padding: 2rem;
  border-radius: 15px;
  border: 2px solid v-bind('brandColors.beige');
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
  flex: 1;
}

.value-title {
  font-family: 'PT Serif', serif;
  font-size: 1.5rem;
  color: v-bind('brandColors.primaryGreen');
  margin: 0 0 1.5rem 0;
  text-align: center;
}

.value-items {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  margin-bottom: 1.5rem;
}

.value-item {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.75rem;
  background: rgba(239, 227, 213, 0.3);
  border-radius: 8px;
}

.checkmark {
  font-size: 1.2rem;
  flex-shrink: 0;
}

.item-text {
  flex: 1;
  font-weight: 500;
}

.item-value {
  font-weight: bold;
  color: v-bind('brandColors.primaryGreen');
}

.value-total {
  text-align: center;
  padding: 1.5rem;
  background: linear-gradient(135deg, #c0894f, #ffffaa, #fdfab2, #cb9452);
  border-radius: 10px;
  margin-top: 1rem;
}

.total-line {
  font-size: 1.25rem;
  font-weight: bold;
  color: v-bind('brandColors.primaryGreen');
  text-decoration: line-through;
  margin-bottom: 0.5rem;
}

.today-price {
  font-size: 1.5rem;
  font-weight: bold;
  color: v-bind('brandColors.primaryGreen');
  text-transform: uppercase;
}

/* Urgency Section */
.urgency-section {
  width: 100%;
  margin-top: 3rem;
}

.urgency-container {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  width: 100%;
}

.urgency-item {
  background: linear-gradient(135deg, v-bind('brandColors.terracotta'), #A85A47);
  color: white;
  padding: 1rem;
  border-radius: 8px;
  text-align: center;
  font-weight: bold;
}

.urgency-item.animated {
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0% { transform: scale(1); }
  50% { transform: scale(1.02); }
  100% { transform: scale(1); }
}

.progress-section {
  background: v-bind('brandColors.beige');
  padding: 1.5rem;
  border-radius: 10px;
  text-align: center;
}

.progress-text {
  font-weight: bold;
  color: v-bind('brandColors.primaryGreen');
  margin-bottom: 1rem;
}

.progress-bar {
  background: rgba(239, 227, 213, 0.5);
  height: 20px;
  border-radius: 10px;
  overflow: hidden;
  margin-bottom: 0.5rem;
}

.progress-fill {
  background: linear-gradient(90deg, v-bind('brandColors.primaryGreen'), #0A5A39);
  height: 100%;
  transition: width 0.3s ease;
  border-radius: 10px;
}

.progress-numbers {
  font-size: 0.9rem;
  color: v-bind('brandColors.primaryGreen');
  font-weight: 500;
}

/* Trust Section */
.trust-section {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 2rem;
  margin-top: 3rem;
  width: 100%;
}

.trust-card {
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.75rem;
  color: v-bind('brandColors.primaryGreen');
  font-weight: 500;
  padding: 1rem 0.5rem;
  transition: all 0.3s ease;
}

.trust-card:hover {
  transform: translateY(-3px);
}

.trust-icon {
  width: 56px;
  height: 56px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: v-bind('brandColors.primaryGreen');
  background: rgba(12, 100, 68, 0.1);
  border-radius: 50%;
  padding: 12px;
  transition: all 0.3s ease;
}

.trust-card:hover .trust-icon {
  background: rgba(12, 100, 68, 0.15);
  transform: scale(1.1);
}

.trust-icon svg {
  width: 32px;
  height: 32px;
  fill: currentColor;
}

.trust-text {
  font-size: 0.875rem;
  line-height: 1.3;
  font-weight: 600;
  text-align: center;
}

/* Responsive */
@media (max-width: 768px) {
  .headline {
    font-size: 2rem;
  }
  
  .subheadline {
    font-size: 1.1rem;
  }
  
  .main-content {
    grid-template-columns: 1fr;
    gap: 2rem;
  }
  
  .countdown-header {
    padding: 1rem;
    margin: -2rem -1.5rem 1.5rem -1.5rem;
  }
  
  .countdown-timer {
    gap: 0.5rem;
  }
  
  .time-unit {
    min-width: 50px;
    padding: 0.5rem 0.25rem;
  }
  
  .time-value {
    font-size: 1.5rem;
  }
  
  .time-separator {
    font-size: 1.25rem;
  }
  
  .trust-section {
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
  }
}

@media (max-width: 480px) {
  .lead-converter-block.padding-medium { padding: 1rem; }
  .lead-converter-block.padding-large { padding: 1.5rem; }
  
  .headline {
    font-size: 1.75rem;
  }
  
  .form-section,
  .value-stack {
    padding: 1.5rem;
  }
  
  .lead-form {
    gap: 0.875rem;
  }
  
  .countdown-header {
    padding: 0.75rem;
    margin: -1.5rem -1.5rem 1rem -1.5rem;
  }
  
  .countdown-label {
    font-size: 0.8rem;
  }
  
  .time-unit {
    min-width: 45px;
  }
  
  .time-value {
    font-size: 1.25rem;
  }
  
  .trust-section {
    grid-template-columns: 1fr;
    gap: 1rem;
  }
  
  .trust-card {
    padding: 0.75rem 0.5rem;
  }
  
  .trust-icon {
    width: 48px;
    height: 48px;
  }
  
  .trust-icon svg {
    width: 28px;
    height: 28px;
  }
  
  .trust-text {
    font-size: 0.8rem;
  }
}
</style>