<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UpdateController extends Controller
{

public function __invoke(User $user,UpdateRequest $request)
{
    $this->authorize('view',$user);
    $data=$request->validated();
    if(!isset($data["picture"])){
        unset($data["picture"]);
    }
    else
        $data["picture"]="img\\".$data["picture"];
    $user->update($data);
    return redirect()->route('users.show',$user->id);

}
}
