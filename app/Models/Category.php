<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    public array $translatable = [
        'name',
        'description',
    ];

    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class);
    }
}