<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PillarSeeder::class,
            ProgramSeeder::class,
            ImpactStatSeeder::class,
            TeamMemberSeeder::class,
            PartnerSeeder::class,
            NewsPostSeeder::class,
            JobPostingSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
