

@extends('layouts.app')
@section('content')

{{-- Flash message --}}
@if(session('success'))
    <x-alert>
        {{ session('success') }}
    </x-alert>
@endif
<h1>All Posts</h1>
@foreach($posts as $post)

<h3><a href="{{ url('/post/'.$post['id']) }}">{{ $post['title'] }}</a></h3>
<p>{{ $post['content'] }}</p>
@endforeach
<x-alert type="success" message="Welcome to Blog!" />

@if(session('success'))
<p style="color: green">{{ session('success') }}</p>
@endif
<form method="POST" action="/post">
@csrf
<input type="text" name="title" placeholder="New Post Title">
<button type="submit">Save</button>
</form>
@endsection