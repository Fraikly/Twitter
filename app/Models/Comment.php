<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded=false;
    use HasFactory;

    function likes(){
        return $this->hasMany(LikesForComment::class,'comment_id','id');
    }
}
