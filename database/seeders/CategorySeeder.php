<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $categories = [
            ['name' => 'Atasan', 'description' => 'Pakaian bagian atas'],
            ['name' => 'Bawahan', 'description' => 'Pakaian bagian bawah'],
            ['name' => 'Luar', 'description' => 'Jaket, rompi, sweater'],
            ['name' => 'Pakaian Formal', 'description' => 'Jas, blazer, celana kain'],
            ['name' => 'Pakaian Santai', 'description' => 'Baju rumah, piyama'],
            ['name' => 'Pakaian Anak', 'description' => 'Pakaian khusus anak-anak'],
            ['name' => 'Aksesoris', 'description' => 'Topi, ikat pinggang, syal'],
            ['name' => 'Sepatu', 'description' => 'Sepatu semua jenis'],
            ['name' => 'Sandal', 'description' => 'Sandal casual dan formal'],
            ['name' => 'Tas', 'description' => 'Tas sekolah, tas kerja'],
            ['name' => 'Pakaian Muslim', 'description' => 'Gamis, koko, hijab'],
            ['name' => 'Olahraga', 'description' => 'Baju olahraga, jersey'],
            ['name' => 'Pakaian Dalam', 'description' => 'Kaos dalam, pakaian dalam'],
            ['name' => 'Batik', 'description' => 'Semua jenis batik'],
            ['name' => 'Outerwear Musim Dingin', 'description' => 'Jaket tebal, coat'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'id' => Str::uuid(),
                'name' => $category['name'],
                'description' => $category['description'],
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
