<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;


class CharacterController extends Controller
{
    public function index()
    {
        return view('characters.index', [
            "title" => "Characters",
            //eager loadng query dipindah ke model
            "characters" => Character::latest()->get()
        ]);
    }

    public function show(Character $character)
    {
        return view('characters.show', [
            "title" => "Dashboard - Show $character->name",
            'chara' => $character,
            'actors' => $character->actor,
            'eventList' => $character->actor_event,
        ]);
    }
}
