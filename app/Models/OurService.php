<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class OurService extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'sub_title',
        'services',
    ];

    protected $casts = [
        'services' => 'array',  // array of service items
    ];

    public array $translatable = [
        'title',
        'sub_title',
        // optionally you can handle translations inside 'services' manually
    ];
}