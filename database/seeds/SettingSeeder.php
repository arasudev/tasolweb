<?php

use App\Menu;
use App\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            ['day' => MONDAY, 'breakfast_menu_id' => Menu::getIdly()->id, 'lunch_menu_id_one' => Menu::getRice()->id, 'lunch_menu_id_two' => null],
            ['day' => TUESDAY, 'breakfast_menu_id' => Menu::getChapati()->id, 'lunch_menu_id_one' => Menu::getRice()->id, 'lunch_menu_id_two' => null],
            ['day' => WEDNESDAY, 'breakfast_menu_id' => Menu::getUpma()->id, 'lunch_menu_id_one' => Menu::getRice()->id, 'lunch_menu_id_two' => null],
            ['day' => THURSDAY, 'breakfast_menu_id' => Menu::getBoori()->id, 'lunch_menu_id_one' => Menu::getRice()->id, 'lunch_menu_id_two' => null],
            ['day' => FRIDAY, 'breakfast_menu_id' => Menu::getDosa()->id, 'lunch_menu_id_one' => Menu::getRice()->id, 'lunch_menu_id_two' => null],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate([
                'day' => $setting['day']
            ], [
                'day' => $setting['day'],
                'breakfast_menu_id' => $setting['breakfast_menu_id'],
                'lunch_menu_id_one' => $setting['lunch_menu_id_one'],
                'lunch_menu_id_two' => $setting['lunch_menu_id_two'],
            ]);
        }
    }
}
