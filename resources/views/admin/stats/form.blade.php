@extends('admin.layout')
@section('title', $stat->exists ? 'Edit Stat' : 'New Stat')
@section('content')
<h1 class="text-2xl font-bold mb-6">{{ $stat->exists ? 'Edit' : 'New' }} Impact Stat</h1>
<form method="POST" action="{{ $stat->exists ? route('admin.stats.update', $stat) : route('admin.stats.store') }}" class="bg-white rounded-xl border p-6 space-y-4">
    @csrf @if($stat->exists) @method('PUT') @endif
    <div><label class="block text-sm font-medium mb-1">Label</label><input name="label" value="{{ old('label', $stat->label) }}" required class="w-full border rounded-lg px-3 py-2 text-sm"></div>
    <div><label class="block text-sm font-medium mb-1">Value</label><input type="number" name="value" value="{{ old('value', $stat->value) }}" required class="w-full border rounded-lg px-3 py-2 text-sm"></div>
    <div><label class="block text-sm font-medium mb-1">Suffix (e.g. +)</label><input name="suffix" value="{{ old('suffix', $stat->suffix) }}" class="w-full border rounded-lg px-3 py-2 text-sm"></div>
    <div><label class="block text-sm font-medium mb-1">Order</label><input type="number" name="order" value="{{ old('order', $stat->order) }}" class="w-full border rounded-lg px-3 py-2 text-sm"></div>
    <button class="bg-[#0B2545] text-white font-semibold px-6 py-2.5 rounded-lg">Save</button>
</form>
@endsection
