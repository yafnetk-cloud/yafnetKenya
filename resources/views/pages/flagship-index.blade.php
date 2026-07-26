@extends('layouts.app')
@section('title', 'Flagship Programs — YAFNET')
@section('content')
<section class="max-w-7xl mx-auto px-6 py-20">
    <div class="reveal mb-14">
        <span class="kicker text-gold">Leading the way</span>
        <h1 class="font-heading text-4xl md:text-5xl font-800 mt-3 mb-4">Flagship Programs</h1>
        <p class="text-navy/60 max-w-2xl">Our flagship initiatives, including Digital Peace Corridors, anchor YAFNET's work across the ASAL region.</p>
    </div>
    <div class="grid md:grid-cols-2 gap-8" data-stagger>
        @forelse($programs as $program)
            <a href="{{ route('programs.show', $program->slug) }}" class="reveal block rounded-2xl border border-navy/10 bg-white overflow-hidden card-hover">
                <div class="h-52 img-zoom">
                    @if($program->image_path)
                        <img src="{{ cloudinary_image_url($program->image_path) }}" alt="{{ $program->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="img-fill w-full h-full bg-gradient-to-br from-navy/15 to-gold/10 flex items-center justify-center text-navy/30 text-xs">No image yet</div>
                    @endif
                </div>
                <div class="p-8">
                    <h2 class="font-heading text-xl font-700 mb-3">{{ $program->title }}</h2>
                    <p class="text-sm text-navy/60">{{ $program->summary }}</p>
                </div>
            </a>
        @empty
            <p class="text-navy/50">Flagship programs will appear here once added in the admin panel.</p>
        @endforelse
    </div>
</section>
@endsection


