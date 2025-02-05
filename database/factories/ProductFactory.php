<?php

namespace Database\Factories;

use App\Models\Product;
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
            'product_code' => $this->faker->unique()->lexify('P???-????'),  // สร้าง product code เช่น PABC-1234
            'product_name' => $this->faker->word(),  // ชื่อสินค้า
            'price' => $this->faker->numberBetween(100, 10000),  // ราคา
            'stock' => $this->faker->numberBetween(1, 100),  // จำนวนสินค้า
        ];
    }
}
