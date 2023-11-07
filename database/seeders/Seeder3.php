<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class Seeder3 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        $ferries = DB::table('ferries')->get();
        $ports = DB::table('ports')->select('name')->get();

        $startDate = Carbon::parse('2023-11-07');
        $endDate = Carbon::parse('2023-12-07');

        for ($i = 0; $i < 50; $i++) {
            $ferry = $ferries->random();
            $departureDate = $faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d');
            $arrivalDate = Carbon::parse($departureDate)->addDay()->format('Y-m-d');

            $departurePort = $ports->random();
            $arrivalPort = $ports->random();
    
            while ($departurePort == $arrivalPort) {
                $arrivalPort = $ports->random();
            }

            // Generate a unique departure time for each date
            $departureTime = $this->getUniqueDepartureTime($departureDate);

            // Generate a random arrival time
            $arrivalTime = $departureTime->copy()->addHours($faker->numberBetween(1, 4));

            DB::table('schedules')->insert([
                'ferry_id' => $ferry->id,
                'departure_port' => $departurePort->name,
                'arrival_port' => $arrivalPort->name,
                'departure_date' => $departureDate,
                'arrival_date' => $arrivalDate,
                'departure_time' => $departureTime->format('H:i'),
                'arrival_time' => $arrivalTime->format('H:i'),
            ]);
        }
    }

    private function getUniqueDepartureTime($departureDate)
    {
        $existingTimes = DB::table('schedules')
            ->where('departure_date', $departureDate)
            ->pluck('departure_time')
            ->toArray();

        $faker = Faker::create();
        $proposedTime = Carbon::createFromTime($faker->numberBetween(1, 20), 0);

        while (in_array($proposedTime->format('H:i'), $existingTimes)) {
            $proposedTime = Carbon::createFromTime($faker->numberBetween(1, 20), 0);
        }

        return $proposedTime;
    }
}
