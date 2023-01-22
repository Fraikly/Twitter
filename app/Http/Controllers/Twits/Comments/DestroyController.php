<?php

namespace App\Http\Controllers\Twits\Comments;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Image;
use App\Models\LikesForComment;
use App\Models\SubscriberSubscription;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DestroyController extends Controller
{

public function __invoke(Twit $twit, Comment $comment)
{
    $this->authorize('view',User::find($comment->user_id));
AppHelper::deleteComment($comment);


 return redirect()->back();
}
}
