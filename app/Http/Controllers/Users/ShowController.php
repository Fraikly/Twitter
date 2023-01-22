<?php

namespace App\Http\Controllers\Users;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\User;


class ShowController extends Controller
{

    public function __invoke(User $user)
    {

        $months = AppHelper::$months;

        $twits = $user->twits()->latest()->paginate(20);
        $twitsCount = $user->twits->count();
        $title = $user->login;
        $subscriptions = $user->subscriptions()->count();
        $subscribers = $user->subscribers()->count();
        return view('users.show', compact('user', 'title', 'subscriptions', 'subscribers', 'twits', 'months', 'twitsCount'));
    }
}
