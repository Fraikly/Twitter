<?php

namespace App\Http\Controllers\Twits;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{

    public function __invoke()
    {
        $title = "Новый твит";
        $user = User::find(Auth::user()->id);
        return view('twits.create', compact('title', 'user'));
    }

}
