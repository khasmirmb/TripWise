<?php

namespace Database\Seeders;

use App\Models\Ferries;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateFerriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
