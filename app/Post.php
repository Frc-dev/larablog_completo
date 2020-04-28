<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['posted', 'title', 'url_clean', 'content', 'category_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function image(){
        return $this->hasOne(PostImage::class);
    }
}
