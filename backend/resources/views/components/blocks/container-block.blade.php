<div class="container-block-content" 
     @if(isset($block['data']['backgroundColor'])) 
         style="background-color: {{ $block['data']['backgroundColor'] }};" 
     @endif>
    
    <div class="container-inner">
        @if(isset($block['data']['blocks']) && is_array($block['data']['blocks']))
            @foreach($block['data']['blocks'] as $subBlock)
                <div class="container-sub-block block-{{ $subBlock['type'] ?? 'unknown' }}">
                    @switch($subBlock['type'] ?? '')
                        @case('text')
                            @include('components.blocks.text-block', ['block' => $subBlock])
                            @break
                            
                        @case('image')
                            @include('components.blocks.image-block', ['block' => $subBlock])
                            @break
                            
                        @default
                            <div class="unknown-sub-block">
                                Tipo de sub-bloque no reconocido: {{ $subBlock['type'] ?? 'N/A' }}
                            </div>
                    @endswitch
                </div>
            @endforeach
        @endif
    </div>
</div>