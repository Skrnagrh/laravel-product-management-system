<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'id' => Str::uuid(),
                'name' => 'PT. Sumber Makmur',
                'contact_person' => 'Budi Santoso',
                'email' => 'budi@sumbermakmur.co.id',
                'phone' => '081234567890',
                'address' => 'Jl. Merdeka No.123, Jakarta',
                'city' => 'Jakarta',
                'province' => 'DKI Jakarta',
                'country' => 'Indonesia',
                'contact_info' => json_encode([
                    'whatsapp' => '081234567890',
                    'fax' => '021-1234567'
                ]),
                'is_active' => true,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'CV. Indo Supplies',
                'contact_person' => 'Siti Aminah',
                'email' => 'siti@indosupplies.com',
                'phone' => '082198765432',
                'address' => 'Jl. Asia Afrika No.45, Bandung',
                'city' => 'Bandung',
                'province' => 'Jawa Barat',
                'country' => 'Indonesia',
                'contact_info' => json_encode([
                    'whatsapp' => '082198765432'
                ]),
                'is_active' => true,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Global Trade Ltd.',
                'contact_person' => 'John Doe',
                'email' => 'john@globaltrade.com',
                'phone' => '+62 811 2233 4455',
                'address' => 'Jl. Sudirman No.89, Surabaya',
                'city' => 'Surabaya',
                'province' => 'Jawa Timur',
                'country' => 'Indonesia',
                'contact_info' => json_encode([
                    'whatsapp' => '+62 811 2233 4455',
                    'website' => 'www.globaltrade.com'
                ]),
                'is_active' => false,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'PT. Fashion Retail',
                'contact_person' => 'Rina Kusuma',
                'email' => 'rina@fashionretail.com',
                'phone' => '081322334455',
                'address' => 'Jl. Braga No.7, Bandung',
                'city' => 'Bandung',
                'province' => 'Jawa Barat',
                'country' => 'Indonesia',
                'contact_info' => json_encode([
                    'whatsapp' => '081322334455'
                ]),
                'is_active' => true,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'CV. Textile Indo',
                'contact_person' => 'Agus Wijaya',
                'email' => 'agus@textileindo.com',
                'phone' => '081355566677',
                'address' => 'Jl. Pemuda No.10, Semarang',
                'city' => 'Semarang',
                'province' => 'Jawa Tengah',
                'country' => 'Indonesia',
                'contact_info' => json_encode([
                    'whatsapp' => '081355566677'
                ]),
                'is_active' => true,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Mega Garment',
                'contact_person' => 'Dewi Sartika',
                'email' => 'dewi@megagarment.co.id',
                'phone' => '082199988877',
                'address' => 'Jl. Gatot Subroto No.20, Medan',
                'city' => 'Medan',
                'province' => 'Sumatera Utara',
                'country' => 'Indonesia',
                'contact_info' => json_encode([
                    'whatsapp' => '082199988877'
                ]),
                'is_active' => true,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Universal Supplies',
                'contact_person' => 'Michael Tan',
                'email' => 'michael@universalsupplies.com',
                'phone' => '081266677788',
                'address' => 'Jl. Imam Bonjol No.5, Denpasar',
                'city' => 'Denpasar',
                'province' => 'Bali',
                'country' => 'Indonesia',
                'contact_info' => json_encode([
                    'whatsapp' => '081266677788'
                ]),
                'is_active' => true,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Nusantara Textile',
                'contact_person' => 'Fitri Handayani',
                'email' => 'fitri@nusantaratextile.co.id',
                'phone' => '082144455566',
                'address' => 'Jl. Diponegoro No.8, Yogyakarta',
                'city' => 'Yogyakarta',
                'province' => 'DIY Yogyakarta',
                'country' => 'Indonesia',
                'contact_info' => json_encode([
                    'whatsapp' => '082144455566'
                ]),
                'is_active' => true,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Asia Pacific Trade',
                'contact_person' => 'Tommy Gunawan',
                'email' => 'tommy@aptrade.com',
                'phone' => '081377788899',
                'address' => 'Jl. Ahmad Yani No.30, Makassar',
                'city' => 'Makassar',
                'province' => 'Sulawesi Selatan',
                'country' => 'Indonesia',
                'contact_info' => json_encode([
                    'whatsapp' => '081377788899'
                ]),
                'is_active' => false,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Prima Textile',
                'contact_person' => 'Linda Pratiwi',
                'email' => 'linda@primatextile.co.id',
                'phone' => '082122334455',
                'address' => 'Jl. Sudirman No.50, Palembang',
                'city' => 'Palembang',
                'province' => 'Sumatera Selatan',
                'country' => 'Indonesia',
                'contact_info' => json_encode([
                    'whatsapp' => '082122334455'
                ]),
                'is_active' => true,
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
