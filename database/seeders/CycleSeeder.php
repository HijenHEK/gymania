<?php

namespace Database\Seeders;

use App\Models\Cycle;
use Illuminate\Database\Seeder;

class CycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Cycle::create([
            'name' => 'Monthly',
            'period' => 30,
        ]);

        Cycle::create([
            'name' => 'six-monthly',
            'period' => 182,

        ]);

        Cycle::create([
            'name' => 'yearly',
            'period' => 365,

        ]);

    }
}
