<?php

namespace App\Http\Controllers\Twits;

use App\Http\Controllers\Controller;
use App\Models\Twit;
use App\Models\User;
use App\Helpers\AppHelper;


class DestroyController extends Controller
{

    public function __invoke(Twit $twit)
    {
        $this->authorize('view', User::find($twit->user_id));

        AppHelper::deleteTwit($twit);


        return redirect()->back();
    }
}
