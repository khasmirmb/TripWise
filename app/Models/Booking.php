<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = ['user_id', 'schedule_id', 'contact_person_id', 'payment_id', 'status', 'reference_number'];
}
