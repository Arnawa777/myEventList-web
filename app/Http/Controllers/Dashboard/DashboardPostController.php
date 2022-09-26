<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Topic;
use App\Models\Event;
use Illuminate\Support\Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topic = Topic::selectRaw('topics.*')
            ->select('topics.id', 'topics.topic', 'topics.sub_topic')
            ->orderby('topic', 'asc')
            ->orderby('sub_topic', 'asc')
            ->get();

        return view('dashboard.posts.index', [
            "title" => "Dashboard - List Post",
            'posts' => Post::latest()->filter(request(['search', 'topic']))->paginate(10)->withQueryString(),
            'topics' => $topic,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $topicSort = Topic::selectRaw('topics.*')
            ->orderBy('topic', 'asc')
            ->orderBy('sub_topic', 'asc')
            ->get();

        $eventSort = Event::selectRaw('events.*')
            ->select('events.id', 'events.name')
            ->orderBy('name', 'asc')
            ->get();

        return view('dashboard.posts.create', [
            "title" => "Dashboard - Create Post",
            'topics' => $topicSort,
            'events' => $eventSort,
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
        if ($request->action == 'cancel') {
            return redirect('dashboard/posts');
        }
        if ($request->action == 'create') {
            $validatedData = $request->validate(
                [
                    'title' => 'required|min:3|max:150',
                    'topic_id' => 'required',
                    'event_id' => 'nullable',
                    'picture' => 'nullable|image|file|max:1024',
                    'body' => 'required|min:20',
                ],
                [
                    'body.min' => 'Body too short'
                ]
            );

            if ($request->file('picture')) {
                // memberikan nama pada file yang diupload
                $filename = time() . '-' . $request->picture->getClientOriginalName() . '.' .  $request->picture->getClientOriginalExtension();
                $request->picture->storeAs('post-picture', $filename, 'public');

                $validatedData['picture'] = $filename;
            }


            $validatedData['slug'] = SlugService::createSlug(Post::class, 'slug', $request->title);
            $validatedData['user_id'] = auth()->user()->id;


            Post::create($validatedData);

            return redirect('dashboard/posts')->with('success', 'New Post has been added!!!');
        }
    }

    public function show(Post $post, Topic $topic,)
    {
        return view('dashboard.posts.show', [
            "title" => "Dashboard - Show $post->title",
            "topic" => $topic,
            "post" => $post,
            "comments" => $post->comments()->paginate(5),
        ]);
    }

    public function edit(Post $post)
    {
        $topicSort = Topic::selectRaw('topics.*')
            ->orderBy('topic', 'asc')
            ->orderBy('sub_topic', 'asc')
            ->get();

        $eventSort = Event::selectRaw('events.*')
            ->select('events.id', 'events.name')
            ->orderBy('name', 'asc')
            ->get();

        return view('dashboard.posts.edit', [
            "title" => "Dashboard - Edit Post",
            'post' => $post,
            'topics' => $topicSort,
            'events' => $eventSort,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        if ($request->action == 'remove') {
            if ($request->oldPicture) {
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
            return redirect('dashboard/posts');
        }

        if ($request->action == 'update') {

            $validatedData = $request->validate(
                [
                    'title' => 'required|min:3|max:150',
                    'topic_id' => 'required',
                    'event_id' => 'nullable',
                    'picture' => 'nullable|image|file|max:1024',
                    'body' => 'required|min:20',
                ],
                [
                    'body.min' => 'Body too short'
                ]
            );

            if ($request->file('picture')) {
                if ($request->oldPicture) {
                    $file = public_path('/storage/post-picture/' . $request->oldPicture);
                    if (file_exists($file)) {
                        unlink($file);
                    }
                }
                // memberikan nama pada file yang diupload
                $filename = time() . '-' . $request->picture->getClientOriginalName() . '.' .  $request->picture->getClientOriginalExtension();
                $request->picture->storeAs('post-picture', $filename, 'public');

                $validatedData['picture'] = $filename;
            }


            $validatedData['slug'] = SlugService::createSlug(Post::class, 'slug', $request->title);
            $validatedData['user_id'] = auth()->user()->id;


            Post::where('id', $post->id)
                ->update($validatedData);

            return redirect('dashboard/posts')->with('success', 'Post has been updated!!!');
        }
    }

    public function destroy(Post $post)
    {
        if ($post->picture) {
            $file = public_path('/storage/post-picture/' . $post->picture);

            if (file_exists($file)) {
                unlink($file);
            }
        }

        Post::destroy($post->id);

        return redirect('/dashboard/posts')->with('success', 'Post has been deleted!!!');
    }
}
