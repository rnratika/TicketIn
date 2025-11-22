<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['organizer_id', 'name', 'description', 'start_time', 'location', 'image'];

    protected $casts = [
        'start_time' => 'datetime',
    ];

    public function organizer() {
        return $this->belongsTo(User::class, 'organizer_id');
    }
    public function tickets() {
        return $this->hasMany(Ticket::class);
    }
}
