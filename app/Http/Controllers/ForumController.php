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
        $threads = Topic::first()->with('latestPost')->get();

        // $myeventlistTopic = DB::table('topics')
        //     ->join('posts', 'topics.id', '=', 'posts.topic_id')
        //     ->select('topics.sub_topic', 'topics.slug', 'posts.title', 'posts.picture', 'posts.user_id')
        //     ->where('topics.topic', 'myeventlist')
        //     ->orderBy('posts.created_at', 'desc')
        //     ->groupBy('topics.sub_topic')
        //     ->get();

        return view('forums.index', [
            "title" => "Forums",
            "posts" => Post::latest()->paginate(10),
            "threads" => $threads,
        ]);
    }

    public function topic(Topic $topic)
    {
        return view('forums.topic', [
            "title" => "Forums - $topic->sub_topic",
            "topic" => $topic,
            "posts" => $topic->posts()->latest()->paginate(10),
        ]);
    }


    public function post(Topic $topic, Post $post)
    {
        return view('forums.post.show', [
            "title" => "Forums - $post->title",
            "topic" => $topic,
            "post" => $post,
            "comments" => $post->comments()->paginate(5),
        ]);
    }

    public function create(Topic $topic)
    {
        return view('forums.post.create', [
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
        if ($request->event_id) {
            $validatedData['event_id'] = $request->event_id;
        }

        $validatedData['user_id'] = auth()->user()->id;

        Post::create($validatedData);

        //! Cara 1
        // return Redirect::to('forum/' . $topic->slug . '/' . $slug);
        //! Cara 2
        // return Redirect::route('forum.post', array('topic' => $topic->slug, 'post' => $slug))->with('success', 'New Post has been added!!!');
        //! Cara 3 Laravel 9
        return to_route('forum.post', [$topic->slug,  $slug])->with('success', 'New Post has been added!!!');
    }

    public function show($id)
    {
        //
    }

    public function edit(Topic $topic, Post $post)
    {
        return view('forums.post.edit', [
            "title" => "Edit Post - $post->title",
            "topic" => $topic,
            "post" => $post,
            "events" => Event::all(),
        ]);
    }

    public function update(Request $request, Topic $topic, Post $post)
    {
        // dd($post->picture);
        if ($request->action == 'remove') {
            if ($post->picture !== 'default.jpg') {
                $file = public_path('/storage/post-picture/' . $post->picture);

                if (file_exists($file)) {
                    unlink($file);
                }
            }

            Post::where('id', $post->id)
                ->update(['picture' => null]);

            return redirect()->back();
        }

        if ($request->action == 'cancel') {
            return to_route('forum.post', [$topic->slug,  $post->slug]);
        }

        if ($request->action == 'update') {
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
            if ($request->event_id) {
                $validatedData['event_id'] = $request->event_id;
            }
            $validatedData['user_id'] = auth()->user()->id;

            Post::where('id', $request->post_id)
                ->update($validatedData);

            //! Cara 1
            // return Redirect::to('forum/' . $topic->slug . '/' . $slug);
            //! Cara 2
            // return Redirect::route('forum.post', array('topic' => $topic->slug, 'post' => $slug))->with('success', 'New Post has been added!!!');
            //! Cara 3 Laravel 9
            return to_route('forum.post', [$topic->slug,  $slug])->with('success', 'Post has been updated!!!');
        }
    }

    public function destroy(Topic $topic, Post $post, Request $request)
    {
        // dd($request->redirect);
        if (!empty($post->picture)) {
            if ($post->picture !== 'default.jpg') {
                $file = public_path('/storage/post-picture/' . $post->picture);
                if (file_exists($file)) {
                    unlink($file);
                }
            }
        }

        Post::where('id', $post->id)
            ->delete();
        // Post::destroy($post->id);

        // return redirect('/forum')->with('success', 'Post has been delete!!!');
        // $slug = $request->topic_slug;

        if ($request->redirect == 'profile') {
            // return to_route('forum.topic', [$topic->slug])->with('success', 'Post has been deleted!!!');
            return redirect()->back()->with('success', 'Post has been delete!!!');
        } else {
            return to_route('forum.topic', [$topic->slug])->with('success', 'Post has been deleted!!!');
        }
    }
}
