<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlanResource;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        return PlanResource::collection(Plan::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'plan_name' => 'required|array',         // expects { en: "...", ar: "..." }
            'price' => 'required|numeric',
            'description' => 'nullable|array',
        ]);

        $plan = Plan::create($data);

        return new PlanResource($plan);
    }

    public function show(Plan $plan)
    {
        return new PlanResource($plan);
    }


}
