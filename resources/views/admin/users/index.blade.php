@extends('admin.layout')
@section('title', 'Admin Users')
@section('content')
<div class="flex justify-between items-center mb-6"><h1 class="text-2xl font-bold">Admin Users</h1><a href="{{ route('admin.users.create') }}" class="bg-[#0B2545] text-white text-sm font-semibold px-4 py-2 rounded-lg">+ Add User</a></div>
<div class="bg-white rounded-xl border divide-y">
    @foreach($users as $u)
        <div class="px-5 py-4 flex justify-between items-center text-sm">
            <div><div class="font-semibold">{{ $u->name }}</div><div class="text-gray-400 text-xs">{{ $u->email }} · {{ $u->role === 'super_admin' ? 'Super Admin' : 'Editor' }}</div></div>
            @if($u->id !== auth()->id())
                <form action="{{ route('admin.users.destroy', $u) }}" method="POST" onsubmit="return confirm('Remove this user?')">@csrf @method('DELETE')<button class="text-red-600">Remove</button></form>
            @endif
        </div>
    @endforeach
</div>
@endsection

