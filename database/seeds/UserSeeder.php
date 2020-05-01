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
                'phone' => '8148406208',
                'gender' => 'Male',
                'breakfast' => true,
                'lunch' => true,
            ],
            [
                'name' => 'Anandhan S',
                'email' => 'anandhan@mallow-tech.com',
                'password' => 'password',
                'phone' => '1234567890',
                'gender' => 'Male',
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
                'phone' => $user['phone'],
                'gender' => $user['gender'],
                'breakfast' => $user['breakfast'],
                'lunch' => $user['lunch'],
            ]);
        }
    }
}
