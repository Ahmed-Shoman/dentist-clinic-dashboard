<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'about_us';

    protected $fillable = [
        'title',
        'description',
        'sub_title',
        'sub_description',
        'phone_number',
        'doctor_image',
    ];

    public array $translatable = [
        'title',
        'description',
        'sub_title',
        'sub_description',
    ];
}