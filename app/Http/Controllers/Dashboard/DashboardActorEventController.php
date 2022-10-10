<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActorEvent;
use App\Models\Event;
use App\Models\Actor;
use Illuminate\Validation\Rule;

class DashboardActorEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.actor-events.index', [
            'title' => "Dashboard - Daftar Aktor pada Komunitas",
            'actor_events' => ActorEvent::orderBy('updated_at', 'desc')->orderBy('created_at', 'desc')->filter(request(['search']))->paginate(10)->withQueryString(),
        ]);
    }


    public function create()
    {
        //Join for sorting by character asc
        $actorSortBy = Actor::selectRaw('actors.*')
            ->join('characters', 'characters.id', '=', 'actors.character_id')
            ->join('people', 'people.id', '=', 'actors.person_id')
            ->select('characters.name as chara_name', 'people.name as person_name', 'actors.*')
            ->orderBy('chara_name', 'asc')
            ->orderBy('person_name', 'asc')
            ->get();
        // dd($actorSortBy);

        return view('dashboard.actor-events.create', [
            'title' => "Dashboard - Tetapkan Aktor pada Komunitas",
            'events' => Event::orderBy('name', 'asc')->get(),
            'actors' => $actorSortBy,
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
            return redirect('dashboard/actor-events');
        }
        if ($request->action == 'create') {
            $validatedData = $request->validate(
                [
                    'event_id' => 'required|unique:actor_events,event_id,NULL,id,actor_id,' . $request->actor_id,
                    'actor_id' => 'required',
                    'role' => 'required',
                ],
                [
                    'event_id.unique' => 'Event and Actor already exist!',
                ]
            );
            ActorEvent::create($validatedData);

            return redirect('/dashboard/actor-events')->with('success', 'Aktor berhasil ditambahkan pada data Komunitas!!!');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(ActorEvent $actorEvent)
    {
        $actorSortBy = Actor::selectRaw('actors.*')
            ->join('characters', 'characters.id', '=', 'actors.character_id')
            ->join('people', 'people.id', '=', 'actors.person_id')
            ->select('characters.name as chara_name', 'people.name as person_name', 'actors.*')
            ->orderBy('chara_name', 'asc')
            ->orderBy('person_name', 'asc')
            ->get();

        return view('dashboard.actor-events.edit', [
            "title" => "Dashboard - Ubah Aktor yang ditetapkan",
            'actor_events' => $actorEvent,
            'events' => Event::orderBy('name', 'asc')->get(),
            'actors' => $actorSortBy,
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request->action == 'cancel') {
            return redirect('dashboard/actor-events');
        }
        if ($request->action == 'update') {
            $validatedData = $request->validate(
                [
                    'event_id' => 'required|unique:actor_events,event_id,' . $id . ',id,actor_id,' . $request->actor_id,
                    'actor_id' => 'required',
                    'role' => 'required',
                ],
                [
                    'event_id.unique' => 'Event and Actor already exist!',
                ]
            );

            ActorEvent::where('id', $id)
                ->update($validatedData);

            return redirect('/dashboard/actor-events')->with('success', 'Aktor berhasil diubah pada data Komunitas!!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ActorEvent::destroy($id);

        return redirect('/dashboard/actor-events')->with('success', 'Aktor pada data Komunitas berhasil dihapus!!');
    }
}
