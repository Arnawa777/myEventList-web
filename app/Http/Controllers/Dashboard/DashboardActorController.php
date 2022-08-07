<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Actor;
use App\Models\Person;
use App\Models\Character;

class DashboardActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.actors.index', [
            "title" => "Dashboard Actors",
            'actors' => Actor::latest()->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.actors.create', [
            "title" => "Create Actor",
            'people' => Person::orderBy('name', 'asc')->get(),
            'characters' => Character::orderBy('name', 'asc')->get(),
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
        $validatedData = $request->validate(
            [
                'character_id' => 'required|unique:actors,character_id,NULL,id,person_id,' . $request->person_id,
                'person_id' => 'required',
            ],
            [
                'character_id.unique' => 'Actor already exist!!!',
            ]
        );

        Actor::create($validatedData);

        return redirect('/dashboard/actors')->with('success', 'New Actor has been added!!!');
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
    public function edit(Actor $actor)
    {
        return view('dashboard.actors.edit', [
            "title" => "Edit Actor",
            'people' => Person::orderBy('name', 'asc')->get(),
            'characters' => Character::orderBy('name', 'asc')->get(),
            'actor' => $actor
        ]);
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
        $validatedData = $request->validate(
            [
                'character_id' => 'required|unique:actors,character_id,' . $id . ',id,person_id,' . $request->person_id,
                'person_id' => 'required',
            ],
            [
                'character_id.unique' => 'Actor already exist!!!',
            ]
        );

        Actor::where('id', $id)
            ->update($validatedData);

        return redirect('/dashboard/actors')->with('success', 'Actor has been update!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Actor::destroy($id);

        return redirect('/dashboard/actors')->with('success', 'Actor has been delete!!');
    }
}
