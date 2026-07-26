<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaItem;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index() { return view('admin.media.index', ['items' => MediaItem::latest()->paginate(24)]); }

    public function store(Request $request)
    {
        $request->validate(['file' => 'required|file|max:10240', 'alt_text' => 'nullable|string']);
        $path = $request->file('file')->store('media', 'cloudinary');
        MediaItem::create([
            'title' => $request->file('file')->getClientOriginalName(),
            'file_path' => $path,
            'type' => str_starts_with($request->file('file')->getMimeType(), 'image') ? 'image' : 'document',
            'alt_text' => $request->alt_text,
        ]);
        return back()->with('success', 'File uploaded.');
    }

    public function destroy(MediaItem $item) { $item->delete(); return back()->with('success', 'File removed.'); }
}

