<?php

namespace App\Http\Controllers\Users\Subscriptions;

use App\Http\Controllers\Controller;
use App\Models\SubscriberSubscription;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DestroyController extends Controller
{

public function __invoke(User $user)
{

    SubscriberSubscription::where([
        'subscriber_id'=>$user->id,
        'subscription_id'=>Auth::user()->getAuthIdentifier()
    ])->delete();

 return redirect()->back();
}
}
