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
        Package::create(['name'=>'fitness1' , 'activity_id'=>1 , 'fee'=>4 , 'cycle_id'=>4]);
        Package::create(['name'=>'boxing1' , 'activity_id'=>2 , 'fee'=>6, 'cycle_id'=>4]);
        Package::create(['name'=>'swimming1' , 'activity_id'=>3 , 'fee'=>7 , 'cycle_id'=>4]);
        Package::create(['name'=>'fitness365' , 'activity_id'=>1 , 'fee'=>450 , 'cycle_id'=>3]);
        Package::create(['name'=>'boxing365' , 'activity_id'=>2 , 'fee'=>600, 'cycle_id'=>3]);
        Package::create(['name'=>'swimming365' , 'activity_id'=>3 , 'fee'=>700 , 'cycle_id'=>3]);



        // Member::all()->map->memberships()->create(['package_id' => random_int(1,9) ]);
        
        // Membership::all()->map->setStatus('active');
        foreach (Member::all() as $member) {
            $member->memberships()->create(['package_id' => random_int(1,9) ]); ;
            
        }
        foreach (Membership::all() as $membership) {
            $membership->setStatus('active') ;
            $membership->expired_at = now()->addDays( random_int(0 , $membership->package->cycle->period ))->setTime(00, 00, 00) ;
            $membership->save();
        }
        
        Role::where('name' , 'Admin')->first()->allowTo('manage_users');



    }
}
