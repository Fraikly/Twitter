<?php

namespace App\Http\Controllers\Twits\Comments;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditController extends Controller
{

public function __invoke(Twit $twit, Comment $comment)
{
    $this->authorize('view',User::find($comment->user_id));
    $title="Редактирование комментария";
//    $user=User::find(Auth::user()->id);
    return view('comments.edit',compact('title','twit','comment'));
}
}
