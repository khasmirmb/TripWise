<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    use HasFactory;

    protected $table = 'contact_persons';

    protected $fillable = ['name', 'phone', 'email', 'address'];

    // Relationship Has Many
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'contact_person_id', 'id');
    }
}
