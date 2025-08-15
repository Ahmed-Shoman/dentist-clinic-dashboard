<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AboutUsSection extends Model
{
    use HasTranslations;

    protected $fillable = [
        'image',
        'title',
        'description',
        'cards',
    ];

    public array $translatable = [
        'title',
        'description',
        'cards',
    ];

    protected $casts = [
        'cards' => 'array',
    ];
}