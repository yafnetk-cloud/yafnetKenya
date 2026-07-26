@extends('admin.layout')
@section('title', 'Partners')
@section('content')
<div class="flex justify-between items-center mb-6"><h1 class="text-2xl font-bold">Partners</h1><a href="{{ route('admin.partners.create') }}" class="bg-[#0B2545] text-white text-sm font-semibold px-4 py-2 rounded-lg">+ Add Partner</a></div>
<div class="bg-white rounded-xl border divide-y">
    @forelse($partners as $p)
        <div class="px-5 py-4 flex justify-between items-center text-sm">
            <div><div class="font-semibold">{{ $p->name }}</div><div class="text-gray-400 text-xs">{{ $p->category }}</div></div>
            <div class="flex gap-3"><a href="{{ route('admin.partners.edit', $p) }}" class="text-blue-600">Edit</a>
            <form action="{{ route('admin.partners.destroy', $p) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="text-red-600">Delete</button></form></div>
        </div>
    @empty<div class="px-5 py-6 text-sm text-gray-400">No partners yet.</div>@endforelse
</div>
@endsection

