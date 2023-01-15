<?php

namespace App\Http\Controllers\Twits;

use App\Http\Controllers\Controller;
use App\Models\SubscriberSubscription;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{

public function __invoke(User $user)
{
$title="Новый твит";

   return view('twits.create',compact('title'));
}

}
