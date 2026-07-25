<?php
namespace App\Http\Controllers;

use App\Models\ImpactStat;
use App\Models\NewsPost;
use App\Models\Partner;
use App\Models\Pillar;
use App\Models\Program;
use App\Models\TeamMember;
use App\Models\JobPosting;
use App\Models\FormSubmission;
use App\Models\Setting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'stats'      => ImpactStat::orderBy('order')->get(),
            'pillars'    => Pillar::where('published', true)->orderBy('order')->get(),
            'flagship'   => Program::where('is_flagship', true)->where('published', true)->orderBy('order')->first(),
            'news'       => NewsPost::published()->latest('published_at')->take(3)->get(),
            'partners'   => Partner::where('published', true)->orderBy('order')->get(),
            'heroImage'  => Setting::get('hero_image'),
        ]);
    }

    public function about()
    {
        return view('pages.about');
    }

    public function programsIndex()
    {
        return view('pages.programs-index', [
            'pillars' => Pillar::where('published', true)->orderBy('order')->with('programs')->get(),
        ]);
    }

    public function programShow(Program $program)
    {
        abort_unless($program->published, 404);
        return view('pages.program-show', ['program' => $program]);
    }

    public function flagshipIndex()
    {
        return view('pages.flagship-index', [
            'programs' => Program::where('is_flagship', true)->where('published', true)->orderBy('order')->get(),
        ]);
    }

    public function whereWeWork()
    {
        return view('pages.where-we-work');
    }

    public function newsIndex(Request $request)
    {
        $query = NewsPost::published()->latest('published_at');
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }
        return view('pages.news-index', [
            'posts'      => $query->paginate(9)->withQueryString(),
            'categories' => NewsPost::published()->distinct()->pluck('category')->filter(),
        ]);
    }

    public function newsShow(NewsPost $post)
    {
        abort_unless($post->status === 'published', 404);
        return view('pages.news-show', ['post' => $post]);
    }

    public function partners()
    {
        return view('pages.partners', [
            'partners' => Partner::where('published', true)->orderBy('order')->get()->groupBy('category'),
        ]);
    }

    public function getInvolved()
    {
        return view('pages.get-involved', [
            'jobs' => JobPosting::where('published', true)->latest()->get(),
        ]);
    }

    public function governance()
    {
        return view('pages.governance', [
            'founders'  => TeamMember::where('group', 'founder')->where('published', true)->orderBy('order')->get(),
            'executive' => TeamMember::where('group', 'executive')->where('published', true)->orderBy('order')->get(),
            'board'     => TeamMember::where('group', 'board')->where('published', true)->orderBy('order')->get(),
            'programTeams' => TeamMember::where('group', 'program_team')->where('published', true)->orderBy('order')->get(),
        ]);
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function submitContact(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);
        FormSubmission::create($data + ['type' => 'contact']);
        return back()->with('success', 'Thank you — your message has been received. We will respond soon.');
    }

    public function submitVolunteer(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:50',
            'message' => 'required|string',
        ]);
        FormSubmission::create($data + ['type' => 'volunteer']);
        return back()->with('success', 'Thanks for your interest in volunteering — our team will be in touch.');
    }

    public function submitPartnerInquiry(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);
        FormSubmission::create($data + ['type' => 'partner_inquiry']);
        return back()->with('success', 'Thank you for reaching out to partner with YAFNET.');
    }

    public function newsletter(Request $request)
    {
        $data = $request->validate(['email' => 'required|email']);
        FormSubmission::create($data + ['type' => 'newsletter']);
        return back()->with('success', 'Subscribed! Thanks for joining our newsletter.');
    }
}