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
use App\Models\LikesForTwit;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesForTwitController extends Controller
{
    public function store(Twit $twit,Request $request)
    {
        if(!isset($request["user_id"])){
            return "user_id is a required field";
        }else if (User::find($request['user_id']) === null) {
            return 'User with this user_id doesnt exist';
        }

        if(LikesForTwit::where(['twit_id'=>$twit->id,
            'user_id'=>$request['user_id'],])->get()->isEmpty())

            LikesForTwit::create([
                'twit_id'=>$twit->id,
                'user_id'=>$request['user_id'],

            ]);
        return "Like was successful";
    }

    public function destroy(Twit $twit,Request $request)
    {
        if(!isset($request["user_id"])){
            return "user_id is a required field";
        }else if (User::find($request['user_id']) === null) {
            return 'User with this user_id doesnt exist';
        }

        LikesForTwit::where([
            'twit_id'=>$twit->id,
            'user_id'=>$request["user_id"],
        ])->delete();

        return "Like was delete";
    }
}
