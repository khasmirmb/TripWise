<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class TestUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();

        for ($i = 0; $i < 30; $i++) {
            DB::table('users')->insert([
                'firstname' => $faker->firstNameFemale,
                'lastname' => $faker->lastName,
                'phone_number' => '09123456789',
                'address' => $faker->streetAddress,
                'image' => null,
                'email' => $faker->email,
                'email_verified_at' => null,
                'password' => Hash::make('password123'),
                'type' => 0,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
