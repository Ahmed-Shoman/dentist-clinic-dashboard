<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DentistFactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'facts' => $this->facts, // array of subtitle & description
            'time_table_title' => $this->time_table_title,
            'time_table_description' => $this->time_table_description,
            'schedule' => $this->schedule, // array of day & time
            'image' => $this->image ? asset('storage/' . $this->image) : null,
            'background_image' => $this->background_image ? asset('storage/' . $this->background_image) : null,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}