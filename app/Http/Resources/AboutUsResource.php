<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutUsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'sub_title' => $this->sub_title,
            'sub_description' => $this->sub_description,
            'phone_number' => $this->phone_number,
            'doctor_image' => $this->doctor_image ? asset('storage/' . $this->doctor_image) : null,
        ];
    }
}