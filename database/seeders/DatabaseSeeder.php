<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            UserSeeder::class
        ]);
        

        Role::where('name' , 'Admin')->first()->allowTo('manage_users');



    }
}
