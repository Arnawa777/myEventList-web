<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;


class CharacterController extends Controller
{
    public function index()
    {
        return view('events.characters', [
        "title" => "All Character",
        //eager loadng query dipindah ke model
        "characters" => Character::latest()->get()
    ]);

    }

    public function show(Character $chara)
    {
        return view ('events.character', [
        "chara" => $chara
        ]);
    }
}
