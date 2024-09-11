@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p><strong>Description:</strong> {{ $post->description }}</p>
        <p><strong>Created At:</strong> {{ $post->human_readable_date }}</p>
        <p><strong>Creator:</strong> {{ $post->user->name }}</p>
        
        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="Image" width="500">
        @endif

        <!-- Check if the authenticated user can modify the post -->
        @can('modify-post', $post)
            <div class="mt-3">
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit Post</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Post</button>
                </form>
            </div>
        @endcan

        <a href="{{ route('posts.index') }}" class="btn btn-primary mt-3">Back to Posts</a>

        <!-- Comments Section -->
        <div class="mt-5">
            <h3>Comments</h3>
            @if($post->comments->count() > 0)
                @foreach($post->comments as $comment)
                    <div class="card mt-3">
                        <div class="card-body">
                            <strong>{{ $comment->user->name }}</strong> said:
                            <p>{{ $comment->body }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No comments yet. Be the first to comment!</p>
            @endif
        </div>

        <!-- Add Comment Form -->
        <div class="mt-4">
            <h4>Add a Comment</h4>
            <form action="{{ route('comments.store', $post->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea name="body" class="form-control" placeholder="Write your comment here..." rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </div>
    </div>
@endsection
