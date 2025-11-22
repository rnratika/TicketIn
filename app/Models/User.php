<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',   // admin, organizer, user
        'status', // active, pending, rejected
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi: User (Organizer) punya banyak Event
    public function events()
    {
        return $this->hasMany(Event::class, 'organizer_id');
    }

    // Relasi: User punya banyak Booking
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    
    // Helper untuk cek role
    public function hasRole($role)
    {
        return $this->role === $role;
    }
}