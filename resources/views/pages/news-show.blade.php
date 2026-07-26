@extends('layouts.app')
@section('title', $post->title . ' — YAFNET')
@section('content')
<article class="max-w-3xl mx-auto px-6 py-20">
    <a href="{{ route('news.index') }}" class="text-gold text-sm font-semibold hover:underline reveal is-visible">← Back to News</a>
    <span class="kicker text-gold mt-6 reveal">{{ $post->category }}</span>
    <h1 class="font-heading text-3xl md:text-4xl font-800 mt-2 mb-4 reveal">{{ $post->title }}</h1>
    <p class="text-navy/50 text-sm mb-8 reveal">{{ optional($post->published_at)->format('F j, Y') }} · By {{ $post->author->name ?? 'YAFNET Team' }}</p>

    <div class="h-72 md:h-96 rounded-2xl overflow-hidden mb-10 reveal-scale">
        @if($post->featured_image)
            <img src="{{ \Illuminate\Support\Facades\Storage::disk('cloudinary')->url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-gradient-to-br from-navy/15 to-gold/10 flex items-center justify-center text-navy/30 text-sm">No image uploaded yet</div>
        @endif
    </div>

    <div class="prose max-w-none text-navy/80 reveal">{!! $post->body !!}</div>
</article>
@endsection

