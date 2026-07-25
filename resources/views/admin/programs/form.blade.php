@extends('admin.layout')
@section('title', $program->exists ? 'Edit Program' : 'New Program')
@section('content')
<h1 class="text-2xl font-bold mb-6">{{ $program->exists ? 'Edit' : 'New' }} Program</h1>
<form method="POST" action="{{ $program->exists ? route('admin.programs.update', $program) : route('admin.programs.store') }}" enctype="multipart/form-data" class="bg-white rounded-xl border p-6 space-y-4">
    @csrf @if($program->exists) @method('PUT') @endif
    <div><label class="block text-sm font-medium mb-1">Title</label><input name="title" value="{{ old('title', $program->title) }}" required class="w-full border rounded-lg px-3 py-2 text-sm"></div>
    <div><label class="block text-sm font-medium mb-1">Pillar ID (optional)</label><input type="number" name="pillar_id" value="{{ old('pillar_id', $program->pillar_id) }}" class="w-full border rounded-lg px-3 py-2 text-sm"></div>
    <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_flagship" value="1" @checked(old('is_flagship', $program->is_flagship))> Flagship program</label>
    <div><label class="block text-sm font-medium mb-1">Summary</label><textarea name="summary" rows="2" class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('summary', $program->summary) }}</textarea></div>
    <div><label class="block text-sm font-medium mb-1">Body</label><textarea name="body" rows="8" class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('body', $program->body) }}</textarea></div>
    <div><label class="block text-sm font-medium mb-1">Image</label><input type="file" name="image" class="w-full text-sm"></div>
    <div><label class="block text-sm font-medium mb-1">Order</label><input type="number" name="order" value="{{ old('order', $program->order) }}" class="w-full border rounded-lg px-3 py-2 text-sm"></div>
    <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="published" value="1" @checked(old('published', $program->published ?? true))> Published</label>
    <button class="bg-[#0B2545] text-white font-semibold px-6 py-2.5 rounded-lg">Save</button>
</form>
@endsection
