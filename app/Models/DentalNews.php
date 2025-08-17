<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DentalNews extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'description',
        'author',
        'date',
        'image',
    ];

    protected $dates = ['date'];

    public array $translatable = [
        'title',
        'description',
        'author',
    ];
}