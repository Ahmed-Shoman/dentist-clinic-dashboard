<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HeroSectionResource;
use App\Models\HeroSection;
use Illuminate\Http\Request;

class HeroSectionController extends Controller
{
    public function index()
    {
        return HeroSectionResource::collection(HeroSection::all());
    }

    public function show($id)
    {
        return new HeroSectionResource(HeroSection::findOrFail($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('hero-section', 'public');
        }

        $hero = HeroSection::create($data);
        return new HeroSectionResource($hero);
    }

    public function update(Request $request, $id)
    {
        $hero = HeroSection::findOrFail($id);

        $data = $request->validate([
            'title' => 'sometimes|string',
            'description' => 'sometimes|string',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('hero-section', 'public');
        }

        $hero->update($data);
        return new HeroSectionResource($hero);
    }

    public function destroy($id)
    {
        $hero = HeroSection::findOrFail($id);
        $hero->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}