<?php

namespace App\Http\Controllers\Twits\Comments\Likes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Twits\StoreRequest;
use App\Models\Comment;
use App\Models\Image;
use App\Models\LikesForComment;
use App\Models\LikesForTwit;
use App\Models\SubscriberSubscription;
use App\Models\Twit;
use App\Models\User;
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
