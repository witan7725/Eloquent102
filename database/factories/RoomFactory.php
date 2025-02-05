<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_number' => $this->faker->unique()->numberBetween(100, 999),  // สร้างหมายเลขห้อง เช่น 101, 205
            'room_type_id' => RoomType::factory(),  // ใช้ factory ของ RoomType เพื่อสร้างความสัมพันธ์
            'price_per_night' => $this->faker->numberBetween(500, 5000),  // ราคาต่อคืน
            'available' => $this->faker->boolean(),  // สถานะห้อง (ว่างหรือไม่)
        ];
    }
}
