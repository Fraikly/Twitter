<?php

namespace App\Http\Controllers\Api;


use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilterRequest;
use App\Http\Resources\User\UserResource;
use App\Models\SubscriberSubscription;
use App\Models\User;
use Illuminate\Http\Request;

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
        $error =  AppHelper::checkUserId($request['subscribers_id'],'subscribers_id');
        if($error!=null){
            return $error;
        }

        SubscriberSubscription::where([
            'subscriber_id' => $request['subscribers_id'],
            'subscription_id' => $user->id,
        ])->delete();

        return "The deletion was successful";
    }


}
