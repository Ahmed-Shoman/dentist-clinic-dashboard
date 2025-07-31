<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfessionClinicResource;
use App\Models\ProfessionClinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfessionClinicController extends Controller
{
    public function index()
    {
        return ProfessionClinicResource::collection(ProfessionClinic::latest()->get());
    }

    public function show($id)
    {
        $record = ProfessionClinic::find($id);

        if (!$record) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return new ProfessionClinicResource($record);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'       => 'required|string|max:255',
            'subtitle'    => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'required|image',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $path = $request->file('image')->store('profession-clinic', 'public');

        $record = ProfessionClinic::create([
            'title'       => $request->title,
            'subtitle'    => $request->subtitle,
            'description' => $request->description,
            'image'       => $path,
        ]);

        return new ProfessionClinicResource($record);
    }

    public function update(Request $request, $id)
    {
        $record = ProfessionClinic::find($id);

        if (!$record) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title'       => 'sometimes|string|max:255',
            'subtitle'    => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'image'       => 'sometimes|image',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profession-clinic', 'public');
            $record->image = $path;
        }

        $record->update($request->only(['title', 'subtitle', 'description']));

        return new ProfessionClinicResource($record);
    }

    public function destroy($id)
    {
        $record = ProfessionClinic::find($id);

        if (!$record) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $record->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}