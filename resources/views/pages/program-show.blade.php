@extends('layouts.app')
@section('title', $program->title . ' — YAFNET')
@section('content')
<section class="max-w-4xl mx-auto px-6 py-20">
    <a href="{{ route('programs.index') }}" class="text-gold text-sm font-semibold hover:underline reveal is-visible">← Back to Programs</a>
    <h1 class="font-heading text-4xl md:text-5xl font-800 mt-4 mb-6 reveal">{{ $program->title }}</h1>

    <div class="h-72 md:h-96 rounded-2xl overflow-hidden mb-10 reveal-scale">
        @if($program->image_path)
            <img src="{{ \Illuminate\Support\Facades\Storage::disk('cloudinary')->url($program->image_path) }}" alt="{{ $program->title }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-gradient-to-br from-navy/15 to-gold/10 flex items-center justify-center text-navy/30 text-sm">No image uploaded yet</div>
        @endif
    </div>

    <p class="text-navy/70 text-lg mb-8 reveal">{{ $program->summary }}</p>

    @if($program->components)
        <div class="grid md:grid-cols-3 gap-6 mb-10" data-stagger>
            @foreach($program->components as $c)
                <div class="reveal bg-white border border-navy/10 rounded-2xl p-6 card-hover">
                    <h3 class="font-heading font-semibold mb-2">{{ $c['title'] ?? $c }}</h3>
                    <p class="text-sm text-navy/60">{{ $c['description'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
    @endif

    <div class="prose max-w-none text-navy/80 reveal">{!! $program->body !!}</div>
</section>
@endsection

