<?php

namespace App\Http\Controllers\Api;


use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Twit;
use Illuminate\Http\Request;

class RetwitsController extends Controller
{
    public function store(Twit $twit, Request $request)
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
        $data['retwit']=1;
        $data['original_twit']=$twit->id;


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

}
