@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Post</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group mt-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" required>
            </div>
            <div class="form-group mt-3">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $post->description) }}</textarea>
            </div>
            <div class="form-group mt-3">
                <label for="user_id">Post Creator</label>
                <select class="form-control" id="user_id" name="user_id" {{ Auth::user()->id != $post->user_id ? 'disabled' : '' }} required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $post->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @if (Auth::user()->id != $post->user_id)
                    <small class="form-text text-muted">You cannot change the post creator.</small>
                @endif
            </div>
            <div class="form-group mt-3 mb-3">
                <label for="image">Image (optional)</label>
                <input type="file" class="form-control-file" id="image" name="image">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" width="100" class="mt-2">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
