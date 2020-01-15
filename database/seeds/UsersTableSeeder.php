<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'admin 1',
            'email' => 'admin1@mail.com',
            'phone' => '088899998888',
            'address' => 'addres admin 1',
            'password' => Hash::make('12345')
        ]);

        User::create([
            'name' => 'admin 2',
            'email' => 'admin2@mail.com',
            'phone' => '088899998888',
            'address' => 'addres admin 2',
            'password' => Hash::make('12345')
        ]);
    }
}
