<?php

namespace App\Http\Controllers\Twits\Comments\Likes;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\LikesForComment;
use App\Models\LikesForTwit;
use App\Models\SubscriberSubscription;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DestroyController extends Controller
{

public function __invoke(Twit $twit,Comment $comment)
{
LikesForComment::where([
    'comment_id'=>$comment->id,
    'user_id'=>Auth::user()->id,
])->delete();

 return redirect()->back();
}
}
