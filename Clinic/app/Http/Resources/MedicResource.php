<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;

class MedicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
        //    'user' => $this->user,
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'specialty' => $this->specialty,
            'rating' => $this->rating,
            'adse' => $this->adse,
            'calendarid' => $this->calendarid
        ];
    }
}
