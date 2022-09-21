<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.topics.index', [
            'title' => "Dashboard - List Topic",
            'topics' => Topic::latest()->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.topics.create', [
            'title' => "Dashboard - Create Topic",
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
        $validatedData = $request->validate([
            'topic' => 'required',
            'sub_topic' => 'required|min:3|max:25|unique:topics,sub_topic',
            'description' => 'nullable|min:5'
        ]);
        $validatedData['slug'] = SlugService::createSlug(Topic::class, 'slug', $request->sub_topic);

        Topic::create($validatedData);
        return redirect('dashboard/topics')->with('success', 'New Topic has been added!!!');
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
    public function edit(Topic $topic)
    {
        return view('dashboard.topics.edit', [
            'title' => "Dashboard - Edit Topic",
            'topic' => $topic
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        $validatedData = $request->validate([
            'topic' => 'required',
            'sub_topic' => 'required|min:3|max:25|unique:topics,sub_topic,' . $topic->id,
            'description' => 'nullable|min:5'
        ]);
        $validatedData['slug'] = SlugService::createSlug(Topic::class, 'slug', $request->sub_topic);

        Topic::where('id', $topic->id)
            ->update($validatedData);
        return redirect('dashboard/topics')->with('success', 'Topic has been update!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        try {
            Topic::destroy($topic->id);
            return redirect('dashboard/topics')->with('success', 'Topic has been delete!!!');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                return redirect('dashboard/topics')->with('fail', 'Topic in use!!!');
                // return error to user here
            }
        }
    }
}
