@extends('admin.layout')
@section('title', 'Submission')
@section('content')
<a href="{{ route('admin.submissions.index') }}" class="text-blue-600 text-sm">← Back</a>
<h1 class="text-2xl font-bold mt-3 mb-6">{{ ucfirst(str_replace('_',' ',$submission->type)) }} Submission</h1>
<div class="bg-white rounded-xl border p-6 space-y-3 text-sm">
    <p><strong>Name:</strong> {{ $submission->name }}</p>
    <p><strong>Email:</strong> {{ $submission->email }}</p>
    <p><strong>Phone:</strong> {{ $submission->phone ?? '—' }}</p>
    <p><strong>Subject:</strong> {{ $submission->subject ?? '—' }}</p>
    <p><strong>Message:</strong></p>
    <p class="bg-gray-50 rounded-lg p-4">{{ $submission->message }}</p>
    <p class="text-gray-400 text-xs">Received {{ $submission->created_at->format('F j, Y g:i A') }}</p>
</div>
<form action="{{ route('admin.submissions.destroy', $submission) }}" method="POST" onsubmit="return confirm('Delete this submission?')" class="mt-4">
    @csrf @method('DELETE')
    <button class="text-red-600 text-sm">Delete submission</button>
</form>
@endsection
