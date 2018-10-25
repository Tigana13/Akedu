<?php

namespace App\Http\Resources\Courses;

use App\Http\Resources\Colleges\CollegesResource;
use App\Http\Resources\Intakes\IntakesResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursesResource extends JsonResource
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
            'course_name' => $this->course_name,
            'certified' => $this->certified,
            'college' => CollegesResource::collection($this->whenLoaded('college')),
            'intakes' => IntakesResource::collection($this->whenLoaded('intakes')),
        ];
    }
}
