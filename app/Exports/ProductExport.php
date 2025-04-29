<?php

// namespace App\Exports;

// use App\Models\Product;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithMapping;
// use Maatwebsite\Excel\Concerns\WithHeadings;
// use Illuminate\Support\Facades\Log;

// class ProductExport implements FromCollection, WithMapping, WithHeadings
// {
//     protected $fields;

//     public function __construct(array $fields)
//     {
//         $this->fields = $fields;
//     }

//     public function collection()
//     {
//         return Product::select('name', 'price',  'category_id', 'supplier_id',  'is_active', 'created_at', 'updated_at')
//                     ->with(['category', 'supplier'])
//                     ->get();

//         return $products->map(function ($product, $index) {
//             $product->row_number = $index + 1;
//             return $product;
//         });
//     }

//     public function map($product): array
//     {
//         Log::info('Product is_active: ', [$product->is_active]);

//         return collect($this->fields)->map(function ($field) use ($product) {
//             if ($field === 'id') {
//                 return $product->row_number ?? '-'; // pakai nomor urut
//             }
//             if ($field === 'category_name') {
//                 return optional($product->category)->name ?? '-';
//             }
//             if ($field === 'supplier_name') {
//                 return optional($product->supplier)->name ?? '-';
//             }
//             if ($field === 'availability') {
//                 return $product->is_active == 1 ? 'Tersedia' : 'Habis';
//             }

//             if ($field === 'is_active') {
//                 return (int) $product->is_active;
//             }
//             return $product->{$field} ?? '-';
//         })->toArray();
//     }


//     public function headings(): array
//     {
//         return collect($this->fields)->map(function ($field) {
//             return match ($field) {
//                 'id' => 'No',
//                 'category_name' => 'Kategori',
//                 'supplier_name' => 'Supplier',
//                 'availability' => 'Ketersediaan',
//                 default => ucfirst(str_replace('_', ' ', $field)),
//             };
//         })->toArray();
//     }
// }


namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Log;

class ProductExport implements FromCollection, WithMapping, WithHeadings
{
    protected $fields;

    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }

    public function collection()
    {
        $products = Product::select('name', 'price', 'category_id', 'supplier_id', 'is_active', 'created_at', 'updated_at')
            ->with(['category', 'supplier'])
            ->get();

        return $products->map(function ($product, $index) {
            $product->row_number = $index + 1;
            return $product;
        });
    }

    public function map($product): array
    {
        return collect($this->fields)->map(function ($field) use ($product) {
            if ($field === 'id') {
                return $product->row_number ?? '-'; // pakai nomor urut
            }
            if ($field === 'category_name') {
                return optional($product->category)->name ?? '-';
            }
            if ($field === 'supplier_name') {
                return optional($product->supplier)->name ?? '-';
            }
            if ($field === 'availability') {
                return $product->is_active == 1 ? 'Tersedia' : 'Habis';
            }
            if ($field === 'is_active') {
                return (int) $product->is_active;
            }
            return $product->{$field} ?? '-';
        })->toArray();
    }

    public function headings(): array
    {
        return collect($this->fields)->map(function ($field) {
            return match ($field) {
                'id' => 'No',
                'category_name' => 'Kategori',
                'supplier_name' => 'Supplier',
                'availability' => 'Ketersediaan',
                default => ucfirst(str_replace('_', ' ', $field)),
            };
        })->toArray();
    }
}
