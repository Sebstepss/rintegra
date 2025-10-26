@php
    // Calcular la cantidad real de columnas basándose en el array
    $columnsArray = $block['columns'] ?? [];
    $columnsCount = is_array($columnsArray) ? count($columnsArray) : 1;
    $columnsCount = max(1, min(4, $columnsCount)); // Entre 1 y 4

    // Gap
    $gapValue = '2rem';
    if (isset($block['gap'])) {
        $gapValue = $block['gap'] === 'small' ? '1rem' : ($block['gap'] === 'large' ? '3rem' : ($block['gap'] === 'none' ? '0' : '2rem'));
    }

    // Padding
    $paddingValue = '2rem 0';
    if (isset($block['padding'])) {
        $paddingValue = $block['padding'] === 'small' ? '1rem 0' : ($block['padding'] === 'large' ? '3rem 0' : ($block['padding'] === 'none' ? '0' : '2rem 0'));
    }
@endphp

<div class="text-block-content"
     style="background-color: {{ $block['backgroundColor'] ?? 'transparent' }}; padding: {{ $paddingValue }}; width: 100%;">
    <div class="text-block-container" style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
        <div class="columns-container" style="display: grid; grid-template-columns: repeat({{ $columnsCount }}, 1fr); gap: {{ $gapValue }}; width: 100%;">
            @if(isset($block['columns']) && is_array($block['columns']))
                @foreach($block['columns'] as $column)
                    <div class="text-column"
                         style="background-color: {{ $column['backgroundColor'] ?? 'transparent' }}; color: {{ $column['textColor'] ?? 'inherit' }}; padding: 1rem; border-radius: 8px; min-height: 100px; display: flex; flex-direction: column; gap: 1rem;">
                        @if(isset($column['texts']) && is_array($column['texts']))
                            @foreach($column['texts'] as $text)
                                <div class="text-item">
                                    {!! $text['content'] ?? '' !!}
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<style>
    .text-block-content .text-item h1 {
        font-size: var(--font-size-h1, 2.25rem);
        font-weight: var(--font-weight-h1, 700);
        font-family: var(--font-family-h1, var(--base-font-family, 'Lato', sans-serif));
        letter-spacing: var(--letter-spacing-h1, 0px);
        line-height: 1.2;
        margin: 0 0 1rem 0;
    }

    .text-block-content .text-item h2 {
        font-size: var(--font-size-h2, 1.875rem);
        font-weight: var(--font-weight-h2, 600);
        font-family: var(--font-family-h2, var(--base-font-family, 'Lato', sans-serif));
        letter-spacing: var(--letter-spacing-h2, 0px);
        line-height: 1.3;
        margin: 0 0 1rem 0;
    }

    .text-block-content .text-item h3 {
        font-size: var(--font-size-h3, 1.5rem);
        font-weight: var(--font-weight-h3, 600);
        font-family: var(--font-family-h3, var(--base-font-family, 'Lato', sans-serif));
        letter-spacing: var(--letter-spacing-h3, 0px);
        line-height: 1.4;
        margin: 0 0 1rem 0;
    }

    .text-block-content .text-item h4 {
        font-size: var(--font-size-h4, 1.25rem);
        font-weight: var(--font-weight-h4, 600);
        font-family: var(--font-family-h4, var(--base-font-family, 'Lato', sans-serif));
        letter-spacing: var(--letter-spacing-h4, 0px);
        line-height: 1.4;
        margin: 0 0 1rem 0;
    }

    .text-block-content .text-item h5 {
        font-size: var(--font-size-h5, 1.125rem);
        font-weight: var(--font-weight-h5, 600);
        font-family: var(--font-family-h5, var(--base-font-family, 'Lato', sans-serif));
        letter-spacing: var(--letter-spacing-h5, 0px);
        line-height: 1.5;
        margin: 0 0 1rem 0;
    }

    .text-block-content .text-item h6 {
        font-size: var(--font-size-h6, 1rem);
        font-weight: var(--font-weight-h6, 600);
        font-family: var(--font-family-h6, var(--base-font-family, 'Lato', sans-serif));
        letter-spacing: var(--letter-spacing-h6, 0px);
        line-height: 1.5;
        margin: 0 0 1rem 0;
    }

    .text-block-content .text-item p {
        font-size: var(--font-size-p, 1rem);
        font-weight: var(--font-weight-p, 400);
        font-family: var(--font-family-p, var(--base-font-family, 'Lato', sans-serif));
        letter-spacing: var(--letter-spacing-p, 0px);
        line-height: 1.6;
        margin: 0 0 1rem 0;
    }

    .text-block-content .text-item strong,
    .text-block-content .text-item b {
        font-weight: 700 !important;
    }

    .text-block-content .text-item em,
    .text-block-content .text-item i {
        font-style: italic !important;
    }

    .text-block-content .text-item u {
        text-decoration: underline !important;
    }

    .text-block-content .text-item s,
    .text-block-content .text-item strike {
        text-decoration: line-through !important;
    }

    .text-block-content .text-item a {
        color: var(--color-1, #007bff);
        text-decoration: underline;
        transition: opacity 0.2s ease;
    }

    .text-block-content .text-item a:hover {
        opacity: 0.8;
    }

    .text-block-content .text-item ul,
    .text-block-content .text-item ol {
        margin: 1rem 0;
        padding-left: 2rem;
        font-family: var(--font-family-p, var(--base-font-family, 'Lato', sans-serif));
    }

    .text-block-content .text-item li {
        margin: 0.5rem 0;
        font-size: var(--font-size-p, 1rem);
    }

    @media (max-width: 1024px) {
        .text-block-content .columns-container {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }

    @media (max-width: 768px) {
        .text-block-content .columns-container {
            grid-template-columns: 1fr !important;
            gap: 1rem !important;
        }

        .text-block-container {
            padding: 0 0.5rem !important;
        }
    }
</style>
