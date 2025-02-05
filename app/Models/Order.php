<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // กำหนดฟิลด์ที่สามารถกรอกข้อมูลได้
    protected $fillable = [
        'prod_customer_id',
        'order_date'
    ];

    // ความสัมพันธ์แบบหลายต่อหนึ่งกับ ProdCustomer
    public function prodCustomer()
    {
        return $this->belongsTo(ProdCustomer::class);
    }

    // ความสัมพันธ์แบบหนึ่งต่อหลายกับ OrderDetail
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
