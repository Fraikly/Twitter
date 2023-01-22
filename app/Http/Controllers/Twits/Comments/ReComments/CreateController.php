<?php

namespace App\Http\Controllers\Twits\Comments\ReComments;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\SubscriberSubscription;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{

public function __invoke(Twit $twit, Comment $comment)
{
    $title="Ответ на комментарий";
   return view('comments.recomments.create',compact('title','comment','twit'));
}

}
