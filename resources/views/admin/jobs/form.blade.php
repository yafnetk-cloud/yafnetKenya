@extends('admin.layout')
@section('title', $job->exists ? 'Edit Opportunity' : 'New Opportunity')
@section('content')
<h1 class="text-2xl font-bold mb-6">{{ $job->exists ? 'Edit' : 'New' }} Opportunity</h1>
<form method="POST" action="{{ $job->exists ? route('admin.jobs.update', $job) : route('admin.jobs.store') }}" class="bg-white rounded-xl border p-6 space-y-4">
    @csrf @if($job->exists) @method('PUT') @endif
    <div><label class="block text-sm font-medium mb-1">Title</label><input name="title" value="{{ old('title', $job->title) }}" required class="w-full border rounded-lg px-3 py-2 text-sm"></div>
    <div><label class="block text-sm font-medium mb-1">Type</label><input name="type" value="{{ old('type', $job->type) }}" placeholder="Full-time, Volunteer, Consultancy" required class="w-full border rounded-lg px-3 py-2 text-sm"></div>
    <div><label class="block text-sm font-medium mb-1">Location</label><input name="location" value="{{ old('location', $job->location) }}" class="w-full border rounded-lg px-3 py-2 text-sm"></div>
    <div><label class="block text-sm font-medium mb-1">Description</label><textarea name="description" rows="6" required class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('description', $job->description) }}</textarea></div>
    <div><label class="block text-sm font-medium mb-1">Closing Date</label><input type="date" name="closing_date" value="{{ old('closing_date', $job->closing_date?->format('Y-m-d')) }}" class="w-full border rounded-lg px-3 py-2 text-sm"></div>
    <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="published" value="1" @checked(old('published', $job->published ?? true))> Published</label>
    <button class="bg-[#0B2545] text-white font-semibold px-6 py-2.5 rounded-lg">Save</button>
</form>
@endsection
