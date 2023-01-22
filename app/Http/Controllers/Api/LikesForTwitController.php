<?php

namespace App\Http\Controllers\Api;


use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\LikesForTwit;
use App\Models\Twit;
use Illuminate\Http\Request;

class LikesForTwitController extends Controller
{
    public function store(Twit $twit,Request $request)
    {
        $error =  AppHelper::checkUserId($request['user_id']);
        if($error!=null){
            return $error;
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
        $error =  AppHelper::checkUserId($request['user_id']);
        if($error!=null){
            return $error;
        }

        LikesForTwit::where([
            'twit_id'=>$twit->id,
            'user_id'=>$request["user_id"],
        ])->delete();

        return "Like was delete";
    }
}
