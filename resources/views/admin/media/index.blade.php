@extends('admin.layout')
@section('title', 'Media Library')
@section('content')
<h1 class="text-2xl font-bold mb-6">Media Library</h1>
<form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data" class="bg-white rounded-xl border p-6 mb-8 flex flex-wrap gap-3 items-end">
    @csrf
    <div><label class="block text-sm font-medium mb-1">File</label><input type="file" name="file" required class="text-sm"></div>
    <div><label class="block text-sm font-medium mb-1">Alt text</label><input name="alt_text" class="border rounded-lg px-3 py-2 text-sm"></div>
    <button class="bg-[#0B2545] text-white font-semibold px-6 py-2.5 rounded-lg">Upload</button>
</form>
<div class="grid grid-cols-2 md:grid-cols-6 gap-4">
    @forelse($items as $item)
        <div class="bg-white border rounded-lg p-3 text-center">
            <div class="h-20 bg-gray-100 rounded mb-2"></div>
            <div class="text-xs truncate">{{ $item->title }}</div>
            <form action="{{ route('admin.media.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete?')" class="mt-1">
                @csrf @method('DELETE')<button class="text-red-600 text-xs">Delete</button>
            </form>
        </div>
    @empty<p class="col-span-6 text-sm text-gray-400">No media uploaded yet.</p>@endforelse
</div>
<div class="mt-6">{{ $items->links() }}</div>
@endsection

