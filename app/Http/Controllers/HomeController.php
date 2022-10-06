<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Person;
use App\Models\Character;
use App\Models\Favorite;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        //change strict in config/database.php 
        $favorites = Favorite::selectRaw('favorites.event_id, count(event_id) as times_added, events.name, events.slug, events.picture')
            ->join('events', 'events.id', '=', 'favorites.event_id')
            ->groupBy('event_id')
            ->orderByDesc('times_added')
            ->limit(6)
            // if you want to get the top 5
            ->get();
        $popular = Review::selectRaw('reviews.event_id, count(event_id) as member, sum(rating) / count(event_id) as rating, events.name, events.slug, events.picture')
            ->join('events', 'events.id', '=', 'reviews.event_id')
            ->groupBy('event_id')
            ->orderByDesc('member')
            ->orderBy('rating', 'desc')
            ->limit(6)
            // if you want to get the top 5
            ->get();
        $events = Event::latest()->paginate(6);
        $people = Person::latest()->paginate(6);
        $characters = Character::latest()->paginate(6);
        return view('home', [
            "title" => "Home",
            'favorites' => $favorites,
            'events' => $events,
            'people' => $people,
            'characters' => $characters,
            'popular' => $popular,
        ]);
    }

    public function search()
    {
        return view('search', [
            "title" => "Search All",
            "events" => Event::latest()->filter(request(['search']))->get(),
            "people" => Person::latest()->filter(request(['search']))->get(),
            "characters" => Character::latest()->filter(request(['search']))->get(),
        ]);
    }
}
