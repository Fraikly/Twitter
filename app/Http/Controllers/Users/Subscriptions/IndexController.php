<?php

namespace App\Http\Controllers\Users\Subscriptions;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterRequest;
use App\Models\SubscriberSubscription;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{

public function __invoke(User $user, FilterRequest $request)
{
    $ownerUser = $user;
    $title = "Подписки ".$ownerUser->login;
    $data = $request->validated();
    if ($data != null) {
        $users = $ownerUser->subscriptions()->where('login','like',"%{$data['login']}%")->paginate(20);

    } else {
        $users = $ownerUser->subscriptions()->paginate(20);

    }

   return view('subscriptions.index',compact('users','title','ownerUser'));
}
}
