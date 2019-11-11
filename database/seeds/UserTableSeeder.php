<?php

use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(User::class, 10)->create();
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '09078785656',
            'gender' => 'Male', 
            'address' => 'Lagos',
            'role' => 'Admin',
            'password' => bcrypt('password'),
        ]);
    }
}
