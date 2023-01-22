<?php

namespace App\Http\Controllers\Twits\Comments\ReComments;

use App\Http\Controllers\Controller;

use App\Http\Requests\Comments\ReComments\StoreRequest;
use App\Models\Comment;
use App\Models\Image;
use App\Models\SubscriberSubscription;
use App\Models\Twit;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{

public function __invoke(Twit $twit, Comment $comment, StoreRequest $request)
{

    $data= $request->validated();
    Comment::create([
        'twit_id'=>$twit->id,
        'user_id'=>Auth::user()->id,
        'text'=>$data['text'],
        'is_answer'=>$data['is_answer'],
        'comment_id'=>$comment->id,
    ]);

    return redirect()->route('comments.index',$twit->id);
}

}
