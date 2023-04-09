<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
//    Index method
    public function index()
    {
        $posts = Post::with('user', 'comments')->paginate(5);
        return PostResource::collection($posts);
    }

//    Show method
    public function show($id)
    {
        $post = Post::with('comments')->find($id);
        return new PostResource($post);
    }

//    Store method
    public function store(StorePostRequest $request)
    {
        // Save Data
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $post=Post::create($request->except('image') + ['image' => $imageName]);
        } else {
            $post=Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => $request->user_id,
            ]);
        }
//        Return Stored Data
        return new PostResource($post);

    }
}
