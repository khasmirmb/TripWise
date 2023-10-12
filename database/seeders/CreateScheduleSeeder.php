<?php

namespace Database\Seeders;

use App\Models\Ferries;
use App\Models\Ports;
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

        $ferries = [
            [
                'name'=>'Justus Ondricka',
                'description'=>'Et ab placeat iste sed hic asperiores magnam. Minima minima officiis iure molestiae ab vero eos. Voluptatem voluptatum aut enim dolorem eligendi. Consectetur eius accusamus omnis a non facere numquam.',
                'capacity'=>1452,
                'route'=>'Minus voluptatem non aut minima dolores reprehenderit nesciunt.',
                'price'=> 1959.00,
            ],
            [
                'name'=>'Luis Luettgen II',
                'description'=>'Porro similique dolorum ea sunt omnis consequatur et. Et qui neque aut ut quisquam. Perferendis dolor nostrum et nihil magnam incidunt non quibusdam. Repellat aut similique modi nemo aspernatur sequi corporis ullam.',
                'capacity'=>900,
                'route'=>'Aliquam reprehenderit unde quidem modi tempora.',
                'price'=> 2965.00,
            ],
            [
                'name'=>'Kailyn Maggio DDS',
                'description'=>'Iure laudantium a iusto distinctio sequi repellendus quasi. Veniam quia quisquam iure quo est et. Impedit aut facere non dolor. Nostrum nobis et delectus sunt ab maxime. Assumenda doloribus esse sit odio non cum ducimus et.',
                'capacity'=>1045,
                'route'=>'Qui rem aut aut.',
                'price'=> 1781.00,
            ],
        ];
    
        foreach ($ferries as $key => $ferry) {
            Ferries::create($ferry);
        }
        
        $schedules = [
            [
                'ferry_id'=>'1',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-12',
                'arrival_date'=>'2023-10-13',
                'departure_time'=> Carbon::now()->format('H:i:m'),
                'arrival_time'=> Carbon::now()->format('H:i:m'),
            ],
            [
                'ferry_id'=>'2',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-13',
                'arrival_date'=>'2023-10-14',
                'departure_time'=> Carbon::now()->format('H:i:m'),
                'arrival_time'=> Carbon::now()->format('H:i:m'),
            ],
            [
                'ferry_id'=>'3',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-14',
                'arrival_date'=>'2023-10-15',
                'departure_time'=> Carbon::now()->format('H:i:m'),
                'arrival_time'=> Carbon::now()->format('H:i:m'),
            ],
            [
                'ferry_id'=>'1',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-15',
                'arrival_date'=>'2023-10-16',
                'departure_time'=> Carbon::now()->format('H:i:m'),
                'arrival_time'=> Carbon::now()->format('H:i:m'),
            ],
            [
                'ferry_id'=>'2',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-16',
                'arrival_date'=>'2023-10-17',
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
                'ferry_id'=>'3',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-18',
                'arrival_date'=>'2023-10-19',
                'departure_time'=> Carbon::now()->format('H:i:m'),
                'arrival_time'=> Carbon::now()->format('H:i:m'),
            ],
            [
                'ferry_id'=>'2',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-19',
                'arrival_date'=>'2023-10-20',
                'departure_time'=> Carbon::now()->format('H:i:m'),
                'arrival_time'=> Carbon::now()->format('H:i:m'),
            ],
            [
                'ferry_id'=>'1',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-20',
                'arrival_date'=>'2023-10-21',
                'departure_time'=> Carbon::now()->format('H:i:m'),
                'arrival_time'=> Carbon::now()->format('H:i:m'),
            ],
            [
                'ferry_id'=>'2',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-21',
                'arrival_date'=>'2023-10-22',
                'departure_time'=> Carbon::now()->format('H:i:m'),
                'arrival_time'=> Carbon::now()->format('H:i:m'),
            ],
            [
                'ferry_id'=>'3',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-22',
                'arrival_date'=>'2023-10-23',
                'departure_time'=> Carbon::now()->format('H:i:m'),
                'arrival_time'=> Carbon::now()->format('H:i:m'),
            ],
            [
                'ferry_id'=>'2',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-23',
                'arrival_date'=>'2023-10-24',
                'departure_time'=> Carbon::now()->format('H:i:m'),
                'arrival_time'=> Carbon::now()->format('H:i:m'),
            ],
            [
                'ferry_id'=>'1',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-24',
                'arrival_date'=>'2023-10-25',
                'departure_time'=> Carbon::now()->format('H:i:m'),
                'arrival_time'=> Carbon::now()->format('H:i:m'),
            ],
            [
                'ferry_id'=>'3',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-25',
                'arrival_date'=>'2023-10-26',
                'departure_time'=> Carbon::now()->format('H:i:m'),
                'arrival_time'=> Carbon::now()->format('H:i:m'),
            ],
            [
                'ferry_id'=>'2',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-26',
                'arrival_date'=>'2023-10-27',
                'departure_time'=> Carbon::now()->format('H:i:m'),
                'arrival_time'=> Carbon::now()->format('H:i:m'),
            ],
        ];
    
        foreach ($schedules as $key => $schedule) {
            Schedules::create($schedule);
        }
    }
}
