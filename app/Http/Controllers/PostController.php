<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(5);
        return view('posts.index', ['posts' => $posts]);
    }

    public function show($id)
    {

        $post = Post::with('comments')->find($id);
        // $user = User::find($post->user_id);
        // return view('posts.show', ['post' => $post, 'user' => $user]);
        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        // find all users
        $users = User::all();
        return view('posts.create', ['users' => $users]);
    }

    // store
    public function store(StorePostRequest $request)
    {
        // Save Data
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            Post::create($request->except('image') + ['image' => $imageName]);
        } else {
            Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => $request->user_id,
            ]);
        }

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
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::where('id', $id)->first();
        if (!$post) {
            return redirect()->route('post.index');
        }
        if ($request->hasFile('image')) {
            $oldImage = public_path('images') . '/' . $post->image;
            if (file_exists($oldImage)) {
                @unlink($oldImage);
            }
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $post->update($request->except('image') + ['image' => $imageName]);
        } else {
            $post->update($request->all());
        }
        return redirect()->route('posts.index');
    }

    //Delete Post
    public function destroy(int $id)
    {
        $post = Post::find($id);
        $post?->delete();
        return redirect()->route('posts.index');
    }

    // Comments
    public function addComment(Request $request, $id)
    {
        $post = Post::find($id);
        $comment = new Comment([
            'body' => $request->body,
        ]);
        $post->comments()->save($comment);
        return redirect()->route('posts.show', $post->id);
    }


    public function updateComment(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment?->update($request->all());
        return redirect()->back();
    }

    public function deleteComment(int $id)
    {
        $comment = Comment::find($id);
        $comment?->delete();
        return redirect()->back();
    }

    // Restore
    public function restore()
    {
        Post::withTrashed()->restore();
        return redirect()->back();
    }
}