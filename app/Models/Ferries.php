<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ferries extends Model
{
    use HasFactory;

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'ferry_id', 'id');
    }

    public function fares()
    {
        return $this->hasMany(Fares::class, 'ferry_id', 'id');
    }

}
