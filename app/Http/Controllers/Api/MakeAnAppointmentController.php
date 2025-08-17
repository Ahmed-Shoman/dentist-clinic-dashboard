<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MakeAnAppointmentResource;
use App\Models\MakeAnAppointment;
use Illuminate\Http\Request;

class MakeAnAppointmentController extends Controller
{
    public function index()
    {
        return MakeAnAppointmentResource::collection(MakeAnAppointment::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|array',
            'description' => 'required|array',
            'main_image' => 'nullable|string',
            'sub_image' => 'nullable|string',
        ]);

        $appointment = MakeAnAppointment::create($data);

        return new MakeAnAppointmentResource($appointment);
    }

    public function show(MakeAnAppointment $makeAnAppointment)
    {
        return new MakeAnAppointmentResource($makeAnAppointment);
    }

}
