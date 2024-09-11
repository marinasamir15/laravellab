@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Auth::check())
            @php
                // Check if the logged-in user has reached the post limit
                $postCount = App\Models\Post::where('user_id', Auth::id())->count();
            @endphp

            @if ($postCount >= 3)
                <div class="alert alert-warning">
                    <p>You have reached the maximum number of posts allowed (3). You cannot create more posts.</p>
                </div>
            @else
                <h1>Create Post</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mt-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group mt-3 mb-3">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            @endif
        @else
            <p>You need to be logged in to create a post. <a href="{{ route('login') }}">Login here</a></p>
        @endif
    </div>
@endsection
