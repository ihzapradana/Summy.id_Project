<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'owner123',
            'username' => 'owner123',
            'phone' => '083853797950',
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('owner123'),
            'role' => 'owner',
        ]);
        DB::table('users')->insert([
            'name' => 'petani123',
            'username' => 'petani123',
            'phone' => '083853797951',
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('petani123'),
            'role' => 'petani',
        ]);
        DB::table('users')->insert([
            'name' => 'customer123',
            'username' => 'customer123',
            'phone' => '083853797952',
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('customer123'),
            'role' => 'customer',
        ]);
    }
}
