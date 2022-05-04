<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;

class TopicController extends Controller
{
    public function index()
    {
        return view('forums.topic', [
        "title" => "All Posts",
        //eager loadng query dipindah ke model
        "topics" => Topic::latest()->get()
    ]);

    }

}