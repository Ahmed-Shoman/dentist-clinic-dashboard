<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return ServiceResource::collection(Service::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'thumbnail' => 'nullable|string',
            'title' => 'required|array',           // expects { en: "...", ar: "..." }
            'description' => 'nullable|array',
            'is_active' => 'boolean',
            'images' => 'nullable|array',
        ]);

        $service = Service::create($data);

        return new ServiceResource($service);
    }

    public function show(Service $service)
    {
        return new ServiceResource($service);
    }


}
