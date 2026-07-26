@extends('admin.layout')
@section('title', 'Site Settings')
@section('content')
<h1 class="text-2xl font-bold mb-6">Site-wide Settings</h1>
<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="bg-white rounded-xl border p-6 space-y-6">
    @csrf

    <div class="pb-6 border-b">
        <label class="block text-sm font-medium mb-2">Homepage Hero Image</label>
        @if($heroImage)
            <img src="{{ cloudinary_image_url($heroImage) }}" alt="Current hero image" class="w-full max-w-md h-40 object-cover rounded-lg mb-3 border">
            <p class="text-xs text-gray-500 mb-3">Current image shown above. Upload a new file below to replace it.</p>
        @else
            <p class="text-xs text-gray-500 mb-3">No hero image uploaded yet — the homepage will use a gradient background until you add one. Recommended size: at least 1920×1080, landscape photo of youth/community/programs.</p>
        @endif
        <input type="file" name="hero_image" accept="image/*" class="text-sm">
    </div>

    @foreach($settings as $key => $value)
        <div>
            <label class="block text-sm font-medium mb-1">{{ ucwords(str_replace('_',' ',$key)) }}</label>
            <input name="{{ $key }}" value="{{ old($key, $value) }}" class="w-full border rounded-lg px-3 py-2 text-sm">
        </div>
    @endforeach
    <button class="bg-[#0B2545] text-white font-semibold px-6 py-2.5 rounded-lg">Save Settings</button>
</form>
@endsection


