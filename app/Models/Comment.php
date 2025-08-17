<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations; //

class Comment extends Model
{
    use HasFactory;
    use HasTranslations; //

    protected $fillable = [
        'name',
        'email',
        'message',
    ];

    public array $translatable = [
        'name',
        'message',
    ];
}
