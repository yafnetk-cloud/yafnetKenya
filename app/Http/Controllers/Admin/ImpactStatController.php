<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImpactStat;
use Illuminate\Http\Request;

class ImpactStatController extends Controller
{
    public function index() { return view('admin.stats.index', ['stats' => ImpactStat::orderBy('order')->get()]); }
    public function create() { return view('admin.stats.form', ['stat' => new ImpactStat()]); }

    public function store(Request $request)
    {
        ImpactStat::create($this->validated($request));
        return redirect()->route('admin.stats.index')->with('success', 'Stat added.');
    }

    public function edit(ImpactStat $stat) { return view('admin.stats.form', compact('stat')); }

    public function update(Request $request, ImpactStat $stat)
    {
        $stat->update($this->validated($request));
        return redirect()->route('admin.stats.index')->with('success', 'Stat updated.');
    }

    public function destroy(ImpactStat $stat) { $stat->delete(); return back()->with('success', 'Stat removed.'); }

    private function validated(Request $request): array
    {
        return $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|integer',
            'suffix' => 'nullable|string|max:10',
            'order' => 'nullable|integer',
        ]);
    }
}
