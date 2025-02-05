<?php

namespace Database\Factories;

use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),  // ใช้ factory ของ Order เพื่อสร้างความสัมพันธ์
            'product_id' => Product::factory(),  // ใช้ factory ของ Product เพื่อสร้างความสัมพันธ์
            'quantity' => $this->faker->numberBetween(1, 10),  // จำนวนสินค้าที่สั่ง
            'price' => $this->faker->numberBetween(100, 10000),  // ราคาต่อหน่วย
        ];
    }
}
