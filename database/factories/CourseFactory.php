<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_code' => $this->faker->unique()->bothify('??###'),  // ใช้ bothify เพื่อสร้างรหัสที่ไม่ซ้ำ
            'course_name' => $this->faker->randomElement([
                'Mathematics', 'Physics', 'Chemistry', 'Biology',
                'History', 'Geography', 'Literature', 'Art',
                'Music', 'Physical Education', 'Computer Science', 'Economics',
                'Philosophy', 'Psychology', 'Sociology'
            ]),
            'teacher_id' => Teacher::factory(),
        ];
    }
}
