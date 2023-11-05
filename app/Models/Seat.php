<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    // Inverse Relationship
    public function ferries()
    {
        return $this->belongsTo(Ferries::class);
    }

    public function schedules()
    {
        return $this->belongsTo(Schedules::class);
    }
}
