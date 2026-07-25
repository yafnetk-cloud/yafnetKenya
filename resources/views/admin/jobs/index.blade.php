@extends('admin.layout')
@section('title', 'Jobs / Volunteering')
@section('content')
<div class="flex justify-between items-center mb-6"><h1 class="text-2xl font-bold">Jobs &amp; Opportunities</h1><a href="{{ route('admin.jobs.create') }}" class="bg-[#0B2545] text-white text-sm font-semibold px-4 py-2 rounded-lg">+ Post Opportunity</a></div>
<div class="bg-white rounded-xl border divide-y">
    @forelse($jobs as $j)
        <div class="px-5 py-4 flex justify-between items-center text-sm">
            <div><div class="font-semibold">{{ $j->title }}</div><div class="text-gray-400 text-xs">{{ $j->type }} · {{ $j->location }}</div></div>
            <div class="flex gap-3"><a href="{{ route('admin.jobs.edit', $j) }}" class="text-blue-600">Edit</a>
            <form action="{{ route('admin.jobs.destroy', $j) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="text-red-600">Delete</button></form></div>
        </div>
    @empty<div class="px-5 py-6 text-sm text-gray-400">No postings yet.</div>@endforelse
</div>
@endsection
