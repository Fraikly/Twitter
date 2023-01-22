<?php

namespace App\Http\Controllers\Users\Subscribers;

use App\Http\Controllers\Controller;
use App\Models\SubscriberSubscription;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DestroyController extends Controller
{

    public function __invoke(User $user)
    {

        SubscriberSubscription::where([
            'subscription_id' => $user->id,
            'subscriber_id' => Auth::user()->getAuthIdentifier()
        ])->delete();

        return redirect()->back();
    }
}
