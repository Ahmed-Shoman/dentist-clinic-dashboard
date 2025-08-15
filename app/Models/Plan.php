<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Plan extends Model
{
    use HasTranslations;

    protected $fillable = [
        'plan_name',
        'price',
        'description',
    ];

    public array $translatable = [
        'plan_name',
        'description',
    ];
}