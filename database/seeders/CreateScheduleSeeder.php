<?php

namespace Database\Seeders;

use App\Models\Schedules;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
            [
                'ferry_id'=>'1',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Isabela',
                'departure_date'=>'2023-10-14',
                'arrival_date'=>'2023-10-15',
                'departure_time'=> Carbon::now()->format('H:i:m'),
                'arrival_time'=> Carbon::now()->format('H:i:m'),
            ],
            [
                'ferry_id'=>'2',
                'departure_port'=>'Isabela',
                'arrival_port'=>'Lamitan',
                'departure_date'=>'2023-10-11',
                'arrival_date'=>'2023-10-12',
                'departure_time'=> Carbon::now()->format('H:i:m'),
                'arrival_time'=> Carbon::now()->format('H:i:m'),
            ],
            [
                'ferry_id'=>'3',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-15',
                'arrival_date'=>'2023-10-16',
                'departure_time'=> Carbon::now()->format('H:i:m'),
                'arrival_time'=> Carbon::now()->format('H:i:m'),
            ],
            [
                'ferry_id'=>'1',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-17',
                'arrival_date'=>'2023-10-18',
                'departure_time'=> Carbon::now()->format('H:i:m'),
                'arrival_time'=> Carbon::now()->format('H:i:m'),
            ],
            [
                'ferry_id'=>'1',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-19',
                'arrival_date'=>'2023-10-20',
                'departure_time'=> Carbon::now()->format('H:i:m'),
                'arrival_time'=> Carbon::now()->format('H:i:m'),
            ],
        ];
    
        foreach ($schedules as $key => $schedule) {
            Schedules::create($schedule);
        }
    }
}
