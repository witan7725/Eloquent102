<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\ProdCustomer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'prod_customer_id' => ProdCustomer::factory(),  // ใช้ factory ของ ProdCustomer เพื่อสร้างความสัมพันธ์
            'order_date' => $this->faker->date(),  // วันที่สั่งซื้อ
        ];
    }
}
