<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.events.index', [
            "title" => "Dashboard Events",
            'events' => Event::latest()->paginate(5),
            ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.events.create', [
            "title" => "Create Event",
            'events' => Event::class,
            'categories' => Category::all()
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
        $rules = [
            'name' => 'required|unique:events|min:3|max:100',
            'location_id' => 'required',
            'category_id' => 'required',
            'synopsis' => '',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:13',
            'date' => 'required',
            'picture' => 'image|file|max:1024',
        ];

        $validatedData = $request->validate($rules);

        if (empty($request->file('picture')))
        {
            $validatedData['picture'] = 'default.jpg';
        }else{
            // memberikan nama pada file yang diupload
            $filename = time() .'-'.$request->picture->getClientOriginalName().'.' .  $request->picture->getClientOriginalExtension();
            $request->picture->storeAs('event-picture',$filename,'public');

            $validatedData['picture'] = $filename;
        }
        
        if (!empty($request->video))
        {
            $url = $request->input('video');
            preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/", $url, $matches);
            //Cuma bisa yang ada V= nya 
            // parse_str( parse_url( $url, PHP_URL_QUERY ), $youtube );

            $validatedData['video'] = $matches[1];
        }
        $validatedData['slug'] = SlugService::createSlug(Event::class, 'slug', $request->name);
        
        Event::create($validatedData);

        return redirect('dashboard/events')->with('success', 'New Event has been added!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('dashboard.events.show', [
            "title" => "Event",
            'event' => $event,
            'actors' => $event->actor()->paginate(10),
            'staff' => $event->staff()->paginate(10)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('dashboard.events.edit', [
            "title" => "Event",
            'event' => $event,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $rules = [
            'name' => 'required|min:3|max:100|unique:events,name,'.$event->id,
            'location_id' => 'required',
            'category_id' => 'required',
            'synopsis' => '',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:13|unique:events,phone,'.$event->id,
            'date' => 'required',
            'picture' => 'image|file|max:1024',
        ];

        $validatedData = $request->validate($rules);

        if (empty($request->file('picture')))
        {
            $validatedData['picture'] = 'default.jpg';
        }else{
            if(!empty($request->oldPicture))
            {
                if($request->oldPicture !== 'default.jpg'){
                    $file = public_path('/storage/event-picture/' . $request->oldPicture);
                
                    if (file_exists($file)) {
                        unlink($file);
                    }
                }
            }
            // memberikan nama pada file yang diupload
            $filename = time() .'-'.$request->picture->getClientOriginalName().'.' .  $request->picture->getClientOriginalExtension();
            $request->picture->storeAs('event-picture',$filename,'public');

            $validatedData['picture'] = $filename;
        }

        if (!empty($request->video))
        {
            $url = $request->input('video');
            preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/", $url, $matches);
            //Cuma bisa yang ada V= nya 
            // parse_str( parse_url( $url, PHP_URL_QUERY ), $youtube );

            if(!empty($matches))
            {
                $validatedData['video'] = $matches[1];
            }else{
                $validatedData['video'] = $url;
            }
        }

        $validatedData['slug'] = SlugService::createSlug(Event::class, 'slug', $request->name);
        
        Event::where('id', $event->id)
                ->update($validatedData);

        return redirect('dashboard/events')->with('success', 'New Event has been added!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if(!empty($event->picture))
        {
            if($event->picture !== 'default.jpg'){
                $file = public_path('/storage/event-picture/' . $event->picture);
            
                if (file_exists($file)) {
                    unlink($file);
                }
            }
        }

        Event::destroy($event->id);
        
        return redirect('/dashboard/events')->with('success', 'Event has been delete!!!');
    }
}
