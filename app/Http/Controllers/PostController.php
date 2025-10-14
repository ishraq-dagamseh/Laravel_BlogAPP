<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class PostController extends Controller {
public function index() {
$posts = [
['id'=>1, 'title'=>'First Post', 'content'=>'This is the first post'],
['id'=>2, 'title'=>'Second Post', 'content'=>'This is the second post']
];
return view('posts.index', compact('posts'));
}
public function show($id) {
$post = ['id'=>$id, 'title'=>"Post #$id", 'content'=>'Post details here...'];
return view('posts.show', compact('post'));
}
public function store(Request $request) {
return redirect('/')->with('success','Post Created!');
}
}