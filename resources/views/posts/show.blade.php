@extends('layouts.app')

@section('title')
    Show
@endsection

@section('content')
    <div class="card mt-4 text-center">
        <div class="card-header">
            <h1>Post Info</h1>
        </div>
        <div class="card-body">
            <h5 class="card-title">Title: {{ $post->title }}</h5>
            <p class="card-text">Content: {{ $post->content }}</p>
            <p class="card-text">Posted at: {{ $post->created_at }}</p>
            <p class="card-text">Posted by: {{ $post->user->name }}</p>
        </div>
    </div>

    <div class="card mt-4 text-center">
        <div class="card-header">
            <h1>Comments</h1>
        </div>
        <div class="card-body">
            {{-- <h5 class="card-title">Comments</h5> --}}
            @if ($post->comments->count() > 0)
                {{-- @dd($post->comments) --}}
                @foreach ($post->comments as $comment)
                    <div class="commentContainer">
                        {{-- Comment id for js --}}
                        <input type="hidden" name="commentId" class="commentId" value="{{ $comment->id }}">
                        <p class="card-text fs-3">{{ $comment->body }}</p>
                        <a class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#updateModal{{ $comment->id }}">Edit</a>

                        {{-- Edit button  for js --}}
                        {{-- <a class="btn btn-primary edit">Edit</a> --}}

                        <form action="{{ route('posts.deleteComment', $comment->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        <hr>
                    </div>
                    {{-- Modal --}}
                    <div class="modal fade" id="updateModal{{ $comment->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Comment</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('posts.updateComment', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <input type="text" class="form-control" name="body"
                                            value="{{ $comment->body }}">
                                    </div>
                                    <div class="modal-footer ">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="card-text">No comments</p>
            @endif
        </div>
    </div>
    <div class="card mt-4 text-center">
        <div class="card-header">
            <h1>Add Comment</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('posts.addComment', $post->id) }}" method="POST">
                @csrf
                <div class="form-outline">
                    <textarea class="form-control" id="" name="body" rows="4"></textarea>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-success fs-3">
                        Comment
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- Script to handle edit comment --}}
    {{-- <script>
        // console.log("1")
        // edit buttons
        const editBtns = document.querySelectorAll('.edit');
        // loop on buttons
        editBtns.forEach(btn => {
            console.log(btn);
            // comment id
            const commentId = btn.parentElement.querySelector("input[name='commentId']").value;
            console.log(commentId);
            // comment body
            const commentBody = btn.parentElement.querySelector('p').innerText;
            console.log(commentBody);

            btn.addEventListener('click', (e) => {
                // console.log(e.target.parentElement)
                e.target.parentElement.innerHTML = `
                    <form action="{{ route('posts.updateComment', $comment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="commentId" value="${commentId}">
                        <div class="form-outline">
                            <textarea class="form-control" name="body" rows="4">${commentBody}</textarea>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success fs-3 update">
                                Update
                            </button>
                        </div>
                    </form>
                    <hr>
                `;


                const updateBtn = e.target.parentElement.querySelector('.update');
                // const updateBtn = document.querySelector('.update');
                updateBtn.addEventListener('click', (e) => {
                    e.target.parentElement.innerHTML = `
                        <a class="btn btn-primary edit">Edit</a>
                    `;
                });
            });
        });
    </script> --}}


@endsection
