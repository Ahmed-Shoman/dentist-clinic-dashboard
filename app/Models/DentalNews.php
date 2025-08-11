<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DentalNews extends Model
{
    protected $fillable = [
        'title',
        'description',
        'author',
        'date',
        'image',  // <-- add this line
    ];

    protected $dates = ['date'];
}