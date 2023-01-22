<?php

namespace App\Http\Controllers\Twits\Comments\ReComments;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Twit;
use App\Models\User;

class CreateController extends Controller
{

    public function __invoke(Twit $twit, Comment $comment)
    {
        $title = "Ответ на комментарий";
        return view('comments.recomments.create', compact('title', 'comment', 'twit'));
    }

}
