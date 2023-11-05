<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ferries extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'capacity', 'description', 'image'];
    
    // Relationship Has Many
    public function schedules()
    {
        return $this->hasMany(Schedules::class, 'ferry_id', 'id');
    }

    public function fares()
    {
        return $this->hasMany(Fares::class, 'ferry_id', 'id');
    }

    public function seats()
    {
        return $this->hasMany(Seat::class, 'ferry_id', 'id');
    }

}
