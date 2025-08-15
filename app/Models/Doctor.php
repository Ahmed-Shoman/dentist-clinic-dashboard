<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Service;

class Doctor extends Model
{
    use HasTranslations;

    protected $fillable = [
        'image',
        'name',
        'job',
        'is_active',
        'service_id',
    ];

    public array $translatable = [
        'name',
        'job',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}