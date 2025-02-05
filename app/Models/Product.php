<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // กำหนดฟิลด์ที่สามารถกรอกข้อมูลได้
    protected $fillable = [
        'product_code',
        'product_name',
        'price',
        'stock'
    ];

    // ความสัมพันธ์แบบหนึ่งต่อหลายกับ OrderDetail
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
