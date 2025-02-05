<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdCustomer extends Model
{
    use HasFactory;

    // กำหนดฟิลด์ที่สามารถกรอกข้อมูลได้
    protected $fillable = [
        'name',
        'email'
    ];

    // ความสัมพันธ์แบบหนึ่งต่อหลายกับ Order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
