<?php

namespace App\Http\Controllers\Twits\Comments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comments\StoreRequest;
use App\Models\Comment;
use App\Models\Twit;

class UpdateController extends Controller
{

public function __invoke(Twit $twit,Comment $comment, StoreRequest $request)
{

    $data=$request->validated();
    Comment::find($comment->id)->update($data);
    return redirect()->route('comments.index',$twit->id);

}
}
