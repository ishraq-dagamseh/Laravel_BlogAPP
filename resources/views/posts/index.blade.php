@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

    {{-- Flash message --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-2xl font-bold mb-4">All Posts</h1>

    {{-- Create post form (only for logged-in users) --}}
    @auth
    <div class="mb-6">
        <form method="POST" action="{{ route('posts.store') }}" class="flex flex-col space-y-2">
            @csrf
            <input type="text" name="title" placeholder="New Post Title" class="border rounded px-2 py-1" required>
            <textarea name="body" placeholder="Post content..." class="border rounded px-2 py-1" required></textarea>
            <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">Save</button>
        </form>
    </div>
    @endauth

    {{-- Posts List --}}
    @forelse($posts as $post)
    <div class="border-b border-gray-200 py-4">
        <h3 class="text-xl font-semibold">
            <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:underline">
                {{ $post->title }}
            </a>
        </h3>
        <p class="mt-1">{{ $post->body }}</p>

        {{-- Edit/Delete buttons (only for owner) --}}
        @can('update', $post)
            <a href="{{ route('posts.edit', $post) }}" class="text-sm text-white bg-yellow-500 px-2 py-1 rounded mt-2 inline-block">Edit</a>
        @endcan

        @can('delete', $post)
            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-sm text-white bg-red-500 px-2 py-1 rounded mt-2">Delete</button>
            </form>
        @endcan
    </div>
    @empty
        <p>No posts found.</p>
    @endforelse
</div>
@endsection
