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

    $gapMap = ['none' => '0', 'small' => '1rem', 'medium' => '2rem', 'large' => '3rem'];
    $paddingMap = ['none' => '0', 'small' => '2rem', 'medium' => '4rem', 'large' => '6rem'];
    $iconSizeMap = ['small' => '2rem', 'medium' => '3rem', 'large' => '4rem'];

    $gapValue = $gapMap[$gap] ?? '2rem';
    $paddingValue = $paddingMap[$padding] ?? '4rem';
    $iconSizeValue = $iconSizeMap[$iconSize] ?? '3rem';
@endphp

<div class="services-block-content" style="background-color: {{ $backgroundColor }}; padding: {{ $paddingValue }}; text-align: {{ $alignment }};">
    <div class="services-container" style="max-width: 1400px; margin: 0 auto;">

        @if($title)
            <h2 class="services-title" style="font-size: 2rem; font-weight: 600; margin-bottom: 1rem; color: #2c3e50;">
                {{ $title }}
            </h2>
        @endif

        @if($subtitle)
            <p class="services-subtitle" style="font-size: 1.1rem; color: #6c757d; margin-bottom: 3rem;">
                {{ $subtitle }}
            </p>
        @endif

        @if(count($services) > 0)
            @if($displayMode === 'tabs')
                <!-- Tabs Display Mode -->
                <div class="services-tabs">
                    <div class="tabs-nav" style="display: flex; justify-content: center; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap;">
                        @foreach($services as $index => $service)
                            <button class="tab-button {{ $index === 0 ? 'active' : '' }}"
                                    onclick="switchTab({{ $index }})"
                                    style="padding: 0.75rem 1.5rem; border: 2px solid #0a5a39; background: {{ $index === 0 ? '#0a5a39' : 'white' }}; color: {{ $index === 0 ? 'white' : '#0a5a39' }}; border-radius: 50px; cursor: pointer; font-weight: 600; transition: all 0.3s;">
                                {{ $service['title'] ?? 'Servicio ' . ($index + 1) }}
                            </button>
                        @endforeach
                    </div>

                    <div class="tabs-content">
                        @foreach($services as $index => $service)
                            <div class="tab-pane {{ $index === 0 ? 'active' : '' }}" id="tab-{{ $index }}" style="display: {{ $index === 0 ? 'block' : 'none' }}; padding: 2rem; background: #f8f9fa; border-radius: 12px;">
                                <div style="display: flex; align-items: center; gap: 2rem;">
                                    @if(!empty($service['icon']))
                                        <i class="{{ $service['icon'] }}" style="font-size: {{ $iconSizeValue }}; color: #0a5a39;"></i>
                                    @endif
                                    <div>
                                        <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">{{ $service['title'] ?? '' }}</h3>
                                        <p style="color: #6c757d; margin: 0;">{{ $service['description'] ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            @elseif($displayMode === 'accordion')
                <!-- Accordion Display Mode -->
                <div class="services-accordion" style="max-width: 800px; margin: 0 auto;">
                    @foreach($services as $index => $service)
                        <div class="accordion-item" style="margin-bottom: 1rem; border: 1px solid #dee2e6; border-radius: 8px; overflow: hidden;">
                            <button class="accordion-header" onclick="toggleAccordion({{ $index }})"
                                    style="width: 100%; padding: 1.5rem; background: white; border: none; text-align: left; cursor: pointer; display: flex; align-items: center; gap: 1rem; font-size: 1.1rem; font-weight: 600;">
                                @if(!empty($service['icon']))
                                    <i class="{{ $service['icon'] }}" style="font-size: 1.5rem; color: #0a5a39;"></i>
                                @endif
                                <span style="flex: 1;">{{ $service['title'] ?? '' }}</span>
                                <i class="fas fa-chevron-down" style="transition: transform 0.3s;"></i>
                            </button>
                            <div class="accordion-content" id="accordion-{{ $index }}" style="max-height: 0; overflow: hidden; transition: max-height 0.3s;">
                                <div style="padding: 1.5rem; background: #f8f9fa;">
                                    <p style="color: #6c757d; margin: 0;">{{ $service['description'] ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            @else
                <!-- Cards Display Mode (Default) -->
                <div class="services-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: {{ $gapValue }};">
                    @foreach($services as $service)
                        <div class="service-card" style="padding: 2rem; background: white; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s, box-shadow 0.3s;">
                            @if(!empty($service['icon']))
                                <div class="service-icon" style="font-size: {{ $iconSizeValue }}; color: #0a5a39; margin-bottom: 1rem;">
                                    <i class="{{ $service['icon'] }}"></i>
                                </div>
                            @endif

                            <h3 class="service-title" style="font-size: 1.3rem; font-weight: 600; margin-bottom: 0.75rem; color: #2c3e50;">
                                {{ $service['title'] ?? '' }}
                            </h3>

                            <p class="service-description" style="color: #6c757d; line-height: 1.6; margin: 0;">
                                {{ $service['description'] ?? '' }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
</div>

<style>
    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .tab-button:hover {
        opacity: 0.8;
    }

    @media (max-width: 768px) {
        .services-block-content {
            padding: 2rem 1rem !important;
        }

        .services-grid {
            grid-template-columns: 1fr !important;
        }
    }
</style>

<script>
function switchTab(index) {
    document.querySelectorAll('.tab-button').forEach((btn, i) => {
        btn.style.background = i === index ? '#0a5a39' : 'white';
        btn.style.color = i === index ? 'white' : '#0a5a39';
    });
    document.querySelectorAll('.tab-pane').forEach((pane, i) => {
        pane.style.display = i === index ? 'block' : 'none';
    });
}

function toggleAccordion(index) {
    const content = document.getElementById('accordion-' + index);
    const icon = content.previousElementSibling.querySelector('.fa-chevron-down');
    if (content.style.maxHeight && content.style.maxHeight !== '0px') {
        content.style.maxHeight = '0';
        icon.style.transform = 'rotate(0deg)';
    } else {
        content.style.maxHeight = content.scrollHeight + 'px';
        icon.style.transform = 'rotate(180deg)';
    }
}
</script>