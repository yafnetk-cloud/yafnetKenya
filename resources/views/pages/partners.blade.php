@extends('layouts.app')
@section('title', 'Partners — YAFNET')
@section('content')
<section class="max-w-7xl mx-auto px-6 py-20">
    <div class="reveal mb-14">
        <span class="kicker text-gold">Working together</span>
        <h1 class="font-heading text-4xl md:text-5xl font-800 mt-3">Our Partners</h1>
    </div>
    @forelse($partners as $category => $items)
        <div class="mb-12">
            <h2 class="font-heading text-xl font-700 mb-6 reveal">{{ $category }}</h2>
            <div class="flex flex-wrap gap-6" data-stagger>
                @foreach($items as $partner)
                    <a href="{{ $partner->website_url ?? '#' }}" target="_blank" rel="noopener" class="reveal w-44 bg-white border border-navy/10 rounded-xl flex flex-col items-center justify-center px-4 py-4 card-hover overflow-hidden">
                        <div class="h-14 flex items-center justify-center">
                            @if($partner->logo_path)
                                <img src="{{ asset('storage/'.$partner->logo_path) }}" alt="{{ $partner->name }}" class="max-h-14 max-w-full object-contain">
                            @else
                                <div class="h-14 w-14 rounded-full bg-navy/5 flex items-center justify-center text-navy/30 text-xs">No logo</div>
                            @endif
                        </div>
                        <span class="text-xs text-navy/60 text-center mt-3 font-medium leading-snug">{{ $partner->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    @empty
        <p class="text-navy/50">Partners will appear here once added in the admin panel.</p>
    @endforelse
</section>
@endsection
