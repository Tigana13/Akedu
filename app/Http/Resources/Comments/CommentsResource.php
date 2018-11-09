<?php

namespace App\Http\Resources\Comments;

use App\User;
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
        $user = User::find($this->user_id);
        return[
            'body' => $this->body,
            'author' => $user['name'],
            'replies' => CommentsResource::collection($this->comments),
            'created_at' => $this->created_at
        ];
    }
}
