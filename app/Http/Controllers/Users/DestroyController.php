<?php

namespace App\Http\Controllers\Users;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\Comment;
use App\Models\Image;
use App\Models\LikesForComment;
use App\Models\LikesForTwit;
use App\Models\SubscriberSubscription;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DestroyController extends Controller
{

public function __invoke(User $user)
{

    $this->authorize('view',$user);
    AppHelper::deleteUser($user);
    return redirect()->route('home');

}
}
