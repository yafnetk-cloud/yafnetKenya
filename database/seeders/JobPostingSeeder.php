<?php
namespace Database\Seeders;

use App\Models\JobPosting;
use Illuminate\Database\Seeder;

class JobPostingSeeder extends Seeder
{
    public function run(): void
    {
        JobPosting::updateOrCreate(
            ['title' => 'Program Officer — Digital Peace Corridors'],
            ['type' => 'Full-time', 'location' => 'Moyale, Marsabit County', 'description' => 'Coordinate delivery of the Digital Peace Corridors flagship program.', 'published' => true]
        );
    }
}
