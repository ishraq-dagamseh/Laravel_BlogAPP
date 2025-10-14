@extends('layouts.app')
@section('content')
<h2>{{ $post['title'] }}</h2>
<p>{{ $post['content'] }}</p>
@isset($post['id'])
<small>Post ID: {{ $post['id'] }}</small>
@endisset
@empty($post['tags'])
<p>No tags for this post</p>
@endempty
@endsection