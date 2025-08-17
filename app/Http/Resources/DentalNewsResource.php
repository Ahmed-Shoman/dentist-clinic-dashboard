<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class DentalNewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->getTranslations('title'),       // ترجمات Spatie
            'description' => $this->getTranslations('description'), // ترجمات Spatie
            'author'      => $this->getTranslations('author'),      // ترجمات Spatie
            'date'        => $this->date ? Carbon::parse($this->date)->format('Y-m-d') : null,
            'image'       => $this->image,
            'created_at'  => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null,
            'updated_at'  => $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : null,
        ];
    }
}
