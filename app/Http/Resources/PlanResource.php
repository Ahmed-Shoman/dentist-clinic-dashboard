<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'plan_name' => $this->plan_name,
            'price' => $this->price,
            'description' => $this->description,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}