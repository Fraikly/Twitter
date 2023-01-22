<?php

namespace App\Helpers;
use App\Models\Comment;
use App\Models\Image;
use App\Models\LikesForComment;
use App\Models\LikesForTwit;
use App\Models\SubscriberSubscription;
use App\Models\Twit;
use App\Models\User;
use \Illuminate\Http\Request;

class AppHelper
{
    static $months = [
        "Jan" => "Янв.",
        "Feb" => "Февр.",
        "Mar" => "Март.",
        "Apr" => "Апр.",
        "May" => "Мая",
        "Jun" => "Июня",
        "Jul" => "Июля",
        "Aug" => "Авг.",
        "Sep" => "Сент.",
        "Oct" => "Окт.",
        "Nov" => "Нояб.",
        "Dec" => "Дек.",
    ];
    static function deleteUser(User $user){
        SubscriberSubscription::where(['subscriber_id'=>$user->id])->delete();
        SubscriberSubscription::where(['subscription_id'=> $user->id])->delete();

        LikesForComment::where(['user_id'=>$user->id])->delete();
        LikesForTwit::where(['user_id'=>$user->id])->delete();

        foreach (Comment::where(['user_id'=>$user->id])->get() as $comment){
           self::deleteComment($comment);
        }
//        Comment::where(['user_id'=>$user->id])->delete();
        foreach (Twit::where(['user_id'=> $user->id])->get() as $twit){
           self::deleteTwit($twit);
        }

        if($user->picture!="icons/user.png"){
            if (file_exists(public_path()."/storage/". $user->picture)){
                unlink(public_path()."/storage/". $user->picture);
            }

        }
        $user->delete();
    }
    static function deletePhotosFromTwit(Twit $twit)
    {
        foreach ($twit->images()->get() as $photo) {
            if(file_exists(public_path() . "/storage/" . $photo->patch))
            unlink(public_path() . "/storage/" . $photo->patch);
        }
    }

    static function deleteTwit(Twit $twit){
        self::deletePhotosFromTwit($twit);
        Image::where(['twit_id'=>$twit->id])->delete();
        self::deleteAllComments($twit);
        LikesForTwit::where(['twit_id'=>$twit->id])->delete();

        foreach(Twit::where(['original_twit'=>$twit->id])->get() as $retwit){
            self::deleteTwit($retwit);
        }

        Twit::where('id',$twit->id)->delete();


    }
    static function deleteAllComments(Twit $twit){

        foreach (Comment::where(['twit_id'=>$twit->id])->get() as $comment){
            self::deleteComment($comment);
        }
        Comment::where(['twit_id'=>$twit->id])->delete();


    }
    static function deleteComment(Comment $comment){

            LikesForComment::where(['comment_id'=>$comment->id])->delete();
            self::deleteAnswerForComments($comment);
            $mustDelete= Comment::find($comment->id);
                if($mustDelete!=null){
                    $mustDelete->delete();
                }


    }


    static function deleteAnswerForComments(Comment $comment){
        foreach ( Comment::where(['comment_id'=>$comment->id])->get() as $reComment){
            LikesForComment::where(['comment_id'=>$reComment->id])->delete();
        }
        Comment::where(['comment_id'=>$comment->id])->delete();
    }


    static function checkText($text=null, int $max_char=200){
        if ($text=='') {
            return "text is a required field.";
        }
        else if (mb_strlen($text) > $max_char) {
            return "Text must be less than {$max_char} characters";
        }
        return null;
    }

    static function checkUserId($id=null, $title='user_id'){
        if ($id=='') {
            return " {$title} is a required field.";
        }
        else if (User::find($id) === null) {
            return ' User with this user_id doesnt exist.';
        }
        return null;
    }
}
