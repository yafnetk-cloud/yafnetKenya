<?php
namespace Database\Seeders;

use App\Models\ImpactStat;
use Illuminate\Database\Seeder;

class ImpactStatSeeder extends Seeder
{
    public function run(): void
    {
        $stats = [
            ['label' => 'Counties Reached', 'value' => 3, 'suffix' => '', 'order' => 0],
            ['label' => 'Youth Trained', 'value' => 1200, 'suffix' => '+', 'order' => 1],
            ['label' => 'Peace Dialogues Held', 'value' => 45, 'suffix' => '+', 'order' => 2],
            ['label' => 'Partner Organizations', 'value' => 15, 'suffix' => '+', 'order' => 3],
        ];
        foreach ($stats as $s) {
            ImpactStat::updateOrCreate(['label' => $s['label']], $s);
        }
    }
}
