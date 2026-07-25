<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\FormSubmission;
use App\Models\NewsPost;
use App\Models\Partner;
use App\Models\TeamMember;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'newsCount'        => NewsPost::count(),
            'draftCount'       => NewsPost::where('status', 'draft')->count(),
            'partnerCount'     => Partner::count(),
            'teamCount'        => TeamMember::count(),
            'unreadSubmissions'=> FormSubmission::where('is_read', false)->count(),
            'recentActivity'   => ActivityLog::with('user')->latest()->take(10)->get(),
        ]);
    }
}
