<?php
namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::set('contact_email', 'info@yafnet.org');
        Setting::set('nairobi_hq_address', 'Nairobi, Kenya');
        Setting::set('moyale_office_address', 'Moyale, Marsabit County, Kenya');
        Setting::set('meta_description', 'YAFNET — Empowering Youth. Building Peace. Transforming ASAL Communities.');
    }
}
