@extends('layouts.app')
@section('title')
    Home
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            {{-- <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Status') }}</div>

                    <div class="card-body"> --}}
            <div class="col-md-8 mt-4 text-center border rounded-3 border-success p-4">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- Welcome Message with User Name --}}
                <h3>Welcome, <span class="text-primary">{{ Auth::user()->name }}</span> </h3>
                <h5 class="text-success"> {{ __('You are logged in!') }} </h5>
                {{-- </div> --}}
                {{-- </div> --}}
            </div>
            {{-- All Posts Button if Loged in --}}
            @auth
                <div class="col-md-8 mt-4 text-center">
                    <a href="{{ route('posts.index') }}" class="btn btn-primary">See Posts Table</a>
                    <a href="{{ route('posts.create') }}" class="btn btn-success">Add New Post</a>
                </div>

            @endauth
        </div>
    </div>
@endsection
