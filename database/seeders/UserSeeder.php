<?php

namespace Database\Seeders;

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
            'email' => 'admin@gymnia.com',
            'password' => Hash::make('adminpassword')
        ]);

        $admin->assignRole('Admin');
        $admin->save();
    }
}
