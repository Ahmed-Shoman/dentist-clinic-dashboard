<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // List all comments
    public function index()
    {
        return CommentResource::collection(Comment::latest()->get());
    }

    // Store a new comment
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $comment = Comment::create($data);

        return new CommentResource($comment);
    }

    // Show a single comment
    public function show(Comment $comment)
    {
        return new CommentResource($comment);
    }



}