<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StatisticResource;
use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
        return StatisticResource::collection(Statistic::latest()->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'number' => 'required|numeric',
            'name' => 'required|string|max:255',
        ]);

        $statistic = Statistic::create($data);

        return new StatisticResource($statistic);
    }

    public function show(Statistic $statistic)
    {
        return new StatisticResource($statistic);
    }

    public function update(Request $request, Statistic $statistic)
    {
        $data = $request->validate([
            'number' => 'sometimes|numeric',
            'name' => 'sometimes|string|max:255',
        ]);

        $statistic->update($data);

        return new StatisticResource($statistic);
    }

    public function destroy(Statistic $statistic)
    {
        $statistic->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}