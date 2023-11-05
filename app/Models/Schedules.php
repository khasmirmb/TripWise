<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'origin',
        'destination',
        'depart_date',
        'return_date',
        'passenger',
    ];

    public function seats()
    {
        return $this->hasMany(Seat::class, 'schedule_id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'schedule_id', 'id');
    }

}
