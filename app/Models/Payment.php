<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = ['payment_amount', 'depart_total', 'return_total', 'discount_total', 'service_total', 'payment_date', 'payment_method', 'payment_status'];

    // Relationship Has Many
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'payment_id', 'id');
    }
}
