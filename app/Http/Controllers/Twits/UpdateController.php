<?php

namespace App\Http\Controllers\Twits;

use App\Http\Controllers\Controller;
use  \App\Http\Requests\Twits\UpdateRequest;
use App\Models\Image;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{

public function __invoke(Twit $twit, UpdateRequest $request)
{

    $data=$request->validated();
//    dd($data);
    $paths=[];
    if(!isset($data['old_photo'])){

        foreach ($twit->images()->get() as $photo){
            unlink(public_path()."/storage/". $photo->patch);
        }
        Image::where(['twit_id'=>$twit->id])->delete();

        if($request->hasFile('photos')){
            foreach ( $data["photos"] as $photo){
                $paths[] = $photo->store('photos','public');
            }
            unset($data["photos"]);

            foreach ($paths as $path){
                Image::create([
                    'twit_id'=>$twit->id,
                    'patch'=>$path
                ]);
            }
        }
    }
unset($data['old_photo']);



    $twit->update($data);
    return redirect()->route('users.show',Auth::user()->getAuthIdentifier());

}
}
