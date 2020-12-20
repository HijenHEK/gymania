<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Activity::create([
            'name' => 'Fitness',
            'desc' => 'access to gym equipment',
        ]);

        Activity::create([
            'name' => 'Boxing',
            'desc' => 'access to the ring and  boxing equipment'
        ]);

        Activity::create([
            'name' => 'swimming',
            'desc' => 'access to the pool',
        ]);

    }
}