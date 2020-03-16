<?php

use Illuminate\Database\Seeder;
use App\Posts;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $post = new Posts();
            $post->title = Str::random(12);
            $post->content = Str::random(12);
            $post->category_id = 1;
            $post->save();
        }
    }
}