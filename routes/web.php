<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

// Halaman Depan (Bisa diakses Guest)
Route::get('/', [EventController::class, 'index'])->name('home');
Route::get('/event/{event}', [EventController::class, 'show'])->name('event.detail');

// User Terautentikasi
Route::middleware(['auth'])->group(function () {
    
    // Dashboard Umum (Redirect sesuai role nanti di Controller)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Registered User: Booking
    Route::post('/booking/{ticket}', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/my-bookings', [BookingController::class, 'history'])->name('booking.history');

    // ADMIN AREA
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        // Disini buat route untuk Manage Users, Approve Organizer, Reports
        Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    });

    // ORGANIZER AREA
    Route::middleware('role:organizer')->prefix('organizer')->name('organizer.')->group(function () {
        // CRUD Event
        Route::resource('events', \App\Http\Controllers\Organizer\EventController::class);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';