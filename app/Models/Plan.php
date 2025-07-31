<?php

// app/Models/Plan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'plan_name',
        'price',
        'description',
    ];
}