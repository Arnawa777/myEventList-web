<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Terima Kasih STACKOVERFLOW
        $threads = Topic::latest()->with('latestPost')->get();

        // $myeventlistTopic = DB::table('topics')
        //     ->join('posts', 'topics.id', '=', 'posts.topic_id')
        //     ->select('topics.sub_topic', 'topics.slug', 'posts.title', 'posts.picture', 'posts.user_id')
        //     ->where('topics.topic', 'myeventlist')
        //     ->orderBy('posts.created_at', 'desc')
        //     ->groupBy('topics.sub_topic')
        //     ->get();

        return view('forums.index', [
            "title" => "Forums",
            "threads" => $threads,
        ]);
    }

    public function topic(Topic $topic)
    {
        return view('forums.topic', [
            "title" => "Forums - $topic->sub_topic",
            "topic" => $topic
        ]);
    }


    public function post(Topic $topic, Post $post)
    {
        return view('forums.post', [
            "title" => "Forums -",
            "topic" => $topic,
            "post" => $post
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
