<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;


class CharacterController extends Controller
{
    public function index()
    {
        return view('characters.index', [
            "title" => "Daftar Karakter",
            //eager loadng query dipindah ke model
            "characters" => Character::latest()->filter(request(['search']))->paginate(4)->withQueryString(),
        ]);
    }

    public function show(Character $character)
    {
        return view('characters.show', [
            "title" => "Dashboard - Detail $character->name",
            'chara' => $character,
            'actors' => $character->actor,
            'eventList' => $character->actor_event->unique('event_id'),
        ]);
    }
}
