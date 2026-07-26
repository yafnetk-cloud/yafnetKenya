@extends('admin.layout')
@section('title', $post->exists ? 'Edit Post' : 'New Post')
@section('content')
<h1 class="text-2xl font-bold mb-6">{{ $post->exists ? 'Edit' : 'New' }} News Post</h1>
<form method="POST" action="{{ $post->exists ? route('admin.news.update', $post) : route('admin.news.store') }}" enctype="multipart/form-data" class="bg-white rounded-xl border p-6 space-y-4">
    @csrf
    @if($post->exists) @method('PUT') @endif
    <div><label class="block text-sm font-medium mb-1">Title</label><input name="title" value="{{ old('title', $post->title) }}" required class="w-full border rounded-lg px-3 py-2 text-sm"></div>
    <div><label class="block text-sm font-medium mb-1">Category</label><input name="category" value="{{ old('category', $post->category) }}" class="w-full border rounded-lg px-3 py-2 text-sm"></div>
    <div><label class="block text-sm font-medium mb-1">Excerpt</label><textarea name="excerpt" rows="2" class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('excerpt', $post->excerpt) }}</textarea></div>
    <div><label class="block text-sm font-medium mb-1">Body (rich text — wire a WYSIWYG editor like TipTap/Quill in production)</label><textarea name="body" rows="8" required class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('body', $post->body) }}</textarea></div>
    <div><label class="block text-sm font-medium mb-1">Featured Image</label><input type="file" name="featured_image" class="w-full text-sm"></div>
    <div class="grid grid-cols-2 gap-4">
        <div><label class="block text-sm font-medium mb-1">Status</label>
            <select name="status" class="w-full border rounded-lg px-3 py-2 text-sm">
                @foreach(['draft','published','scheduled'] as $s)<option value="{{ $s }}" @selected(old('status',$post->status)===$s)>{{ ucfirst($s) }}</option>@endforeach
            </select>
        </div>
        <div><label class="block text-sm font-medium mb-1">Publish Date</label><input type="datetime-local" name="published_at" value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}" class="w-full border rounded-lg px-3 py-2 text-sm"></div>
    </div>
    <button class="bg-[#0B2545] text-white font-semibold px-6 py-2.5 rounded-lg">Save</button>
</form>
@endsection

