@php
    $title = $block['title'] ?? '';
    $subtitle = $block['subtitle'] ?? '';
    $contactItems = $block['contactItems'] ?? [];
    $iconColor = $block['iconColor'] ?? '#0C6444';
    $textColor = $block['textColor'] ?? '#333';
    $backgroundColor = $block['backgroundColor'] ?? 'transparent';
    $padding = $block['padding'] ?? 'medium';
    $showMap = $block['showMap'] ?? false;
    $mapAddress = $block['mapAddress'] ?? '';
    $mapZoom = $block['mapZoom'] ?? 15;
    $mapHeight = $block['mapHeight'] ?? 450;

    $paddingClasses = [
        'none' => '0',
        'small' => '2rem 1rem',
        'medium' => '4rem 2rem',
        'large' => '6rem 2rem'
    ];

    $paddingStyle = $paddingClasses[$padding] ?? $paddingClasses['medium'];
@endphp

<div class="contact-block" style="background-color: {{ $backgroundColor }}; color: {{ $textColor }}; padding: {{ $paddingStyle }};">
    <div class="contact-block-inner">
        <!-- Header -->
        @if($title || $subtitle)
            <div class="contact-header">
                @if($title)
                    <h2 class="contact-title" style="color: {{ $textColor }};">{{ $title }}</h2>
                @endif
                @if($subtitle)
                    <p class="contact-subtitle">{{ $subtitle }}</p>
                @endif
            </div>
        @endif

        <!-- Grid de Tarjetas -->
        <div class="contact-grid">
            @foreach($contactItems as $item)
                <div class="contact-card">
                    <div class="card-icon" style="color: {{ $iconColor }}; background-color: {{ $iconColor }}15;">
                        <i class="{{ $item['icon'] ?? 'fas fa-info-circle' }}"></i>
                    </div>
                    <h3 class="card-title">{{ $item['title'] ?? '' }}</h3>
                    <div class="card-content">
                        @if($item['type'] === 'address')
                            <p>{{ $item['value'] ?? '' }}</p>
                        @elseif($item['type'] === 'phone')
                            <a href="tel:{{ $item['value'] ?? '' }}" class="contact-link" style="color: {{ $iconColor }};">{{ $item['value'] ?? '' }}</a>
                        @elseif($item['type'] === 'email')
                            <a href="mailto:{{ $item['value'] ?? '' }}" class="contact-link" style="color: {{ $iconColor }};">{{ $item['value'] ?? '' }}</a>
                        @elseif($item['type'] === 'hours')
                            @foreach($item['hours'] ?? [] as $hour)
                                <p class="hours-item">{{ $hour }}</p>
                            @endforeach
                        @elseif($item['type'] === 'social')
                            <div class="social-links">
                                @foreach($item['socials'] ?? [] as $social)
                                    <a href="{{ $social['url'] ?? '#' }}"
                                       target="_blank"
                                       aria-label="{{ $social['name'] ?? '' }}"
                                       class="social-link"
                                       style="background-color: {{ $iconColor }};">
                                        <i class="{{ $social['icon'] ?? 'fas fa-link' }}"></i>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <p>{{ $item['value'] ?? '' }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Mapa -->
        @if($showMap && $mapAddress)
            @php
                $encodedAddress = urlencode($mapAddress);
                $mapUrl = "https://www.google.com/maps?q={$encodedAddress}&t=m&z={$mapZoom}&output=embed&iwloc=near";
            @endphp
            <div class="map-container" style="height: {{ $mapHeight }}px;">
                <iframe
                    src="{{ $mapUrl }}"
                    style="height: {{ $mapHeight }}px;"
                    class="google-map"
                    frameborder="0"
                    allowfullscreen
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
            </div>
        @endif
    </div>
</div>

<style>
.contact-block {
    width: 100%;
}

.contact-block-inner {
    max-width: 1400px;
    margin: 0 auto;
}

/* Header */
.contact-header {
    text-align: center;
    margin-bottom: 3rem;
}

.contact-title {
    font-size: var(--font-size-h1, 2.5rem);
    font-weight: var(--font-weight-h1, 700);
    font-family: var(--font-family-h1, var(--base-font-family, 'Lato', sans-serif));
    margin: 0 0 1rem 0;
    line-height: 1.2;
}

.contact-subtitle {
    font-size: var(--font-size-p, 1.1rem);
    font-weight: var(--font-weight-p, 400);
    font-family: var(--font-family-p, var(--base-font-family, 'Lato', sans-serif));
    color: #666;
    margin: 0;
    max-width: 600px;
    margin: 0 auto;
}

/* Grid */
.contact-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

/* Tarjetas */
.contact-card {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.contact-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
}

.card-icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
    font-size: 2rem;
}

.card-title {
    font-size: var(--font-size-h3, 1.25rem);
    font-weight: var(--font-weight-h3, 600);
    font-family: var(--font-family-h3, var(--base-font-family, 'Lato', sans-serif));
    margin: 0 0 1rem 0;
    color: #333;
}

.card-content {
    font-size: var(--font-size-p, 1rem);
    font-family: var(--font-family-p, var(--base-font-family, 'Lato', sans-serif));
    line-height: 1.6;
    color: #666;
}

.card-content p {
    margin: 0.25rem 0;
}

.contact-link {
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.contact-link:hover {
    text-decoration: underline;
    opacity: 0.8;
}

.hours-item {
    margin: 0.5rem 0;
    padding: 0.5rem;
    background: #f8f9fa;
    border-radius: 6px;
}

/* Social Links */
.social-links {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.social-link {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-size: 1.2rem;
    transition: all 0.3s ease;
}

.social-link:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    opacity: 0.9;
}

/* Mapa */
.map-container {
    margin-top: 3rem;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.google-map {
    width: 100%;
    border: 0;
}

/* Responsive */
@media (max-width: 768px) {
    .contact-title {
        font-size: 2rem;
    }

    .contact-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
}
</style>
