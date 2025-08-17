<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'image' => $this->image,
            'name' => $this->getTranslations('name'), // يدعم اللغات
            'job' => $this->getTranslations('job'),   // يدعم اللغات
            'is_active' => $this->is_active,
            'service' => [
                'id' => $this->service?->id,
                'name' => $this->service?->getTranslations('name') ?? null,
            ],
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}