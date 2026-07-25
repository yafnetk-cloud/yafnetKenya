@extends('admin.layout')
@section('title', 'New Admin User')
@section('content')
<h1 class="text-2xl font-bold mb-6">New Admin User</h1>
<form method="POST" action="{{ route('admin.users.store') }}" class="bg-white rounded-xl border p-6 space-y-4">
    @csrf
    <div><label class="block text-sm font-medium mb-1">Name</label><input name="name" required class="w-full border rounded-lg px-3 py-2 text-sm"></div>
    <div><label class="block text-sm font-medium mb-1">Email</label><input type="email" name="email" required class="w-full border rounded-lg px-3 py-2 text-sm"></div>
    <div><label class="block text-sm font-medium mb-1">Password</label><input type="password" name="password" required class="w-full border rounded-lg px-3 py-2 text-sm"></div>
    <div><label class="block text-sm font-medium mb-1">Role</label>
        <select name="role" class="w-full border rounded-lg px-3 py-2 text-sm">
            <option value="editor">Editor (content only)</option>
            <option value="super_admin">Super Admin (full access)</option>
        </select>
    </div>
    <button class="bg-[#0B2545] text-white font-semibold px-6 py-2.5 rounded-lg">Create User</button>
</form>
@endsection
