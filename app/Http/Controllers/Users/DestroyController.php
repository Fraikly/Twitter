<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateRequest;
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

    SubscriberSubscription::where(['subscriber_id'=>Auth::user()->getAuthIdentifier()])->delete();
    SubscriberSubscription::where(['subscription_id'=> Auth::user()->getAuthIdentifier()])->delete();
    Twit::where(['user_id'=> Auth::user()->getAuthIdentifier()])->delete();
    $user->delete();

    return redirect()->route('home');

}
}
