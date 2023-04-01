@extends('layouts.app')

@section('title')
    Create
@endsection

@section('content')
    <form action="{{ route('posts.update', ['id' => $post['id']]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" value="{{ $post['title'] }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" rows="3">{{ $post['description'] }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Post Creator</label>
            <select class="form-control">
                <option value="1" @if ($post['posted_by'] == 'Ahmed') selected @endif>Ahmed</option>
                <option value="2" @if ($post['posted_by'] == 'Mohamed') selected @endif>Mohamed</option>
                <option value="3" @if ($post['posted_by'] == 'Ali') selected @endif>Ali</option>
                <option value="4"@if ($post['posted_by'] == 'Elsayed') selected @endif>Elsayed</option>

            </select>
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
@endsection
