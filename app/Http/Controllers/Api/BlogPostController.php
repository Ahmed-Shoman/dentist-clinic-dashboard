<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Http\Resources\BlogPostResource;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function index()
    {
        $blogs = BlogPost::with('category')->latest()->get();
        return BlogPostResource::collection($blogs);
    }

    public function show($id)
    {
        $blog = BlogPost::with('category')->findOrFail($id);
        return new BlogPostResource($blog);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'nullable|string',
            'published_at' => 'nullable|date',
            'author' => 'required|string|max:255',
            'title' => 'required',
            'description' => 'required|array',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $blog = BlogPost::create($data);

        return new BlogPostResource($blog);
    }
}
