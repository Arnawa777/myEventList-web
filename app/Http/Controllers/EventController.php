<?php

namespace App\Http\Controllers;

use App\Models\Event;
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

        return view('events.index', [
            "title" => "All Events",
            //eager loadng query dipindah ke model
            "events" => Event::latest()->paginate(99),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        $validatedData = $request->validate([
            'body' => 'required|min:200|max:1000',
        ]);

        Review::create($validatedData);
        return redirect()->back()->with('success', 'Review has been added!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
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
            "title" => "Event",
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
