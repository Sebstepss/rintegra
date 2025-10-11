@php
    // Background configuration
    $backgroundType = $block['backgroundType'] ?? 'color';
    $backgroundColor = $block['backgroundColor'] ?? 'transparent';
    $backgroundGradient = $block['backgroundGradient'] ?? ['colorStart' => '#052b1b', 'colorEnd' => '#0c6a44', 'direction' => 'to bottom'];
    $backgroundImage = $block['backgroundImage'] ?? '';
    $backgroundImageOpacity = ($block['backgroundImageOpacity'] ?? 100) / 100;

    // Padding configuration
    $padding = $block['padding'] ?? 'medium';
    $paddingMap = [
        'none' => '0',
        'small' => '2rem',
        'medium' => '4rem',
        'large' => '6rem'
    ];
    $paddingValue = $paddingMap[$padding] ?? '4rem';

    // Custom attributes
    $customId = $block['customId'] ?? '';
    $customClass = $block['customClass'] ?? '';

    // Background style
    $backgroundStyle = '';
    if ($backgroundType === 'color') {
        $backgroundStyle = "background-color: {$backgroundColor};";
    } elseif ($backgroundType === 'gradient') {
        $direction = $backgroundGradient['direction'] ?? 'to bottom';
        $colorStart = $backgroundGradient['colorStart'] ?? '#052b1b';
        $colorEnd = $backgroundGradient['colorEnd'] ?? '#0c6a44';
        $backgroundStyle = "background: linear-gradient({$direction}, {$colorStart}, {$colorEnd});";
    } elseif ($backgroundType === 'image' && $backgroundImage) {
        $backgroundStyle = "background-image: url('{$backgroundImage}'); background-size: cover; background-position: center; background-repeat: no-repeat; position: relative;";
    }
@endphp

<div class="container-block-content {{ $customClass }}"
     @if($customId) id="{{ $customId }}" @endif
     style="{{ $backgroundStyle }} padding: {{ $paddingValue }}; position: relative; width: 100%;">

    @if(isset($block['customCSS']) && $block['customCSS'])
        <style>
            {!! $block['customCSS'] !!}
        </style>
    @endif

    @if($backgroundType === 'image' && $backgroundImage)
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,{{ 1 - $backgroundImageOpacity }}); pointer-events: none;"></div>
    @endif

    <div class="container-inner" style="position: relative; z-index: 1; max-width: 1400px; margin: 0 auto;">
        @if(isset($block['children']) && is_array($block['children']) && count($block['children']) > 0)
            <div class="container-children">
                @foreach($block['children'] as $childBlock)
                    @if(isset($childBlock['type']))
                        @switch($childBlock['type'])
                            @case('text')
                                @include('components.blocks.text-block', ['block' => $childBlock])
                                @break

                            @case('banner-integra')
                                @include('components.blocks.banner-integra-block', ['block' => $childBlock])
                                @break

                            @case('cualidades')
                                @include('components.blocks.cualidades-block', ['block' => $childBlock])
                                @break

                            @case('textoy-video')
                                @include('components.blocks.textoy-video-block', ['block' => $childBlock])
                                @break

                            @case('spacer')
                                @include('components.blocks.spacer-block', ['block' => $childBlock])
                                @break

                            @case('image')
                                @include('components.blocks.image-block', ['block' => $childBlock])
                                @break

                            @case('services')
                                @include('components.blocks.services-block', ['block' => $childBlock])
                                @break

                            @case('team')
                                @include('components.blocks.team-block', ['block' => $childBlock])
                                @break

                            @case('image-gallery')
                                @include('components.blocks.image-gallery-block', ['block' => $childBlock])
                                @break

                            @case('map')
                                @include('components.blocks.map-block', ['block' => $childBlock])
                                @break

                            @case('lead-converter')
                                @include('components.blocks.lead-converter-block', ['block' => $childBlock])
                                @break

                            @default
                                <div style="padding: 20px; background: #fff3cd; border: 2px dashed #ffc107; margin: 10px 0; border-radius: 8px;">
                                    <p style="margin: 0; color: #856404;">
                                        <strong>⚠️ Bloque hijo no implementado:</strong> {{ $childBlock['type'] }}
                                    </p>
                                </div>
                        @endswitch
                    @endif
                @endforeach
            </div>
        @else
            <div style="min-height: 200px; display: flex; align-items: center; justify-content: center; color: #6c757d;">
                <div style="text-align: center; padding: 2rem;">
                    <i class="fas fa-cube" style="font-size: 3rem; opacity: 0.5; display: block; margin-bottom: 1rem;"></i>
                    <h4 style="margin: 0 0 0.5rem 0; color: #495057;">Contenedor Vacío</h4>
                    <p style="margin: 0;">Este contenedor no tiene bloques</p>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    .container-block-content {
        box-sizing: border-box;
    }

    @media (max-width: 768px) {
        .container-block-content {
            padding: 2rem 1rem !important;
        }
    }
</style>