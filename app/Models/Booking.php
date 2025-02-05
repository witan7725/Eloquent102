<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_customer_id',
        'room_id',
        'booking_date',
        'status'
    ];

    public function bookCustomer()
    {
        return $this->belongsTo(BookCustomer::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
