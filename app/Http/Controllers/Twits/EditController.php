<?php

namespace App\Http\Controllers\Twits;

use App\Http\Controllers\Controller;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditController extends Controller
{

public function __invoke(Twit $twit)
{
    $this->authorize('view',User::find($twit->user_id));
    $title="Редактирование твита";
    $user=User::find(Auth::user()->id);
    return view('twits.edit',compact('title','twit','user'));
}
}
