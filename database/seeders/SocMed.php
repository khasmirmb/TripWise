<?php

namespace Database\Seeders;

use App\Models\Social;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocMed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socials = [
            ['name' => 'facebook', 'url' => 'https://www.facebook.com/'],
            ['name' => 'twitter', 'url' => 'https://www.twitter.com/'],
            ['name' => 'google', 'url' => 'https://www.google.com/'],
            ['name' => 'instagram', 'url' => 'https://www.instagram.com/'],
            ['name' => 'linkedin', 'url' => 'https://www.linkedin.com/'],
            // Add more social media platforms if needed
        ];

        foreach ($socials as $social) {
            Social::create($social);
        }
    }
}
