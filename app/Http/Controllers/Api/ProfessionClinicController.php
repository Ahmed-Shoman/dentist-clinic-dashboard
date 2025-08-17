<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfessionClinicResource;
use App\Models\ProfessionClinic;
use Illuminate\Http\Request;

class ProfessionClinicController extends Controller
{
    public function index()
    {
        return ProfessionClinicResource::collection(ProfessionClinic::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|array',
            'subtitle' => 'nullable|array',
            'description' => 'nullable|array',
            'image' => 'nullable|string',
        ]);

        $clinic = ProfessionClinic::create($data);

        return new ProfessionClinicResource($clinic);
    }

    public function show(ProfessionClinic $professionClinic)
    {
        return new ProfessionClinicResource($professionClinic);
    }


}