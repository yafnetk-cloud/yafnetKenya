<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use Illuminate\Http\Request;

class JobPostingController extends Controller
{
    public function index() { return view('admin.jobs.index', ['jobs' => JobPosting::latest()->get()]); }
    public function create() { return view('admin.jobs.form', ['job' => new JobPosting()]); }

    public function store(Request $request)
    {
        JobPosting::create($this->validated($request));
        return redirect()->route('admin.jobs.index')->with('success', 'Opportunity posted.');
    }

    public function edit(JobPosting $job) { return view('admin.jobs.form', compact('job')); }

    public function update(Request $request, JobPosting $job)
    {
        $job->update($this->validated($request));
        return redirect()->route('admin.jobs.index')->with('success', 'Opportunity updated.');
    }

    public function destroy(JobPosting $job) { $job->delete(); return back()->with('success', 'Opportunity removed.'); }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'location' => 'nullable|string|max:255',
            'description' => 'required|string',
            'closing_date' => 'nullable|date',
            'published' => 'boolean',
        ]);
    }
}
