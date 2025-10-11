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
        <slot>
            <!-- El contenido interno se renderiza aquí -->
            <!-- En el contexto de página, los bloques internos se procesan por el sistema de bloques principal -->
        </slot>
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