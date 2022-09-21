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
        return view('dashboard.posts.index', [
            "title" => "Dashboard - List Post",
            'posts' => Post::latest()->paginate(10),
            // 'posts' => Post::where('user_id', auth()->user()->id)->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            "title" => "Dashboard - Create Post",
            'topics' => Topic::all(),
            'events' => Event::all(),
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
        $rules = [
            'title' => 'required|min:3|max:150',
            'topic_id' => 'required',
            'event_id' => '',
            'picture' => 'image|file|max:1024',
            'body' => 'required|min:3',
        ];

        $validatedData = $request->validate($rules);

        if (empty($request->file('picture'))) {
            $validatedData['picture'] = 'default.jpg';
        } else {
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            "title" => "Dashboard - Show $post->title",
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            "title" => "Dashboard - Edit Post",
            'post' => $post,
            'topics' => Topic::all(),
            'events' => Event::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|min:3|max:150',
            'topic_id' => 'required',
            'event_id' => '',
            'image' => 'image|file|max:1024',
            'body' => 'required',
        ];

        $validatedData = $request->validate($rules);

        if (empty($request->file('picture'))) {
            $validatedData['picture'] = 'default.jpg';
        } else {
            if (!empty($request->oldPicture)) {
                if ($request->oldPicture !== 'default.jpg') {
                    $file = public_path('/storage/post-picture/' . $request->oldPicture);
                    if (file_exists($file)) {
                        unlink($file);
                    }
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

        return redirect('dashboard/posts')->with('success', 'Post has been update!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (!empty($post->picture)) {
            if ($post->picture !== 'default.jpg') {
                $file = public_path('/storage/post-picture/' . $post->picture);

                if (file_exists($file)) {
                    unlink($file);
                }
            }
        }

        Post::destroy($post->id);

        return redirect('/dashboard/posts')->with('success', 'Post has been delete!!!');
    }
}
