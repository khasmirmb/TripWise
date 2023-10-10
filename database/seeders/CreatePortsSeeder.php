<?php

namespace Database\Seeders;

use App\Models\Ports;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreatePortsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ports = [
            [
                'name'=>'Zamboanga',
                'location'=>'Zamboanga City',
            ],
            [
                'name'=>'Lamitan',
                'location'=>'Lamitan City',
            ],
            [
                'name'=>'Jolo, Sulu',
                'location'=>'Jolo, Sulu City',
            ],
            [
                'name'=>'Isabela',
                'location'=>'Isabela City',
            ],
        ];
    
        foreach ($ports as $key => $port) {
            Ports::create($port);
        }
    }
}
