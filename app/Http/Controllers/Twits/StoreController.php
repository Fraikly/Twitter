<?php

namespace App\Http\Controllers\Twits;

use App\Http\Controllers\Controller;
use App\Http\Requests\Twits\StoreRequest;
use App\Models\SubscriberSubscription;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{

public function __invoke(StoreRequest $request)
{

    $data=$request->validated();
    $data['user_id']=Auth::user()->getAuthIdentifier();

    $data["photos"]=implode('; ',$data["photos"]);
    Twit::create(
        $data
    );
    return redirect()->route('users.show',$data['user_id']);
}

}
