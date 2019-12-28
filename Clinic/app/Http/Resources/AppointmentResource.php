<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MedicResource;
use App\Http\Resources\StateResource;
use App\Http\Resources\ClientResource;

class AppointmentResource extends JsonResource
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
            'id' => $this->id,
            'date' => $this->date,
            'state' => $this->state->state,
            'comments' => $this->comments,
            'rating' => $this->rating,
            'client' => [
                'name'=>$this->client->user->name,
                'email'=>$this->client->user->email
            ],
            'medic' => [
                'id' => $this->medic->id,
                'name' => $this->medic->user ->name,
                'specialty' => $this->medic->specialty->specialty,
                'rating' => $this->medic->rating
            ]
           
        ];
    }
}
