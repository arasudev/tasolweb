<?php

use App\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = [
            [
                'name' => 'PHP Team',
            ],
            [
                'name' => 'ROR Team'
            ],
            [
                'name' => 'Design team'
            ],
        ];

        foreach ($teams as $team) {
            Team::updateOrCreate([
                'name' => $team['name']
            ], [
                'name' => $team['name'],
            ]);
        }
    }
}
