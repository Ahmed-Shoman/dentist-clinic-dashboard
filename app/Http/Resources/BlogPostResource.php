<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogPostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'image' => asset('storage/' . $this->image),
            'published_at' => $this->published_at?->format('Y-m-d'),
            'author' => $this->getTranslation('author', app()->getLocale()),
            'title' => $this->getTranslation('title', app()->getLocale()),
            'description' => $this->getTranslation('description', app()->getLocale()),
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
