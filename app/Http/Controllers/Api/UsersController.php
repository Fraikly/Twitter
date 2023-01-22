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
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index(FilterRequest $request)
    {

        $data = $request->validated();
        $page = $request['page'] ?? 1;
        $per_page = $request['per_page'] ?? 20;


        if ($data != null) {
            $filter = app()->make(UserFilter::class, ['queryParams' => array_filter($data)]);
            $users = User::filter($filter)->paginate($per_page, ['*'], 'page', $page);

        } else {
            $users = User::paginate($per_page, ['*'], 'page', $page);

        }
        return UserResource::collection($users);
    }

    public function show(User $user, Request $request)
    {
        $data = $request;
        $page = $data['page'] ?? 1;
        $per_page = $data['per_page'] ?? 20;

        $twits = $user->twits()->latest()->paginate($per_page, ['*'], 'page', $page);


        return ['user_info' => [new UserResource($user), new UserInfoResource($user)], 'twits' => TwitResource::collection($twits)];
    }

    public function update(User $user, Request $request)
    {
        if(!isset($request['login'])){
            return 'Login is a required field';
        }
        else if(mb_strlen($request['login'])>20){
            return 'Login must be less than 20 characters';
        }
        else if(mb_strlen($request['about'])>160){
            return 'About must be less than 160 characters';
        }

        $data = $request->validate([
            'login'=>'string|required|max:20',
            'about'=>'max:160',
            'picture'=>''
        ]);

        if ($request->hasFile('picture')) {
            if ($user->picture != "icons/user.png")
                unlink(public_path() . "/storage/" . $user->picture);

            $paths = $data["picture"]->store('icons', 'public');
            $data["picture"] = $paths;
        }


        $user->update($data);
        $user->fresh();
        return ['user_info' => [new UserResource($user), new UserInfoResource($user)]];


    }
    public function destroy(User $user){
        AppHelper::deleteUser($user);
        return "The deletion was successful";
    }
}
