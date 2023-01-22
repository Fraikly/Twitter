<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Filters\UserFilter;
use App\Http\Requests\FilterRequest;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isEmpty;

class IndexController extends Controller
{

    public function __invoke(FilterRequest $request)
    {
        $title="Главная";

       if(Auth::check()){
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


           $user = User::find(Auth::user()->id);
           $subscriptions=$user->subscriptions()->pluck('subscription_id');
           $subscriptionsTwits=Twit::whereIn('user_id',$subscriptions)->orderBy('created_at','DESC')->paginate(20);
//           dd();
           return view('home.authorize',compact('title','subscriptionsTwits','months','subscriptions','user'));
       }

        return view('home.no_authorize',compact('title'));
    }
}
