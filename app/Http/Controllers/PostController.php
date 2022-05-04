<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return view('forums.posts', [
        "title" => "All Posts",
        //eager loadng query dipindah ke model
        "posts" => Post::latest()->get()
    ]);

    }


    public function show(Post $post)
    {
        return view ('forums.post', [
        "title" => "Single Post",
        //3. Dikirim
        "post" => $post
    ]);
    }
}
