@php
    // Usar 'items' como en Vue, con fallback a 'images' por compatibilidad
    $items = $block['items'] ?? $block['images'] ?? [];
    $columnsCount = $block['columnsCount'] ?? 3;
    $gap = $block['gap'] ?? 'medium';
    $padding = $block['padding'] ?? 'medium';
    $aspectRatio = $block['aspectRatio'] ?? 'square';
    $hoverEffect = $block['hoverEffect'] ?? 'zoom';
    $backgroundColor = $block['backgroundColor'] ?? 'transparent';

    $gapMap = ['none' => '0', 'small' => '0.5rem', 'medium' => '1rem', 'large' => '2rem'];
    $paddingMap = ['none' => '0', 'small' => '1rem 0', 'medium' => '2rem 0', 'large' => '3rem 0'];
    $aspectMap = [
        'square' => '1 / 1',
        '4:3' => '4 / 3',
        '16:9' => '16 / 9',
        '3:4' => '3 / 4',
        '9:16' => '9 / 16',
        'auto' => 'auto'
    ];

    $gapValue = $gapMap[$gap] ?? '1rem';
    $paddingValue = $paddingMap[$padding] ?? '2rem 0';
    $aspectValue = $aspectMap[$aspectRatio] ?? '1 / 1';

    // Helper para construir URL de medios
    function buildMediaUrl($src) {
        if (empty($src)) return '';
        // Si ya es una URL completa, retornarla
        if (str_starts_with($src, 'http://') || str_starts_with($src, 'https://') || str_starts_with($src, 'data:')) {
            return $src;
        }
        // Si comienza con /, es ruta absoluta del servidor
        if (str_starts_with($src, '/')) {
            return url($src);
        }
        // Asumimos que está en storage/uploads
        return url('/storage/' . ltrim($src, '/'));
    }
@endphp

<div class="image-gallery-block-content" style="padding: {{ $paddingValue }}; background-color: {{ $backgroundColor }}; width: 100%;">
    <div class="gallery-container" style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
        @if(count($items) > 0)
            <div class="gallery-grid" style="display: grid; grid-template-columns: repeat({{ $columnsCount }}, 1fr); gap: {{ $gapValue }}; width: 100%;">
                @foreach($items as $item)
                    @php
                        $imageSrc = buildMediaUrl($item['src'] ?? $item['url'] ?? '');
                        $imageAlt = $item['alt'] ?? '';
                        $imageCaption = $item['caption'] ?? '';
                        $imageLink = $item['link'] ?? '';
                        $linkTarget = $item['linkTarget'] ?? '_self';
                    @endphp

                    <div class="gallery-item hover-{{ $hoverEffect }}"
                         style="position: relative; overflow: hidden; border-radius: 8px; background: #f8f9fa; aspect-ratio: {{ $aspectValue }};">
                        @if($imageLink)
                            <a href="{{ $imageLink }}" target="{{ $linkTarget }}" class="image-wrapper" style="display: block; width: 100%; height: 100%; position: relative; text-decoration: none; color: inherit;">
                                <img src="{{ $imageSrc }}"
                                     alt="{{ $imageAlt }}"
                                     loading="lazy"
                                     class="gallery-image"
                                     style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease; display: block;">
                                @if($imageCaption)
                                    <div class="image-caption" style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.7)); color: white; padding: 2rem 1rem 1rem; font-size: 0.9rem; text-align: center; opacity: 0; transition: opacity 0.3s ease;">
                                        {{ $imageCaption }}
                                    </div>
                                @endif
                            </a>
                        @else
                            <div class="image-wrapper" style="display: block; width: 100%; height: 100%; position: relative;">
                                <img src="{{ $imageSrc }}"
                                     alt="{{ $imageAlt }}"
                                     loading="lazy"
                                     class="gallery-image"
                                     style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease; display: block;"
                                     onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZGRkIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxNiIgZmlsbD0iIzk5OSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9IjAuM2VtIj5JbWFnZW4gbm8gZGlzcG9uaWJsZTwvdGV4dD48L3N2Zz4='">
                                @if($imageCaption)
                                    <div class="image-caption" style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.7)); color: white; padding: 2rem 1rem 1rem; font-size: 0.9rem; text-align: center; opacity: 0; transition: opacity 0.3s ease;">
                                        {{ $imageCaption }}
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="gallery-empty" style="min-height: 200px; display: flex; align-items: center; justify-content: center;">
                <div class="empty-state" style="text-align: center; color: #6c757d; padding: 2rem;">
                    <i class="fas fa-images" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5; display: block;"></i>
                    <h4 style="margin: 0 0 0.5rem 0; color: #495057; font-size: 1.5rem;">Galería Vacía</h4>
                    <p style="margin: 0; font-size: 1rem;">Esta galería no tiene imágenes aún</p>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    /* Efectos hover */
    .hover-zoom:hover .gallery-image {
        transform: scale(1.05);
    }

    .hover-fade:hover .gallery-image {
        opacity: 0.8;
    }

    .hover-lift:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .gallery-item:hover .image-caption {
        opacity: 1;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .gallery-grid {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }

    @media (max-width: 768px) {
        .image-gallery-block-content {
            padding: 1rem 0.5rem !important;
        }

        .gallery-grid {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 0.75rem !important;
        }

        .gallery-container {
            padding: 0 0.5rem !important;
        }
    }

    @media (max-width: 480px) {
        .gallery-grid {
            grid-template-columns: 1fr !important;
            gap: 0.5rem !important;
        }
    }
</style>
