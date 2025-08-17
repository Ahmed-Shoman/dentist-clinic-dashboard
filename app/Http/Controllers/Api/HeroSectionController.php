<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HeroSectionResource;
use App\Models\HeroSection;
use Illuminate\Http\Request;

class HeroSectionController extends Controller
{
    // List all hero sections
    public function index()
    {
        return HeroSectionResource::collection(HeroSection::all());
    }

    // Store new hero section
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|array',          // expects { en: "...", ar: "..." }
            'description' => 'nullable|array',
            'image' => 'nullable|string',
        ]);

        $heroSection = HeroSection::create($data);

        return new HeroSectionResource($heroSection);
    }

    // Show single hero section
    public function show(HeroSection $heroSection)
    {
        return new HeroSectionResource($heroSection);
    }
}