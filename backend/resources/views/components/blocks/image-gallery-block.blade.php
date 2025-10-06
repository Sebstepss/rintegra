<div class="image-gallery-block-content">
    @if(isset($block['data']['title']))
        <h2 class="gallery-title">{{ $block['data']['title'] }}</h2>
    @endif
    
    @if(isset($block['data']['images']) && is_array($block['data']['images']))
        <div class="image-gallery">
            @foreach($block['data']['images'] as $image)
                <div class="gallery-item">
                    <img src="{{ $image['url'] ?? '' }}" 
                         alt="{{ $image['alt'] ?? '' }}"
                         loading="lazy"
                         class="gallery-image">
                    
                    @if(isset($image['caption']) && !empty($image['caption']))
                        <p class="gallery-caption">{{ $image['caption'] }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>