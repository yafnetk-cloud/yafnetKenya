<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index() { return view('admin.team.index', ['members' => TeamMember::orderBy('group')->orderBy('order')->get()]); }
    public function create() { return view('admin.team.form', ['member' => new TeamMember()]); }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        if ($request->hasFile('photo')) $data['photo_path'] = $request->file('photo')->store('team', 'cloudinary');
        TeamMember::create($data);
        return redirect()->route('admin.team.index')->with('success', 'Team member added.');
    }

    public function edit(TeamMember $member) { return view('admin.team.form', compact('member')); }

    public function update(Request $request, TeamMember $member)
    {
        $data = $this->validated($request);
        if ($request->hasFile('photo')) $data['photo_path'] = $request->file('photo')->store('team', 'cloudinary');
        $member->update($data);
        return redirect()->route('admin.team.index')->with('success', 'Team member updated.');
    }

    public function destroy(TeamMember $member) { $member->delete(); return back()->with('success', 'Team member removed.'); }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'group' => 'required|in:founder,executive,board,program_team',
            'bio' => 'nullable|string',
            'linkedin_url' => 'nullable|url',
            'order' => 'nullable|integer',
            'published' => 'boolean',
        ]);
    }
}

