<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Fauzi',
                'email' => 'fauzi@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('12108423')
            ],
            [
                'name' => 'Kasir',
                'email' => 'kasir@gmail.com',
                'role' => 'petugas',
                'password' => bcrypt('12108423')
            ],
        ];

        foreach($userData as $key => $value) {
            User::create($value);
        }
    }
}