<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Actor;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Review;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(request('search'));
        return view('events.index', [
            "title" => "Events",
            //eager loadng query dipindah ke model
            //WithQuearyString membawa query sebelumnya pada pagination
            "events" => Event::latest()->filter(request(['search', 'category']))->paginate(4)->withQueryString(),
            "categories" => Category::all(),
        ]);
    }

    public function show(Event $event)
    {
        if (Auth::user()) {
            $user = Auth::user();
            $favorites = Favorite::where('event_id', $event->id)
                ->where('user_id', $user->id)
                ->first();
            $myReview = Review::where('event_id', $event->id)
                ->where('user_id', $user->id)
                ->first();
        } else {
            $favorites = '';
            $myReview =  '';
        }

        //sort not null last
        $allReview = Review::selectRaw('reviews.*')
            ->join('events', 'events.id', '=', 'reviews.event_id')
            ->orderByRaw('ISNULL(body), body ASC')
            ->where('event_id', $event->id)
            ->limit(3)
            // if you want to get the top 3
            ->get();

        $countUserReview = Review::where('event_id', $event->id)->count();
        $countRating = $event->reviews->sum('rating');
        if ($countUserReview > 0) {
            $totalRating = $countRating / $countUserReview;
        } else {
            $totalRating = "N/A";
        }
        return view('events.show', [
            "title" => "$event->name",
            'event' => $event,
            'actors' => $event->actor()->paginate(10),
            'staff' => $event->staff()->paginate(10),
            'favorite' => $favorites,
            'allReviews' =>  $allReview, //$event->reviews()->skip(0)->take(3)->get(),
            'myReview' => $myReview,
            'totalRating' => $totalRating,
            'userReview' => $countUserReview,
        ]);
    }

    public function characters(Event $event)
    {
        if (Auth::user()) {
            $user = Auth::user();
            $favorites = Favorite::where('event_id', $event->id)
                ->where('user_id', $user->id)
                ->first();
        } else {
            $favorites = '';
        }

        return view('events.characters', [
            "title" => "$event->name - Characters & Staff",
            'event' => $event,
            'actors' => $event->actor()->get(),
            'staff' => $event->staff()->get(),
            'favorite' => $favorites,
        ]);
    }

    public function reviews(Event $event)
    {
        if (Auth::user()) {
            $user = Auth::user();
            $favorites = Favorite::where('event_id', $event->id)
                ->where('user_id', $user->id)
                ->first();
        } else {
            $favorites = '';
        }

        //sort not null last
        $allReview = Review::selectRaw('reviews.*')
            ->join('events', 'events.id', '=', 'reviews.event_id')
            ->orderByRaw('ISNULL(body), body ASC')
            ->where('event_id', $event->id)
            ->paginate(10);

        return view('events.reviews', [
            "title" => "$event->name - Reviews",
            'event' => $event,
            'allReviews' =>  $allReview,
            'favorite' => $favorites,
        ]);
    }
}
