<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{
    public function likePost(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'post_id' => 'required|integer|exists:posts,id',
        ]);
        if ($validated->fails()) {
            return response()->json([
                'errors' => $validated->errors()
            ], 422);
        }
        try {
            if (Like::query()
                ->where('post_id', $request->post_id)
                ->where('user_id', Auth::id())
                ->exists()) {
                return response()->json([
                    "message" => "Can't like this post more than one"
                ],403);
            }
            $data = $validated->validated();
            Like::query()->create([
                'post_id' => $data['post_id'],
                'user_id' => Auth::user()->id,
            ]);
            return response()->json([
                'message' => 'Liked successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function unlikePost(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'post_id' => 'required|integer|exists:posts,id',
        ]);
        if ($validated->fails()) {
            return response()->json([
                'errors' => $validated->errors()
            ], 422);
        }
        try {
            $like = Like::query()->where([
                'post_id' => $request->post_id,
                'user_id' => Auth::user()->id,
            ])->firstOrFail();
            $like->delete();
            return response()->json([
                'message' => 'UnLiked successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => $e->getMessage()
            ], 500);
        }
    }
}
