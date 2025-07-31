<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsSection extends Model
{
    protected $fillable = [
        'image',
        'title',
        'description',
        'cards',
    ];

    protected $casts = [
        'cards' => 'array', // to handle JSON field as array
    ];
}
