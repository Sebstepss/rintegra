@extends('layouts.app')

@section('title', $page->meta_description ?? $page->title)
@section('description', $page->meta_description ?? '')

@section('content')
<div class="page-container">
    {{-- Page Content Blocks from pagecontent JSON --}}
    <div class="page-content">
        @php
            $blocks = collect($page->pagecontent ?? [])->sortBy('order');
        @endphp

        @forelse($blocks as $block)
            @if(isset($block['type']))
                <div class="content-block block-{{ $block['type'] }}"
                     @if(isset($block['customId'])) id="{{ $block['customId'] }}" @endif
                     @if(isset($block['customClass'])) class="content-block block-{{ $block['type'] }} {{ $block['customClass'] }}" @endif>

                    @if(isset($block['customCSS']) && $block['customCSS'])
                        <style>{{ $block['customCSS'] }}</style>
                    @endif

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
                            <div class="unknown-block">
                                <p>Tipo de bloque no reconocido: {{ $block['type'] }}</p>
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
