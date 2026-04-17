<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\User::create([
            'name' => 'Administrator',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password123'),
            'image' => 'users/default.jpg',
        ]);
    
        $adminRole = \App\Models\Roles::where('name', 'admin')->first();
    
        $admin->roles()->attach($adminRole);
    }
    
}
