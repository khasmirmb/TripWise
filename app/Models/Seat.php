<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    // Relationship has many
    public function passengers()
    {
        return $this->hasMany(Passenger::class, 'seat_id', 'id');
    }

    // Inverse Relationship
    public function ferries()
    {
        return $this->belongsTo(Ferries::class, 'ferry_id');
    }

    public function schedules()
    {
        return $this->belongsTo(Schedules::class, 'schedule_id');
    }
}
