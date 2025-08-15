<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Statistic extends Model
{
    use HasTranslations;

    protected $fillable = [
        'number',
        'name',
    ];

    public array $translatable = [
        'name',
    ];
}
