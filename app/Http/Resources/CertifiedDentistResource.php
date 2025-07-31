<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CertifiedDentistResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'image' => $this->image ? asset('storage/' . $this->image) : null,
            'name' => $this->name,
            'position' => $this->position,
            'years_of_experience' => $this->years_of_experience,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}