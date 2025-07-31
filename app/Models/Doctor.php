<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service;


class Doctor extends Model
{
    protected $fillable = ['image', 'name', 'job', 'is_active', 'service_id'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
