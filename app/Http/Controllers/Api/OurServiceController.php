<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OurServiceResource;
use App\Models\OurService;
use Illuminate\Http\Request;

class OurServiceController extends Controller
{
    public function index()
    {
        return OurServiceResource::collection(OurService::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|array',
            'sub_title' => 'nullable|array',
            'services' => 'nullable|array',
        ]);

        $service = OurService::create($data);

        return new OurServiceResource($service);
    }

    public function show(OurService $ourService)
    {
        return new OurServiceResource($ourService);
    }
}