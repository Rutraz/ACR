<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MedicResource;
use App\Http\Resources\StateResource;

class ClientAppointmentResource extends JsonResource
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
            'medic' => new MedicResource($this->medic),

        ];
    }
}
