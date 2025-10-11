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

                        @case('spacer')
                            @include('components.blocks.spacer-block', ['block' => $block])
                            @break

                        @case('image')
                            @include('components.blocks.image-block', ['block' => $block])
                            @break

                        @case('container')
                            @include('components.blocks.container-block', ['block' => $block])
                            @break

                        @case('services')
                            @include('components.blocks.services-block', ['block' => $block])
                            @break

                        @case('team')
                            @include('components.blocks.team-block', ['block' => $block])
                            @break

                        @case('image-gallery')
                            @include('components.blocks.image-gallery-block', ['block' => $block])
                            @break

                        @case('map')
                            @include('components.blocks.map-block', ['block' => $block])
                            @break

                        @case('lead-converter')
                            @include('components.blocks.lead-converter-block', ['block' => $block])
                            @break

                        @default
                            <div style="padding: 20px; background: #fff3cd; border: 2px dashed #ffc107; margin: 10px 0; border-radius: 8px;">
                                <p style="margin: 0; color: #856404;">
                                    <strong>⚠️ Bloque no implementado:</strong> {{ $block['type'] }}
                                </p>
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
