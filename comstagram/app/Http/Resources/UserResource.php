<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'name' => $this->username,
            'id' => $this->id,
            'email' => $this->email,
            'posts' => $this->whenLoaded('posts'),
            'greetings' => $this->when(Auth::user()->name == 'scpark', 'Hi SungChul'),
        ];
    }
}
