<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Twit extends Model
{
    protected $guarded = [];
    use HasFactory;
    function images(){
        return $this->hasMany(Image::class,'twit_id','id');
    }
    function likes(){
        return $this->hasMany(LikesForTwit::class,'twit_id','id');
    }
    function comments(){
        return $this->hasMany(Comment::class,'twit_id','id');
    }
}
