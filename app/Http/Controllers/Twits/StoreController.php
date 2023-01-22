<?php

namespace App\Http\Controllers\Twits;

use App\Http\Controllers\Controller;
use App\Http\Requests\Twits\StoreRequest;
use App\Models\Image;
use App\Models\SubscriberSubscription;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{

    public function __invoke(StoreRequest $request)
    {

        $data = $request->validated();

        $data['user_id'] = Auth::user()->getAuthIdentifier();

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

        return redirect()->route('users.show', $data['user_id']);
    }

}
