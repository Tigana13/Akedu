<?php

namespace App\Http\Resources\Colleges;

use App\Http\Resources\Courses\CoursesResource;
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
            'college_name' => $this->college_name,
            'college_email' => $this->college_email,
            'courses' => CoursesResource::collection($this->whenLoaded('courses')),
            'active' => $this->active,
            'certified' => $this->certified
        ];
    }

}
