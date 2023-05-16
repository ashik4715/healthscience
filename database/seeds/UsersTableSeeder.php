<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->insert([
            'role_id' => 1,
            'prefix' => 'Mr.',
            'firstname' => 'First Admin',
            'lastname' => 'Last Admin',
            'address' => 'Admin address',
            'email' => 'admin@email.com',
            'password' => bcrypt('11111111'),
            'status' => 1,
        ]);
        DB::table('users')->insert([
            'role_id' => 2,
            'prefix' => 'Mr.',
            'firstname' => 'First Author',
            'lastname' => 'Last Author',
            'address' => 'Author address',
            'email' => 'author@email.com',
            'password' => bcrypt('22222222'),
            'status' => 1,
        ]);
    }
}
