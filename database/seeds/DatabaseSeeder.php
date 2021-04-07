<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          'name' => 'Admin',
          'email' =>'admin@unigo.com',
          'role' =>'sasAdmin',
          'password' => bcrypt('123456')
        ]);
        // $user = new User;
        // $user->name => 'Admin';
        // $user->email =>'admin@unigo.com';
        // $user->role =>'sasAdmin';
        // $user->password => bcrypt('123456');
        // $user->save();
    }
}
