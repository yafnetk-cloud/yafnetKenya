@extends('admin.layout')
@section('title', 'Programs')
@section('content')
<div class="flex justify-between items-center mb-6"><h1 class="text-2xl font-bold">Programs</h1><a href="{{ route('admin.programs.create') }}" class="bg-[#0B2545] text-white text-sm font-semibold px-4 py-2 rounded-lg">+ Add Program</a></div>
<div class="bg-white rounded-xl border divide-y">
    @forelse($programs as $p)
        <div class="px-5 py-4 flex justify-between items-center text-sm">
            <div><div class="font-semibold">{{ $p->title }}</div><div class="text-gray-400 text-xs">{{ $p->is_flagship ? 'Flagship · ' : '' }}{{ $p->pillar->title ?? 'No pillar' }}</div></div>
            <div class="flex gap-3"><a href="{{ route('admin.programs.edit', $p) }}" class="text-blue-600">Edit</a>
            <form action="{{ route('admin.programs.destroy', $p) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="text-red-600">Delete</button></form></div>
        </div>
    @empty<div class="px-5 py-6 text-sm text-gray-400">No programs yet.</div>@endforelse
</div>
@endsection
