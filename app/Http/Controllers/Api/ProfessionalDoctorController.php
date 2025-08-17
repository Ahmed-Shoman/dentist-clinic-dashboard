<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfessionalDoctorResource;
use App\Models\ProfessionalDoctor;
use Illuminate\Http\Request;

class ProfessionalDoctorController extends Controller
{
    public function index()
    {
        return ProfessionalDoctorResource::collection(ProfessionalDoctor::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'doctors' => 'required|array',
            'doctors.*.image' => 'nullable|string',
            'doctors.*.doctor_name' => 'required|string',
            'doctors.*.position' => 'required|string',
            'doctors.*.years_of_experience' => 'required|integer',
        ]);

        $doctorGroup = ProfessionalDoctor::create($data);

        return new ProfessionalDoctorResource($doctorGroup);
    }

    public function show(ProfessionalDoctor $professionalDoctor)
    {
        return new ProfessionalDoctorResource($professionalDoctor);
    }

}
