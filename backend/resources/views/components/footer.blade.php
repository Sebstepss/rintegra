@php
    // Obtener configuración del footer desde la base de datos
    $footerConfig = null;
    try {
        $config = \App\Models\SiteConfiguration::where('config_type', 'footer')
            ->where('is_active', true)
            ->first();
        if ($config && isset($config->config_data)) {
            $footerConfig = is_array($config->config_data) ? $config->config_data : json_decode($config->config_data, true);
        }
    } catch (\Exception $e) {
        \Log::error('Error loading footer config: ' . $e->getMessage());
    }

    // Valores por defecto
    $backgroundColor = $footerConfig['backgroundColor'] ?? '#17a2b8';
    $ctaTitle = $footerConfig['ctaTitle'] ?? '¿Hablamos?';
    $ctaDescription = $footerConfig['ctaDescription'] ?? 'Si necesitas estructurar tus finanzas o resolver dudas contables y tributarias, agenda una cita o déjanos tu mensaje.';
    $logoUrl = $footerConfig['logoUrl'] ?? '';
    $locationTitle = $footerConfig['locationTitle'] ?? 'Ubicación';
    $socialTitle = $footerConfig['socialTitle'] ?? 'Síguenos en';
    $privacyPolicyUrl = $footerConfig['privacyPolicyUrl'] ?? '/privacy-policy';

    $formLabels = $footerConfig['formLabels'] ?? [
        'fullName' => 'Nombre completo',
        'phone' => 'Teléfono',
        'email' => 'Correo electrónico',
        'message' => 'Mensaje',
        'acceptPolicy' => 'Acepto las políticas de tratamiento de datos',
        'privacyPolicyLink' => 'Políticas de Privacidad',
        'submitButton' => 'Enviar'
    ];

    $contactInfo = $footerConfig['contactInfo'] ?? [
        ['icon' => 'fas fa-map-marker-alt', 'text' => 'Cra 14 #18-50, Cali, Valle del Cauca'],
        ['icon' => 'fas fa-phone', 'text' => '+57 320 8994424'],
        ['icon' => 'fas fa-envelope', 'text' => 'contacto@r-integra.com']
    ];

    $socialLinks = $footerConfig['socialLinks'] ?? [
        ['name' => 'Instagram', 'icon' => 'fab fa-instagram', 'url' => '#'],
        ['name' => 'Facebook', 'icon' => 'fab fa-facebook-f', 'url' => '#'],
        ['name' => 'LinkedIn', 'icon' => 'fab fa-linkedin-in', 'url' => '#']
    ];
@endphp

<footer class="footer" style="background-color: {{ $backgroundColor }}; color: white;">
    <div class="footer-container">
        <!-- Sección 1: CTA y Formulario de Contacto -->
        <div class="cta-section">
            <div class="cta-content">
                <div class="cta-text">
                    <h1 class="cta-title">{!! $ctaTitle !!}</h1>
                    <p class="cta-description">{!! $ctaDescription !!}</p>
                </div>

                <div class="contact-form-wrapper">
                    <form action="/api/forms/contact" method="POST" class="contact-form" id="contactForm">
                        @csrf
                        <div class="form-group">
                            <input
                                type="text"
                                name="name"
                                required
                                class="form-input"
                                placeholder="{{ $formLabels['fullName'] ?? 'Nombre completo' }}"
                            >
                        </div>

                        <div class="form-group">
                            <input
                                type="tel"
                                name="phone"
                                required
                                class="form-input"
                                placeholder="{{ $formLabels['phone'] ?? 'Teléfono' }}"
                            >
                        </div>

                        <div class="form-group">
                            <input
                                type="email"
                                name="email"
                                required
                                class="form-input"
                                placeholder="{{ $formLabels['email'] ?? 'Correo electrónico' }}"
                            >
                        </div>

                        <div class="form-group">
                            <textarea
                                name="message"
                                required
                                class="form-textarea"
                                placeholder="{{ $formLabels['message'] ?? 'Mensaje' }}"
                                rows="3"
                            ></textarea>
                        </div>

                        <div class="form-group checkbox-group">
                            <label class="checkbox-label">
                                <input
                                    type="checkbox"
                                    name="accept_policy"
                                    required
                                    class="checkbox-input"
                                >
                                <span class="checkbox-text">
                                    {{ $formLabels['acceptPolicy'] ?? 'Acepto las políticas de tratamiento de datos' }}
                                    <a href="{{ $privacyPolicyUrl }}" target="_blank" class="policy-link">
                                        {{ $formLabels['privacyPolicyLink'] ?? 'Políticas de Privacidad' }}
                                    </a>
                                </span>
                            </label>
                        </div>

                        <button type="submit" class="submit-btn">
                            {{ $formLabels['submitButton'] ?? 'Enviar' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sección 2: Logo, Ubicación y Redes Sociales -->
        <div class="info-section">
            <div class="info-content">
                <!-- Columna 1: Logo -->
                <div class="info-column logo-column">
                    <div class="footer-logo">
                        @if($logoUrl)
                            <img src="{{ $logoUrl }}" alt="Logo" class="logo-image">
                        @else
                            <h3 class="logo-text">RIntegra</h3>
                        @endif
                    </div>
                </div>

                <!-- Columna 2: Ubicación y Contacto -->
                <div class="info-column contact-column">
                    <h2 class="section-title">{{ $locationTitle }}</h2>
                    <div class="contact-info">
                        @foreach($contactInfo as $contact)
                            <div class="contact-item">
                                <i class="{{ $contact['icon'] }}" class="contact-icon"></i>
                                <span class="contact-text">{!! $contact['text'] !!}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Columna 3: Redes Sociales -->
                <div class="info-column social-column">
                    <h2 class="section-title">{{ $socialTitle }}</h2>
                    <div class="social-links">
                        @foreach($socialLinks as $social)
                            <a href="{{ $social['url'] }}"
                               target="_blank"
                               class="social-link"
                               aria-label="{{ $social['name'] }}">
                                <i class="{{ $social['icon'] }}"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
.footer {
    color: white;
    margin-top: auto;
    font-family: var(--base-font-family, 'Lato', 'Inter', sans-serif);
    width: 100%;
}

.footer-container {
    width: 100%;
    margin: 0;
}

/* Sección 1: CTA y Formulario */
.cta-section {
    padding: 4rem 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.cta-content {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
}

.cta-text {
    max-width: 500px;
}

.cta-title {
    font-size: var(--font-size-h1, 3rem);
    font-weight: var(--font-weight-h1, 700);
    font-family: var(--font-family-h1, var(--base-font-family, 'Lato', sans-serif));
    letter-spacing: var(--letter-spacing-h1, 0px);
    margin: 0 0 1.5rem 0;
    color: white;
    line-height: 1.2;
}

.cta-description {
    font-size: var(--font-size-p, 1.1rem);
    font-weight: var(--font-weight-p, 400);
    font-family: var(--font-family-p, var(--base-font-family, 'Lato', sans-serif));
    letter-spacing: var(--letter-spacing-p, 0px);
    line-height: 1.6;
    margin: 0;
    color: rgba(255, 255, 255, 0.9);
}

.contact-form-wrapper {
    background: rgba(255, 255, 255, 0.1);
    padding: 2rem;
    border-radius: 12px;
    backdrop-filter: blur(10px);
}

.contact-form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-input, .form-textarea {
    padding: 0.65rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.1);
    color: white;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.form-input::placeholder, .form-textarea::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.form-input:focus, .form-textarea:focus {
    outline: none;
    border-color: rgba(255, 255, 255, 0.5);
    background: rgba(255, 255, 255, 0.15);
}

.form-textarea {
    resize: vertical;
    min-height: 80px;
}

.checkbox-group {
    margin: 0.75rem 0;
}

.checkbox-label {
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
    cursor: pointer;
    font-size: 0.9rem;
    line-height: 1.4;
}

.checkbox-input {
    margin: 0;
    accent-color: white;
}

.checkbox-text {
    color: rgba(255, 255, 255, 0.9);
}

.policy-link {
    color: white;
    text-decoration: underline;
    font-weight: 600;
}

.policy-link:hover {
    text-decoration: none;
}

.submit-btn {
    background: linear-gradient(135deg, #c0894f, #ffffaa, #fdfab2, #cb9452);
    color: #0c6a44;
    border: none;
    padding: 0.8rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    font-weight: bold;
    box-shadow: 0 4px 15px rgba(192, 137, 79, 0.3);
}

.submit-btn:hover:not(:disabled) {
    background: linear-gradient(135deg, #b07a42, #f5f59d, #f0f3a5, #b8854a);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(192, 137, 79, 0.4);
}

.submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

/* Sección 2: Info */
.info-section {
    padding: 3rem 0;
}

.info-content {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 3rem;
    align-items: start;
}

.info-column {
    display: flex;
    flex-direction: column;
}

/* Columna Logo */
.footer-logo {
    display: flex;
    align-items: center;
    justify-content: center;
}

.logo-image {
    max-height: 200px;
    width: auto;
    object-fit: contain;
}

.logo-text {
    font-size: var(--font-size-h2, 2rem);
    font-weight: var(--font-weight-h2, 700);
    font-family: var(--font-family-h2, var(--base-font-family, 'Lato', sans-serif));
    color: white;
    margin: 0;
}

/* Columna Contacto */
.section-title {
    font-size: var(--font-size-h3, 1.5rem);
    font-weight: var(--font-weight-h3, 600);
    font-family: var(--font-family-h3, var(--base-font-family, 'Lato', sans-serif));
    letter-spacing: var(--letter-spacing-h3, 0px);
    margin: 0 0 1.5rem 0;
    color: white;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.95rem;
}

.contact-icon {
    width: 20px;
    text-align: center;
    color: white;
    font-size: 1.1rem;
}

.contact-text {
    line-height: 1.4;
}

/* Columna Redes Sociales */
.social-links {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.social-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border-radius: 50%;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 1.3rem;
}

.social-link:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-3px);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .cta-content {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .cta-title {
        font-size: 2.5rem;
        text-align: center;
    }

    .cta-description {
        text-align: center;
    }
}

@media (max-width: 768px) {
    .cta-content, .info-content {
        padding: 0 1rem;
    }

    .info-content {
        grid-template-columns: 1fr;
        gap: 2rem;
        text-align: center;
    }

    .contact-form-wrapper {
        padding: 1.5rem;
    }

    .cta-title {
        font-size: 2rem;
    }

    .social-links {
        justify-content: center;
    }

    .contact-item {
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .cta-title {
        font-size: 1.8rem;
    }

    .contact-form-wrapper {
        padding: 1rem;
    }
}
</style>

<script>
// Handle form submission
document.getElementById('contactForm')?.addEventListener('submit', async function(e) {
    e.preventDefault();

    const form = e.target;
    const submitBtn = form.querySelector('.submit-btn');
    const originalText = submitBtn.textContent;

    submitBtn.disabled = true;
    submitBtn.textContent = 'Enviando...';

    try {
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);

        const response = await fetch('/api/forms/contact', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                name: data.name,
                phone: data.phone,
                email: data.email,
                message: data.message,
                additional_fields: {
                    source: 'Footer Contact Form',
                    accepts_policy: data.accept_policy === 'on'
                }
            })
        });

        if (response.ok) {
            alert('Mensaje enviado correctamente. Te contactaremos pronto.');
            form.reset();
        } else {
            alert('Error al enviar el mensaje. Inténtalo nuevamente.');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error al enviar el mensaje. Inténtalo nuevamente.');
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
    }
});
</script>
