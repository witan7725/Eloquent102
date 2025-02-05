<?php

namespace Database\Factories;

use App\Models\Register;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Register>
 */
class RegisterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),  // ใช้ factory ของ Student เพื่อสร้างความสัมพันธ์
            'course_id' => Course::factory(),    // ใช้ factory ของ Course เพื่อสร้างความสัมพันธ์
            'semester' => $this->faker->randomElement([1, 2]),  // สุ่มเลือกเลข 1 หรือ 2
        ];
    }
}
