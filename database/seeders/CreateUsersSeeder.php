<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'firstname'=>'Admin',
                'lastname'=>'Admin',
                'email'=>'admin@gmail.com',
                'type'=>1,
                'password'=> bcrypt('123'),
            ],
            [
                'firstname'=>'User',
                'lastname'=>'Test',
                'email'=>'user@gmail.com',
                'type'=>0,
                'password'=> bcrypt('123'),
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
