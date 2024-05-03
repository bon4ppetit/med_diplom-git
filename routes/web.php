<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecordToDoctorController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('record')->group(function () {
    Route::get('/get_all', [RecordToDoctorController::class, 'getUserRecords'])->name('get-user-records');
    Route::post('/create_record', [RecordToDoctorController::class, 'createRecord'])->name('create-record');
    Route::post('/delete', [RecordToDoctorController::class, 'deleteRecord'])->name('delete-record');
    Route::get('/get_old', [RecordToDoctorController::class, 'getUserOldRecords'])->name('get-old-records');
});

Route::prefix('doctors')->group(function () {
    Route::get('/get_all', [DoctorController::class, 'getAllDoctors'])->name('get-all-doctors');
    Route::get('/get_professions', [ProfessionController::class, 'getProfession'])->name('get-professions');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
