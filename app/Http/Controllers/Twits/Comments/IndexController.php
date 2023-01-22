<?php

namespace App\Http\Controllers\Twits\Comments;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Twit;
use App\Models\User;

class IndexController extends Controller
{

    public function __invoke(Twit $twit)
    {

        $months = AppHelper::$months;
        $user = User::find($twit->user_id);
        $title = "Комментарии";
        $comments = Comment::where('twit_id', $twit->id)->orderBy('created_at')->paginate(20);
        return view('comments.index', compact('twit', 'comments', 'months', 'title', 'user'));


    }
}
