<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DentalNewsResource;
use App\Models\DentalNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DentalNewsController extends Controller
{
    public function index()
    {
        return DentalNewsResource::collection(DentalNews::latest()->get());
    }

    public function show(DentalNews $dental_news)
    {
        return new DentalNewsResource($dental_news);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title.en'       => 'required|string|max:255',
            'title.ar'       => 'required|string|max:255',
            'description.en' => 'nullable|string',
            'description.ar' => 'nullable|string',
            'author.en'      => 'nullable|string|max:255',
            'author.ar'      => 'nullable|string|max:255',
            'date'           => 'nullable|date',
            'image'          => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('dental_news', 'public');
        }

        $dentalNews = new DentalNews();

        $dentalNews->setTranslations('title', $data['title']);
        $dentalNews->setTranslations('description', $data['description'] ?? []);
        $dentalNews->setTranslations('author', $data['author'] ?? []);
        $dentalNews->date = $data['date'] ?? null;
        $dentalNews->image = $data['image'] ?? null;
        $dentalNews->save();

        return new DentalNewsResource($dentalNews);
    }




}