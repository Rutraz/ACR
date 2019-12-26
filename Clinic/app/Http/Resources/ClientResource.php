<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;

class ClientResource extends JsonResource
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
            'id'=>$this->id,
            'user' => new UserResource($this->user),
            'CC' => $this->CC,
            'adse' => $this->adse,
            'morada' => $this->morada,
            'idade' => $this->idade,
        ];
    }
}
