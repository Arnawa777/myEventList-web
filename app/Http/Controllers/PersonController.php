<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

class PersonController extends Controller
{
    public function index()
    {
        return view('people.index', [
            'title' => 'All Person',
            //eager loadng query dipindah ke model
            'people' => Person::latest()->get()
        ]);
    }

    public function show(Person $person)
    {
        return view('people.show', [
            'title' => $person->name,
            'person' => $person,
            'actors' => $person->actor,
            'staff' => $person->staff,
            'eventList' => $person->actor_event->unique('event_id'),
            "person" => $person
        ]);
    }
}
