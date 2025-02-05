<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number')->unique();
            $table->foreignId('room_type_id')->constrained();
            $table->integer('price_per_night');
            $table->boolean('available')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('rooms');
    }
};

