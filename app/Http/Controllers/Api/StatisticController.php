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
        return StatisticResource::collection(Statistic::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'number' => 'required|integer',
            'name.en' => 'required|string',
            'name.ar' => 'required|string',
        ]);

        $statistic = Statistic::create([
            'number' => $data['number'],
            'name' => $data['name'],
        ]);

        return new StatisticResource($statistic);
    }

    public function show(Statistic $statistic)
    {
        return new StatisticResource($statistic);
    }




}