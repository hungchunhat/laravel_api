<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function postComment(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'post_id' => 'required|integer|exists:posts,id',
            'comment' => 'required|string',
        ]);
        if ($validated->fails()) {
            return response(['errors' => $validated->errors()], 422);
        }
        try {
            $data = $validated->validated();
            Comment::query()->create([
                'post_id' => $data['post_id'],
                'comment' => $data['comment'],
                'user_id' => Auth::user()->id,
            ]);
            return response()->json([
                'success' => 'Comment posted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response(['errors' => $e->getMessage()], 500);
        }
    }
}
