@php
    $url = $block['url'] ?? '';
    $alt = $block['alt'] ?? '';
    $caption = $block['caption'] ?? '';
    $width = $block['width'] ?? null;
    $height = $block['height'] ?? null;
    $alignment = $block['alignment'] ?? 'center';
    $maxWidth = $block['maxWidth'] ?? '100%';
@endphp

@if($url)
    <div class="image-block-content" style="text-align: {{ $alignment }}; padding: 2rem 0;">
        <figure class="image-figure" style="margin: 0; display: inline-block; max-width: {{ $maxWidth }};">
            <img src="{{ $url }}"
                 alt="{{ $alt }}"
                 loading="lazy"
                 style="width: 100%; height: auto; display: block; border-radius: 8px;"
                 @if($width) width="{{ $width }}" @endif
                 @if($height) height="{{ $height }}" @endif>

            @if($caption)
                <figcaption class="image-caption" style="margin-top: 0.5rem; font-size: 0.9rem; color: #6c757d; font-style: italic;">
                    {{ $caption }}
                </figcaption>
            @endif
        </figure>
    </div>
@endif