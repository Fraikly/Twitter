<?php

namespace App\Http\Controllers\Twits\Comments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comments\StoreRequest;
use  \App\Http\Requests\Twits\UpdateRequest;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{

public function __invoke(Twit $twit,Comment $comment, StoreRequest $request)
{

    $data=$request->validated();
    Comment::find($comment->id)->update($data);
    return redirect()->route('comments.index',$twit->id);

}
}
