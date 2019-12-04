<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MedicResource;
use App\Medic;

class SpecialtyResource extends JsonResource
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
            'specialty' => $this->specialty,
            'user' => MedicResource::collection( Medic::where('specialty_id',$this->id)->get() ),
                ];
    }
}
