<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fares extends Model
{
    use HasFactory;

    protected $fillable = ['ferry_id', 'type', 'price', 'notes'];
}