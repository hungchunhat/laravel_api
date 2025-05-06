<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function addNewPost(Request $request){
        $validated = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);
        if($validated->fails()){
            return response()->json([
                'errors' => $validated->errors()
            ]);
        }
        try{
            $data = $validated->validated();
            $post = Post::query()->create([
                'title' => $data['title'],
                'content' => $data['content'],
                'user_id' => Auth::id(),
            ]);
            return response()->json([
                'message' => 'Post created successfully',
            ]);
        }catch (\Exception $e){
            return response()->json([
                'errors' => $e->getMessage()
            ],405);
        }
    }
}
