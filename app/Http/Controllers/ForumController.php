<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Post;
use App\Models\Event;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Redirect;

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
            "posts" => Post::latest()->paginate(5),
            "threads" => $threads,
        ]);
    }

    public function topic(Topic $topic)
    {
        return view('forums.topic', [
            "title" => "Forums - $topic->sub_topic",
            "topic" => $topic,
            "posts" => $topic->posts()->paginate(5),
        ]);
    }


    public function post(Topic $topic, Post $post)
    {
        return view('forums.post', [
            "title" => "Forums - $post->title",
            "topic" => $topic,
            "post" => $post,
            // "comments" => Comment::all(),
        ]);
    }

    public function create(Topic $topic)
    {
        return view('forums.create', [
            "title" => "Create Post - $topic->sub_topic",
            "topic" => $topic,
            "events" => Event::all(),
        ]);
    }

    public function store(Request $request, Topic $topic)
    {
        $rules = [
            'title' => 'required|min:3|max:150',
            'topic_id' => 'required',
            'picture' => 'image|file|max:1024',
            'body' => 'required|min:3',
        ];

        $validatedData = $request->validate($rules);

        if (($request->file('picture'))) {
            // memberikan nama pada file yang diupload
            $filename = time() . '-' . $request->picture->getClientOriginalName() . '.' .  $request->picture->getClientOriginalExtension();
            $request->picture->storeAs('post-picture', $filename, 'public');

            $validatedData['picture'] = $filename;
        }

        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        $validatedData['slug'] = $slug;
        $validatedData['user_id'] = auth()->user()->id;

        Post::create($validatedData);

        //! Cara 1
        // return Redirect::to('forum/' . $topic->slug . '/' . $slug);
        //! Cara 2
        // return Redirect::route('forum.post', array('topic' => $topic->slug, 'post' => $slug))->with('success', 'New Post has been added!!!');
        //! Cara 3 Laravel 9
        return to_route('forum.post', [$topic->slug,  $slug])->with('success', 'New Post has been added!!!');
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
