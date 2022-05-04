<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

class PersonController extends Controller
{
    public function index()
    {
        return view('events.people', [
        "title" => "All Person",
        //eager loadng query dipindah ke model
        "people" => Person::latest()->get()
    ]);

    }

    public function show(Person $person)
    {
        return view ('events.character', [
        "person" => $person
        ]);
    }
}
