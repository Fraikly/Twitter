<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return   [
            'icon'=>$this->picture,
            'about' => $this->about,
            'twitsCount' => $this->twits->count(),
            'subscriptionsCount' => $this->subscriptions()->count(),
            'subscribersCount' => $this->subscribers()->count(),
        ];
    }
}
