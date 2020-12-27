<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Membership;
use App\Models\Package;
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
        

        Package::create(['name'=>'fitness30' , 'activity_id'=>1 , 'fee'=>45 , 'cycle_id'=>1]);
        Package::create(['name'=>'boxing30' , 'activity_id'=>2 , 'fee'=>60, 'cycle_id'=>1]);
        Package::create(['name'=>'swimming30' , 'activity_id'=>3 , 'fee'=>70 , 'cycle_id'=>1]);



        Member::all()->map->memberships()->map->create(['package_id'=>rand(1,3)]);
        // Membership::all()->map->setStatus('active');

        foreach (Membership::all() as $membership) {
            $membership->setStatus('active') ;
            $membership->expired_at = now()->addDays($membership->package->cycle->period)->setTime(0, 0, 0) ;
            $membership->save();
        }

        Role::where('name' , 'Admin')->first()->allowTo('manage_users');



    }
}
