]<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfessionalDoctorResource;
use App\Models\ProfessionalDoctor;
use Illuminate\Http\Request;

class ProfessionalDoctorController extends Controller
{
    public function index()
    {
        return ProfessionalDoctorResource::collection(ProfessionalDoctor::latest()->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'doctors' => 'required|array',
            'doctors.*.image' => 'nullable|string', // base64 or image path, adjust if upload
            'doctors.*.doctor_name' => 'required|string|max:255',
            'doctors.*.position' => 'required|string|max:255',
            'doctors.*.years_of_experience' => 'required|numeric',
        ]);

        $professionalDoctor = ProfessionalDoctor::create([
            'doctors' => $data['doctors'],
        ]);

        return new ProfessionalDoctorResource($professionalDoctor);
    }

    public function show(ProfessionalDoctor $professionalDoctor)
    {
        return new ProfessionalDoctorResource($professionalDoctor);
    }

    public function update(Request $request, ProfessionalDoctor $professionalDoctor)
    {
        $data = $request->validate([
            'doctors' => 'sometimes|array',
            'doctors.*.image' => 'nullable|string',
            'doctors.*.doctor_name' => 'sometimes|string|max:255',
            'doctors.*.position' => 'sometimes|string|max:255',
            'doctors.*.years_of_experience' => 'sometimes|numeric',
        ]);

        if (isset($data['doctors'])) {
            $professionalDoctor->update(['doctors' => $data['doctors']]);
        }

        return new ProfessionalDoctorResource($professionalDoctor);
    }

    public function destroy(ProfessionalDoctor $professionalDoctor)
    {
        $professionalDoctor->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}