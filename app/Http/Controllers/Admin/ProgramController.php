<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    public function index() { return view('admin.programs.index', ['programs' => Program::orderBy('order')->get()]); }
    public function create() { return view('admin.programs.form', ['program' => new Program()]); }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = Str::slug($request->title);
        if ($request->hasFile('image')) $data['image_path'] = $request->file('image')->store('programs', 'cloudinary');
        Program::create($data);
        return redirect()->route('admin.programs.index')->with('success', 'Program created.');
    }

    public function edit(Program $program) { return view('admin.programs.form', compact('program')); }

    public function update(Request $request, Program $program)
    {
        $data = $this->validated($request);
        if ($request->hasFile('image')) $data['image_path'] = $request->file('image')->store('programs', 'cloudinary');
        $program->update($data);
        return redirect()->route('admin.programs.index')->with('success', 'Program updated.');
    }

    public function destroy(Program $program) { $program->delete(); return back()->with('success', 'Program deleted.'); }

    private function validated(Request $request): array
    {
        return $request->validate([
            'pillar_id' => 'nullable|exists:pillars,id',
            'title' => 'required|string|max:255',
            'is_flagship' => 'boolean',
            'summary' => 'nullable|string',
            'body' => 'nullable|string',
            'order' => 'nullable|integer',
            'published' => 'boolean',
        ]);
    }
}

