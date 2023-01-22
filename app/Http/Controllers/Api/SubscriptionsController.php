<?php

namespace App\Http\Controllers\Api;


use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilterRequest;
use App\Http\Resources\User\UserResource;
use App\Models\SubscriberSubscription;
use App\Models\User;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function index(User $user, FilterRequest $request)
    {
        $ownerUser = $user;
        $data = $request->validated();
        $page = $request['page'] ?? 1;
        $per_page = $request['per_page'] ?? 20;

        if ($data != null) {
            $users = $ownerUser->subscriptions()->where('login', 'like', "%{$data['login']}%")->paginate($per_page, ['*'], 'page', $page);

        } else {
            $users = $ownerUser->subscriptions()->paginate($per_page, ['*'], 'page', $page);

        }
        return UserResource::collection($users);
    }


    public function destroy(User $user, Request $request)
    {
        $error =  AppHelper::checkUserId($request['subscription_id'],'subscription_id');
        if($error!=null){
            return $error;
        }

        SubscriberSubscription::where([
            'subscriber_id' => $user->id,
            'subscription_id' => $request['subscription_id'],
        ])->delete();

        return "The deletion was successful";
    }

    public function store(User $user, Request $request)
    {
        $error =  AppHelper::checkUserId($request['subscription_id'],'subscription_id');
        if($error!=null){
            return $error;
        }

        if (!SubscriberSubscription::where([
            'subscriber_id' => $user->id,
            'subscription_id' => $request['subscription_id']
        ])->get()->isEmpty()) {
            return 'User is already subscribed to it ';
        }
        SubscriberSubscription::create([
            'subscriber_id' => $user->id,
            'subscription_id' => $request['subscription_id']
        ]);
        return "The subscription was successful";
    }
}
