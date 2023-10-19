<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class Seeder2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $ferries = DB::table('ferries')->get();

        foreach ($ferries as $ferry) {
            $economyPrice = $faker->numberBetween(350, 600);
            $airconPrice = $faker->numberBetween(800, 1200);

            DB::table('fares')->insert([
                [
                    'ferry_id' => $ferry->id,
                    'type' => 'Economy',
                    'notes' => 'Open Space',
                    'price' => $economyPrice,
                ],
                [
                    'ferry_id' => $ferry->id,
                    'type' => 'Aircon',
                    'notes' => 'Open Space',
                    'price' => $airconPrice,
                ],
            ]);
        }
    }
}
