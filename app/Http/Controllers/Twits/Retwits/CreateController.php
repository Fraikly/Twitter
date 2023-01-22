<?php

namespace App\Http\Controllers\Twits\Retwits;

use App\Http\Controllers\Controller;
use App\Models\SubscriberSubscription;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{

public function __invoke(Twit $twit)
{
    $title="Новый ретвит";
    $user=User::find($twit->user_id);
   return view('twits.retwits.create',compact('title','user','twit'));
}

}
