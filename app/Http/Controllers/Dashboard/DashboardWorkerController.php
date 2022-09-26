<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Worker;
use App\Models\Event;
use App\Models\Person;

class DashboardWorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.staff.index', [
            "title" => "Dashboard - List Staff",
            'workers' => Worker::latest()->filter(request(['search']))->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.staff.create', [
            "title" => "Dashboard - Create Staff",
            'events' => Event::orderBy('name', 'asc')->get(),
            'people' => Person::orderBy('name', 'asc')->get(),
            'staff' => Worker::class,
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
            return redirect('dashboard/staff');
        }
        if ($request->action == 'create') {
            //Menggunakan database Unique dua column
            $validatedData = $request->validate(
                [
                    'event_id' => 'required|unique:workers,event_id,NULL,id,person_id,' . $request->person_id,
                    'person_id' => 'required',
                    'role' => 'required|min:3|max:75', //Role
                    'description' => ''
                ],
                [
                    'event_id.unique' => 'Staff already in Event!!!',
                ]
            );

            Worker::create($validatedData);

            return redirect('/dashboard/staff')->with('success', 'New Staff has been added in Event!!!');
        }
    }

    public function edit(Worker $staff)
    {
        return view('dashboard.staff.edit', [
            "title" => "Dashboard Edit Staff",
            'staff' => $staff,
            'events' => Event::orderBy('name', 'asc')->get(),
            'people' => Person::orderBy('name', 'asc')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->action == 'cancel') {
            return redirect('dashboard/staff');
        }
        if ($request->action == 'update') {
            $validatedData = $request->validate(
                [
                    'event_id' => 'required|unique:workers,event_id,' . $id . ',id,person_id,' . $request->person_id,
                    'person_id' => 'required',
                    'role' => 'required|min:3|max:75', //Role
                    'description' => ''
                ],
                [
                    'event_id.unique' => 'Staff already in Event!!!',
                ]
            );

            Worker::where('id', $id)
                ->update($validatedData);

            return redirect('/dashboard/staff')->with('success', 'Staff has been updated!!!');
        }
    }

    public function destroy($id)
    {
        Worker::destroy($id);

        return redirect('/dashboard/staff')->with('success', 'Staff has been deleted!!!');
    }
}
