<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'firstname'=>'Staff',
                'lastname'=>'Staff',
                'email'=>'staff@gmail.com',
                'type'=>0,
                'password'=> bcrypt('123'),
            ],
            [
                'firstname'=>'Admin',
                'lastname'=>'Admin',
                'email'=>'admin@gmail.com',
                'type'=>1,
                'password'=> bcrypt('123'),
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
