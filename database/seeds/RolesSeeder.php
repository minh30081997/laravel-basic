<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author = Role::create([
            'name' => 'Phong Vien',
            'slug' => 'author',
            'permissions' => [
                'post.create' => true,
                'post.update' => true,
            ]
        ]);

        $editor = Role::create([
            'name' => 'Bien tap vien',
            'slug' => 'editor',
            'permissions' => [
                'post.update' => true,
                'post.publish' => true
            ]
        ]);
    }
}
