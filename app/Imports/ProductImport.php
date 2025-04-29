<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ProductImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Cari Category ID berdasarkan nama
        $category = Category::where('name', $row['category_id'])->first();
        if (!$category) {
            dd('Category not found', $row['category_id']);
        }

        // Cari Supplier ID berdasarkan nama
        $supplier = Supplier::where('name', $row['supplier_id'])->first();
        if (!$supplier) {
            dd('Supplier not found', $row['supplier_id']);
        }

        return new Product([
            'id' => Str::uuid(),
            'name' => $row['name'],
            'category_id' => $category->id, 
            'supplier_id' => $supplier->id, 
            'price' => $row['price'],
            'metadata' => json_encode(json_decode($row['metadata'], true) ?? []),
            'is_active' => $row['is_active'] ?? 1,
            'attachment' => $row['attachment'] ?? null,
            'available_since' => isset($row['available_since']) ? Carbon::parse($row['available_since']) : now(),
        ]);
    }


}
