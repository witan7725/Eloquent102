<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_customer_id')->constrained();
            $table->foreignId('room_id')->constrained();
            $table->date('booking_date');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('bookings');
    }
};

