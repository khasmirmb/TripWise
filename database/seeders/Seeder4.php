<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class Seeder4 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $ferries = DB::table('ferries')->get();

        foreach ($ferries as $ferry) {
            $capacity = $ferry->capacity;

            // Determine the seat class based on the ferry's ID or other criteria
            $class = $ferry->id % 2 === 0 ? 'Economy' : 'Aircon';

            // Generate seat numbers for the given class (e.g., 'Economy 1', 'Aircon2', ...)
            for ($i = 1; $i <= $capacity; $i++) {
                // Create a seat entry in the 'seats' table
                DB::table('seats')->insert([
                    'ferry_id' => $ferry->id,
                    'seat_number' => $class . $i,
                    'class' => $class,
                    'seat_status' => 'available',
                ]);
            }
        }
    }
}
