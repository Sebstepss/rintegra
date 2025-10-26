@php
    $title = $block['title'] ?? '';
    $subtitle = $block['subtitle'] ?? '';
    $displayMode = $block['displayMode'] ?? 'cards';
    $columnsCount = $block['columnsCount'] ?? 3;
    $gap = $block['gap'] ?? 'medium';
    $padding = $block['padding'] ?? 'medium';
    $alignment = $block['alignment'] ?? 'center';
    $iconSize = $block['iconSize'] ?? 'medium';
    $backgroundColor = $block['backgroundColor'] ?? 'transparent';
    $services = $block['services'] ?? [];
    $customClass = $block['customClass'] ?? '';
    $customId = $block['customId'] ?? '';

    // Mapeo de valores
    $gapMap = ['none' => '0', 'small' => '1rem', 'medium' => '2rem', 'large' => '3rem'];
    $paddingMap = ['none' => '0', 'small' => '1rem', 'medium' => '2rem', 'large' => '3rem'];
    $iconSizeMap = ['small' => '32px', 'medium' => '48px', 'large' => '64px'];

    $gapValue = $gapMap[$gap] ?? '2rem';
    $paddingValue = $paddingMap[$padding] ?? '2rem';
    $iconSizeValue = $iconSizeMap[$iconSize] ?? '48px';

    // Generar ID único para el bloque (para scripts de tabs/accordion)
    $blockId = $customId ?: 'services-block-' . md5(json_encode($block));

    // Sanitizar ID para JavaScript (reemplazar guiones por guiones bajos)
    $jsBlockId = str_replace('-', '_', $blockId);

    // Función para construir URL de medios
    if (!function_exists('buildMediaUrl')) {
        function buildMediaUrl($url) {
            if (empty($url)) return '';
            if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
                return $url;
            }
            if (str_contains($url, 'storage/')) {
                $parts = explode('storage/', $url);
                $storagePath = end($parts);
                return asset('storage/' . $storagePath);
            }
            return asset($url);
        }
    }
@endphp

<div
    id="{{ $blockId }}"
    data-block-id="{{ $blockId }}"
    class="services-block display-mode-{{ $displayMode }} icon-size-{{ $iconSize }} align-{{ $alignment }} gap-{{ $gap }} padding-{{ $padding }} {{ $customClass }}"
    style="background-color: {{ $backgroundColor }}; padding: 6% 14%; width: 100%; min-height: 400px;"
>
    <!-- Block Title and Subtitle -->
    @if($title || $subtitle)
        <div class="services-header">
            @if($title)
                <h1 class="services-title">{{ $title }}</h1>
            @endif
            @if($subtitle)
                <p class="services-subtitle">{{ $subtitle }}</p>
            @endif
        </div>
    @endif

    <!-- Services Content -->
    @if(count($services) > 0)
        <div class="services-container">

            <!-- Tabs Mode -->
            @if($displayMode === 'tabs')
                <div class="services-tabs">
                    <!-- Tab Navigation -->
                    <div class="tabs-nav">
                        @foreach($services as $index => $service)
                            <button
                                class="tab-button {{ $index === 0 ? 'active' : '' }}"
                                onclick="switchTab{{ $jsBlockId }}({{ $index }})"
                            >
                                @if(!empty($service['icon']))
                                    <div class="tab-icon">
                                        <img src="{{ buildMediaUrl($service['icon']) }}" alt="{{ $service['title'] ?? '' }}" />
                                    </div>
                                @endif
                                <div class="tab-content">
                                    <span class="tab-title">{{ $service['title'] ?? '' }}</span>
                                    <span class="tab-description">{{ $service['shortDescription'] ?? $service['description'] ?? '' }}</span>
                                </div>
                            </button>
                        @endforeach
                    </div>

                    <!-- Tab Content -->
                    <div class="tabs-content">
                        @foreach($services as $index => $service)
                            <div class="tab-pane tab-pane-{{ $blockId }} {{ $index === 0 ? 'active' : '' }}" style="display: {{ $index === 0 ? 'block' : 'none' }};">
                                <div class="service-full-content">
                                    <div class="service-header">
                                        @if(!empty($service['icon']))
                                            <div class="service-icon">
                                                <img src="{{ buildMediaUrl($service['icon']) }}" alt="{{ $service['title'] ?? '' }}" />
                                            </div>
                                        @endif
                                        <h3 class="service-title">{{ $service['title'] ?? '' }}</h3>
                                    </div>
                                    <div class="service-description">
                                        {!! $service['longDescription'] ?? $service['description'] ?? '' !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            <!-- Accordion Mode -->
            @elseif($displayMode === 'accordion')
                <div class="services-accordion accordion-cols-{{ $columnsCount }}" style="--accordion-columns: {{ $columnsCount }};">
                    @foreach($services as $index => $service)
                        <div class="accordion-item">
                            <button
                                class="accordion-header accordion-header-{{ $blockId }}"
                                onclick="toggleAccordion{{ $jsBlockId }}({{ $index }})"
                                data-index="{{ $index }}"
                            >
                                <div class="accordion-header-content">
                                    @if(!empty($service['icon']))
                                        <div class="accordion-icon">
                                            <img src="{{ buildMediaUrl($service['icon']) }}" alt="{{ $service['title'] ?? '' }}" />
                                        </div>
                                    @endif
                                    <div class="accordion-text">
                                        <span class="accordion-title">{{ $service['title'] ?? '' }}</span>
                                        <span class="accordion-description">{{ $service['shortDescription'] ?? $service['description'] ?? '' }}</span>
                                    </div>
                                </div>
                                <div class="accordion-toggle">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </div>
                            </button>

                            <div class="accordion-content accordion-content-{{ $blockId }}" data-index="{{ $index }}" style="max-height: 0;">
                                <div class="accordion-body">
                                    <div class="service-full-content">
                                        <div class="service-description">
                                            {!! $service['longDescription'] ?? $service['description'] ?? '' !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            <!-- Cards Mode -->
            @else
                <div class="services-cards" style="grid-template-columns: repeat({{ $columnsCount }}, 1fr);">
                    @foreach($services as $service)
                        <div class="service-card">
                            <div class="card-header">
                                @if(!empty($service['icon']))
                                    <div class="card-icon">
                                        <img src="{{ buildMediaUrl($service['icon']) }}" alt="{{ $service['title'] ?? '' }}" />
                                    </div>
                                @endif
                                <h3 class="card-title">{{ $service['title'] ?? '' }}</h3>
                            </div>
                            <div class="card-description-short">{{ $service['shortDescription'] ?? $service['description'] ?? '' }}</div>
                            <div class="card-description-long">{!! $service['longDescription'] ?? '' !!}</div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    @else
        <!-- Empty State -->
        <div class="services-empty">
            <div class="empty-state">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                </svg>
                <p>No hay servicios configurados para mostrar</p>
            </div>
        </div>
    @endif
</div>

<style>
/* Base Styles */
.services-block {
    width: 100%;
    min-height: 400px;
}

/* Alignment */
.align-left { text-align: left; }
.align-center { text-align: center; }
.align-right { text-align: right; }

/* Header */
.services-header {
    margin-bottom: 2rem;
}

.services-title {
    margin: 0 0 0.5rem 0;
    font-size: 2rem;
    font-weight: 600;
    color: #2c3e50;
}

.services-subtitle {
    font-size: 1.2rem;
    color: #6c757d;
    margin: 0;
}

/* Icon Sizes */
.icon-size-small .tab-icon img,
.icon-size-small .accordion-icon img,
.icon-size-small .card-icon img,
.icon-size-small .service-icon img {
    width: 32px;
    height: 32px;
}

.icon-size-medium .tab-icon img,
.icon-size-medium .accordion-icon img,
.icon-size-medium .card-icon img,
.icon-size-medium .service-icon img {
    width: 48px;
    height: 48px;
}

.icon-size-large .tab-icon img,
.icon-size-large .accordion-icon img,
.icon-size-large .card-icon img,
.icon-size-large .service-icon img {
    width: 64px;
    height: 64px;
}

/* === TABS MODE === */
.services-tabs {
    width: 100%;
}

.tabs-nav {
    display: flex;
    flex-wrap: wrap;
    border-bottom: 2px solid #e9ecef;
    background: #f8f9fa;
    border-radius: 8px 8px 0 0;
    overflow: hidden;
}

.tab-button {
    flex: 1;
    min-width: 200px;
    padding: 1.5rem;
    border: none;
    background: transparent;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 1rem;
    text-align: left;
    border-bottom: 3px solid transparent;
}

.tab-button:hover {
    background: rgba(0, 123, 255, 0.1);
}

.tab-button.active {
    background: white;
    border-bottom-color: #007bff;
}

.tab-icon {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.tab-icon img {
    object-fit: contain;
}

.tab-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.tab-title {
    font-weight: 600;
    color: #2c3e50;
    font-size: 1.1rem;
}

.tab-description {
    color: #6c757d;
    font-size: 0.9rem;
}

.tabs-content {
    background: white;
    border-radius: 0 0 8px 8px;
    border: 1px solid #e9ecef;
    border-top: none;
}

.tab-pane {
    padding: 2rem;
}

/* === ACCORDION MODE === */
.services-accordion {
    width: 100%;
    display: grid;
    gap: 2rem;
    grid-template-columns: 1fr;
}

.services-accordion.accordion-cols-1 { grid-template-columns: 1fr; }
.services-accordion.accordion-cols-2 { grid-template-columns: repeat(2, 1fr); }
.services-accordion.accordion-cols-3 { grid-template-columns: repeat(3, 1fr); }
.services-accordion.accordion-cols-4 { grid-template-columns: repeat(4, 1fr); }

.accordion-item {
    overflow: hidden;
    margin-bottom: 0;
    transition: all 0.3s ease;
}

.accordion-header {
    background: transparent;
    width: 100%;
    padding: 1.5rem;
    border-top: none;
    border-left: none;
    border-right: none;
    border-bottom: 2px solid #d1ae6a;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: space-between;
    text-align: left;
}

.accordion-header:hover {
    background: transparent;
}

.accordion-header.active {
    color: #d1ae6a;
}

.accordion-header.active .accordion-title,
.accordion-header.active .accordion-description {
    color: #d1ae6a;
}

.accordion-header-content {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex: 1;
}

.accordion-icon {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.accordion-icon img {
    object-fit: contain;
}

.accordion-text {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.accordion-title {
    font-weight: 600;
    color: #2c3e50;
    font-size: 1.1rem;
}

.accordion-description {
    color: #6c757d;
    font-size: 0.9rem;
}

.accordion-toggle {
    margin-left: 1rem;
    color: #d1ae6a;
    transition: transform 0.3s ease;
}

.accordion-header.active .accordion-toggle {
    transform: rotate(180deg);
}

.accordion-content {
    overflow: hidden;
    transition: max-height 0.3s ease;
    background: transparent;
}

.accordion-body {
    padding: 1.5rem;
    border-top: 1px solid #e9ecef;
}

/* === CARDS MODE === */
.services-cards {
    display: grid;
    gap: 2rem;
    grid-template-columns: repeat(3, 1fr);
}

.service-card {
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 2rem;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.service-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
}

.card-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.card-icon {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card-icon img {
    object-fit: contain;
}

.card-title {
    font-weight: 600;
    color: #2c3e50;
    margin: 0;
    font-size: 1.25rem;
}

.card-description-short {
    color: #6c757d;
    margin-bottom: 1rem;
    font-size: 0.95rem;
}

.card-description-long {
    color: #495057;
}

/* === SHARED STYLES === */
.service-full-content {
    width: 100%;
}

.service-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.service-icon {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.service-icon img {
    object-fit: contain;
}

.service-title {
    font-weight: 600;
    color: #2c3e50;
    margin: 0;
    font-size: 1.5rem;
}

.service-description {
    color: #495057;
    line-height: 1.6;
}

.service-description h1,
.service-description h2,
.service-description h3,
.service-description h4,
.service-description h5,
.service-description h6 {
    color: #2c3e50;
    margin-top: 1.5rem;
    margin-bottom: 0.5rem;
}

.service-description p {
    margin-bottom: 1rem;
}

.service-description ul,
.service-description ol {
    margin-bottom: 1rem;
    padding-left: 2rem;
}

.service-description strong {
    font-weight: 600;
}

/* Empty State */
.services-empty {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 200px;
    color: #6c757d;
}

.empty-state {
    text-align: center;
}

.empty-state svg {
    margin-bottom: 1rem;
    opacity: 0.5;
}

.empty-state p {
    margin: 1rem 0 0 0;
    font-size: 1.1rem;
}

/* Responsive */
@media (max-width: 1200px) {
    .services-accordion.accordion-cols-4 {
        grid-template-columns: repeat(3, 1fr) !important;
    }

    .services-cards {
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)) !important;
    }
}

@media (max-width: 1024px) {
    .services-accordion.accordion-cols-4,
    .services-accordion.accordion-cols-3 {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 1.5rem;
    }

    .services-cards {
        grid-template-columns: repeat(2, 1fr) !important;
    }

    .tab-button {
        min-width: 150px;
        padding: 1rem;
    }
}

@media (max-width: 900px) {
    .services-accordion.accordion-cols-4,
    .services-accordion.accordion-cols-3,
    .services-accordion.accordion-cols-2 {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 1.25rem;
    }
}

@media (max-width: 768px) {
    .services-cards {
        grid-template-columns: 1fr !important;
    }

    .services-accordion.accordion-cols-4,
    .services-accordion.accordion-cols-3,
    .services-accordion.accordion-cols-2,
    .services-accordion.accordion-cols-1 {
        grid-template-columns: 1fr !important;
        gap: 1rem;
    }

    .tabs-nav {
        flex-direction: column;
    }

    .tab-button {
        min-width: auto;
        width: 100%;
    }

    .accordion-header-content {
        gap: 0.75rem;
    }

    .service-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .services-title {
        font-size: 1.75rem;
    }

    .services-subtitle {
        font-size: 1.1rem;
    }
}

@media (max-width: 480px) {
    .services-block {
        padding: 8% 6% !important;
    }

    .services-accordion {
        gap: 0.75rem;
    }

    .accordion-header {
        padding: 1rem;
    }

    .accordion-body {
        padding: 1rem;
    }

    .tab-pane {
        padding: 1rem;
    }

    .service-card {
        padding: 1.5rem;
    }
}
</style>

<script>
// Tab switching function for block {{ $jsBlockId }}
function switchTab{{ $jsBlockId }}(index) {
    const buttons = document.querySelectorAll('#{{ $blockId }} .tab-button');
    const panes = document.querySelectorAll('#{{ $blockId }} .tab-pane-{{ $blockId }}');

    buttons.forEach((btn, i) => {
        if (i === index) {
            btn.classList.add('active');
        } else {
            btn.classList.remove('active');
        }
    });

    panes.forEach((pane, i) => {
        if (i === index) {
            pane.style.display = 'block';
            pane.classList.add('active');
        } else {
            pane.style.display = 'none';
            pane.classList.remove('active');
        }
    });
}

// Accordion toggle function for block {{ $jsBlockId }}
function toggleAccordion{{ $jsBlockId }}(index) {
    const header = document.querySelector('#{{ $blockId }} .accordion-header-{{ $blockId }}[data-index="' + index + '"]');
    const content = document.querySelector('#{{ $blockId }} .accordion-content-{{ $blockId }}[data-index="' + index + '"]');

    if (!header || !content) {
        console.error('Accordion elements not found for index:', index);
        return;
    }

    const isOpen = header.classList.contains('active');

    console.log('Toggling accordion', index, 'isOpen:', isOpen);

    if (isOpen) {
        // Close
        header.classList.remove('active');
        content.style.maxHeight = '0';
    } else {
        // Open - calculate the full height including padding
        header.classList.add('active');

        // Get the inner content height
        const innerBody = content.querySelector('.accordion-body');
        if (innerBody) {
            const fullHeight = innerBody.scrollHeight;
            content.style.maxHeight = fullHeight + 'px';
            console.log('Setting max-height to:', fullHeight + 'px');
        } else {
            // Fallback
            content.style.maxHeight = content.scrollHeight + 'px';
        }
    }
}

// Initialize accordion heights on load
document.addEventListener('DOMContentLoaded', function() {
    console.log('Initializing accordion for {{ $jsBlockId }}');
    const accordionContents = document.querySelectorAll('#{{ $blockId }} .accordion-content-{{ $blockId }}');
    console.log('Found', accordionContents.length, 'accordion items');
});
</script>
