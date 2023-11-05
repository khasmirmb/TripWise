<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $table = 'passengers';

    protected $fillable = ['booking_id', 'first_name', 'middle_name', 'last_name', 'birthdate', 'gender', 'accommodation', 'discount_type'];

    // Inverse Relationship
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
