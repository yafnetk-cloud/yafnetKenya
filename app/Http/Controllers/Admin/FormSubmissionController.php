<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormSubmission;
use Illuminate\Http\Request;

class FormSubmissionController extends Controller
{
    public function index(Request $request)
    {
        $query = FormSubmission::latest();
        if ($request->filled('type')) $query->where('type', $request->type);
        return view('admin.submissions.index', ['submissions' => $query->paginate(20)->withQueryString()]);
    }

    public function show(FormSubmission $submission)
    {
        $submission->update(['is_read' => true]);
        return view('admin.submissions.show', compact('submission'));
    }

    public function export()
    {
        $rows = FormSubmission::all();
        $filename = 'submissions_' . now()->format('Ymd_His') . '.csv';
        $headers = ['Content-Type' => 'text/csv', 'Content-Disposition' => "attachment; filename=$filename"];

        $callback = function () use ($rows) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Type', 'Name', 'Email', 'Phone', 'Subject', 'Message', 'Submitted At']);
            foreach ($rows as $r) {
                fputcsv($out, [$r->type, $r->name, $r->email, $r->phone, $r->subject, $r->message, $r->created_at]);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function destroy(FormSubmission $submission) { $submission->delete(); return back()->with('success', 'Submission deleted.'); }
}
