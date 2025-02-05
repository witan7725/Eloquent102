<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('registers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id');
            $table->foreignId('course_id');
            $table->string('semester', 10);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('registers');
    }
};

