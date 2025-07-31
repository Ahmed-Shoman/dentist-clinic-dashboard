<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MakeAnAppointmentResource;
use App\Models\MakeAnAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MakeAnAppointmentController extends Controller
{
    public function index()
    {
        return MakeAnAppointmentResource::collection(MakeAnAppointment::all());
    }

    public function show($id)
    {
        $record = MakeAnAppointment::find($id);
        if (!$record) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return new MakeAnAppointmentResource($record);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'main_image'  => 'required|image',
            'sub_image'   => 'required|image',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $mainPath = $request->file('main_image')->store('make-appointment', 'public');
        $subPath  = $request->file('sub_image')->store('make-appointment', 'public');

        $record = MakeAnAppointment::create([
            'title'       => $request->title,
            'description' => $request->description,
            'main_image'  => $mainPath,
            'sub_image'   => $subPath,
        ]);

        return new MakeAnAppointmentResource($record);
    }

    public function update(Request $request, $id)
    {
        $record = MakeAnAppointment::find($id);
        if (!$record) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title'       => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'main_image'  => 'sometimes|image',
            'sub_image'   => 'sometimes|image',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->hasFile('main_image')) {
            $mainPath = $request->file('main_image')->store('make-appointment', 'public');
            $record->main_image = $mainPath;
        }

        if ($request->hasFile('sub_image')) {
            $subPath = $request->file('sub_image')->store('make-appointment', 'public');
            $record->sub_image = $subPath;
        }

        $record->update($request->only(['title', 'description']));

        return new MakeAnAppointmentResource($record);
    }

    public function destroy($id)
    {
        $record = MakeAnAppointment::find($id);
        if (!$record) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $record->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}