<?php

namespace App\Http\Controllers\Api;


use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\LikesForComment;
use App\Models\Twit;
use Illuminate\Http\Request;

class LikesForCommentController extends Controller
{
    public function store(Twit $twit,Comment $comment, Request $request)
    {
        $error =  AppHelper::checkUserId($request['user_id']);
        if($error!=null){
            return $error;
        }

        if(LikesForComment::where(['comment_id'=>$comment->id,
            'user_id'=>$request['user_id'],])->get()->isEmpty())

            LikesForComment::create([
                'comment_id'=>$comment->id,
                'user_id'=>$request['user_id'],

            ]);
        return "Like was successful";
    }

    public function destroy(Twit $twit,Comment $comment, Request $request)
    {
        $error =  AppHelper::checkUserId($request['user_id']);
        if($error!=null){
            return $error;
        }

        LikesForComment::where([
            'comment_id'=>$comment->id,
            'user_id'=>$request["user_id"],
        ])->delete();

        return "Like was delete";
    }
}
