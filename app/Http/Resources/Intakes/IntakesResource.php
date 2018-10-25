<?php

namespace App\Http\Resources\Intakes;

use Illuminate\Http\Resources\Json\JsonResource;

class IntakesResource extends JsonResource
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
            'intake_alias' => $this->intake_alias,
            'intake_description' => $this->intake_description,
            'intake_start' => $this->intake_start,
            'intake_end' => $this->intake_finish
        ];
    }
}
