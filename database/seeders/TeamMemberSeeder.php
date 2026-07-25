<?php
namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            ['name' => 'Ken Auma', 'title' => 'Co-Founder', 'group' => 'founder', 'order' => 0],
            ['name' => 'Beryl Achieng Omondi', 'title' => 'Co-Founder', 'group' => 'founder', 'order' => 1],
            ['name' => 'Adan A. Wako', 'title' => 'Chief Executive Officer', 'group' => 'executive', 'bio' => 'Leads YAFNET\'s strategy and operations across Kenya\'s ASAL counties, with a background in computer science, cybersecurity and AI.', 'order' => 0],
        ];
        foreach ($members as $m) {
            TeamMember::updateOrCreate(['name' => $m['name'], 'group' => $m['group']], $m + ['published' => true]);
        }
    }
}
