<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProfessionalDoctor extends Model
{
    use HasTranslations;

    protected $fillable = [
        'doctors',
    ];

    protected $casts = [
        'doctors' => 'array',
    ];

    // Optionally mark 'doctors' as translatable if you want Spatie to handle it at top level
    // public array $translatable = ['doctors'];
}