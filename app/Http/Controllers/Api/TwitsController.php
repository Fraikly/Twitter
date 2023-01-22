<?php

namespace App\Http\Controllers\Api;


use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Twit\TwitResource;
use App\Models\Image;
use App\Models\Twit;
use Illuminate\Http\Request;


class TwitsController extends Controller
{
    public function store(Request $request)
    {

        $error =  AppHelper::checkText($request['text'],400);
        $error .=  AppHelper::checkUserId($request['user_id']);

        if($error!=null){
            return $error;
        }
        $data = $request->validate([
            'user_id' => '',
            'text' => 'string|max:400|required',
            'photos' => '',
        ]);

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
        return 'Creating was successful';
    }

    public function update(Twit $twit, Request $request)
    {
        $error =  AppHelper::checkText($request['text'],400);
        if($error!=null){
            return $error;
        }
          $data = $request->validate([
              'text'=>'string|max:400|required',
              'photos'=>'',
              'old_photo'=>'',
          ]);

    $paths = [];
    if (!isset($data['old_photo'])) {

        foreach ($twit->images()->get() as $photo) {
            unlink(public_path() . "/storage/" . $photo->patch);
        }
        Image::where(['twit_id' => $twit->id])->delete();

        if ($request->hasFile('photos')) {
            foreach ($data["photos"] as $photo) {
                $paths[] = $photo->store('photos', 'public');
            }
            unset($data["photos"]);

            foreach ($paths as $path) {
                Image::create([
                    'twit_id' => $twit->id,
                    'patch' => $path
                ]);
            }
        }
    }
unset($data['old_photo']);



    $twit->update($data);
    return 'Updating was successful';
    }
    public function show(Twit $twit)
    {
        return new TwitResource($twit);

    }

    public function destroy(Twit $twit)
    {
        AppHelper::deleteTwit($twit);
        return "The deletion was successful";

    }


}
