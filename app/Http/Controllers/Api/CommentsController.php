<?php

namespace App\Http\Controllers\Api;


use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Comments\CommentsResource;
use App\Http\Resources\Twit\TwitResource;
use App\Models\Comment;
use App\Models\Twit;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Twit $twit, Request $request)
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
        ]);

        return "Comments was created";
    }
    public function index(Twit $twit){
        $comments = Comment::where('twit_id',$twit->id)->orderBy('created_at')->get();
        return["twit"=>new TwitResource($twit),"comments"=>CommentsResource::collection($comments)];
    }
    public function destroy(Twit $twit,Comment $comment){
        AppHelper::deleteComment($comment);
        return "The deletion was successful";
    }

    public function update(Twit $twit,Comment $comment, Request $request){
        $error =  AppHelper::checkText($request['text']);

        if($error!=null){
            return $error;
        }

        $data=$request->validate([
            'text'=>'string|max:200|required'
        ]);
        Comment::find($comment->id)->update($data);

        return "Updating was successful";
    }



}
