<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Factories\CommentFactory;
use Illuminate\Database\Factories\PostFactory;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Post::factory()->count(50)
            ->create()
            ->each(function($post){
                $comments = \App\Models\Comment::factory()->count(2)->make();
                $post->comment()->saveMany($comments);
            });
    }
}
