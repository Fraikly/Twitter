<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowController extends Controller
{

    public function __invoke(User $user)
    {

        $months = [
            "Jan" => "Янв.",
            "Feb" => "Февр.",
            "Mar" => "Март.",
            "Apr" => "Апр.",
            "May" => "Мая",
            "Jun" => "Июня",
            "Jul" => "Июля",
            "Aug" => "Авг.",
            "Sep" => "Сент.",
            "Oct" => "Окт.",
            "Nov" => "Нояб.",
            "Dec" => "Дек.",
        ];

        $twits = $user->twits()->latest()->paginate(20);
        $twitsCount = $user->twits->count();
        $title = $user->login;
        $subscriptions = $user->subscriptions()->count();
        $subscribers = $user->subscribers()->count();
        return view('users.show', compact('user', 'title', 'subscriptions', 'subscribers', 'twits','months','twitsCount'));
    }
}
