@extends('layouts.app')

@section('title')
    Create
@endsection

@section('content')
    <form action="{{ route('posts.update', ['id' => $post->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $post->title }}">
            {{-- Update Title Error Message --}}
            @if ($errors->has('title'))
                <div class="text-danger">
                    {{ $errors->first('title') }}
                </div>
            @endif

        </div>
        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea class="form-control" name="content" rows="3">{{ $post->content }}</textarea>
            {{-- Update Content Error Message --}}
            @if ($errors->has('content'))
                <div class="text-danger">
                    {{ $errors->first('content') }}
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Post Creator</label>
            <select class="form-control" name="user_id">
                @foreach ($users as $user)
                    <option @if ($post['user_id'] == $user->id) selected @endif value="{{ $user->id }}">
                        {{ $user->name }}</option>
                @endforeach
            </select>

            {{-- Update User Error Message --}}
            @if ($errors->has('user_id'))
                <div class="text-danger">
                    {{ $errors->first('user_id') }}
                </div>
            @endif
        </div>

        <button class="btn btn-success">Update</button>
    </form>
@endsection
