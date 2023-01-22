<?php

namespace App\Http\Controllers\Api;


use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Http\Filters\UserFilter;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\Twits\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Http\Resources\Twit\TwitResource;
use App\Http\Resources\User\UserInfoResource;
use App\Http\Resources\User\UserResource;
use App\Models\Image;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class RetwitsController extends Controller
{
    public function store(Twit $twit, Request $request)
    {
        if (Twit::find($twit->id) === null) {
            return 'This twit doesnt exist';
        }

        else if (!isset($request['user_id']) or !isset($request['text'])) {
            return "user_id and text are the required field";
        } else if (mb_strlen($request['text']) > 400) {
            return 'text must be less than 400 characters';
        } else if (User::find($request['user_id']) === null) {
            return 'User with this user_id doesnt exist';
        }

        $data = $request->validate([
            'user_id' => '',
            'text' => 'string|max:400|required',
            'photos' => '',
        ]);
        $data['retwit']=1;
        $data['original_twit']=$twit->id;


        $paths = [];
        if ($request->hasFile('photos')) {
            foreach ($data["photos"] as $photo) {
                $paths[] = $photo->store('photos', 'public');
            }
            unset($data["photos"]);
        }


        $twit = Twit::create($data);

        foreach ($paths as $path) {
            Image::create([
                'twit_id' => $twit->id,
                'patch' => $path
            ]);
        }
        return 'Creating was successful';
    }

}
