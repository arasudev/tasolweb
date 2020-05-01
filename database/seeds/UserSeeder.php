<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Poovarasu S',
                'email' => 'poovarasu@mallow-tech.com',
                'password' => 'password',
                'breakfast' => true,
                'lunch' => true,
            ],
            [
                'name' => 'Anandhan S',
                'email' => 'anandhan@mallow-tech.com',
                'password' => 'password',
                'breakfast' => true,
                'lunch' => true,
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate([
                'email' => $user['email']
            ], [
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'breakfast' => $user['breakfast'],
                'lunch' => $user['lunch'],
            ]);
        }
    }
}
