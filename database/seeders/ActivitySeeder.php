<?php

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Activity::truncate();

        Activity::create([
            'id' => 1,
            'name' => 'Boxing',
            'description' => '',
        ]);

        Activity::create([
            'id' => 2,
            'name' => 'Yoga',
            'description' => ''
        ]);

        Activity::create([
            'id' => 3,
            'name' => 'Fitness Only',
            'description' => 'Use gym of equipments',
        ]);

        Activity::create([
            'id' => 4,
            'name' => 'Muai Thai',
            'description' => ''
        ]);
    }
}