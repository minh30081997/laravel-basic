<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;
use App\Category;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author1 = User::where('email', 'pv1@gmail.com')->first();
        $author2 = User::where('email', 'pv2@gmail.com')->first();
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
            $post = Post::create([
                'title' => $title,
                'body' => $faker->text($maxNbChars = 1000),
                'slug' => str_slug($title),
                'published' => rand(0, 1),
                'user_id' => $author1->id,
                'cate_id' => 1,
            ]);
            $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
            $post = Post::create([
                'title' => $title,
                'body' => $faker->text($maxNbChars = 1000),
                'slug' => str_slug($title),
                'published' => rand(0, 1),
                'user_id' => $author2->id,
                'cate_id' => 2,
            ]);
        }
    }
}
