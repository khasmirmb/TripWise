<?php

namespace Database\Seeders;

use App\Models\Ports;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class Seeder1 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ports = [
            [
                'name'=>'Zamboanga Port',
                'location'=>'Zamboanga City, Zamboanga Del Sur',
            ],
            [
                'name'=>'Lamitan Port',
                'location'=>'Lamitan City, Basilan',
            ],
            [
                'name'=>'Jolo Port',
                'location'=>'Jolo, Sulu',
            ],
            [
                'name'=>'Isabela Port',
                'location'=>'Isabela City, Basilan',
            ],
        ];

        foreach ($ports as $key => $port) {
            Ports::create($port);
        }

        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            $girlName = $faker->firstNameFemale;
            $ferryName = "MV $girlName";

            $description = $faker->sentence(20);
            $capacity = $faker->numberBetween(30, 50);

            DB::table('ferries')->insert([
                'name' => $ferryName,
                'description' => $description,
                'capacity' => $capacity,
                'image' => null,
            ]);
        }
    }
}
