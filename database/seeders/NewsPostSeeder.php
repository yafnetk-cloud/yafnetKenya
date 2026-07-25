<?php
namespace Database\Seeders;

use App\Models\NewsPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class NewsPostSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::where('role', 'super_admin')->first();
        $posts = [
            ['title' => 'YAFNET Launches Digital Peace Corridors Pilot in Moyale', 'slug' => 'digital-peace-corridors-pilot-moyale', 'category' => 'Programs', 'excerpt' => 'A new pilot phase brings digital literacy and early-warning training to youth in Moyale.', 'body' => 'Full story content goes here — edit via the admin panel.'],
            ['title' => 'Cross-Border Dialogue Forum Brings Together Kenyan and Ethiopian Youth', 'slug' => 'cross-border-dialogue-forum-2026', 'category' => 'Peacebuilding', 'excerpt' => 'Youth peace ambassadors from both sides of the border met to strengthen cooperation.', 'body' => 'Full story content goes here — edit via the admin panel.'],
        ];
        foreach ($posts as $p) {
            NewsPost::updateOrCreate(['slug' => $p['slug']], $p + ['status' => 'published', 'published_at' => now(), 'author_id' => $author?->id]);
        }
    }
}
