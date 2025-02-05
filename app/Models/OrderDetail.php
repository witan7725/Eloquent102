<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    // กำหนดฟิลด์ที่สามารถกรอกข้อมูลได้
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];

    // ความสัมพันธ์แบบหลายต่อหนึ่งกับ Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // ความสัมพันธ์แบบหลายต่อหนึ่งกับ Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
