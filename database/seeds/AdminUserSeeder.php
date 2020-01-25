<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'phone' => '088899998888',
            'address' => 'addres admin',
            'password' => Hash::make('12345')
        ]);

        $admin->assignRole(['admin']);
    }
}
