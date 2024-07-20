<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class Seat extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $ferries = DB::table('ferries')->get();

        foreach ($ferries as $ferry) {
            
            $schedules = DB::table('schedules')->where('ferry_id', $ferry->id)->get();

            $capacity = $ferry->capacity;

            // Calculate the capacity for each class
            $economyCapacity = $capacity / 2;
            $airconCapacity = $capacity / 2;

            foreach ($schedules as $schedule) {
                // Generate seat numbers for "Economy" class (e.g., 'Economy 1', 'Economy 2', ...)
                for ($i = 1; $i <= $economyCapacity; $i++) {
                    // Create a seat entry in the 'seats' table for "Economy" class
                    DB::table('seats')->insert([
                        'ferry_id' => $ferry->id,
                        'schedule_id' => $schedule->id,
                        'seat_number' => 'E' . $i,
                        'class' => 'Economy',
                        'seat_status' => 'available',
                    ]);
                }

                // Generate seat numbers for "Aircon" class (e.g., 'Aircon 1', 'Aircon 2', ...)
                for ($i = 1; $i <= $airconCapacity; $i++) {
                    // Create a seat entry in the 'seats' table for "Aircon" class
                    DB::table('seats')->insert([
                        'ferry_id' => $ferry->id,
                        'schedule_id' => $schedule->id,
                        'seat_number' => 'A' . $i,
                        'class' => 'Aircon',
                        'seat_status' => 'available',
                    ]);
                }
            }
        }
    }
}
