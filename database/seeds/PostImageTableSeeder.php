<?php

use App\Post;
use App\PostImage;
use Illuminate\Database\Seeder;

class PostImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostImage::truncate();

        $posts = Post::all();

        foreach($posts as $key => $p){
            for($i=1; $i<=20; $i++){
                PostImage::create([
                    'image' => "$i.png",
                    'post_id' => $p->id,

                ]);
            }
        }
    }
}
