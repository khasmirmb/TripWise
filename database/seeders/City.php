<?php

namespace Database\Seeders;

use App\Models\City as ModelsCity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class City extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [

            ['city'=>'Alaminos'], ['city'=>'Angeles City'], ['city'=>'Antipolo'], ['city'=>'Bacolod'], ['city'=>'Bacoor'], ['city'=>'Bago'], ['city'=>'Baguio'], ['city'=>'Bais'], ['city'=>'Balanga'], ['city'=>'Baliwag'], ['city'=>'Batac'], ['city'=>'Batangas City'], ['city'=>'Bayawan'], ['city'=>'Baybay'], ['city'=>'Bayugan'], ['city'=>'Biñan'], ['city'=>'Bislig'], ['city'=>'Bogo'], ['city'=>'Borongan'], ['city'=>'Butuan'], ['city'=>'Cabadbaran'], ['city'=>'Cabanatuan'], ['city'=>'Cabuyao'], ['city'=>'Cadiz'], ['city'=>'Cagayan de Oro'], ['city'=>'Calaca'], ['city'=>'Calamba'], ['city'=>'Calapan'], ['city'=>'Calbayog'], ['city'=>'Caloocan'], ['city'=>'Candon'], ['city'=>'Canlaon'], ['city'=>'Carcar'], ['city'=>'Carmona'], ['city'=>'Catbalogan'], ['city'=>'Cauayan'], ['city'=>'Cavite City'], ['city'=>'Cebu City'], ['city'=>'Cotabato City'], ['city'=>'Dagupan'], ['city'=>'Danao'], ['city'=>'Dapitan'], ['city'=>'Dasmariñas'], ['city'=>'Davao City'], ['city'=>'Digos'], ['city'=>'Dipolog'], ['city'=>'Dumaguete'], ['city'=>'El Salvador'], ['city'=>'Escalante'], ['city'=>'Gapan'], ['city'=>'General Santos'], ['city'=>'General Trias'], ['city'=>'Gingoog'], ['city'=>'Guihulngan'], ['city'=>'Himamaylan'], ['city'=>'Ilagan'], ['city'=>'Iligan'], ['city'=>'Iloilo City'], ['city'=>'Imus'], ['city'=>'Iriga'], ['city'=>'Isabela'], ['city'=>'Kabankalan'], ['city'=>'Kidapawan'], ['city'=>'Koronadal'], ['city'=>'La Carlota'], ['city'=>'Lamitan'], ['city'=>'Laoag'], ['city'=>'Lapu-Lapu City'], ['city'=>'Las Piñas'], ['city'=>'Legazpi'], ['city'=>'Ligao'], ['city'=>'Lipa'], ['city'=>'Lucena'], ['city'=>'Maasin'], ['city'=>'Mabalacat'], ['city'=>'Makati'], ['city'=>'Malaybalay'], ['city'=>'Malolos'], ['city'=>'Mandaluyong'], ['city'=>'Mandaue'], ['city'=>'Manila'], ['city'=>'Marawi'], ['city'=>'Marikina'], ['city'=>'Masbate City'], ['city'=>'Mati'], ['city'=>'Meycauayan'], ['city'=>'Muñoz'], ['city'=>'Muntinlupa'], ['city'=>'Naga Camarines Sur'], ['city'=>'Naga Cebu'], ['city'=>'Navotas'], ['city'=>'Olongapo'], ['city'=>'Ormoc'], ['city'=>'Oroquieta'], ['city'=>'Ozamiz'], ['city'=>'Pagadian'], ['city'=>'Palayan'], ['city'=>'Panabo'], ['city'=>'Parañaque'], ['city'=>'Pasay'], ['city'=>'Pasig'], ['city'=>'Passi'], ['city'=>'Puerto Princesa'], ['city'=>'Quezon City'], ['city'=>'Roxas'], ['city'=>'Sagay'], ['city'=>'Samal'], ['city'=>'San Carlos Negros Occidental'], ['city'=>'San Carlos Pangasinan'], ['city'=>'San Fernando La Union'], ['city'=>'San Fernando Pampanga'], ['city'=>'San Jose'], ['city'=>'San Jose del Monte'], ['city'=>'San Juan'], ['city'=>'San Pablo'], ['city'=>'San Pedro'], ['city'=>'Santa Rosa'], ['city'=>'Santo Tomas'], ['city'=>'Santiago'], ['city'=>'Silay'], ['city'=>'Sipalay'], ['city'=>'Sorsogon City'], ['city'=>'Surigao City'], ['city'=>'Tabaco'], ['city'=>'Tabuk'], ['city'=>'Tacloban'], ['city'=>'Tacurong'], ['city'=>'Tagaytay'], ['city'=>'Tagbilaran'], ['city'=>'Taguig'], ['city'=>'Tagum'], ['city'=>'Talisay Cebu'], ['city'=>'Talisay Negros Occidental'], ['city'=>'Tanauan'], ['city'=>'Tandag'], ['city'=>'Tangub'], ['city'=>'Tanjay'], ['city'=>'Tarlac City'], ['city'=>'Tayabas'], ['city'=>'Toledo'], ['city'=>'Trece Martires'], ['city'=>'Tuguegarao'], ['city'=>'Urdaneta'], ['city'=>'Valencia'], ['city'=>'Valenzuela'], ['city'=>'Victorias'], ['city'=>'Vigan'], ['city'=>'Zamboanga City'], ['city'=>'Jolo Sulu']

        ];
    
        foreach ($cities as $key => $city) {
            ModelsCity::create($city);
        }
    }
}
