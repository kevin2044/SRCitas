<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Kevin Luna',
            'email' => 'kevin_2044@hotmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'cedula' => '123456789',
            'address' => '',
            'phone' => '',
            'role' => 'admin'
        ]);
        factory(App\User::class, 50)->create();
    }
}
