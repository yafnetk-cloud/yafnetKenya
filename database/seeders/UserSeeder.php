<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@yafnet.org'],
            ['name' => 'YAFNET Super Admin', 'password' => Hash::make('ChangeMe123!'), 'role' => 'super_admin']
        );
        User::updateOrCreate(
            ['email' => 'editor@yafnet.org'],
            ['name' => 'YAFNET Content Editor', 'password' => Hash::make('ChangeMe123!'), 'role' => 'editor']
        );
    }
}
