<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Filters\UserFilter;
use App\Http\Requests\FilterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{

    public function __invoke(FilterRequest $request)
    {

        $data = $request->validated();
        if ($data != null) {
            $filter = app()->make(UserFilter::class, ['queryParams' => array_filter($data)]);
            $users = User::filter($filter)->paginate(20);

        } else {
            $users = User::paginate(20);

        }
        $subscriptions = null;
        if (Auth::check())
            $subscriptions = Auth::user()->subscriptions;
        $title = "Пользователи";

        return view('users.index', compact('users', 'title', 'subscriptions'));
    }
}
