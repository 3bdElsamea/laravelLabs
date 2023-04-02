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
            <p class="card-text">Posted by: {{ $user->name }}</p>
        </div>
    </div>

    <div class="card mt-4 text-center">
        <div class="card-header">
            <h1>Comments</h1>
        </div>
        <div class="card-body">
            {{-- <h5 class="card-title">Comments</h5> --}}
            @if ($post->comments->count() > 0)
                @foreach ($post->comments as $comment)
                    <p class="card-text fs-3">{{ $comment->body }}</p>
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal">Edit</a>
                    <form action="{{ route('posts.deleteComment', $comment->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                    <hr>
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

    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('posts.updateComment', $comment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="text" class="form-control" name="body" value="{{ $comment->body }}">
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection
