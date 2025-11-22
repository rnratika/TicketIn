<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminEventController; // Pastikan buat ini jika belum, atau gunakan logic event biasa
use App\Http\Controllers\Organizer\OrganizerEventController;
use App\Http\Controllers\Organizer\OrganizerReportController;
use App\Http\Controllers\Organizer\OrganizerStatusController;

// 1. Public Routes (Bisa diakses siapa saja)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/events/{event}', [HomeController::class, 'show'])->name('events.show');

// 2. Authenticated Routes (Harus Login)
Route::middleware(['auth'])->group(function () {
    
    // Redirect ke dashboard sesuai role
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Management (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- ROLE: REGISTERED USER ---
    Route::middleware('role:user')->group(function() {
        Route::post('/booking/{ticket}', [BookingController::class, 'store'])->name('booking.store');
        Route::get('/my-bookings', [BookingController::class, 'history'])->name('booking.history');
        Route::patch('/my-bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
    });

    // --- ROLE: ORGANIZER ---
    Route::middleware('role:organizer')->prefix('organizer')->name('organizer.')->group(function () {
        
        // Halaman status pending/rejected (Bisa diakses meski belum approved)
        Route::get('/pending', [OrganizerStatusController::class, 'pending'])->name('pending');
        Route::get('/rejected', [OrganizerStatusController::class, 'rejected'])->name('rejected');
        Route::post('/delete-account', [OrganizerStatusController::class, 'deleteAccount'])->name('deleteAccount');

        // Middleware check status (Hanya bisa diakses jika status = active)
        Route::middleware(function ($request, $next) {
             if ($request->user()->status !== 'active') {
                 return redirect()->route('organizer.pending');
             }
             return $next($request);
        })->group(function () {
            Route::resource('events', OrganizerEventController::class);
            Route::get('/reports', [OrganizerReportController::class, 'index'])->name('reports.index');
        });
    });

    // --- ROLE: ADMIN ---
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/approve', [AdminUserController::class, 'approve'])->name('users.approve');
        Route::patch('/users/{user}/reject', [AdminUserController::class, 'reject'])->name('users.reject');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    });
});

require __DIR__.'/auth.php';