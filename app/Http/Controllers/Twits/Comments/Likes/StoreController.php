<?php

namespace App\Http\Controllers\Twits\Comments\Likes;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\LikesForComment;
use App\Models\Twit;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{

public function __invoke(Twit $twit,Comment $comment)
{
    if(LikesForComment::where(['comment_id'=>$comment->id,
        'user_id'=>Auth::user()->id,])->get()->isEmpty())

        LikesForComment::create([
        'comment_id'=>$comment->id,
        'user_id'=>Auth::user()->id,

    ]);

    return redirect()->back();
}

}
