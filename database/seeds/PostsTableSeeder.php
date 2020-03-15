<?php

use Illuminate\Database\Seeder;
use App\Posts;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Posts();
        $post->title = 'Title 1';
        $post->content = 'Content 1';
        $post->image = 'Image 1';
        $post->user_id = 1;
        $post->save();

        $post = new Posts();
        $post->title = 'Title 2';
        $post->content = 'Content 2';
        $post->image = 'Image 2';
        $post->user_id = 1;
        $post->save();

        $post = new Posts();
        $post->title = 'Title 3';
        $post->content = 'Content 3';
        $post->image = 'Image 3';
        $post->user_id = 1;
        $post->save();
    }
}