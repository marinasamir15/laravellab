@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Posts</h1>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Creator</th>
                    <th>Slug</th>
                    <th>Image</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Image" width="100">
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($post->created_at)->format('d M Y, H:i') }}</td>
                        <td>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info">View</a>
                            
                            @can('update', $post)
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
                            @endcan

                            @can('delete', $post)
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $post->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $post->id }})">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between">
            {{ $posts->links() }}
        </div>

        @if($trashedPosts->count())
            <h2 class="mt-4">Trashed Posts</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Creator</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th>Deleted At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trashedPosts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->description }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>{{ $post->slug }}</td>
                            <td>
                                @if($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Image" width="100">
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($post->deleted_at)->format('d M Y, H:i') }}</td>
                            <td>
                                @can('restore', $post)
                                    <form action="{{ route('posts.restore', $post->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success">Restore</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script>
        function confirmDelete(postId) {
            if (confirm('Are you sure you want to delete this post?')) {
                document.getElementById('delete-form-' + postId).submit();
            }
        }
    </script>
@endsection
