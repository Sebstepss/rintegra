<div class="image-block-content">
    @if(isset($block['data']['url']))
        <figure class="image-figure">
            <img src="{{ $block['data']['url'] }}" 
                 alt="{{ $block['data']['alt'] ?? '' }}"
                 loading="lazy"
                 @if(isset($block['data']['width'])) width="{{ $block['data']['width'] }}" @endif
                 @if(isset($block['data']['height'])) height="{{ $block['data']['height'] }}" @endif>
            
            @if(isset($block['data']['caption']) && !empty($block['data']['caption']))
                <figcaption class="image-caption">
                    {{ $block['data']['caption'] }}
                </figcaption>
            @endif
        </figure>
    @endif
</div>