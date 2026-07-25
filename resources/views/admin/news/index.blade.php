@extends('admin.layout')
@section('title', 'News & Stories')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">News &amp; Stories</h1>
    <a href="{{ route('admin.news.create') }}" class="bg-[#0B2545] text-white text-sm font-semibold px-4 py-2 rounded-lg">+ New Post</a>
</div>
<div class="bg-white rounded-xl border divide-y">
    @forelse($posts as $post)
        <div class="px-5 py-4 flex justify-between items-center text-sm">
            <div>
                <div class="font-semibold">{{ $post->title }}</div>
                <div class="text-gray-400 text-xs mt-1">{{ ucfirst($post->status) }} · {{ $post->category }}</div>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.news.edit', $post) }}" class="text-blue-600">Edit</a>
                <form action="{{ route('admin.news.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this post?')">
                    @csrf @method('DELETE')
                    <button class="text-red-600">Delete</button>
                </form>
            </div>
        </div>
    @empty
        <div class="px-5 py-6 text-sm text-gray-400">No posts yet.</div>
    @endforelse
</div>
<div class="mt-6">{{ $posts->links() }}</div>
@endsection
