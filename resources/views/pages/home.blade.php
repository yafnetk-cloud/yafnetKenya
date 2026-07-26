@extends('layouts.app')
@section('title', 'YAFNET — Empowering Youth. Building Peace. Transforming ASAL Communities.')

@push('head')
<style>
    @keyframes floatSlow { 0%, 100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-14px) rotate(3deg); } }
    .float-slow { animation: floatSlow 6s ease-in-out infinite; }
    @keyframes pulseGlow { 0%, 100% { box-shadow: 0 0 0 0 rgba(217,164,65,.5); } 70% { box-shadow: 0 0 0 16px rgba(217,164,65,0); } }
    .pulse-glow { animation: pulseGlow 2.6s cubic-bezier(.4,0,.6,1) infinite; }
    .gradient-text {
        background: linear-gradient(90deg, #F0C878, #D9A441 40%, #F0C878);
        background-size: 200% auto;
        -webkit-background-clip: text; background-clip: text; color: transparent;
        animation: gradientShift 5s ease infinite;
    }
    @keyframes gradientShift { 0% { background-position: 0% center; } 100% { background-position: 200% center; } }
    .marquee-fade {
        -webkit-mask-image: linear-gradient(90deg, transparent, black 8%, black 92%, transparent);
        mask-image: linear-gradient(90deg, transparent, black 8%, black 92%, transparent);
    }
    .ticker-track { display: flex; gap: 3rem; width: max-content; animation: marquee 22s linear infinite; }
    .ticker-track:hover { animation-play-state: paused; }
    .word-reveal span { display: inline-block; opacity: 0; transform: translateY(100%); animation: wordUp .7s cubic-bezier(.22,1,.36,1) forwards; }
    @keyframes wordUp { to { opacity: 1; transform: translateY(0); } }
    .dot-grid { background-image: radial-gradient(rgba(217,164,65,.35) 1.5px, transparent 1.5px); background-size: 20px 20px; }
</style>
@endpush

@section('content')
{{-- ============ HERO ============ --}}
<section class="relative text-white overflow-hidden"
    style="@if($heroImage) background-image: linear-gradient(180deg, rgba(6,24,41,.72), rgba(6,24,41,.93)), url('{{ cloudinary_image_url($heroImage) }}'); background-size: cover; background-position: center; @else background: linear-gradient(135deg, #0B2545 0%, #13355F 60%, #0B2545 100%); @endif"
    <div class="absolute inset-0 overflow-hidden" data-parallax="0.12">
        <div class="hero-orb w-72 h-72 bg-gold top-10 -left-10 float-slow"></div>
        <div class="hero-orb w-96 h-96 bg-navy-light top-1/3 -right-20 float-slow" style="animation-delay:1.5s"></div>
        <div class="hero-orb w-56 h-56 bg-gold/60 bottom-0 left-1/3 float-slow" style="animation-delay:3s"></div>
    </div>
    <div class="grain"></div>

    <div class="relative max-w-5xl mx-auto px-6 py-32 md:py-48 text-center">
        <span class="kicker text-gold reveal is-visible justify-center">Youth Action Forum for Networking</span>

        <h1 class="font-heading text-4xl md:text-6xl font-800 leading-tight mt-5 word-reveal">
            <span style="animation-delay:.05s">Empowering</span> <span style="animation-delay:.15s">Youth.</span>
            <span class="gradient-text" style="animation-delay:.25s">Building</span> <span class="gradient-text" style="animation-delay:.35s">Peace.</span><br class="hidden md:block">
            <span style="animation-delay:.45s">Transforming</span> <span style="animation-delay:.55s">ASAL</span> <span style="animation-delay:.65s">Communities.</span>
        </h1>

        <p class="mt-6 text-lg text-white/80 max-w-2xl mx-auto reveal is-visible" style="transition-delay:.7s">
            YAFNET works across Kenya's Arid and Semi-Arid Lands — from Moyale to the border counties — equipping young people with digital skills and pathways to peace.
        </p>

        <div class="mt-9 flex flex-wrap gap-4 justify-center reveal is-visible" style="transition-delay:.85s">
            <a href="{{ route('get-involved') }}#donate" data-magnetic class="btn-glow btn-lift pulse-glow bg-gold text-navy font-semibold px-8 py-3.5 rounded-full">Donate</a>
            <a href="{{ route('get-involved') }}" data-magnetic class="btn-lift border border-white/30 px-8 py-3.5 rounded-full hover:bg-white/10 transition">Get Involved</a>
        </div>

        <div class="mt-16 flex justify-center reveal is-visible" style="transition-delay:1s">
            <svg class="w-5 h-5 text-white/50 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
        </div>
    </div>

    {{-- Ambient ticker strip — always moving, not scroll-triggered --}}
    <div class="relative border-t border-white/10 bg-black/20 py-3 marquee-fade overflow-hidden">
        <div class="ticker-track text-xs uppercase tracking-widest text-white/60">
            @foreach(array_merge(range(1,2)) as $loop)
                <span class="flex items-center gap-2">✦ Digital &amp; AI Literacy</span>
                <span class="flex items-center gap-2">✦ Conflict Early-Warning</span>
                <span class="flex items-center gap-2">✦ Livelihood Pathways</span>
                <span class="flex items-center gap-2">✦ Cross-Border Peace Dialogue</span>
                <span class="flex items-center gap-2">✦ Youth-Led Innovation</span>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ STATS ============ --}}
<section class="max-w-7xl mx-auto px-6 py-20 grid grid-cols-2 md:grid-cols-4 gap-6 text-center" data-stagger>
    @forelse($stats as $stat)
        <div class="reveal-scale group relative rounded-2xl border border-navy/10 bg-white/70 backdrop-blur py-9 px-4 overflow-hidden card-hover">
            <div class="absolute inset-x-0 bottom-0 h-0 bg-gradient-to-t from-gold/10 to-transparent group-hover:h-full transition-all duration-500"></div>
            <div class="relative font-heading text-4xl md:text-5xl font-800 text-navy" data-counter="{{ $stat->value }}">0</div>
            <div class="relative text-sm text-navy/60 mt-2">{{ $stat->label }}{{ $stat->suffix }}</div>
            <div class="relative w-8 h-0.5 bg-gold mx-auto mt-4 scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
        </div>
    @empty
        <p class="col-span-4 text-navy/50">Impact stats will appear here once added in the admin panel.</p>
    @endforelse
</section>

{{-- ============ FIVE PILLARS ============ --}}
<section class="bg-white py-24 relative overflow-hidden">
    <div class="absolute inset-0 -z-10 dot-grid opacity-30" style="mask-image: radial-gradient(600px 400px at 90% 0%, black, transparent);"></div>
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16 reveal">
            <span class="kicker text-gold justify-center">What we do</span>
            <h2 class="font-heading text-3xl md:text-5xl font-800 mt-3">Our Five Pillars</h2>
            <p class="text-navy/60 max-w-2xl mx-auto mt-4">Integrated programming across peacebuilding, education, empowerment and protection — five pillars, one mission.</p>
        </div>

        @php
            $pillarIcons = [
                'peacebuilding-social-cohesion' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
                'education-skills-development' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14zm0 0v7.5"/>',
                'youth-empowerment' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
                'women-empowerment' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 15a5 5 0 100-10 5 5 0 000 10zm0 0v6m-3 0h6"/>',
                'child-protection-development' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
            ];
            $fallbackIcon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 0c2.5 2.7 4 6.1 4 10s-1.5 7.3-4 10c-2.5-2.7-4-6.1-4-10s1.5-7.3 4-10zM2.5 9h19M2.5 15h19"/>';
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-5" data-stagger>
            @forelse($pillars as $i => $pillar)
                <a href="{{ route('programs.index') }}"
                   class="reveal group relative block rounded-3xl border border-navy/10 bg-white p-7 overflow-hidden transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_35px_70px_-30px_rgba(11,37,69,0.45)] hover:border-transparent">

                    <span class="absolute -top-3 -right-2 font-heading font-800 text-7xl text-navy/[.04] group-hover:text-gold/10 transition-colors duration-500 select-none">
                        {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                    </span>

                    <div class="absolute inset-0 bg-gradient-to-br from-navy to-navy-dark opacity-0 group-hover:opacity-100 transition-opacity duration-500 -z-0"></div>

                    <div class="relative z-10">
                        <div class="w-14 h-14 rounded-2xl bg-gold/10 group-hover:bg-gold flex items-center justify-center mb-6 transition-all duration-500 group-hover:rotate-6 group-hover:scale-110">
                            <svg class="w-7 h-7 text-gold-dark group-hover:text-navy transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $pillarIcons[$pillar->slug] ?? $fallbackIcon !!}
                            </svg>
                        </div>
                        <h3 class="font-heading font-700 text-lg text-navy group-hover:text-white transition-colors duration-500 leading-snug">{{ $pillar->title }}</h3>
                        <p class="text-sm text-navy/60 group-hover:text-white/70 mt-3 leading-relaxed transition-colors duration-500">{{ $pillar->summary }}</p>
                        <span class="inline-flex items-center gap-1.5 text-gold text-xs font-bold mt-6 uppercase tracking-wide">
                            Explore
                            <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </span>
                    </div>
                </a>
            @empty
                <p class="col-span-5 text-navy/50">Pillars will appear here once added in the admin panel.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- ============ FLAGSHIP PROGRAM ============ --}}
@if($flagship)
<section class="bg-navy text-white py-24 relative overflow-hidden">
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-gold/10 blur-3xl float-slow"></div>
    <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-gold/5 blur-3xl float-slow" style="animation-delay:2s"></div>
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center relative">
        <div class="reveal-left">
            <span class="kicker text-gold">Flagship Program</span>
            <h2 class="font-heading text-3xl md:text-4xl font-700 mt-4 mb-4">{{ $flagship->title }}</h2>
            <p class="text-white/75 leading-relaxed">{{ $flagship->summary }}</p>

            @if($flagship->components)
                <div class="flex flex-wrap gap-2 mt-6">
                    @foreach($flagship->components as $c)
                        <span class="text-xs font-medium bg-white/10 border border-white/15 rounded-full px-3 py-1.5">{{ $c['title'] ?? $c }}</span>
                    @endforeach
                </div>
            @endif

            <a href="{{ route('programs.show', $flagship->slug) }}" class="inline-flex items-center gap-2 mt-7 text-gold font-semibold group">
                Learn more <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
        <div class="reveal-right reveal-scale rounded-2xl overflow-hidden border border-white/10 h-64 md:h-80 img-zoom shadow-[0_40px_80px_-30px_rgba(0,0,0,0.5)]">
            @if($flagship->image_path)
                <img src="{{ cloudinary_image_url($flagship->image_path) }}" alt="{{ $flagship->title }}" class="w-full h-full object-cover">
            @else
                <div class="img-fill w-full h-full bg-gradient-to-br from-white/10 to-white/[.03] backdrop-blur-sm flex items-center justify-center text-white/30 text-xs">No image uploaded yet</div>
            @endif
        </div>
    </div>
</section>
@endif

{{-- ============ NEWS ============ --}}
<section class="max-w-7xl mx-auto px-6 py-20">
    <div class="flex items-center justify-between mb-10 reveal">
        <div>
            <span class="kicker text-gold">Stories from the field</span>
            <h2 class="font-heading text-3xl font-700 mt-3">Latest News &amp; Stories</h2>
        </div>
        <a href="{{ route('news.index') }}" class="text-gold font-semibold hover:underline whitespace-nowrap inline-flex items-center gap-1.5 group">
            View all <svg class="w-3.5 h-3.5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>
    <div class="grid md:grid-cols-3 gap-8" data-stagger>
        @forelse($news as $post)
            <a href="{{ route('news.show', $post->slug) }}" class="reveal block rounded-2xl overflow-hidden border border-navy/10 card-hover bg-white">
                <div class="h-44 img-zoom relative">
                    @if($post->featured_image)
                        <img src="{{ cloudinary_image_url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="img-fill w-full h-full bg-gradient-to-br from-navy/15 to-gold/10 flex items-center justify-center text-navy/30 text-xs">No image yet</div>
                    @endif
                    <span class="absolute top-3 left-3 text-[10px] uppercase tracking-wide font-bold bg-white/90 text-navy px-2.5 py-1 rounded-full">{{ $post->category }}</span>
                </div>
                <div class="p-5">
                    <h3 class="font-heading font-semibold group-hover:text-gold transition">{{ $post->title }}</h3>
                    <p class="text-sm text-navy/60 mt-2">{{ Str::limit($post->excerpt, 90) }}</p>
                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-gold mt-4">Read story <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></span>
                </div>
            </a>
        @empty
            <p class="text-navy/50 col-span-3">News posts will appear here once published in the admin panel.</p>
        @endforelse
    </div>
</section>

{{-- ============ PARTNERS ============ --}}
@if($partners->count())
<section class="py-20 bg-slate-50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 text-center mb-12 reveal">
        <span class="kicker text-gold justify-center">Trusted alliances</span>
        <h2 class="font-heading text-3xl md:text-4xl font-800 text-navy mt-3 mb-3">Our Partners</h2>
        <p class="text-navy/60 max-w-2xl mx-auto">We work alongside government institutions, development partners, community organizations and the private sector to deliver lasting impact.</p>
    </div>

    <div class="marquee-fade overflow-hidden">
        <div class="marquee-track">
            @foreach($partners->concat($partners) as $partner)
                <div class="w-48 flex-shrink-0 flex flex-col items-center justify-center px-6 text-center group">
                    <div class="h-20 w-20 rounded-full bg-white border border-navy/10 shadow-sm flex items-center justify-center overflow-hidden transition-all duration-300 group-hover:shadow-lg group-hover:-translate-y-1">
                        @if($partner->logo_path)
                            <img src="{{ cloudinary_image_url($partner->logo_path) }}" alt="{{ $partner->name }}" class="max-h-14 max-w-[70%] object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                        @else
                            <div class="h-10 w-10 rounded-full bg-navy/5"></div>
                        @endif
                    </div>
                    <span class="mt-4 text-xs font-medium text-navy/70 leading-snug">{{ $partner->name }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ============ CTA ============ --}}
<section class="bg-gradient-to-br from-gold to-gold-dark py-20 text-center relative overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle, #061829 1px, transparent 1px); background-size: 22px 22px;"></div>
    <div class="hero-orb w-64 h-64 bg-navy/10 -top-10 -left-10 float-slow"></div>
    <div class="hero-orb w-48 h-48 bg-navy/10 -bottom-10 -right-10 float-slow" style="animation-delay:2s"></div>
    <div class="max-w-3xl mx-auto px-6 relative reveal-scale">
        <h2 class="font-heading text-3xl md:text-4xl font-700 text-navy mb-4">Partner with us. Build peace together.</h2>
        <p class="text-navy/70 max-w-xl mx-auto mb-8">Every contribution helps train more youth, fund more dialogues, and reach more ASAL communities.</p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('get-involved') }}#donate" data-magnetic class="btn-lift pulse-glow bg-navy text-white font-semibold px-8 py-3.5 rounded-full">Donate</a>
            <a href="{{ route('get-involved') }}" data-magnetic class="btn-lift border border-navy text-navy px-8 py-3.5 rounded-full hover:bg-navy hover:text-white transition">Get Involved</a>
        </div>
    </div>
</section>
@endsection



