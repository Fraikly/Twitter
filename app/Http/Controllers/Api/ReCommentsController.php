<?php

namespace App\Http\Controllers\Api;


use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Twit;
use Illuminate\Http\Request;

class ReCommentsController extends Controller
{
    public function store(Twit $twit, Comment $comment, Request $request)
    {
        $error =  AppHelper::checkText($request['text']);
        $error .=  AppHelper::checkUserId($request['user_id']);

        if($error!=null){
            return $error;
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
