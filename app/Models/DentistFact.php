<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DentistFact extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'facts',
        'time_table_title',
        'time_table_description',
        'schedule',
        'image',
        'background_image',
    ];

    protected $casts = [
        'facts' => 'array',     // Each fact can contain translated text inside the array
        'schedule' => 'array',  // Schedule can also have translated text inside
    ];

    public array $translatable = [
        'title',
        'time_table_title',
        'time_table_description',
    ];
}