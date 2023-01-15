<?php

namespace App\Http\Controllers\Twits;

use App\Http\Controllers\Controller;
use App\Models\SubscriberSubscription;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DestroyController extends Controller
{

public function __invoke(Twit $twit)
{
    $this->authorize('view',User::find($twit->user_id));
    Twit::where('id',$twit->id)->delete();

 return redirect()->back();
}
}
