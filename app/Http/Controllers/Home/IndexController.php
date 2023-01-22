<?php

namespace App\Http\Controllers\Home;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilterRequest;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{

    public function __invoke(FilterRequest $request)
    {
        $title = "Главная";

        if (Auth::check()) {
            $months = AppHelper::$months;
            $user = User::find(Auth::user()->id);
            $subscriptions = $user->subscriptions()->pluck('subscription_id');
            $subscriptionsTwits = Twit::whereIn('user_id', $subscriptions)->orderBy('created_at', 'DESC')->paginate(20);

            return view('home.authorize', compact('title', 'subscriptionsTwits', 'months', 'subscriptions', 'user'));
        }

        return view('home.no_authorize', compact('title'));
    }
}
