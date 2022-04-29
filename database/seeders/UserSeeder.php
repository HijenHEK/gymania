<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = User::make([
            'name' => 'admin' ,
            'username' => 'admin' ,
            'email' => 'admin@gymania.com',
            'password' => Hash::make('password')

        ]);

        $admin->assignRole('Admin');
        $admin->save();


        Member::factory()->count(30)->create();
    }
}
