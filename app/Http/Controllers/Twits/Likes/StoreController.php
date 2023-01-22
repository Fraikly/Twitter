<?php

namespace App\Http\Controllers\Twits\Likes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Twits\StoreRequest;
use App\Models\Image;
use App\Models\LikesForTwit;
use App\Models\SubscriberSubscription;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{

public function __invoke(Twit $twit)
{
    if(LikesForTwit::where(['twit_id'=>$twit->id,
        'user_id'=>Auth::user()->id,])->get()->isEmpty())

    LikesForTwit::create([
        'twit_id'=>$twit->id,
        'user_id'=>Auth::user()->id,

    ]);

    return redirect()->back();
}

}
