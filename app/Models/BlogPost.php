<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class BlogPost extends Model
{
    // use HasTranslations;



    use HasTranslations;

     protected $fillable = ['image', 'published_at', 'author', 'title', 'description', 'category_id'];

    public $translatable = ['author', 'title', 'description'];



    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
