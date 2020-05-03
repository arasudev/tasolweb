<?php

use App\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            // Breakfast
            ['name' => 'Idly', 'slug' => 'idly', 'type' => BREAKFAST_MENU, 'bill_type' => BILL_TYPE_INDIVIDUAL, 'price' => 7],
            ['name' => 'Chapati', 'slug' => 'chapati', 'type' => BREAKFAST_MENU, 'bill_type' => BILL_TYPE_INDIVIDUAL, 'price' => 13],
            // TODO :: Curd for upma rs 50 addddddddd
            ['name' => 'Upma', 'slug' => 'upma', 'type' => BREAKFAST_MENU, 'bill_type' => BILL_TYPE_COMMON, 'price' => 35],
            ['name' => 'Boori', 'slug' => 'boori', 'type' => BREAKFAST_MENU, 'bill_type' => BILL_TYPE_INDIVIDUAL, 'price' => 13],
            ['name' => 'Dosa', 'slug' => 'dosa', 'type' => BREAKFAST_MENU, 'bill_type' => BILL_TYPE_INDIVIDUAL, 'price' => 13],


            // Lunch
            ['name' => 'Rice', 'slug' => 'rice', 'type' => LUNCH_MENU, 'bill_type' => BILL_TYPE_COMMON, 'price' => 65],
        ];

        foreach ($menus as $menu) {
            Menu::updateOrCreate([
                'slug' => $menu['slug']
            ], [
                'name' => $menu['name'],
                'slug' => $menu['slug'],
                'type' => $menu['type'],
                'bill_type' => $menu['bill_type'],
                'price' => $menu['price']
            ]);
        }
    }
}
