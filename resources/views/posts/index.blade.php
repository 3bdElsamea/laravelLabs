@extends('layouts.app')

@section('title')
    Index
@endsection

@section('content')
    <div class="text-center">
        <a href="{{ route('posts.create') }}" class="btn btn-success">Create New Post</a>
    </div>
    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Posted By</th>
                <th scope="col">Created At</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post['id'] }}</td>
                    <td>{{ $post['title'] }}</td>
                    <td>{{ $post['posted_by'] }}</td>
                    <td>{{ $post['created_at'] }}</td>
                    <td>
                        <a href="{{ route('posts.show', ['id' => $post['id']]) }}" class="btn btn-info">View</a>
                        <a href="{{ route('posts.edit', ['id' => $post['id']]) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('posts.destroy', ['id' => $post['id']]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirmDelete()">Delete</button>
                        </form>

                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>
    <script >
        function confirmDelete() {
            return confirm('Are you sure you want to delete this post?');
        }
    </script>
@endsection
