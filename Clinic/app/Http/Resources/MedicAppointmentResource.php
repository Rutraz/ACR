<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ClientResource;
use App\Http\Resources\StateResource;

class MedicAppointmentResource extends JsonResource
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
            'state' => new StateResource($this->state),
            'comments' => $this->comments,
            'rating' => $this->rating,
            'client' => new ClientResource($this->client),
        ];
    }
}
