<?php

namespace App\Http\Controllers\Api;


use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Http\Filters\UserFilter;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Http\Resources\Twit\TwitResource;
use App\Http\Resources\User\UserInfoResource;
use App\Http\Resources\User\UserResource;
use App\Models\SubscriberSubscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribersController extends Controller
{
    public function index(User $user, FilterRequest $request)
    {
        $ownerUser = $user;
        $data = $request->validated();
        $page = $request['page'] ?? 1;
        $per_page = $request['per_page'] ?? 20;

        if ($data != null) {
            $users = $ownerUser->subscribers()->where('login', 'like', "%{$data['login']}%")->paginate($per_page, ['*'], 'page', $page);

        } else {
            $users = $ownerUser->subscribers()->paginate($per_page, ['*'], 'page', $page);

        }
        return UserResource::collection($users);
    }


    public function destroy(User $user, Request $request)
    {
        if (!isset ($request['subscribers_id'])) {
            return 'Specify the subscribers subscribers_id';
        }
        SubscriberSubscription::where([
            'subscriber_id' => $request['subscribers_id'],
            'subscription_id' => $user->id,
        ])->delete();

        return "The deletion was successful";
    }


}
