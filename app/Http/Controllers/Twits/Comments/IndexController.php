<?php

namespace App\Http\Controllers\Twits\Comments;

use App\Http\Controllers\Controller;
use App\Http\Filters\UserFilter;
use App\Http\Requests\FilterRequest;
use App\Http\Resources\User\UserResource;
use App\Models\Comment;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{

    public function __invoke(Twit $twit)
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
        $user=User::find($twit->user_id);
        $title="Комментарии";
        $comments = Comment::where('twit_id',$twit->id)->orderBy('created_at')->paginate(20);
        return view('comments.index',compact('twit','comments','months','title','user'));


    }
}
