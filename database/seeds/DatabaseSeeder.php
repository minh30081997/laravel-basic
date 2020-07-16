<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        DB::table('loaisanpham')->insert([
            ['Ten' => 'may tinh'],
            ['Ten' => 'dien thoai'],
            ['Ten' => 'xe may'],
            ['Ten' => 'o to'],            
            ['Ten' => 'dieu hoa'],
        ]);

    }
}
