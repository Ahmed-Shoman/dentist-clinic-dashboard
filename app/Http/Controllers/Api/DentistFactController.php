<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DentistFactResource;
use App\Models\DentistFact;
use Illuminate\Http\Request;

class DentistFactController extends Controller
{
    public function index()
    {
        return DentistFactResource::collection(DentistFact::latest()->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'facts' => 'nullable|array',
            'facts.*.subtitle' => 'nullable|string|max:255',
            'facts.*.description' => 'nullable|string',
            'time_table_title' => 'nullable|string|max:255',
            'time_table_description' => 'nullable|string',
            'schedule' => 'nullable|array',
            'schedule.*.day' => 'nullable|string|max:50',
            'schedule.*.time' => 'nullable|string|max:50',
            'image' => 'nullable|image|max:2048',
            'background_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('dentist_facts', 'public');
        }

        if ($request->hasFile('background_image')) {
            $data['background_image'] = $request->file('background_image')->store('dentist_facts/backgrounds', 'public');
        }

        $fact = DentistFact::create($data);

        return new DentistFactResource($fact);
    }

    public function show(DentistFact $dentistFact)
    {
        return new DentistFactResource($dentistFact);
    }

    public function update(Request $request, DentistFact $dentistFact)
    {
        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'facts' => 'nullable|array',
            'facts.*.subtitle' => 'nullable|string|max:255',
            'facts.*.description' => 'nullable|string',
            'time_table_title' => 'nullable|string|max:255',
            'time_table_description' => 'nullable|string',
            'schedule' => 'nullable|array',
            'schedule.*.day' => 'nullable|string|max:50',
            'schedule.*.time' => 'nullable|string|max:50',
            'image' => 'nullable|image|max:2048',
            'background_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('dentist_facts', 'public');
        }

        if ($request->hasFile('background_image')) {
            $data['background_image'] = $request->file('background_image')->store('dentist_facts/backgrounds', 'public');
        }

        $dentistFact->update($data);

        return new DentistFactResource($dentistFact);
    }

    public function destroy(DentistFact $dentistFact)
    {
        $dentistFact->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
