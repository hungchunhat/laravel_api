<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function addPost(Request $request){
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
    public function editPost(Request $request, Post $post){
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
            $post->update([
                'title' => $data['title'],
                'content' => $data['content'],
                'user_id' => Auth::id(),
            ]);
            return response()->json([
                'message' => 'Post updated successfully',
                'updated_post' => $post
            ]);
        }catch (\Exception $e){
            return response()->json([
                'errors' => $e->getMessage()
            ],405);
        }
    }
    public function getAllPost(){
        try{
            $posts = Post::query()->with('user')->get();
            return response()->json([
                'posts' => $posts
            ]);
        }catch (\Exception $e){
            return response()->json([
                'errors' => $e->getMessage()
            ],500);
        }
    }
    public function getPost($id){
        try{
            $post = Post::query()->with('user','comments','likes')->findOrFail($id);
            return response()->json([
//                'post' => $post
                'post' => new PostResource($post)
            ]);
        }catch (\Exception $e){
            return response()->json([
                'errors' => $e->getMessage()
            ],405);
        }

    }
    public function deletePost($id)
    {
        try{
            $post = Post::query()->findOrFail($id);
            $post->delete();
            return response()->json([
                'message' => 'Post deleted successfully'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'errors' => $e->getMessage(),
            ]);
        }
    }
}
