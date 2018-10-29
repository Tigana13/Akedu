<?php

namespace App\Http\Resources\Colleges;

use App\Http\Resources\Courses\CoursesResource;
use App\Http\Resources\Facilities\FacilitiesResource;
use App\Http\Resources\Images\ImagesResource;
use App\Http\Resources\Intakes\IntakesResource;
use App\Http\Resources\Locations\LocationsResource;
use App\Models\College\Profile\CollegeProfile;
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
        $college = CollegeProfile::where('college_id', id)->first();
        return [
            'id' => $this->id,
            'college_name' => $this->college_name,
            'college_email' => $this->college_email,
            'college_description' => $college->college_description,
            'active' => $this->active,
            'certified' => $this->certified,
            'branches' => LocationsResource::collection($this->whenLoaded('locations')),
            'courses' => CoursesResource::collection($this->whenLoaded('courses')),
            'facilities' => FacilitiesResource::collection($this->whenLoaded('facilities')),
            'intakes' => IntakesResource::collection($this->whenLoaded('intakes')),
            'images' => ImagesResource::collection($this->whenLoaded('images'))
        ];
    }

}
