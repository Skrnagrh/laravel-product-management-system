<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    // public function run()
    // {
    //     $categories = Category::pluck('id');
    //     $suppliers = Supplier::pluck('id');

    //     if ($categories->isEmpty() || $suppliers->isEmpty()) {
    //         $this->command->warn('Seeder dibatalkan: kategori atau supplier belum tersedia.');
    //         return;
    //     }

    //     $products = [
    //         [
    //             'name' => 'Kaos Polos Katun',
    //             'price' => 50000,
    //         ],
    //         [
    //             'name' => 'Kemeja Flanel',
    //             'price' => 120000,
    //         ],
    //         [
    //             'name' => 'Jaket Hoodie',
    //             'price' => 150000,
    //         ],
    //         [
    //             'name' => 'Celana Jeans Slim Fit',
    //             'price' => 180000,
    //         ],
    //         [
    //             'name' => 'Rok Plisket',
    //             'price' => 75000,
    //         ],
    //     ];

    //     foreach ($products as $product) {
    //         Product::create([
    //             'id' => (string) Str::uuid(),
    //             'name' => $product['name'],
    //             'price' => $product['price'],
    //             'category_id' => $categories->random(),
    //             'supplier_id' => $suppliers->random(),
    //             'metadata' => ['tags' => ['pakaian', 'fashion']],
    //             'is_active' => true,
    //             'available_since' => now(),
    //         ]);
    //     }
    // }
    public function run()
    {
        $categories = Category::pluck('id');
        $suppliers = Supplier::pluck('id');

        if ($categories->isEmpty() || $suppliers->isEmpty()) {
            $this->command->warn('Seeder dibatalkan: kategori atau supplier belum tersedia.');
            return;
        }

        $products = [
            ['name' => 'Kaos Polos Katun', 'price' => 50000],
            ['name' => 'Kemeja Flanel', 'price' => 120000],
            ['name' => 'Jaket Hoodie', 'price' => 150000],
            ['name' => 'Celana Jeans Slim Fit', 'price' => 180000],
            ['name' => 'Rok Plisket', 'price' => 75000],
            ['name' => 'Blazer Wanita', 'price' => 200000],
            ['name' => 'Sweater Rajut', 'price' => 130000],
            ['name' => 'Kaos Lengan Panjang', 'price' => 60000],
            ['name' => 'Celana Chino', 'price' => 170000],
            ['name' => 'Kemeja Batik', 'price' => 150000],
            ['name' => 'Jaket Denim', 'price' => 190000],
            ['name' => 'Rok Span', 'price' => 85000],
        ];

        foreach ($products as $product) {
            Product::create([
                'id' => (string) Str::uuid(),
                'name' => $product['name'],
                'price' => $product['price'],
                'category_id' => $categories->random(),
                'supplier_id' => $suppliers->random(),
                'metadata' => ['tags' => ['pakaian', 'fashion']],
                'is_active' => true,
                'available_since' => now(),
            ]);
        }
    }

}

