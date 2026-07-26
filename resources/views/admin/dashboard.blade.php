@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')
<h1 class="text-2xl font-bold mb-8">Dashboard</h1>
<div class="grid md:grid-cols-4 gap-6 mb-10">
    <div class="bg-white rounded-xl border p-6"><div class="text-3xl font-bold">{{ $newsCount }}</div><div class="text-sm text-gray-500 mt-1">News posts</div></div>
    <div class="bg-white rounded-xl border p-6"><div class="text-3xl font-bold">{{ $draftCount }}</div><div class="text-sm text-gray-500 mt-1">Drafts</div></div>
    <div class="bg-white rounded-xl border p-6"><div class="text-3xl font-bold">{{ $partnerCount }}</div><div class="text-sm text-gray-500 mt-1">Partners</div></div>
    <div class="bg-white rounded-xl border p-6"><div class="text-3xl font-bold">{{ $unreadSubmissions }}</div><div class="text-sm text-gray-500 mt-1">Unread submissions</div></div>
</div>
<h2 class="text-lg font-semibold mb-4">Recent Activity</h2>
<div class="bg-white rounded-xl border divide-y">
    @forelse($recentActivity as $log)
        <div class="px-5 py-3 text-sm flex justify-between"><span>{{ $log->user->name ?? 'System' }} {{ $log->action }}</span><span class="text-gray-400">{{ $log->created_at->diffForHumans() }}</span></div>
    @empty
        <div class="px-5 py-4 text-sm text-gray-400">No activity yet.</div>
    @endforelse
</div>
@endsection

