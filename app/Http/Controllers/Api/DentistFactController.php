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
        $facts = DentistFact::all();
        return DentistFactResource::collection($facts);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'                 => 'required|array', // expect ['en'=>..,'ar'=>..]
            'facts'                 => 'nullable|array',
            'time_table_title'      => 'nullable|array',
            'time_table_description'=> 'nullable|array',
            'schedule'              => 'nullable|array',
            'image'                 => 'nullable|string',
            'background_image'      => 'nullable|string',
        ]);

        $dentistFact = DentistFact::create($data);
        return new DentistFactResource($dentistFact);
    }

    public function show(DentistFact $dentistFact)
    {
        return new DentistFactResource($dentistFact);
    }



}
