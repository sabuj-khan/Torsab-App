<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    
    protected $fillable = ['first_name', 'last_name', 'email', 'mobile', 'password', 'user_type', 'otp'];

    protected $attributes = [
        'otp'       => 0,
        'user_type' => 'user'
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function tag(){
        return $this->hasMany(User::class);
    }

    public function category(){
        return $this->hasMany(Category::class);
    }





}
