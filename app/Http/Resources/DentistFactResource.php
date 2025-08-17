<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DentistFactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id'                    => $this->id,
            'title'                 => $this->getTranslations('title'),
            'facts'                 => $this->facts, // already casted to array
            'time_table_title'      => $this->getTranslations('time_table_title'),
            'time_table_description'=> $this->getTranslations('time_table_description'),
            'schedule'              => $this->schedule, // already casted to array
            'image'                 => $this->image,
            'background_image'      => $this->background_image,
            'created_at'            => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at'            => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}