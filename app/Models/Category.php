<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'image'];

    public $translatable = ['name', 'description'];
    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class);
    }
}