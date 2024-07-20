<?php

namespace Database\Seeders;

use App\Models\Accommodation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Acc extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accommodations = [
            [
                'acc_type'=>'Economy',
            ],
            [
                'acc_type'=>'Aircon',
            ],
            [
                'acc_type'=>'Tourist',
            ],
            [
                'acc_type'=>'Business',
            ],
            [
                'acc_type'=>'Cabin',
            ],
            [
                'acc_type'=>'Suite',
            ],
        ];
    
        foreach ($accommodations as $key => $accommodation) {
            Accommodation::create($accommodation);
        }
    }
}
