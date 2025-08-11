<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurService extends Model
{
    protected $fillable = [
        'title',
        'sub_title',
        'services',
    ];

    protected $casts = [
        'services' => 'array',  // cast JSON field to array automatically
    ];
}