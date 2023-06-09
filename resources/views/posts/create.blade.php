@extends('layouts.app')

@section('title')
    Create
@endsection

@section('content')
    <h1 class="text-center text-success"> Add New Post</h1>
    <hr>

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control">
            {{-- Title Error Messages --}}
            @if ($errors->has('title'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->get('title') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea class="form-control" name="content" rows="3"></textarea>
            {{-- Content Error Messages --}}
            @if ($errors->has('content'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->get('content') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Post Creator</label>
            <select class="form-control" name="user_id">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            {{-- User Error Messages --}}
            @if ($errors->has('user_id'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->get('user_id') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input class="form-control" name="image" type="file" id="formFile">
            @if ($errors->has('image'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->get('image') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="text-center">
            <button class="btn btn-success fs-3">Add</button>
        </div>
    </form>
@endsection
