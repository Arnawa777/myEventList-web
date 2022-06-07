<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.people.index', [
            "title" => "Dashboard People",
            'people' => Person::latest()->paginate(5),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.people.create', [
            "title" => "Dashboard - Create Person",
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
            'name' => 'required|unique:people|min:3|max:50',
            'birthday' => '',
            'biography' => '',
            'picture' => 'image|file|max:1024',
        ];

        $validatedData = $request->validate($rules);

        if (empty($request->file('picture')))
        {
            $validatedData['picture'] = 'default.jpg';
        }else{
            // memberikan nama pada file yang diupload
            $filename = time() .'-'.$request->picture->getClientOriginalName().'.' .  $request->picture->getClientOriginalExtension();
            $request->picture->storeAs('person-picture',$filename,'public');

            $validatedData['picture'] = $filename;
        }

        $validatedData['slug'] = SlugService::createSlug(Person::class, 'slug', $request->name);

        Person::create($validatedData);

        return redirect('/dashboard/people')->with('success', 'New Person has been added!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        return view('dashboard.people.show', [
            "title" => "Dashboard - Show $person->name",
            'person' => $person,
            'actors' => $person->actor,
            'staff' => $person->staff,
            'eventList' => $person->actor_event->unique('event_id'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        return view('dashboard.people.edit', [
            "title" => "Dashboard - Edit Person",
            'person' => $person,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        $rules = [
            'name' => 'required|min:3|max:50|unique:people,name,'.$person->id,
            'birthday' => '',
            'biography' => '',
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
                    $file = public_path('/storage/person-picture/' . $request->oldPicture);
                
                    if (file_exists($file)) {
                        unlink($file);
                    }
                }
            }
            // memberikan nama pada file yang diupload
            $filename = time() .'-'.$request->picture->getClientOriginalName().'.' .  $request->picture->getClientOriginalExtension();
            $request->picture->storeAs('person-picture',$filename,'public');

            $validatedData['picture'] = $filename;
        }

        $validatedData['slug'] = SlugService::createSlug(Person::class, 'slug', $request->name);

        Person::where('id', $person->id)
        ->update($validatedData);

        return redirect('/dashboard/people')->with('success', 'Person has been update!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        if(!empty($person->picture))
        {
            if($person->picture !== 'default.jpg'){
                $file = public_path('/storage/person-picture/' . $person->picture);
            
                if (file_exists($file)) {
                    unlink($file);
                }
            }
        }

        Person::destroy($person->id);

        return redirect('/dashboard/people')->with('success', 'Person has been delete!!!');
    }
}
