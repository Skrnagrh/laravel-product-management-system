<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => (string) Str::uuid(),
            // 'name' => $this->faker->productName(),
            'name' => $this->faker->words(2, true),
            'category_id' => Category::inRandomOrder()->first()?->id ?? null,
            'supplier_id' => Supplier::inRandomOrder()->first()?->id ?? null,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'metadata' => ['tags' => $this->faker->words(2)],
            'is_active' => $this->faker->boolean(),
            'available_since' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'attachment' => null,
        ];
    }

}
