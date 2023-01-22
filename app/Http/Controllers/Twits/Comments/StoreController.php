<?php

namespace App\Http\Controllers\Twits\Comments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comments\StoreRequest;
use App\Models\Comment;
use App\Models\Twit;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{

    public function __invoke(Twit $twit, StoreRequest $request)
    {

        $data = $request->validated();

        Comment::create([
            'twit_id' => $twit->id,
            'user_id' => Auth::user()->id,
            'text' => $data['text'],
        ]);

        return redirect()->back();
    }

}
