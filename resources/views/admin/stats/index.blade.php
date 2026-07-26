@extends('admin.layout')
@section('title', 'Impact Stats')
@section('content')
<div class="flex justify-between items-center mb-6"><h1 class="text-2xl font-bold">Impact Stats</h1><a href="{{ route('admin.stats.create') }}" class="bg-[#0B2545] text-white text-sm font-semibold px-4 py-2 rounded-lg">+ Add Stat</a></div>
<div class="bg-white rounded-xl border divide-y">
    @forelse($stats as $s)
        <div class="px-5 py-4 flex justify-between items-center text-sm">
            <div><div class="font-semibold">{{ $s->value }}{{ $s->suffix }}</div><div class="text-gray-400 text-xs">{{ $s->label }}</div></div>
            <div class="flex gap-3"><a href="{{ route('admin.stats.edit', $s) }}" class="text-blue-600">Edit</a>
            <form action="{{ route('admin.stats.destroy', $s) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="text-red-600">Delete</button></form></div>
        </div>
    @empty<div class="px-5 py-6 text-sm text-gray-400">No stats yet.</div>@endforelse
</div>
@endsection

