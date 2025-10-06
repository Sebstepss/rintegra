<div class="map-block-content">
    @if(isset($block['data']['title']))
        <h2 class="map-title">{{ $block['data']['title'] }}</h2>
    @endif
    
    @if(isset($block['data']['embed_code']))
        <div class="map-container">
            {!! $block['data']['embed_code'] !!}
        </div>
    @elseif(isset($block['data']['address']))
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed/v1/place?key=YOUR_API_KEY&q={{ urlencode($block['data']['address']) }}"
                    width="100%" 
                    height="400" 
                    frameborder="0" 
                    style="border:0;" 
                    allowfullscreen="" 
                    aria-hidden="false" 
                    tabindex="0">
            </iframe>
        </div>
    @endif
    
    @if(isset($block['data']['address']))
        <div class="map-address">
            <p><strong>Dirección:</strong> {{ $block['data']['address'] }}</p>
        </div>
    @endif
</div>