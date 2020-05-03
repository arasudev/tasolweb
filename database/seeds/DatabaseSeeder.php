<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(TeamSeeder::class);
         $this->call(UserSeeder::class);
         $this->call(PermissionSeeder::class);
         $this->call(RoleSeeder::class);
         $this->call(MenuSeeder::class);
         $this->call(SettingSeeder::class);
         $this->call(UserMenuSeeder::class);
    }
}
