<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $keys = ['contact_email', 'contact_phone', 'nairobi_hq_address', 'moyale_office_address', 'facebook_url', 'twitter_url', 'linkedin_url', 'instagram_url', 'meta_description', 'google_analytics_id'];
        $settings = collect($keys)->mapWithKeys(fn ($k) => [$k => Setting::get($k)]);
        $heroImage = Setting::get('hero_image');
        return view('admin.settings.edit', compact('settings', 'heroImage'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_image' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('hero_image')) {
            Setting::set('hero_image', $request->file('hero_image')->store('site', 'cloudinary'));
        }

        foreach ($request->except(['_token', '_method', 'hero_image']) as $key => $value) {
            Setting::set($key, $value);
        }

        return back()->with('success', 'Settings updated.');
    }
}