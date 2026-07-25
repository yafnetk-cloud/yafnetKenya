<?php
namespace Database\Seeders;

use App\Models\Pillar;
use Illuminate\Database\Seeder;

class PillarSeeder extends Seeder
{
    public function run(): void
    {
        $pillars = [
            ['title' => 'Peacebuilding & Social Cohesion', 'slug' => 'peacebuilding-social-cohesion', 'summary' => 'Cross-border dialogue, early-warning systems and community reconciliation across Kenya\'s border counties.'],
            ['title' => 'Education & Skills Development', 'slug' => 'education-skills-development', 'summary' => 'Digital and vocational skills training that opens pathways to employment and self-reliance.'],
            ['title' => 'Youth Empowerment', 'slug' => 'youth-empowerment', 'summary' => 'Leadership development, civic engagement and youth-led innovation.'],
            ['title' => 'Women Empowerment', 'slug' => 'women-empowerment', 'summary' => 'Economic resilience and cooperative-based livelihood programs for women.'],
            ['title' => 'Child Protection & Development', 'slug' => 'child-protection-development', 'summary' => 'Safe schools and community structures that protect children from conflict and exploitation.'],
        ];
        foreach ($pillars as $i => $p) {
            Pillar::updateOrCreate(['slug' => $p['slug']], $p + ['order' => $i, 'published' => true]);
        }
    }
}
