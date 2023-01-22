<?php

namespace App\Http\Controllers\Api;


use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Http\Filters\UserFilter;
use App\Http\Requests\Comments\StoreRequest;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Http\Resources\Comments\CommentsResource;
use App\Http\Resources\Twit\TwitResource;
use App\Http\Resources\User\UserInfoResource;
use App\Http\Resources\User\UserResource;
use App\Models\Comment;
use App\Models\LikesForTwit;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReCommentsController extends Controller
{
    public function store(Twit $twit, Comment $comment, Request $request)
    {
        if (!isset($request["text"]) or !isset($request["user_id"])) {
            return "text and user_id are the required field";
        }
        if (User::find($request["user_id"]) === null) {
            return 'User with this user_id doesnt exist';
        } else if (mb_strlen($request['text']) > 200) {
            return 'text must be less than 200 characters';
        }

        Comment::create([
            'twit_id' => $twit->id,
            'user_id' => $request['user_id'],
            'text' => $request['text'],
            'is_answer'=>1,
            'comment_id'=>$comment->id,
        ]);

        return "Comments was created";
    }


}
