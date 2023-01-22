<?php

namespace App\Http\Controllers\Users\Subscribers;

use App\Http\Controllers\Controller;
use App\Models\SubscriberSubscription;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{

    public function __invoke(User $user)
    {
        SubscriberSubscription::create([
            'subscriber_id' => Auth::user()->getAuthIdentifier(),
            'subscription_id' => $user->id
        ]);
        return redirect()->back();
    }

}
