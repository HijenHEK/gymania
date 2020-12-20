<?php

namespace Database\Seeders;

use App\Models\Role;
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


        $this->call([

            RoleSeeder::class,
            AbilitySeeder::class,
            UserSeeder::class,
            CycleSeeder::class,
            ActivitySeeder::class
        ]);
        

        Role::where('name' , 'Admin')->first()->allowTo('manage_users');



    }
}
