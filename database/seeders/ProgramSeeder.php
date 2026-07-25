<?php
namespace Database\Seeders;

use App\Models\Pillar;
use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $peace = Pillar::where('slug', 'peacebuilding-social-cohesion')->first();
        $education = Pillar::where('slug', 'education-skills-development')->first();
        $women = Pillar::where('slug', 'women-empowerment')->first();
        $child = Pillar::where('slug', 'child-protection-development')->first();

        $programs = [
            [
                'pillar_id' => $peace?->id, 'title' => 'Digital Peace Corridors', 'slug' => 'digital-peace-corridors',
                'is_flagship' => true, 'order' => 0,
                'summary' => 'YAFNET\'s flagship initiative combining digital/AI literacy, conflict early-warning systems, and livelihood pathways across Moyale and the wider ASAL region.',
                'components' => [
                    ['title' => 'Digital / AI Literacy', 'description' => 'Foundational and applied digital skills training for youth.'],
                    ['title' => 'Conflict Early-Warning', 'description' => 'Community-based monitoring and rapid response systems.'],
                    ['title' => 'Livelihood Pathways', 'description' => 'Linking trained youth to income-generating opportunities.'],
                ],
                'body' => 'Digital Peace Corridors is YAFNET\'s flagship program, integrating technology, peacebuilding, and economic opportunity for youth in Kenya\'s border counties.',
            ],
            ['pillar_id' => $peace?->id, 'title' => 'Peace Ambassadors & Cross-Border Dialogue Forums', 'slug' => 'peace-ambassadors-dialogue-forums', 'is_flagship' => false, 'order' => 1, 'summary' => 'Training youth peace ambassadors and hosting cross-border dialogue forums with Ethiopia.'],
            ['pillar_id' => $education?->id, 'title' => 'YAFNET Innovation and Digital Skills Hub', 'slug' => 'innovation-digital-skills-hub', 'is_flagship' => false, 'order' => 0, 'summary' => 'A physical and virtual hub for digital skills training, mentorship and innovation projects.'],
            ['pillar_id' => $education?->id, 'title' => 'AI for Youth: Digital Futures Program', 'slug' => 'ai-for-youth-digital-futures', 'is_flagship' => true, 'order' => 1, 'summary' => 'Introducing AI literacy and applied AI skills to young people across ASAL counties.'],
            ['pillar_id' => $women?->id, 'title' => 'Women\'s Economic Resilience Cooperative', 'slug' => 'womens-economic-resilience-cooperative', 'is_flagship' => false, 'order' => 0, 'summary' => 'Cooperative savings and enterprise support for women in Moyale and Marsabit County.'],
            ['pillar_id' => $child?->id, 'title' => 'Safe Schools, Strong Futures', 'slug' => 'safe-schools-strong-futures', 'is_flagship' => false, 'order' => 0, 'summary' => 'Strengthening child protection systems within schools in conflict-affected areas.'],
            ['pillar_id' => $peace?->id, 'title' => 'Climate-Resilient Pastoralism Initiative', 'slug' => 'climate-resilient-pastoralism', 'is_flagship' => false, 'order' => 2, 'summary' => 'Supporting pastoralist communities to adapt livelihoods to a changing climate.'],
        ];

        foreach ($programs as $p) {
            Program::updateOrCreate(['slug' => $p['slug']], $p + ['published' => true]);
        }
    }
}
