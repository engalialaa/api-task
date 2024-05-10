<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->postId,
            'name' => $this->userName,
            'isBelongToMe' => $this->userId == auth()->user()->id,
            'title' => $this->title,
            'body' => $this->body,
            'userId' => $this->userId,
            'createdAt' => $this->created_at,
        ];
    }
}
