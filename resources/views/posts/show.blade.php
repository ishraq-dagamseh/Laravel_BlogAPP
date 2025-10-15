@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-6 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
    <p class="mb-4">{{ $post->body }}</p>

    {{-- Edit/Delete buttons (only for owner) --}}
    @can('update', $post)
        <a href="{{ route('posts.edit', $post) }}" class="text-sm text-white bg-yellow-500 px-2 py-1 rounded">Edit</a>
    @endcan

    @can('delete', $post)
        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-sm text-white bg-red-500 px-2 py-1 rounded">Delete</button>
        </form>
    @endcan

    {{-- Comments Section --}}
    <div class="mt-6">
        <h2 class="text-xl font-semibold mb-2">Comments</h2>
        
        @forelse($post->comments as $comment)
            <div class="border-b border-gray-200 py-2">
                <p>{{ $comment->body }}</p>
                <small class="text-gray-500">By {{ $comment->user->name }}</small>

                {{-- Delete comment (only owner) --}}
                @can('delete', $comment)
                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-white bg-red-500 px-2 py-1 rounded">Delete</button>
                    </form>
                @endcan
            </div>
        @empty
            <p>No comments yet.</p>
        @endforelse

        {{-- Add comment form (only logged-in users) --}}
        @auth
        <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-4">
            @csrf
            <textarea name="body" placeholder="Add a comment..." class="w-full border rounded px-2 py-1" required></textarea>
            <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded mt-2">Comment</button>
        </form>
        @endauth
    </div>
</div>
@endsection
