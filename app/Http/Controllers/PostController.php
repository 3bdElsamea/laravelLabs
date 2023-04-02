<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::all();
        // Use Pagination
        $posts = Post::paginate(5);
        return view('posts.index', ['posts' => $posts]);
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show', ['post' => $post]);
    }

    //Show Create Post Form
    public function create()
    {
        // find all users
        $users = User::all();
        return view('posts.create', ['users' => $users]);
    }

    // store
    public function store(Request $request)
    {
        // Save Data
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user_id,
        ]);

        // redirect
        return redirect()->route('posts.index');
    }

    //Show Edit Post Form
    public function edit($id)
    {
        $post = Post::find($id);
        $users = User::all();
        return view('posts.edit', ['post' => $post, 'users' => $users]);
    }

    //Update Post
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post?->update($request->all()); // if $post is not null, then update it
        // $post->update([
        //     'title' => $request->title,
        //     'content' => $request->content,
        //     'user_id' => $request->user_id,
        // ]);
        return redirect()->route('posts.index');
    }

    //Delete Post
    public function destroy(int $id)
    {
        $post = Post::find($id);
        $post?->delete(); // if $post is not null, then delete it
        return redirect()->route('posts.index');
    }

}
