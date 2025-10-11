@extends('layouts.public')

@section('title', $page->meta_description ?? $page->title)
@section('description', $page->meta_description ?? '')

@section('content')
<div class="page-container">
    <div class="page-content">
        @php
            $blocks = collect($page->pagecontent ?? [])->sortBy('order');
        @endphp

        @forelse($blocks as $block)
            @if(isset($block['type']))
                <div class="content-block block-{{ $block['type'] }}">
                    @switch($block['type'])
                        @case('text')
                            @include('components.blocks.text-block', ['block' => $block])
                            @break
                        @case('banner-integra')
                            @include('components.blocks.banner-integra-block', ['block' => $block])
                            @break
                        @case('cualidades')
                            @include('components.blocks.cualidades-block', ['block' => $block])
                            @break
                        @case('textoy-video')
                            @include('components.blocks.textoy-video-block', ['block' => $block])
                            @break
                        @default
                            <div style="padding: 20px; background: #f0f0f0; margin: 10px 0;">
                                <p>Bloque tipo: {{ $block['type'] }}</p>
                            </div>
                    @endswitch
                </div>
            @endif
        @empty
            <div style="padding: 40px; text-align: center;">
                <p>Esta página no tiene contenido.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
