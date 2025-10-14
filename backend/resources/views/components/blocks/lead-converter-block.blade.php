@php
    $headline = $block['headline'] ?? 'Transforma Tu Negocio Hoy';
    $subheadline = $block['subheadline'] ?? 'Regístrate para recibir una consulta personalizada';
    $backgroundColor = $block['backgroundColor'] ?? 'transparent';
    $padding = $block['padding'] ?? 'medium';

    // Colors
    $useCustomColors = $block['useCustomColors'] ?? false;
    $primaryGreen = $useCustomColors ? ($block['primaryGreen'] ?? '#0C6444') : '#0C6444';
    $primaryGold = $useCustomColors ? ($block['primaryGold'] ?? '#D1AE6A') : '#D1AE6A';
    $beige = $useCustomColors ? ($block['beige'] ?? '#EFE3D5') : '#EFE3D5';
    $terracotta = $useCustomColors ? ($block['terracotta'] ?? '#B86C55') : '#B86C55';
    $white = $useCustomColors ? ($block['white'] ?? '#FFFEF9') : '#FFFEF9';

    // Countdown
    $showCountdown = $block['showCountdown'] ?? false;
    $countdownLabel = $block['countdownLabel'] ?? 'OFERTA ESPECIAL TERMINA EN:';
    $countdownHours = $block['countdownHours'] ?? 24;

    // Form Labels
    $nameLabel = $block['nameLabel'] ?? 'Nombre completo';
    $phoneLabel = $block['phoneLabel'] ?? 'Número de WhatsApp';
    $emailLabel = $block['emailLabel'] ?? 'Correo electrónico';
    $situationLabel = $block['situationLabel'] ?? 'Tu situación actual';
    $urgencyLabel = $block['urgencyLabel'] ?? '¿Qué tan pronto necesitas iniciar?';
    $ctaButtonText = $block['ctaButtonText'] ?? 'QUIERO TRANSFORMAR MI NEGOCIO';

    // Form Options
    $situationOptions = $block['situationOptions'] ?? [
        'Tengo una idea pero no sé cómo empezar',
        'Ya tengo un negocio pero no crece',
        'Necesito mejorar mis ventas',
        'Quiero digitalizar mi negocio'
    ];

    $urgencyOptions = $block['urgencyOptions'] ?? [
        'Lo más pronto posible',
        'En las próximas semanas',
        'En el próximo mes',
        'Solo estoy explorando opciones'
    ];

    // Value Stack
    $showValueStack = $block['showValueStack'] ?? true;
    $valueStackTitle = $block['valueStackTitle'] ?? 'Lo que recibirás:';
    $valueStackItems = $block['valueStackItems'] ?? [];
    $totalValue = $block['totalValue'] ?? '$5,000';
    $todayPrice = $block['todayPrice'] ?? 'GRATIS';

    // Urgency Elements
    $showUrgencyElements = $block['showUrgencyElements'] ?? false;
    $urgencyItems = $block['urgencyItems'] ?? [];
    $progressBarText = $block['progressBarText'] ?? 'CUPOS DISPONIBLES:';
    $progressBarCurrent = $block['progressBarCurrent'] ?? 3;
    $progressBarTotal = $block['progressBarTotal'] ?? 10;

    // Trust Elements
    $showTrustElements = $block['showTrustElements'] ?? false;
    $trustItems = $block['trustItems'] ?? [];

    // Generate unique block ID
    $blockId = 'lead_converter_' . md5(json_encode($block));
    $jsBlockId = str_replace('-', '_', $blockId);
@endphp

<div
    id="{{ $blockId }}"
    class="lead-converter-block padding-{{ $padding }}"
    style="background-color: {{ $backgroundColor }};"
>
    <!-- Header Section -->
    <div class="lead-header">
        <h1 class="headline">{{ $headline }}</h1>
        <p class="subheadline">{{ $subheadline }}</p>
    </div>

    <!-- Main Content Layout -->
    <div class="main-content">
        <!-- Left Column: Form -->
        <div class="form-section" id="form-section">
            <!-- Countdown Header -->
            @if($showCountdown)
                <div class="countdown-header">
                    <div class="countdown-label">{{ $countdownLabel }}</div>
                    <div class="countdown-timer" id="countdown-{{ $jsBlockId }}">
                        <div class="time-unit">
                            <span class="time-value" data-time="hours">00</span>
                            <span class="time-label">H</span>
                        </div>
                        <div class="time-separator">:</div>
                        <div class="time-unit">
                            <span class="time-value" data-time="minutes">00</span>
                            <span class="time-label">M</span>
                        </div>
                        <div class="time-separator">:</div>
                        <div class="time-unit">
                            <span class="time-value" data-time="seconds">00</span>
                            <span class="time-label">S</span>
                        </div>
                    </div>
                </div>
            @endif

            <form class="lead-form" id="leadForm{{ $jsBlockId }}" data-block-id="{{ $blockId }}">
                @csrf

                <div class="form-group">
                    <input
                        type="text"
                        name="name"
                        placeholder="{{ $nameLabel }}"
                        required
                        class="form-input"
                    />
                    <span class="error-message" data-error="name"></span>
                </div>

                <div class="form-group">
                    <div class="phone-input-group">
                        <select name="country_code" class="country-code-select">
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
                            type="tel"
                            name="phone"
                            placeholder="{{ $phoneLabel }}"
                            required
                            class="form-input phone-number-input"
                        />
                    </div>
                    <span class="error-message" data-error="phone"></span>
                </div>

                <div class="form-group">
                    <input
                        type="email"
                        name="email"
                        placeholder="{{ $emailLabel }}"
                        required
                        class="form-input"
                    />
                    <span class="error-message" data-error="email"></span>
                </div>

                <div class="form-group">
                    <select name="situation" required class="form-select">
                        <option value="">{{ $situationLabel }}</option>
                        @foreach($situationOptions as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                    <span class="error-message" data-error="situation"></span>
                </div>

                <div class="form-group">
                    <select name="urgency" required class="form-select">
                        <option value="">{{ $urgencyLabel }}</option>
                        @foreach($urgencyOptions as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                    <span class="error-message" data-error="urgency"></span>
                </div>

                <button type="submit" class="cta-button">
                    {{ $ctaButtonText }}
                </button>
            </form>
        </div>

        <!-- Right Column: Value Stack -->
        @if($showValueStack)
            <div class="content-section">
                <div class="value-stack">
                    <h3 class="value-title">{{ $valueStackTitle }}</h3>
                    <div class="value-items">
                        @foreach($valueStackItems as $item)
                            @if($item['enabled'] ?? false)
                                <div class="value-item">
                                    <span class="checkmark">✅</span>
                                    <span class="item-text">{{ $item['text'] }}</span>
                                    <span class="item-value">(Valor: {{ $item['value'] }})</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="value-total">
                        <div class="total-line">VALOR TOTAL: {{ $totalValue }}</div>
                        <div class="today-price">HOY: {{ $todayPrice }}</div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Urgency Elements - Full Width -->
    @if($showUrgencyElements)
        <div class="urgency-section">
            <div class="urgency-container">
                @foreach($urgencyItems as $item)
                    @if($item['enabled'] ?? false)
                        <div class="urgency-item {{ ($item['animated'] ?? false) ? 'animated' : '' }}">
                            {{ $item['text'] }}
                        </div>
                    @endif
                @endforeach

                <!-- Progress Bar -->
                <div class="progress-section">
                    <div class="progress-text">{{ $progressBarText }}</div>
                    <div class="progress-bar">
                        <div
                            class="progress-fill"
                            style="width: {{ ($progressBarTotal > 0 ? ($progressBarCurrent / $progressBarTotal) * 100 : 0) }}%;"
                        ></div>
                    </div>
                    <div class="progress-numbers">
                        {{ $progressBarCurrent }}/{{ $progressBarTotal }} espacios restantes
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Trust Elements - Full Width -->
    @if($showTrustElements)
        <div class="trust-section">
            @foreach($trustItems as $item)
                @if($item['enabled'] ?? false)
                    <div class="trust-card">
                        <div class="trust-icon">{!! $item['icon'] ?? '' !!}</div>
                        <div class="trust-text">{{ $item['text'] }}</div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>

<style>
.lead-converter-block {
    width: 100%;
    max-width: 100%;
    margin: 0 auto;
    font-family: 'Lato', sans-serif;
    line-height: 1.6;
}

.lead-converter-block.padding-small { padding: 1rem 5%; }
.lead-converter-block.padding-medium { padding: 2rem 10%; }
.lead-converter-block.padding-large { padding: 3rem 15%; }

/* Header */
.lead-converter-block .lead-header {
    text-align: center;
    margin: 0 auto 2rem auto;
    max-width: 1200px;
}

.lead-converter-block .headline {
    font-family: 'PT Serif', serif;
    font-size: 2.5rem;
    font-weight: normal;
    color: {{ $primaryGreen }};
    margin: 0 0 1rem 0;
    line-height: 1.2;
}

.lead-converter-block .subheadline {
    font-size: 1.25rem;
    color: #333;
    margin: 0;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}

/* Countdown Header */
.lead-converter-block .countdown-header {
    background: linear-gradient(135deg, #c0894f, #ffffaa, #fdfab2, #cb9452);
    padding: 1.5rem;
    border-radius: 12px 12px 0 0;
    margin: -2rem -2rem 2rem -2rem;
    text-align: center;
}

.lead-converter-block .countdown-label {
    font-size: 0.9rem;
    font-weight: bold;
    color: {{ $primaryGreen }};
    margin-bottom: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.lead-converter-block .countdown-timer {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.75rem;
}

.lead-converter-block .time-unit {
    display: flex;
    flex-direction: column;
    align-items: center;
    background: {{ $white }};
    padding: 0.75rem 0.5rem;
    border-radius: 8px;
    min-width: 60px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.lead-converter-block .time-value {
    font-size: 1.75rem;
    font-weight: bold;
    color: {{ $primaryGreen }};
    line-height: 1;
}

.lead-converter-block .time-label {
    font-size: 0.7rem;
    font-weight: bold;
    color: {{ $primaryGreen }};
    margin-top: 0.25rem;
}

.lead-converter-block .time-separator {
    font-size: 1.5rem;
    font-weight: bold;
    color: {{ $primaryGreen }};
}

/* Main Content */
.lead-converter-block .main-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: stretch;
    max-width: 1200px;
    margin: 0 auto;
    width: 100%;
}

/* Form Section */
.lead-converter-block .form-section {
    background: {{ $white }};
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    border: 2px solid {{ $beige }};
    height: fit-content;
}

.lead-converter-block .lead-form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.lead-converter-block .form-group {
    margin-bottom: 0;
}

.lead-converter-block .form-input,
.lead-converter-block .form-select {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid #d1d1d1;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background: {{ $white }};
    margin-bottom: 0;
    box-sizing: border-box;
}

.lead-converter-block .phone-input-group {
    display: flex;
    gap: 0.5rem;
    align-items: stretch;
}

.lead-converter-block .country-code-select {
    flex: 0 0 120px;
    padding: 0.875rem 0.5rem;
    border: 2px solid #d1d1d1;
    border-radius: 8px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    background: {{ $white }};
    cursor: pointer;
    box-sizing: border-box;
}

.lead-converter-block .phone-number-input {
    flex: 1;
    margin: 0;
}

.lead-converter-block .form-input:focus,
.lead-converter-block .form-select:focus,
.lead-converter-block .country-code-select:focus {
    outline: none;
    border-color: {{ $primaryGreen }};
    box-shadow: 0 0 0 3px rgba(12, 100, 68, 0.1);
}

.lead-converter-block .form-input.error,
.lead-converter-block .form-select.error,
.lead-converter-block .country-code-select.error {
    border-color: #dc3545;
}

.lead-converter-block .error-message {
    color: #dc3545;
    font-size: 0.8rem;
    margin-top: 0.25rem;
    margin-bottom: 0.5rem;
    display: none;
}

.lead-converter-block .error-message.show {
    display: block;
}

.lead-converter-block .cta-button {
    background: linear-gradient(135deg, {{ $primaryGreen }}, #0A5A39);
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

.lead-converter-block .cta-button:hover:not(:disabled) {
    background: linear-gradient(135deg, #0A5A39, {{ $primaryGreen }});
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(12, 100, 68, 0.4);
}

.lead-converter-block .cta-button:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

/* Content Section */
.lead-converter-block .content-section {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    height: fit-content;
}

/* Value Stack */
.lead-converter-block .value-stack {
    background: {{ $white }};
    padding: 2rem;
    border-radius: 15px;
    border: 2px solid {{ $beige }};
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    flex: 1;
}

.lead-converter-block .value-title {
    font-family: 'PT Serif', serif;
    font-size: 1.5rem;
    color: {{ $primaryGreen }};
    margin: 0 0 1.5rem 0;
    text-align: center;
}

.lead-converter-block .value-items {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.lead-converter-block .value-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    background: rgba(239, 227, 213, 0.3);
    border-radius: 8px;
}

.lead-converter-block .checkmark {
    font-size: 1.2rem;
    flex-shrink: 0;
}

.lead-converter-block .item-text {
    flex: 1;
    font-weight: 500;
}

.lead-converter-block .item-value {
    font-weight: bold;
    color: {{ $primaryGreen }};
}

.lead-converter-block .value-total {
    text-align: center;
    padding: 1.5rem;
    background: linear-gradient(135deg, #c0894f, #ffffaa, #fdfab2, #cb9452);
    border-radius: 10px;
    margin-top: 1rem;
}

.lead-converter-block .total-line {
    font-size: 1.25rem;
    font-weight: bold;
    color: {{ $primaryGreen }};
    text-decoration: line-through;
    margin-bottom: 0.5rem;
}

.lead-converter-block .today-price {
    font-size: 1.5rem;
    font-weight: bold;
    color: {{ $primaryGreen }};
    text-transform: uppercase;
}

/* Urgency Section */
.lead-converter-block .urgency-section {
    width: 100%;
    margin-top: 3rem;
}

.lead-converter-block .urgency-container {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
}

.lead-converter-block .urgency-item {
    background: linear-gradient(135deg, {{ $terracotta }}, #A85A47);
    color: white;
    padding: 1rem;
    border-radius: 8px;
    text-align: center;
    font-weight: bold;
}

.lead-converter-block .urgency-item.animated {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.02); }
    100% { transform: scale(1); }
}

.lead-converter-block .progress-section {
    background: {{ $beige }};
    padding: 1.5rem;
    border-radius: 10px;
    text-align: center;
}

.lead-converter-block .progress-text {
    font-weight: bold;
    color: {{ $primaryGreen }};
    margin-bottom: 1rem;
}

.lead-converter-block .progress-bar {
    background: rgba(239, 227, 213, 0.5);
    height: 20px;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 0.5rem;
}

.lead-converter-block .progress-fill {
    background: linear-gradient(90deg, {{ $primaryGreen }}, #0A5A39);
    height: 100%;
    transition: width 0.3s ease;
    border-radius: 10px;
}

.lead-converter-block .progress-numbers {
    font-size: 0.9rem;
    color: {{ $primaryGreen }};
    font-weight: 500;
}

/* Trust Section */
.lead-converter-block .trust-section {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
    margin: 3rem auto 0 auto;
    width: 100%;
    max-width: 1200px;
}

.lead-converter-block .trust-card {
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.75rem;
    color: {{ $primaryGreen }};
    font-weight: 500;
    padding: 1rem 0.5rem;
    transition: all 0.3s ease;
}

.lead-converter-block .trust-card:hover {
    transform: translateY(-3px);
}

.lead-converter-block .trust-icon {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: {{ $primaryGreen }};
    background: rgba(12, 100, 68, 0.1);
    border-radius: 50%;
    padding: 12px;
    transition: all 0.3s ease;
}

.lead-converter-block .trust-card:hover .trust-icon {
    background: rgba(12, 100, 68, 0.15);
    transform: scale(1.1);
}

.lead-converter-block .trust-icon svg {
    width: 32px;
    height: 32px;
    fill: currentColor;
}

.lead-converter-block .trust-text {
    font-size: 0.875rem;
    line-height: 1.3;
    font-weight: 600;
    text-align: center;
}

/* Responsive */
@media (max-width: 768px) {
    .lead-converter-block .headline { font-size: 2rem; }
    .lead-converter-block .subheadline { font-size: 1.1rem; }
    .lead-converter-block .main-content { grid-template-columns: 1fr; gap: 2rem; }
    .lead-converter-block .countdown-header { padding: 1rem; margin: -2rem -1.5rem 1.5rem -1.5rem; }
    .lead-converter-block .countdown-timer { gap: 0.5rem; }
    .lead-converter-block .time-unit { min-width: 50px; padding: 0.5rem 0.25rem; }
    .lead-converter-block .time-value { font-size: 1.5rem; }
    .lead-converter-block .time-separator { font-size: 1.25rem; }
    .lead-converter-block .trust-section { grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
}

@media (max-width: 480px) {
    .lead-converter-block.padding-medium { padding: 1rem; }
    .lead-converter-block.padding-large { padding: 1.5rem; }
    .lead-converter-block .headline { font-size: 1.75rem; }
    .lead-converter-block .form-section, .lead-converter-block .value-stack { padding: 1.5rem; }
    .lead-converter-block .lead-form { gap: 0.875rem; }
    .lead-converter-block .countdown-header { padding: 0.75rem; margin: -1.5rem -1.5rem 1rem -1.5rem; }
    .lead-converter-block .countdown-label { font-size: 0.8rem; }
    .lead-converter-block .time-unit { min-width: 45px; }
    .lead-converter-block .time-value { font-size: 1.25rem; }
    .lead-converter-block .trust-section { grid-template-columns: 1fr; gap: 1rem; }
    .lead-converter-block .trust-card { padding: 0.75rem 0.5rem; }
    .lead-converter-block .trust-icon { width: 48px; height: 48px; }
    .lead-converter-block .trust-icon svg { width: 28px; height: 28px; }
    .lead-converter-block .trust-text { font-size: 0.8rem; }
}
</style>

<script>
// Countdown timer for {{ $jsBlockId }}
@if($showCountdown)
(function() {
    const countdownElement = document.getElementById('countdown-{{ $jsBlockId }}');
    if (!countdownElement) return;

    const endTime = Date.now() + ({{ $countdownHours }} * 60 * 60 * 1000);

    function updateCountdown() {
        const now = Date.now();
        const timeRemaining = Math.max(0, endTime - now);

        const hours = Math.floor(timeRemaining / (1000 * 60 * 60));
        const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

        const hoursEl = countdownElement.querySelector('[data-time="hours"]');
        const minutesEl = countdownElement.querySelector('[data-time="minutes"]');
        const secondsEl = countdownElement.querySelector('[data-time="seconds"]');

        if (hoursEl) hoursEl.textContent = String(hours).padStart(2, '0');
        if (minutesEl) minutesEl.textContent = String(minutes).padStart(2, '0');
        if (secondsEl) secondsEl.textContent = String(seconds).padStart(2, '0');
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
})();
@endif

// Form submission for {{ $jsBlockId }}
(function() {
    const form = document.getElementById('leadForm{{ $jsBlockId }}');
    if (!form) return;

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Clear previous errors
        form.querySelectorAll('.error-message').forEach(el => {
            el.classList.remove('show');
            el.textContent = '';
        });
        form.querySelectorAll('.error').forEach(el => {
            el.classList.remove('error');
        });

        // Collect form data
        const formData = new FormData(form);
        const submitButton = form.querySelector('.cta-button');
        const originalText = submitButton.textContent;

        // Disable button
        submitButton.disabled = true;
        submitButton.textContent = 'ENVIANDO...';

        // Convert FormData to object and prepare for API
        const data = Object.fromEntries(formData);
        const countryCode = data.country_code || '+57';
        const phoneNumber = data.phone || '';

        try {
            const response = await fetch('{{ url("/api/forms/submit") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    form_type: 'lead_converter',
                    name: data.name,
                    phone: `${countryCode} ${phoneNumber}`,
                    email: data.email,
                    message: `Situación: ${data.situation} | Urgencia: ${data.urgency}`,
                    additional_fields: {
                        situation: data.situation,
                        urgency: data.urgency,
                        source: 'Lead Converter Block'
                    }
                })
            });

            const result = await response.json();

            if (response.ok) {
                alert('¡Formulario enviado exitosamente! Te contactaremos pronto.');
                form.reset();
            } else {
                if (result.errors) {
                    // Show field-specific errors
                    for (const [field, messages] of Object.entries(result.errors)) {
                        const errorEl = form.querySelector(`[data-error="${field}"]`);
                        const inputEl = form.querySelector(`[name="${field}"]`);
                        if (errorEl && inputEl) {
                            errorEl.textContent = messages[0];
                            errorEl.classList.add('show');
                            inputEl.classList.add('error');
                        }
                    }
                } else {
                    alert('Error al enviar el formulario. Intenta nuevamente.');
                }
            }
        } catch (error) {
            console.error('Error submitting form:', error);
            alert('Error al enviar el formulario. Intenta nuevamente.');
        } finally {
            submitButton.disabled = false;
            submitButton.textContent = originalText;
        }
    });
})();
</script>
