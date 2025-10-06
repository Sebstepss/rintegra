@extends('layouts.app')

@section('title', $page->seo_title ?? $page->title)
@section('description', $page->seo_description ?? '')

@section('content')
<div class="page-container">
    {{-- Featured Image --}}
    @if($page->featured_image)
        <div class="page-featured-image">
            <img src="{{ asset('storage/' . $page->featured_image) }}" 
                 alt="{{ $page->title }}"
                 loading="lazy">
        </div>
    @endif
    
    {{-- Page Title --}}
    @if(!$page->is_main_page)
        <header class="page-header">
            <h1 class="page-title">{{ $page->title }}</h1>
        </header>
    @endif
    
    {{-- Page Content Blocks --}}
    <div class="page-content">
        @forelse($page->contents as $content)
            @php
                $blockData = json_decode($content->content, true);
            @endphp
            
            @if($blockData && isset($blockData['type']))
                <div class="content-block block-{{ $blockData['type'] }}">
                    @switch($blockData['type'])
                        @case('text')
                            @include('components.blocks.text-block', ['block' => $blockData])
                            @break
                            
                        @case('image')
                            @include('components.blocks.image-block', ['block' => $blockData])
                            @break
                            
                        @case('container')
                            @include('components.blocks.container-block', ['block' => $blockData])
                            @break
                            
                        @case('services')
                            @include('components.blocks.services-block', ['block' => $blockData])
                            @break
                            
                        @case('team')
                            @include('components.blocks.team-block', ['block' => $blockData])
                            @break
                            
                        @case('image-gallery')
                            @include('components.blocks.image-gallery-block', ['block' => $blockData])
                            @break
                            
                        @case('map')
                            @include('components.blocks.map-block', ['block' => $blockData])
                            @break
                            
                        @case('banner-integra')
                            @include('components.blocks.banner-integra-block', ['block' => $blockData])
                            @break
                            
                        @case('cualidades')
                            @include('components.blocks.cualidades-block', ['block' => $blockData])
                            @break
                            
                        @case('textoy-video')
                            @include('components.blocks.textoy-video-block', ['block' => $blockData])
                            @break
                            
                        @case('lead-converter')
                            @include('components.blocks.lead-converter-block', ['block' => $blockData])
                            @break
                            
                        @case('spacer')
                            @include('components.blocks.spacer-block', ['block' => $blockData])
                            @break
                            
                        @default
                            {{-- Fallback para bloques desconocidos --}}
                            <div class="unknown-block">
                                <p>Tipo de bloque no reconocido: {{ $blockData['type'] }}</p>
                            </div>
                    @endswitch
                </div>
            @endif
        @empty
            <div class="no-content">
                <p>Esta página no tiene contenido configurado.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection