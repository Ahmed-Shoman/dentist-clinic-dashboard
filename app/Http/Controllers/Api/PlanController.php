<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlanResource;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return PlanResource::collection($plans);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $plan = Plan::create($validator->validated());

        return new PlanResource($plan);
    }

    public function show($id)
    {
        $plan = Plan::findOrFail($id);
        return new PlanResource($plan);
    }

    public function update(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'plan_name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'description' => 'sometimes|required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $plan->update($validator->validated());

        return new PlanResource($plan);
    }

    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
