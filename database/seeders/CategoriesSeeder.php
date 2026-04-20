<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categories;
use Illuminate\Support\Carbon;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['title' => 'profil', 'code' => 'PRL'],
            ['title' => 'akademik', 'code' => 'AKD'],
            ['title' => 'sdm', 'code' => 'SDM'],
            ['title' => 'media', 'code' => 'MED'],
            ['title' => 'administrasi', 'code' => 'ADM'],
        ];
        
        foreach ($data as $item) {
            Categories::create($item);
        }
    }
}
