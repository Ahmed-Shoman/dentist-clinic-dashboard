<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CertifiedDentistResource;
use App\Models\CertifiedDentist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CertifiedDentistController extends Controller
{
    public function index()
    {
        $dentists = CertifiedDentist::all();
        return CertifiedDentistResource::collection($dentists);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|string',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'years_of_experience' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $dentist = CertifiedDentist::create($validator->validated());

        return new CertifiedDentistResource($dentist);
    }

    public function show($id)
    {
        $dentist = CertifiedDentist::findOrFail($id);
        return new CertifiedDentistResource($dentist);
    }

    public function update(Request $request, $id)
    {
        $dentist = CertifiedDentist::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'image' => 'nullable|string',
            'name' => 'sometimes|required|string|max:255',
            'position' => 'sometimes|required|string|max:255',
            'years_of_experience' => 'sometimes|required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $dentist->update($validator->validated());

        return new CertifiedDentistResource($dentist);
    }

    public function destroy($id)
    {
        $dentist = CertifiedDentist::findOrFail($id);
        $dentist->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}