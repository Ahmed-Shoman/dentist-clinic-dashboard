<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DentistFact extends Model
{
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
        'facts' => 'array',
        'schedule' => 'array',
    ];
}
