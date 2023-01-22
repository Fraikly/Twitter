<?php

namespace App\Http\Controllers\Twits\Likes;

use App\Http\Controllers\Controller;
use App\Models\LikesForTwit;
use App\Models\SubscriberSubscription;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DestroyController extends Controller
{

public function __invoke(Twit $twit)
{
LikesForTwit::where([
    'twit_id'=>$twit->id,
    'user_id'=>Auth::user()->id,
])->delete();

 return redirect()->back();
}
}
