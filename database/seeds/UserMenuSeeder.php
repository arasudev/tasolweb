<?php

use App\Menu;
use App\User;
use Illuminate\Database\Seeder;

class UserMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('breakfast', true)->get();
        $menuIds = Menu::where('type', BREAKFAST_MENU)->pluck('id')->toArray();
        foreach ($users as $user) {
            $user->menus()->sync($menuIds);
        }
    }
}
