@extends('admin.layout')
@section('title', 'Form Submissions')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Form Submissions</h1>
    <a href="{{ route('admin.submissions.export') }}" class="bg-[#0B2545] text-white text-sm font-semibold px-4 py-2 rounded-lg">Export CSV</a>
</div>
<form method="GET" class="mb-6">
    <select name="type" onchange="this.form.submit()" class="border rounded-lg px-3 py-2 text-sm">
        <option value="">All types</option>
        @foreach(['contact','volunteer','partner_inquiry','donation','newsletter'] as $t)
            <option value="{{ $t }}" @selected(request('type')===$t)>{{ ucfirst(str_replace('_',' ',$t)) }}</option>
        @endforeach
    </select>
</form>
<div class="bg-white rounded-xl border divide-y">
    @forelse($submissions as $s)
        <a href="{{ route('admin.submissions.show', $s) }}" class="px-5 py-4 flex justify-between items-center text-sm hover:bg-gray-50 {{ $s->is_read ? '' : 'font-semibold' }}">
            <div><div>{{ $s->name }} — {{ ucfirst(str_replace('_',' ',$s->type)) }}</div><div class="text-gray-400 text-xs font-normal">{{ $s->email }}</div></div>
            <span class="text-gray-400 font-normal">{{ $s->created_at->diffForHumans() }}</span>
        </a>
    @empty<div class="px-5 py-6 text-sm text-gray-400">No submissions yet.</div>@endforelse
</div>
<div class="mt-6">{{ $submissions->links() }}</div>
@endsection
