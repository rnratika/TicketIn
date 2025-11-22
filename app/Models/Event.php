<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'organizer_id',
        'name',
        'description',
        'start_time',
        'location',
        'image',
    ];

    protected $casts = [
        'start_time' => 'datetime',
    ];

    // Relasi ke Organizer
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    // Relasi ke Tiket
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    // Relasi ke Booking melalui Tiket (untuk melihat total penjualan event)
    public function bookings()
    {
        return $this->hasManyThrough(Booking::class, Ticket::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->avg('rating'), 1);
    }

}