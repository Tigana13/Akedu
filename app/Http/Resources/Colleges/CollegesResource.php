<?php

namespace App\Http\Resources\Colleges;

use App\Http\Resources\Courses\CoursesResource;
use App\Http\Resources\Locations\LocationsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CollegesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'college_name' => $this->college_name,
            'college_email' => $this->college_email,
            'active' => $this->active,
            'certified' => $this->certified,
            'branches' => LocationsResource::collection($this->whenLoaded('locations')),
            'courses' => CoursesResource::collection($this->whenLoaded('courses')),
            'facilities' => CoursesResource::collection($this->whenLoaded('facilities')),
            'intakes' => CoursesResource::collection($this->whenLoaded('intakes')),
        ];
    }

}
