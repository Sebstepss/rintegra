@php
    $title = $block['title'] ?? '';
    $images = $block['images'] ?? [];
    $columnsCount = $block['columnsCount'] ?? 3;
    $gap = $block['gap'] ?? 'medium';
    $padding = $block['padding'] ?? 'medium';

    $gapMap = ['none' => '0', 'small' => '0.5rem', 'medium' => '1rem', 'large' => '2rem'];
    $paddingMap = ['none' => '0', 'small' => '2rem', 'medium' => '4rem', 'large' => '6rem'];

    $gapValue = $gapMap[$gap] ?? '1rem';
    $paddingValue = $paddingMap[$padding] ?? '4rem';
@endphp

<div class="image-gallery-block-content" style="padding: {{ $paddingValue }};">
    <div class="gallery-container" style="max-width: 1400px; margin: 0 auto;">
        @if($title)
            <h2 class="gallery-title" style="text-align: center; font-size: 2rem; font-weight: 600; margin-bottom: 3rem; color: #2c3e50;">
                {{ $title }}
            </h2>
        @endif

        @if(count($images) > 0)
            <div class="image-gallery" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: {{ $gapValue }};">
                @foreach($images as $image)
                    <div class="gallery-item" style="position: relative; overflow: hidden; border-radius: 8px; aspect-ratio: 1; cursor: pointer;">
                        <img src="{{ $image['url'] ?? '' }}"
                             alt="{{ $image['alt'] ?? '' }}"
                             loading="lazy"
                             class="gallery-image"
                             style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s;">

                        @if(!empty($image['caption']))
                            <div class="gallery-caption" style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.8)); color: white; padding: 1rem; font-size: 0.9rem; opacity: 0; transition: opacity 0.3s;">
                                {{ $image['caption'] }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<style>
    .gallery-item:hover .gallery-image {
        transform: scale(1.05);
    }

    .gallery-item:hover .gallery-caption {
        opacity: 1;
    }

    @media (max-width: 768px) {
        .image-gallery-block-content {
            padding: 2rem 1rem !important;
        }

        .image-gallery {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)) !important;
        }
    }
</style>
