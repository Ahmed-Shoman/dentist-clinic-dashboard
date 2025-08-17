<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return CommentResource::collection(Comment::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|array', // expect {'en': '...', 'ar': '...'}
            'message' => 'required|array',
            'email' => 'required|email|max:255',
        ]);

        $comment = Comment::create($data);

        return new CommentResource($comment);
    }

    public function show(Comment $comment)
    {
        return new CommentResource($comment);
    }


}
