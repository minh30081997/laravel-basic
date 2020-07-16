<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            ['name' => 'ClickBy', 'email' => 'clickby@gmail.com', 'password' => bcrypt('password')],
            ['name' => 'HP', 'email' => 'hp@gmail.com', 'password' => bcrypt('password')],
            ['name' => 'Acer', 'email' => 'acer@gmail.com', 'password' => bcrypt('password')],
            ['name' => 'Apple', 'email' => 'apple@gmail.com', 'password' => bcrypt('password')],
        ]);
    }
}
