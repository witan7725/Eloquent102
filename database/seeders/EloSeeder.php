<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Register;
use App\Models\ProdCustomer;
use App\Models\BookCustomer;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Booking;

class EloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // สร้างข้อมูลจำลองจำนวน xxx
        ProdCustomer::factory(100)->create();
        Product::factory(100)->create();
        Order::factory(100)->create();
        OrderDetail::factory(100)->create();

        BookCustomer::factory(100)->create();
        RoomType::factory(5)->create();
        Room::factory(10)->create();
        Booking::factory(150)->create();

        Student::factory(50)->create();
        Teacher::factory(50)->create();
        Course::factory(50)->create();
        Register::factory(50)->create();
    }
}
