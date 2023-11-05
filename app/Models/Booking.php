<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = ['user_id', 'schedule_id', 'contact_person_id', 'payment_id', 'trip_type', 'status', 'reference_number'];

    // Relationship has many
    public function passengers()
    {
        return $this->hasMany(Passenger::class, 'booking_id', 'id');
    }

    // Inverse relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function contactPerson()
    {
        return $this->belongsTo(ContactPerson::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
