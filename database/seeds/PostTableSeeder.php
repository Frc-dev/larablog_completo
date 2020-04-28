<?php

use App\Category;
use App\Post;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();

        $categories = Category::all();

        foreach($categories as $key => $c){
            for($i=1; $i<=20; $i++){
                Post::create([
                    'title' => "Post $i $key",
                    'url_clean' => "post-$i-$key",
                    'content' => "djsaikfjkafijkoadsfjdasfjkopadfs",
                    'posted' => 'yes',
                    'category_id' => $c->id
                ]);
            }
        }

    }
}
