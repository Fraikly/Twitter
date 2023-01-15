<?php

namespace App\Http\Controllers\Twits;

use App\Http\Controllers\Controller;
use  \App\Http\Requests\Twits\UpdateRequest;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{

public function __invoke(Twit $twit, UpdateRequest $request)
{
    $data=$request->validated();
    if( $data["photos"][0]!=null){
        $data["photos"]=implode('; ',$data["photos"]);
    }
else{
    unset( $data["photos"]);
}
    $twit->update($data);
    return redirect()->route('users.show',Auth::user()->getAuthIdentifier());

}
}
