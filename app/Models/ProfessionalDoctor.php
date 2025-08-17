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
        'doctors' => 'array', // cast JSON to array
    ];
}