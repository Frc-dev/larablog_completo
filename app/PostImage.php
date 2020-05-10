<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PostImage extends Model
{
    protected $fillable = ['post_id', 'image'];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function getImageAttribute($value){
        return Storage::url($this->image);
    }
}
