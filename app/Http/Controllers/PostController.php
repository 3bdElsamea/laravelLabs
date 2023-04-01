<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // constant allPosts array
    // const allPosts = [];
    public function index()
    {
        $allPosts = [
            [
                'id' => 1,
                'title' => 'Laravel',
                'description' => 'hello laravel',
                'posted_by' => 'Ahmed',
                'created_at' => '2023-04-01 10:00:00',
            ],

            [
                'id' => 2,
                'title' => 'PHP',
                'description' => 'hello php',
                'posted_by' => 'Mohamed',
                'created_at' => '2023-04-01 10:00:00',
            ],

            [
                'id' => 3,
                'title' => 'Javascript',
                'description' => 'hello javascript',
                'posted_by' => 'Mohamed',
                'created_at' => '2023-04-01 10:00:00',
            ],
        ];
        // return view with allPosts array
        // return view('posts.index', ['posts' => self::allPosts]);
        return view('posts.index', ['posts' => $allPosts]);
    }

    //Show Post Details
    public function show($id)
    {
        $allPosts = [
            [
                'id' => 1,
                'title' => 'Laravel',
                'description' => 'hello laravel',
                'posted_by' => 'Ahmed',
                'created_at' => '2023-04-01 10:00:00',
            ],

            [
                'id' => 2,
                'title' => 'PHP',
                'description' => 'hello php',
                'posted_by' => 'Mohamed',
                'created_at' => '2023-04-01 10:00:00',
            ],

            [
                'id' => 3,
                'title' => 'Javascript',
                'description' => 'hello javascript',
                'posted_by' => 'Mohamed',
                'created_at' => '2023-04-01 10:00:00',
            ],
        ];
        // return view with allPosts array
        return view('posts.show', ['post' => $allPosts[$id - 1]]);
    }

    //Show Create Post Form
    public function create()
    {
        return view('posts.create');
    }

    // store
    public function store(Request $request)
    {
        // $allPosts = [
        //     [
        //         'id' => 1,
        //         'title' => 'Laravel',
        //         'description' => 'hello laravel',
        //         'posted_by' => 'Ahmed',
        //         'created_at' => '2023-04-01 10:00:00',
        //     ],

        //     [
        //         'id' => 2,
        //         'title' => 'PHP',
        //         'description' => 'hello php',
        //         'posted_by' => 'Mohamed',
        //         'created_at' => '2023-04-01 10:00:00',
        //     ],

        //     [
        //         'id' => 3,
        //         'title' => 'Javascript',
        //         'description' => 'hello javascript',
        //         'posted_by' => 'Mohamed',
        //         'created_at' => '2023-04-01 10:00:00',
        //     ],
        // ];
        // $newPost = [
        //     'id' => count($allPosts) + 1,
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'posted_by' => $request->posted_by,
        //     'created_at' => date('Y-m-d H:i:s'),
        // ];
        // array_push($allPosts, $newPost);
        return redirect()->route('posts.index');
        // return view('posts.index', ['posts' => $allPosts]);
    }

    //Show Edit Post Form
    public function edit($id)
    {
        $post = [
            'id' => 3,
            'title' => 'Javascript',
            'description' => 'hello javascript',
            'posted_by' => 'Mohamed',
            'created_at' => '2023-04-01 10:00:00',
        ];
        return view('posts.edit', ['post' => $post]);
    }

    //Update Post
    public function update(Request $request, $id)
    {
        return redirect()->route('posts.index');
    }

    //Delete Post
    public function destroy($id)
    {
        // $allPosts = [
        //     [
        //         'id' => 1,
        //         'title' => 'Laravel',
        //         'description' => 'hello laravel',
        //         'posted_by' => 'Ahmed',
        //         'created_at' => '2023-04-01 10:00:00',
        //     ],

        //     [
        //         'id' => 2,
        //         'title' => 'PHP',
        //         'description' => 'hello php',
        //         'posted_by' => 'Mohamed',
        //         'created_at' => '2023-04-01 10:00:00',
        //     ],

        //     [
        //         'id' => 3,
        //         'title' => 'Javascript',
        //         'description' => 'hello javascript',
        //         'posted_by' => 'Mohamed',
        //         'created_at' => '2023-04-01 10:00:00',
        //     ],
        // ];
        // unset($allPosts[$id - 1]);
        return redirect()->route('posts.index');
        // return view('posts.index', ['posts' => $allPosts]);
    }

}