@extends('admin.layout')
@section('title', $member->exists ? 'Edit Member' : 'New Member')
@section('content')
<h1 class="text-2xl font-bold mb-6">{{ $member->exists ? 'Edit' : 'New' }} Team Member</h1>
<form method="POST" action="{{ $member->exists ? route('admin.team.update', $member) : route('admin.team.store') }}" enctype="multipart/form-data" class="bg-white rounded-xl border p-6 space-y-4">
    @csrf @if($member->exists) @method('PUT') @endif
    <div><label class="block text-sm font-medium mb-1">Name</label><input name="name" value="{{ old('name', $member->name) }}" required class="w-full border rounded-lg px-3 py-2 text-sm"></div>
    <div><label class="block text-sm font-medium mb-1">Title</label><input name="title" value="{{ old('title', $member->title) }}" required class="w-full border rounded-lg px-3 py-2 text-sm"></div>
    <div><label class="block text-sm font-medium mb-1">Group</label>
        <select name="group" class="w-full border rounded-lg px-3 py-2 text-sm">
            @foreach(['founder'=>'Founder','executive'=>'Executive Team','board'=>'Board of Directors','program_team'=>'Program Team'] as $k=>$label)
                <option value="{{ $k }}" @selected(old('group',$member->group)===$k)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div><label class="block text-sm font-medium mb-1">Bio</label><textarea name="bio" rows="4" class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('bio', $member->bio) }}</textarea></div>
    <div><label class="block text-sm font-medium mb-1">Photo</label><input type="file" name="photo" class="w-full text-sm"></div>
    <div><label class="block text-sm font-medium mb-1">LinkedIn URL</label><input name="linkedin_url" value="{{ old('linkedin_url', $member->linkedin_url) }}" class="w-full border rounded-lg px-3 py-2 text-sm"></div>
    <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="published" value="1" @checked(old('published', $member->published ?? true))> Published</label>
    <button class="bg-[#0B2545] text-white font-semibold px-6 py-2.5 rounded-lg">Save</button>
</form>
@endsection
