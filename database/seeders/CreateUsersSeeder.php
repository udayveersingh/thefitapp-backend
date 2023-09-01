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
        $user = [
            [
               'name'=>'Admin',
               'email'=>'admin@admin.com',
               'role'=>'admin',
               'password'=> bcrypt('Password@123'),
            ],
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
