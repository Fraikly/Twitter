<?php

namespace App\Http\Controllers\Users\Subscribers;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterRequest;
use App\Models\User;

class IndexController extends Controller
{

    public function __invoke(User $user, FilterRequest $request)
    {
        $ownerUser = $user;
        $title = "Подписчики " . $ownerUser->login;
        $data = $request->validated();
        if ($data != null) {
            $users = $ownerUser->subscribers()->where('login', 'like', "%{$data['login']}%")->paginate(20);

        } else {
            $users = $ownerUser->subscribers()->paginate(20);

        }

        return view('subscribers.index', compact('users', 'title', 'ownerUser'));
    }
}
