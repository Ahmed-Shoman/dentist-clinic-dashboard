<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DentalNewsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => $this->image ? asset('storage/' . $this->image) : null,
            'title' => $this->title,
            'description' => $this->description,
            'author' => $this->author,
            'date' => $this->date?->toDateString(),
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
