<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController; // Pastikan ini ada
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Organizer\OrganizerEventController;
use App\Http\Controllers\Organizer\OrganizerReportController;
use App\Http\Controllers\Organizer\OrganizerStatusController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/events/{event}', [HomeController::class, 'show'])->name('events.show');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- ROLE: REGISTERED USER ---
    Route::middleware('role:user')->group(function() {
        // Booking
        Route::post('/booking/{ticket}', [BookingController::class, 'store'])->name('booking.store');
        Route::get('/my-bookings', [BookingController::class, 'history'])->name('booking.history');
        Route::patch('/my-bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
        
        // Favorites & Reviews
        Route::get('/my-favorites', [FavoriteController::class, 'index'])->name('favorites.index');
        Route::post('/events/{event}/favorite', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
        Route::post('/events/{event}/review', [ReviewController::class, 'store'])->name('reviews.store');
    });

    // --- ROLE: ORGANIZER ---
    Route::middleware('role:organizer')->prefix('organizer')->name('organizer.')->group(function () {
        Route::get('/pending', [OrganizerStatusController::class, 'pending'])->name('pending');
        Route::get('/rejected', [OrganizerStatusController::class, 'rejected'])->name('rejected');
        Route::post('/delete-account', [OrganizerStatusController::class, 'deleteAccount'])->name('deleteAccount');

        Route::middleware('organizer.active')->group(function () {
            Route::resource('events', OrganizerEventController::class);
            Route::get('/reports', [OrganizerReportController::class, 'index'])->name('reports.index');

            // [BARU] Organizer Booking Management (Lihat Peserta & Approval)
            Route::get('/events/{event}/attendees', [OrganizerEventController::class, 'attendees'])->name('events.attendees');
            Route::patch('/bookings/{booking}/approve', [OrganizerEventController::class, 'approveBooking'])->name('bookings.approve');
            Route::patch('/bookings/{booking}/reject', [OrganizerEventController::class, 'rejectBooking'])->name('bookings.reject');
        });
    });

    // --- ROLE: ADMIN ---
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        // User Management
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/approve', [AdminUserController::class, 'approve'])->name('users.approve');
        Route::patch('/users/{user}/reject', [AdminUserController::class, 'reject'])->name('users.reject');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

        // Event Management
        Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');
        
        // [BARU] Admin Create Event Routes
        Route::get('/events/create', [AdminEventController::class, 'create'])->name('events.create');
        Route::post('/events', [AdminEventController::class, 'store'])->name('events.store');
        
        Route::delete('/events/{event}', [AdminEventController::class, 'destroy'])->name('events.destroy');

        // Reports
        Route::get('/reports', [AdminEventController::class, 'reports'])->name('reports.index');
    });
});

require __DIR__.'/auth.php';