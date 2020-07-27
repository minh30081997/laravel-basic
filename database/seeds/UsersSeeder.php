<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author = Role::where('slug', 'author')->first();
        $editor = Role::where('slug', 'editor')->first();

        $user1 = User::create([
            'name' => 'Phong vien 1',
            'email' => 'pv1@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $user1->role()->attach($author->id);

        $user2 = User::create([
            'name' => 'Phong vien 2', 
            'email' => 'pv2@gmail.com',
            'password' => bcrypt('password')
        ]);
        $user2->role()->attach($author->id);

        $user3 = User::create([
            'name' => 'Bien tap vien 1', 
            'email' => 'btv1@gmail.com',
            'password' => bcrypt('password')
        ]);
        $user3->role()->attach($editor->id);
    }
}
