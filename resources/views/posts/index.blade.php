@extends('layouts.app')

@section('title')
    Index
@endsection

@section('content')
    <div class="text-center">
        <a href="{{ route('posts.create') }}" class="btn btn-success">Add New Post</a>
    </div>
    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                {{-- Slug --}}
                <th scope="col">Slug</th>
                <th scope="col">Posted By</th>
                <th scope="col">Created At</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->slug }}</td>
                    @if ($post->user)
                        <td>{{ $post->user->name }}</td>
                    @else
                        <td>Not Found</td>
                    @endif
                    <td>{{ $post->readable_date }}</td>
                    {{-- <td>{{ $post->created_at->format('d-m-y') }}</td> --}}
                    {{-- <td>{{ $post->created_at->isoFormat('Do-MMMM-YYYY, h:mm:ss A') }}</td> --}}
                    <td>
                        <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="btn btn-info">View</a>
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
    <div class="text-center">
        <a href="{{ route('posts.restore') }}" class="btn btn-secondary" onclick="return confirm('Are you sure?')">Restore
            All
            Deleted Posts</a>
    </div>

    {{ $posts->links() }}
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this post?');
        }
    </script>
@endsection
