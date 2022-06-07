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
    public function index(Request $request)
    {
        return view('dashboard.actor-events.index', [
            "title" => "Dashboard Actor Events",
            'actor_events' => ActorEvent::latest()->paginate(5),
            ]);
    }

    public function search(Request $request){
        $movies = [];
        if($request->has('q')){
            $search = $request->q;
            $movies =Event::select("id", "name", "slug")
            		->where('name', 'LIKE', "%$search%")
            		->get();
        }
        return response()->json($movies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $query = new Actor; //new object
        //$query = Product::where('id','!=',0);
        $chara = $query->join('characters', 'characters.id','=','actors.character_id');
        $chara = $chara->select('characters.name as char_name','actors.*');
        $chara = $chara->orderBy('char_name','asc');
        $recordChara = $chara->get();

        return view('dashboard.actor-events.create', [
            "title" => "Create Actor Events",
            'events' => Event::orderBy('name', 'asc')->get(),
            'actor_events' => ActorEvent::class,
            'actors' => $recordChara,
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
            'event_id' => 'required|unique:actor_events,event_id,NULL,id,actor_id,'. $request->actor_id,
            'actor_id' => 'required',
        ],
        [
            'event_id.unique' => 'Event and Actor has already been use!',
        ]);
        ActorEvent::create($validatedData);

        return redirect('/dashboard/actor-events')->with('success', 'New Actor in Event has been added!!!');
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
    public function edit(ActorEvent $actorEvent)
    {
        $query = new Actor; //new object
        //$query = Product::where('id','!=',0);
        $query = $query->join('characters', 'characters.id','=','actors.character_id');
        $query = $query->select('characters.name as char_name','actors.*');
        $query = $query->orderBy('char_name','asc');
        $record = $query->get();

        return view('dashboard.actor-events.edit', [
            "title" => "Edit Actor Events",
            'actor_events' => $actorEvent,
            'events' => Event::orderBy('name', 'asc')->get(),
            'actors' => $record,
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
        $validatedData = $request->validate([
            'event_id' => 'required|unique:actor_events,event_id,'. $id . ',id,actor_id,'. $request->actor_id,
            'actor_id' => 'required',
        ],
        [
            'event_id.unique' => 'Event and Actor has already been use!',
        ]);

        ActorEvent::where('id', $id)
                ->update($validatedData);

        return redirect('/dashboard/actor-events')->with('success', 'New Actor in Event has been update!!!');
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

        return redirect('/dashboard/actor-events')->with('success', 'Actor in Event has been delete!!');
    }
}
