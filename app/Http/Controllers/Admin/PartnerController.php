<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index() { return view('admin.partners.index', ['partners' => Partner::orderBy('order')->get()]); }
    public function create() { return view('admin.partners.form', ['partner' => new Partner()]); }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        if ($request->hasFile('logo')) $data['logo_path'] = $request->file('logo')->store('partners', 'cloudinary');
        Partner::create($data);
        return redirect()->route('admin.partners.index')->with('success', 'Partner added.');
    }

    public function edit(Partner $partner) { return view('admin.partners.form', compact('partner')); }

   public function update(Request $request, Partner $partner)
{
    \Log::info('PARTNER UPDATE — has file?', ['hasFile' => $request->hasFile('logo')]);
    $data = $this->validated($request);
    if ($request->hasFile('logo')) $data['logo_path'] = $request->file('logo')->store('partners', 'cloudinary');
    \Log::info('PARTNER UPDATE — data about to save', $data);
    $partner->update($data);
    \Log::info('PARTNER UPDATE — after save', ['logo_path_in_db' => $partner->fresh()->logo_path]);
    return redirect()->route('admin.partners.index')->with('success', 'Partner updated.');
}

    public function destroy(Partner $partner) { $partner->delete(); return back()->with('success', 'Partner removed.'); }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:Government,UN/Development,Private Sector,Civil Society',
            'website_url' => 'nullable|url',
            'order' => 'nullable|integer',
            'published' => 'boolean',
        ]);
    }
}

