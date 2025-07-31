<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertifiedDentist extends Model
{
    protected $fillable = [
        'image',
        'name',
        'position',
        'years_of_experience',
    ];
}