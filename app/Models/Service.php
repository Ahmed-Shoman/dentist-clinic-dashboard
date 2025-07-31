<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $fillable = ['thumbnail', 'title', 'description', 'is_active', 'images'];

    protected $casts = [
        'images' => 'array',
    ];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}