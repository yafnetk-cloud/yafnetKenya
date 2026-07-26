<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\NewsPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsPostController extends Controller
{
    public function index()
    {
        return view('admin.news.index', ['posts' => NewsPost::latest()->paginate(15)]);
    }

    public function create()
    {
        return view('admin.news.form', ['post' => new NewsPost()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($request->title);
        $data['author_id'] = $request->user()->id;
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('news', 'cloudinary');
        }
        $post = NewsPost::create($data);
        ActivityLog::create(['user_id' => $request->user()->id, 'action' => 'created news post', 'subject_type' => NewsPost::class, 'subject_id' => $post->id]);
        return redirect()->route('admin.news.index')->with('success', 'News post created.');
    }

    public function edit(NewsPost $post)
    {
        return view('admin.news.form', compact('post'));
    }

    public function update(Request $request, NewsPost $post)
    {
        $data = $this->validated($request);
        // Only regenerate the slug if the title actually changed, and exclude this post from the uniqueness check.
        if ($request->title !== $post->title) {
            $data['slug'] = $this->uniqueSlug($request->title, $post->id);
        }
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('news', 'cloudinary');
        }
        $post->update($data);
        ActivityLog::create(['user_id' => $request->user()->id, 'action' => 'updated news post', 'subject_type' => NewsPost::class, 'subject_id' => $post->id]);
        return redirect()->route('admin.news.index')->with('success', 'News post updated.');
    }

    public function destroy(Request $request, NewsPost $post)
    {
        $post->delete();
        ActivityLog::create(['user_id' => $request->user()->id, 'action' => 'deleted news post', 'subject_type' => NewsPost::class, 'subject_id' => $post->id]);
        return back()->with('success', 'News post deleted.');
    }

    /**
     * Generate a slug from the title, appending -2, -3, etc. if it already
     * exists so posts with similar or identical titles never collide.
     */
    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'post';
        $slug = $base;
        $i = 2;

        while (
            NewsPost::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'excerpt' => 'nullable|string',
            'body' => 'required|string',
            'status' => 'required|in:draft,published,scheduled',
            'published_at' => 'nullable|date',
        ]);
    }
}
