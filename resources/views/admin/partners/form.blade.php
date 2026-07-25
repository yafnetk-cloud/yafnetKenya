@extends('admin.layout')
@section('title', $partner->exists ? 'Edit Partner' : 'New Partner')
@section('content')
<h1 class="text-2xl font-bold mb-6">{{ $partner->exists ? 'Edit' : 'New' }} Partner</h1>
<form method="POST" action="{{ $partner->exists ? route('admin.partners.update', $partner) : route('admin.partners.store') }}" enctype="multipart/form-data" class="bg-white rounded-xl border p-6 space-y-4">
    @csrf @if($partner->exists) @method('PUT') @endif
    <div><label class="block text-sm font-medium mb-1">Name</label><input name="name" value="{{ old('name', $partner->name) }}" required class="w-full border rounded-lg px-3 py-2 text-sm"></div>
    <div><label class="block text-sm font-medium mb-1">Category</label>
        <select name="category" class="w-full border rounded-lg px-3 py-2 text-sm">
            @foreach(['Government','UN/Development','Private Sector','Civil Society'] as $c)<option @selected(old('category',$partner->category)===$c)>{{ $c }}</option>@endforeach
        </select>
    </div>
    <div><label class="block text-sm font-medium mb-1">Website URL</label><input name="website_url" value="{{ old('website_url', $partner->website_url) }}" class="w-full border rounded-lg px-3 py-2 text-sm"></div>
    <div><label class="block text-sm font-medium mb-1">Logo</label><input type="file" name="logo" class="w-full text-sm"></div>
    <div><label class="block text-sm font-medium mb-1">Order</label><input type="number" name="order" value="{{ old('order', $partner->order) }}" class="w-full border rounded-lg px-3 py-2 text-sm"></div>
    <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="published" value="1" @checked(old('published', $partner->published ?? true))> Published</label>
    <button class="bg-[#0B2545] text-white font-semibold px-6 py-2.5 rounded-lg">Save</button>
</form>
@endsection
