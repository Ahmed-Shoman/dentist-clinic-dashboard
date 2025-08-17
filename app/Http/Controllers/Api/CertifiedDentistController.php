<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CertifiedDentistResource;
use App\Models\CertifiedDentist;
use Illuminate\Http\Request;

class CertifiedDentistController extends Controller
{
    public function index()
    {
        return CertifiedDentistResource::collection(CertifiedDentist::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'nullable|string',
            'name.en' => 'required|string',
            'name.ar' => 'required|string',
            'position.en' => 'required|string',
            'position.ar' => 'required|string',
            'years_of_experience' => 'nullable|integer',
        ]);

        $dentist = CertifiedDentist::create([
            'image' => $data['image'] ?? null,
            'name' => $data['name'],
            'position' => $data['position'],
            'years_of_experience' => $data['years_of_experience'] ?? null,
        ]);

        return new CertifiedDentistResource($dentist);
    }

    public function show(CertifiedDentist $certified_dentist)
    {
        return new CertifiedDentistResource($certified_dentist);
    }


}