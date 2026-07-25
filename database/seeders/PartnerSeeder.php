<?php
namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            ['name' => 'County Government of Marsabit', 'category' => 'Government', 'order' => 0],
            ['name' => 'UNDP Kenya', 'category' => 'UN/Development', 'order' => 1],
            ['name' => 'ICT Authority of Kenya', 'category' => 'Government', 'order' => 2],
            ['name' => 'Local Civil Society Network', 'category' => 'Civil Society', 'order' => 3],
        ];
        foreach ($partners as $p) {
            Partner::updateOrCreate(['name' => $p['name']], $p + ['published' => true]);
        }
    }
}
