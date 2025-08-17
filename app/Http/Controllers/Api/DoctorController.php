<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        return DoctorResource::collection(Doctor::with('service')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'nullable|string',
            'name' => 'required|array',
            'name.en' => 'required|string',
            'name.ar' => 'required|string',
            'job' => 'required|array',
            'job.en' => 'required|string',
            'job.ar' => 'required|string',
            'is_active' => 'boolean',
            'service_id' => 'required|exists:services,id',
        ]);

        $doctor = Doctor::create($data);

        return new DoctorResource($doctor->load('service'));
    }

    public function show(Doctor $doctor)
    {
        return new DoctorResource($doctor->load('service'));
    }


    }