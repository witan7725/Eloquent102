<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\BookCustomer;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_customer_id' => BookCustomer::factory(),  // ใช้ factory ของ BookCustomer เพื่อสร้างความสัมพันธ์
            'room_id' => Room::factory(),  // ใช้ factory ของ Room เพื่อสร้างความสัมพันธ์
            'booking_date' => $this->faker->date(),  // วันที่จอง
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),  // สถานะการจอง
        ];
    }
}
