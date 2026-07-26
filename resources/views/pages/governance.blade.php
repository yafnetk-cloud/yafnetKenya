@extends('layouts.app')
@section('title', 'Governance & Leadership — YAFNET')

@push('head')
<style>
    .portrait-card { position: relative; overflow: hidden; }
    .portrait-card img { transition: transform .8s cubic-bezier(.22,1,.36,1), filter .6s ease; filter: grayscale(15%); }
    .portrait-card:hover img { transform: scale(1.06); filter: grayscale(0%); }
    .portrait-overlay {
        background: linear-gradient(180deg, transparent 40%, rgba(6,24,41,.92) 100%);
    }
    .social-chip {
        opacity: 0; transform: translateY(8px);
        transition: opacity .35s ease, transform .35s ease;
    }
    .portrait-card:hover .social-chip { opacity: 1; transform: translateY(0); }
    .avatar-ring { transition: box-shadow .35s ease, transform .35s ease; }
    .group:hover .avatar-ring { box-shadow: 0 0 0 4px #D9A441; transform: scale(1.05); }
</style>
@endpush

@section('content')
<section class="max-w-6xl mx-auto px-6 py-20">
    <div class="reveal mb-16 text-center">
        <span class="kicker text-gold justify-center">Who we are</span>
        <h1 class="font-heading text-4xl md:text-5xl font-800 mt-3">Governance &amp; Leadership</h1>
        <p class="text-navy/60 max-w-2xl mx-auto mt-4">The people steering YAFNET's mission — from the founders who started it, to the teams delivering it on the ground.</p>
    </div>

    {{-- ============ FOUNDERS — large feature cards ============ --}}
    @if($founders->count())
    <div class="mb-24">
        <div class="flex items-center gap-3 mb-8 reveal">
            <span class="w-8 h-px bg-gold"></span>
            <h2 class="font-heading text-2xl font-700">Founders</h2>
        </div>
        <div class="grid md:grid-cols-2 gap-8" data-stagger>
            @foreach($founders as $m)
                <div class="reveal group rounded-3xl border border-navy/10 bg-white overflow-hidden transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_35px_70px_-30px_rgba(11,37,69,0.4)]">
                    <div class="portrait-card aspect-[4/5] bg-navy/10">
                        @if($m->photo_path)
                            <img src="{{ cloudinary_image_url($m->photo_path) }}" alt="{{ $m->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-navy/25 text-sm">No photo uploaded yet</div>
                        @endif
                        <div class="absolute inset-0 portrait-overlay"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <h3 class="font-heading text-xl font-700 text-white">{{ $m->name }}</h3>
                            <p class="text-gold text-sm font-semibold mt-1">{{ $m->title }}</p>
                        </div>
                        @if($m->linkedin_url)
                            <a href="{{ $m->linkedin_url }}" target="_blank" rel="noopener"
                               class="social-chip absolute top-4 right-4 w-9 h-9 rounded-full bg-white/95 flex items-center justify-center hover:bg-gold transition-colors">
                                <svg class="w-4 h-4 text-navy" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 11.001-4.124 2.062 2.062 0 01-.001 4.124zM7.114 20.452H3.558V9h3.556v11.452z"/></svg>
                            </a>
                        @endif
                    </div>
                    <div class="p-6">
                        <p class="text-sm text-navy/70 leading-relaxed">{{ $m->bio }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- ============ EXECUTIVE TEAM — medium cards ============ --}}
    @if($executive->count())
    <div class="mb-24">
        <div class="flex items-center gap-3 mb-8 reveal">
            <span class="w-8 h-px bg-gold"></span>
            <h2 class="font-heading text-2xl font-700">Executive Team</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6" data-stagger>
            @foreach($executive as $m)
                <div class="reveal group rounded-2xl border border-navy/10 bg-white overflow-hidden transition-all duration-500 hover:-translate-y-1.5 hover:shadow-[0_25px_50px_-25px_rgba(11,37,69,0.4)]">
                    <div class="portrait-card aspect-square bg-navy/10">
                        @if($m->photo_path)
                            <img src="{{ cloudinary_image_url($m->photo_path) }}" alt="{{ $m->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-navy/25 text-sm">No photo uploaded yet</div>
                        @endif
                        <div class="absolute inset-0 portrait-overlay"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-5">
                            <h3 class="font-heading font-700 text-white">{{ $m->name }}</h3>
                            <p class="text-gold text-xs font-semibold mt-1">{{ $m->title }}</p>
                        </div>
                        @if($m->linkedin_url)
                            <a href="{{ $m->linkedin_url }}" target="_blank" rel="noopener"
                               class="social-chip absolute top-3 right-3 w-8 h-8 rounded-full bg-white/95 flex items-center justify-center hover:bg-gold transition-colors">
                                <svg class="w-3.5 h-3.5 text-navy" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 11.001-4.124 2.062 2.062 0 01-.001 4.124zM7.114 20.452H3.558V9h3.556v11.452z"/></svg>
                            </a>
                        @endif
                    </div>
                    @if($m->bio)
                        <div class="p-5">
                            <p class="text-sm text-navy/60 leading-relaxed">{{ $m->bio }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- ============ BOARD OF DIRECTORS — compact avatar cards ============ --}}
    @if($board->count())
    <div class="mb-24">
        <div class="flex items-center gap-3 mb-8 reveal">
            <span class="w-8 h-px bg-gold"></span>
            <h2 class="font-heading text-2xl font-700">Board of Directors</h2>
        </div>
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-5" data-stagger>
            @foreach($board as $m)
                <div class="reveal group flex items-center gap-4 bg-white border border-navy/10 rounded-2xl p-5 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="avatar-ring w-16 h-16 rounded-full overflow-hidden bg-navy/10 shrink-0 ring-2 ring-transparent">
                        @if($m->photo_path)
                            <img src="{{ cloudinary_image_url($m->photo_path) }}" alt="{{ $m->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-navy/30 font-heading font-700">{{ Str::of($m->name)->explode(' ')->map(fn($w) => $w[0] ?? '')->join('') }}</div>
                        @endif
                    </div>
                    <div class="min-w-0">
                        <h3 class="font-heading font-semibold truncate">{{ $m->name }}</h3>
                        <p class="text-sm text-gold font-semibold truncate">{{ $m->title }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- ============ PROGRAM TEAMS — compact avatar cards ============ --}}
    @if($programTeams->count())
    <div>
        <div class="flex items-center gap-3 mb-8 reveal">
            <span class="w-8 h-px bg-gold"></span>
            <h2 class="font-heading text-2xl font-700">Program Teams</h2>
        </div>
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-5" data-stagger>
            @foreach($programTeams as $m)
                <div class="reveal group flex items-center gap-4 bg-white border border-navy/10 rounded-2xl p-5 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="avatar-ring w-16 h-16 rounded-full overflow-hidden bg-navy/10 shrink-0 ring-2 ring-transparent">
                        @if($m->photo_path)
                            <img src="{{ cloudinary_image_url($m->photo_path) }}" alt="{{ $m->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-navy/30 font-heading font-700">{{ Str::of($m->name)->explode(' ')->map(fn($w) => $w[0] ?? '')->join('') }}</div>
                        @endif
                    </div>
                    <div class="min-w-0">
                        <h3 class="font-heading font-semibold truncate">{{ $m->name }}</h3>
                        <p class="text-sm text-gold font-semibold truncate">{{ $m->title }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</section>
@endsection


