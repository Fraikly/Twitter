<?php

namespace App\Http\Resources\Twit;

use App\Models\Comment;
use App\Models\Image;
use App\Models\LikesForTwit;
use App\Models\Twit;
use Illuminate\Http\Resources\Json\JsonResource;

class TwitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'user_id'=>$this->user_id,
            'text'=>$this->text,
            'pictures'=>Image::where('twit_id',$this->id)->pluck('patch'),
            'is_retwit'=>$this->retwit,
             'original_twit_id'=>$this->original_twit,
            'likes'=>LikesForTwit::where('twit_id',$this->id)->count(),
            'comments'=>Comment::where('twit_id',$this->id)->count(),
            'retwits_count'=>Twit::where('original_twit',$this->id)->count(),

        ];
    }
}
