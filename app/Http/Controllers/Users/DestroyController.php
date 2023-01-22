<?php

namespace App\Http\Controllers\Users;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\Comment;
use App\Models\Image;
use App\Models\LikesForComment;
use App\Models\LikesForTwit;
use App\Models\SubscriberSubscription;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DestroyController extends Controller
{

public function __invoke(User $user)
{

    $this->authorize('view',$user);

//    SubscriberSubscription::where(['subscriber_id'=>$user->id])->delete();
//    SubscriberSubscription::where(['subscription_id'=> $user->id])->delete();
//
//
//    LikesForComment::where(['user_id'=>$user->id])->delete();
//    LikesForTwit::where(['user_id'=>$user->id])->delete();

//    $comments = Comment::where(['user_id'=>$user->id])->get();
//
//    foreach ($comments as $comment){
//        LikesForComment::where(['comment_id'=>$comment->id])->delete();
//
//        foreach (Comment::where('comment_id',$comment->id)->get() as $reComment){
//            LikesForComment::where('comment_id',$reComment->id)->delete();
//        }
//        Comment::where('comment_id',$comment->id)->delete();
//    }
//    Comment::where(['user_id'=>$user->id])->delete();

//    $twits =  Twit::where(['user_id'=> $user->id])->get();
//
//    foreach ($twits as $twit){
//        foreach ($twit->images()->get() as $photo){
//            if(file_exists(public_path()."/storage/". $photo->patch)){
//                unlink(public_path()."/storage/". $photo->patch);
//            }
//
//        }
//        Image::where(['twit_id'=>$twit->id])->delete();
//        LikesForTwit::where(['twit_id'=>$twit->id])->delete();
//
//
//         foreach (Comment::where(['twit_id'=>$twit->id])->get() as $comment){
//             LikesForComment::where(['comment_id'=>$comment->id])->delete();
//           foreach (Comment::where(['comment_id'=>$comment->id])->get() as $reComment){
//               LikesForComment::where(['comment_id'=>$reComment->id])->delete();
//           }
//             Comment::where(['comment_id'=>$comment->id])->delete();
//         }
//        Comment::where(['twit_id'=>$twit->id])->delete();
//    }

//    Twit::where(['user_id'=> $user->id])->delete();

//    if($user->picture!="icons/user.png"){
//        if (file_exists(public_path()."/storage/". $user->picture)){
//            unlink(public_path()."/storage/". $user->picture);
//        }
//
//    }
//    $user->delete();
AppHelper::deleteUser($user);
    return redirect()->route('home');

}
}
