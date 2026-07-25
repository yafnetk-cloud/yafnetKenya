@extends('layouts.app')
@section('title', 'Programs — YAFNET')
@section('content')
<section class="max-w-7xl mx-auto px-6 py-20">
    <div class="reveal mb-14">
        <span class="kicker text-gold">What we do</span>
        <h1 class="font-heading text-4xl md:text-5xl font-800 mt-3 mb-4">Our Programs</h1>
        <p class="text-navy/60 max-w-2xl">Programming is organized under five pillars, each with cross-cutting attention to climate, digital transformation and inclusion.</p>
    </div>

    @forelse($pillars as $pillar)
        <div class="mb-16">
            <h2 class="font-heading text-2xl font-700 mb-4 reveal">{{ $pillar->title }}</h2>
            <p class="text-navy/60 mb-6 max-w-2xl reveal">{{ $pillar->summary }}</p>
            <div class="grid md:grid-cols-3 gap-6" data-stagger>
                @foreach($pillar->programs as $program)
                    <a href="{{ route('programs.show', $program->slug) }}" class="reveal block rounded-2xl border border-navy/10 bg-white overflow-hidden card-hover">
                        <div class="h-40 img-zoom">
                            @if($program->image_path)
                                <img src="{{ asset('storage/'.$program->image_path) }}" alt="{{ $program->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="img-fill w-full h-full bg-gradient-to-br from-navy/15 to-gold/10 flex items-center justify-center text-navy/30 text-xs">No image yet</div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="font-heading font-semibold">{{ $program->title }}</h3>
                            <p class="text-sm text-navy/60 mt-2">{{ Str::limit($program->summary, 90) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @empty
        <p class="text-navy/50">Programs will appear here once added in the admin panel.</p>
    @endforelse
</section>
@endsection 