<?php

namespace App\Http\Resources\Comments;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'body' => $this->body,
            'created_at' => $this->created_at
        ];
    }
}
