<?php

namespace App\Http\Controllers\Users;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\User;

class DestroyController extends Controller
{

    public function __invoke(User $user)
    {

        $this->authorize('view', $user);
        AppHelper::deleteUser($user);
        return redirect()->route('home');

    }
}
