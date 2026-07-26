@extends('layouts.app')
@section('title', 'News & Stories — YAFNET')
@section('content')
<section class="max-w-7xl mx-auto px-6 py-20">
    <div class="reveal mb-10">
        <span class="kicker text-gold">Stories from the field</span>
        <h1 class="font-heading text-4xl md:text-5xl font-800 mt-3">News &amp; Stories</h1>
    </div>
    <form method="GET" class="flex flex-wrap gap-3 mb-10 reveal">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search news..." class="border border-navy/20 rounded-full px-4 py-2 text-sm flex-1 min-w-[200px] focus:outline-none focus:ring-2 focus:ring-gold/40">
        <select name="category" class="border border-navy/20 rounded-full px-4 py-2 text-sm">
            <option value="">All categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat }}" @selected(request('category')===$cat)>{{ $cat }}</option>
            @endforeach
        </select>
        <button class="btn-lift bg-navy text-white rounded-full px-6 py-2 text-sm font-semibold">Search</button>
    </form>
    <div class="grid md:grid-cols-3 gap-8" data-stagger>
        @forelse($posts as $post)
            <a href="{{ route('news.show', $post->slug) }}" class="reveal block rounded-2xl overflow-hidden border border-navy/10 card-hover bg-white">
                <div class="h-44 img-zoom">
                    @if($post->featured_image)
                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('cloudinary')->url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="img-fill w-full h-full bg-gradient-to-br from-navy/15 to-gold/10 flex items-center justify-center text-navy/30 text-xs">No image yet</div>
                    @endif
                </div>
                <div class="p-5">
                    <span class="text-xs uppercase tracking-wide text-gold font-semibold">{{ $post->category }}</span>
                    <h3 class="font-heading font-semibold mt-2">{{ $post->title }}</h3>
                    <p class="text-sm text-navy/60 mt-2">{{ Str::limit($post->excerpt, 90) }}</p>
                </div>
            </a>
        @empty
            <p class="text-navy/50 col-span-3">No news posts found.</p>
        @endforelse
    </div>
    <div class="mt-10">{{ $posts->links() }}</div>
</section>
@endsection

