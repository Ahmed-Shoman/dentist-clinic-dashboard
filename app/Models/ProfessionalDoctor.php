<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalDoctor extends Model
{
    protected $fillable = ['doctors'];

    protected $casts = [
        'doctors' => 'array',
    ];
}