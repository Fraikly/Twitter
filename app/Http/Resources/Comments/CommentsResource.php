<?php

namespace App\Http\Resources\Comments;

use App\Models\LikesForComment;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'user_id'=>$this->user_id,
            'text'=>$this->text,
            'is_answer'=>$this->is_answer,
            'comment_id'=>$this->comment_id,
            'likes'=>LikesForComment::where('comment_id',$this->id)->count()
        ];
    }
}
