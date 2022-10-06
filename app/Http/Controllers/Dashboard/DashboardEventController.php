<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Review;
use App\Models\Category;
use App\Models\Location;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Validation\Rule;

class DashboardEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::selectRaw('locations.*')
            ->groupby('regency')
            ->get();

        return view('dashboard.events.index', [
            "title" => "Dashboard - List Event",
            'events' => Event::latest()->filter(request(['search', 'category', 'location']))->paginate(5)->withQueryString(),
            "categories" => Category::all(),
            "locations" => $locations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location = Location::selectRaw('locations.*')
            ->orderBy('regency', 'asc')
            ->orderBy('sub_regency', 'asc')
            ->get();

        return view('dashboard.events.create', [
            "title" => "Dashboard - Create Event",
            'events' => Event::class,
            'categories' => Category::all(),
            'locations' => $location
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
            return redirect('dashboard/events');
        }
        if ($request->action == 'create') {
            // dd($check[0]);
            $rules = [
                'name' => 'required|unique:events|min:3|max:100',
                'location_id' => 'required',
                'category_id' => 'required',
                'description' => 'nullable',
                'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
                'date' => 'nullable',
                'picture' => 'nullable|image|file|max:1024',
            ];

            // if ($request->phone) {
            //     $number = $request->input('phone');
            //     preg_match('%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i', $number, $regexPhone);

            // dd($regexPhone[2]);
            //     if ($regexPhone) {
            //         $validatedData['phone'] = $regexPhone[2];
            //     } else {
            //         $validatedData['phone'] = $number;
            //     }
            // }

            $validatedData = $request->validate($rules);

            if ($request->file('picture')) {
                // memberikan nama pada file yang diupload
                $filename = time() . '-' . $request->picture->getClientOriginalName() . '.' .  $request->picture->getClientOriginalExtension();
                $request->picture->storeAs('event-picture', $filename, 'public');

                $validatedData['picture'] = $filename;
            }

            if ($request->video) {
                $url = $request->input('video');
                preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/", $url, $matches);
                //Cuma bisa yang ada V= nya 
                // parse_str( parse_url( $url, PHP_URL_QUERY ), $youtube );
                if ($matches) {
                    $validatedData['video'] = $matches[1];
                } else {
                    $validatedData['video'] = $url;
                }
            }
            $validatedData['slug'] = SlugService::createSlug(Event::class, 'slug', $request->name);

            Event::create($validatedData);

            return redirect('dashboard/events')->with('success', 'New Event has been added!!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
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

        return view('dashboard.events.show', [
            "title" => "Dashboard - Show $event->name",
            'event' => $event,
            'actors' => $event->actor()->paginate(10),
            'staff' => $event->staff()->paginate(10),
            'allReviews' =>  $allReview, //$event->reviews()->skip(0)->take(3)->get()
            'totalRating' => $totalRating,
            'userReview' => $countUserReview,
        ]);
    }

    public function edit(Event $event)
    {
        $location = Location::selectRaw('locations.*')
            ->orderBy('regency', 'asc')
            ->orderBy('sub_regency', 'asc')
            ->get();

        return view('dashboard.events.edit', [
            "title" => "Dashboard - Edit Event",
            'event' => $event,
            'categories' => Category::all(),
            'locations' => $location,
        ]);
    }

    public function update(Request $request, Event $event)
    {
        // dd($request);
        if ($request->action == 'remove') {
            $file = public_path('/storage/event-picture/' . $event->picture);

            if (file_exists($file)) {
                unlink($file);
            }

            Event::where('id', $event->id)
                ->update(['picture' => null]);

            return redirect()->back();
        }

        if ($request->action == 'cancel') {
            return redirect('dashboard/events');
        }

        if ($request->action == 'update') {
            $rules = [
                'name' => 'required|min:3|max:100|unique:events,name,' . $event->id,
                'location_id' => 'required',
                'category_id' => 'required',
                'description' => 'nullable',
                'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15|unique:events,phone,' . $event->id,
                'date' => 'nullable',
                'picture' => 'nullable|image|file|max:1024',
            ];

            $validatedData = $request->validate($rules);

            if (($request->file('picture'))) {
                // Delete old picture
                if ($request->oldPicture) {
                    $file = public_path('/storage/event-picture/' . $event->picture);

                    if (file_exists($file)) {
                        unlink($file);
                    }
                }

                // memberikan nama pada file yang diupload
                $filename = time() . '-' . $request->picture->getClientOriginalName() . '.' .  $request->picture->getClientOriginalExtension();
                $request->picture->storeAs('event-picture', $filename, 'public');

                $validatedData['picture'] = $filename;
            }

            if ($request->video) {
                $url = $request->input('video');
                preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/", $url, $matches);
                //Cuma bisa yang ada V= nya 
                // parse_str( parse_url( $url, PHP_URL_QUERY ), $youtube );

                if ($matches) {
                    $validatedData['video'] = $matches[1];
                } else {
                    $validatedData['video'] = $url;
                }
            }

            $validatedData['slug'] = SlugService::createSlug(Event::class, 'slug', $request->name);

            Event::where('id', $event->id)
                ->update($validatedData);

            return redirect('dashboard/events')->with('success', 'Event has been updated!!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if (($event->picture)) {
            $file = public_path('/storage/event-picture/' . $event->picture);

            if (file_exists($file)) {
                unlink($file);
            }
        }

        Event::destroy($event->id);

        return redirect('/dashboard/events')->with('success', 'Event has been delete!!!');
    }

    public function characters(Event $event)
    {
        return view('dashboard.events.characters', [
            "title" => "$event->name - Characters & Staff",
            'event' => $event,
            'actors' => $event->actor()->get(),
            'staff' => $event->staff()->get(),
        ]);
    }

    public function reviews(Event $event)
    {
        //sort not null last
        $allReview = Review::selectRaw('reviews.*')
            ->join('events', 'events.id', '=', 'reviews.event_id')
            ->orderByRaw('ISNULL(body), body ASC')
            ->where('event_id', $event->id)
            ->paginate(10);

        return view('dashboard.events.reviews', [
            "title" => "$event->name - Reviews",
            'event' => $event,
            'allReviews' =>  $allReview,
        ]);
    }
}
