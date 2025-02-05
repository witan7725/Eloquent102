<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// เส้นทางเพื่อแสดงหน้าดัชนีของทะเบียน
Route::get('/registers', [RegisterController::class, 'index'])
    ->name('registers.index');

// เส้นทางเพื่อแสดงฟอร์มสร้างทะเบียนใหม่
Route::get('/registers/create', [RegisterController::class, 'create'])
    ->name('registers.create');

// เส้นทางเพื่อบันทึกทะเบียนใหม่และครูใหม่
Route::post('/registers', [RegisterController::class, 'store'])
    ->name('registers.store');
Route::post('/teachers', [RegisterController::class, 'storeTeacher'])
    ->name('teachers.store');

// เส้นทางเพื่อแสดงฟอร์มแก้ไขทรัพยากร
Route::get('/registers/{id}/edit', [RegisterController::class, 'edit'])
    ->name('registers.edit');

// เส้นทางเพื่อแสดงเมนูแก้ไข
Route::get('/registers/edit', [RegisterController::class, 'editMenu'])
    ->name('registers.editMenu');

// เส้นทางเพื่ออัปเดตทรัพยากร
Route::patch('/registers/{id}', [RegisterController::class, 'update'])
    ->name('registers.update');

// เส้นทางเพื่อลบทรัพยากร
Route::delete('/registers/{id}', [RegisterController::class, 'destroy'])
    ->name('registers.destroy');




// เส้นทางเพื่อแสดงหน้าต้อนรับ
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// เส้นทางเพื่อแสดงแดชบอร์ด
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// เส้นทางสำหรับการจัดการโปรไฟล์
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
