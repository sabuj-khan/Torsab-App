<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'image', 'user_id', 'category_id', 'tag_id'];


    public function user() {
        return $this->belongsTo(User::class);
    }


    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tag(){
        return $this->belongsTo(Tag::class);
    }


}
