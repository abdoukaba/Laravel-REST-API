<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SneakerResource extends JsonResource
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
        'sneaker_name' => $this->sneaker_name,
        'hype_level' => $this->hyper_level,
        'price' => $this->price,
        'release_date' => (string)$this->release_date,
        'user' => $this->user,
        'ratings' => $this->ratings,
      ];

    }
}
