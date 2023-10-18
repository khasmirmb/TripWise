<?php

namespace Database\Seeders;

use App\Models\Fares;
use App\Models\Ferries;
use App\Models\Ports;
use App\Models\Schedules;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
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
                'name'=>'MV Maria Diana',
                'description'=>'Et ab placeat iste sed hic asperiores magnam. Minima minima officiis iure molestiae ab vero eos. Voluptatem voluptatum aut enim dolorem eligendi. Consectetur eius accusamus omnis a non facere numquam.',
                'capacity'=>1452,
                'route'=>'Minus voluptatem non aut minima dolores reprehenderit nesciunt.',
                'image'=> 'asdasdas',
            ],
            [
                'name'=>'MV Stephanie Marie',
                'description'=>'Porro similique dolorum ea sunt omnis consequatur et. Et qui neque aut ut quisquam. Perferendis dolor nostrum et nihil magnam incidunt non quibusdam. Repellat aut similique modi nemo aspernatur sequi corporis ullam.',
                'capacity'=>900,
                'route'=>'Aliquam reprehenderit unde quidem modi tempora.',
                'image'=> 'asdasd',
            ],
            [
                'name'=>'Weesam Express 7',
                'description'=>'Iure laudantium a iusto distinctio sequi repellendus quasi. Veniam quia quisquam iure quo est et. Impedit aut facere non dolor. Nostrum nobis et delectus sunt ab maxime. Assumenda doloribus esse sit odio non cum ducimus et.',
                'capacity'=>1045,
                'route'=>'Qui rem aut aut.',
                'image'=> 'asdasda',
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
                'departure_date'=>'2023-10-18',
                'arrival_date'=>'2023-10-19',
                'departure_time'=> '13:00',
                'arrival_time'=> '16:00',
            ],
            [
                'ferry_id'=>'2',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-18',
                'arrival_date'=>'2023-10-19',
                'departure_time'=> '24:00',
                'arrival_time'=> '02:00',
            ],
            [
                'ferry_id'=>'3',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-19',
                'arrival_date'=>'2023-10-20',
                'departure_time'=> '01:00',
                'arrival_time'=> '03:00',
            ],
            [
                'ferry_id'=>'2',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-19',
                'arrival_date'=>'2023-10-20',
                'departure_time'=> '13:00',
                'arrival_time'=> '15:00',
            ],
            [
                'ferry_id'=>'1',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-20',
                'arrival_date'=>'2023-10-21',
                'departure_time'=> '16:00',
                'arrival_time'=> '18:00',
            ],
            [
                'ferry_id'=>'2',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-21',
                'arrival_date'=>'2023-10-22',
                'departure_time'=> '16:00',
                'arrival_time'=> '18:00',
            ],
            [
                'ferry_id'=>'3',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-22',
                'arrival_date'=>'2023-10-23',
                'departure_time'=> '15:00',
                'arrival_time'=> '14:00',
            ],
            [
                'ferry_id'=>'2',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-23',
                'arrival_date'=>'2023-10-24',
                'departure_time'=> '13:00',
                'arrival_time'=> '17:00',
            ],
            [
                'ferry_id'=>'1',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-24',
                'arrival_date'=>'2023-10-25',
                'departure_time'=> '06:00',
                'arrival_time'=> '08:00',
            ],
            [
                'ferry_id'=>'3',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-25',
                'arrival_date'=>'2023-10-26',
                'departure_time'=> '08:00',
                'arrival_time'=> '10:00',
            ],
            [
                'ferry_id'=>'2',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-26',
                'arrival_date'=>'2023-10-27',
                'departure_time'=> '11:00',
                'arrival_time'=> '12:00',
            ],
            [
                'ferry_id'=>'1',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-26',
                'arrival_date'=>'2023-10-27',
                'departure_time'=> '12:00',
                'arrival_time'=> '13:00',
            ],
            [
                'ferry_id'=>'1',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-27',
                'arrival_date'=>'2023-10-28',
                'departure_time'=> '13:30',
                'arrival_time'=> '15:30',
            ],
            [
                'ferry_id'=>'2',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-27',
                'arrival_date'=>'2023-10-28',
                'departure_time'=> '11:00',
                'arrival_time'=> '13:00',
            ],
            [
                'ferry_id'=>'3',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-27',
                'arrival_date'=>'2023-10-28',
                'departure_time'=> '08:00',
                'arrival_time'=> '06:00',
            ],
            [
                'ferry_id'=>'1',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-28',
                'arrival_date'=>'2023-10-29',
                'departure_time'=> '13:00',
                'arrival_time'=> '14:00',
            ],
            [
                'ferry_id'=>'2',
                'departure_port'=>'Zamboanga',
                'arrival_port'=>'Jolo, Sulu',
                'departure_date'=>'2023-10-28',
                'arrival_date'=>'2023-10-29',
                'departure_time'=> '18:00',
                'arrival_time'=> '20:00',
            ],
        ];
    
        foreach ($schedules as $key => $schedule) {
            Schedules::create($schedule);
        }

        $fares = [
            [
                'ferry_id'=>'1',
                'type'=>'Economy',
                'notes'=> 'Open Space',
                'price'=> 1000.00,
            ],
            [
                'ferry_id'=>'1',
                'type'=>'Aircon',
                'notes'=> 'Open Space',
                'price'=> 1500.00,
            ],
            [
                'ferry_id'=>'2',
                'type'=>'Economy',
                'notes'=> 'Open Space',
                'price'=> 600.00,
            ],
            [
                'ferry_id'=>'2',
                'type'=>'Aircon',
                'notes'=> 'Open Space',
                'price'=> 800.00,
            ],
            [
                'ferry_id'=>'3',
                'type'=>'Economy',
                'notes'=> 'Open Space',
                'price'=> 250.00,
            ],
            [
                'ferry_id'=>'3',
                'type'=>'Aircon',
                'notes'=> 'Open Space',
                'price'=> 450.00,
            ],
        ];
    
        foreach ($fares as $key => $fare) {
            Fares::create($fare);
        }
    }
}
