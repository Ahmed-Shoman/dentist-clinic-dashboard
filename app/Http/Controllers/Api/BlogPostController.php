<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogPostResource;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BlogPostController extends Controller
{
    /**
     * GET /api/blog-posts
     */
    public function index()
    {
        $posts = BlogPost::with('category')->latest()->get();
        return BlogPostResource::collection($posts);
    }

    /**
     * GET /api/blog-posts/{id}
     */
    public function show($id)
    {
        $post = BlogPost::with('category')->findOrFail($id);
        return new BlogPostResource($post);
    }

    /**
     * POST /api/blog-posts
     */
}
    /**
     * PUT/PATCH /api/blog-posts/{id}
     */
    -
