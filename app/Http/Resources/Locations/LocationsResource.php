<?php

namespace App\Http\Resources\Locations;

use App\Http\Resources\Countries\CountriesResource;
use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Types\Parent_;

class LocationsResource extends JsonResource
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
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address' => $this->address,
            'city' => $this->city,
            'country' => [
                'country_name' => $this->country->country_name,
                'region_code' => $this->country->region_code,
                'continent' => $this->country->continent
            ]
        ];

    }
}
