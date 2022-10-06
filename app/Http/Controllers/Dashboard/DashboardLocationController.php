<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.locations.index', [
            'title' => "Dashboard - List Location",
            'locations' => Location::orderBy('regency', 'asc')->filter(request(['search']))->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.locations.create', [
            'title' => "Dashboard - Create Location",
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
            return redirect('dashboard/locations');
        }
        if ($request->action == 'create') {
            $validatedData = $request->validate(
                [
                    'regency' => 'required|min:3|max:100|unique:locations,regency,NULL,id,sub_regency,' . $request->sub_regency,
                    'sub_regency' => 'required|min:3|max:100',
                ],
                [
                    'regency.unique' => 'Location already exist!!!',
                ]
            );

            Location::create($validatedData);
            return redirect('dashboard/locations')->with('success', 'New Location has been added!!!');
        }
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        return view('dashboard.locations.edit', [
            'title' => "Dashboard - Edit Location",
            'location' => $location
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
            return redirect('dashboard/locations');
        }
        if ($request->action == 'update') {
            $validatedData = $request->validate(
                [
                    'regency' => 'required|min:3|max:100|unique:locations,regency,' . $id . ',id,sub_regency,' . $request->sub_regency,
                    'sub_regency' => 'required|min:3|max:100',
                ],
                [
                    'regency.unique' => 'Location already exist!!!',
                ]
            );

            Location::where('id', $id)
                ->update($validatedData);

            return redirect('dashboard/locations')->with('success', 'Location has been updated!!!');
        }
    }

    public function destroy(Location $location)
    {
        try {
            Location::destroy($location->id);
            return redirect('dashboard/locations')->with('success', 'Location has been deleted!!!');
        } catch (\Illuminate\Database\QueryException $e) {

            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                return redirect('dashboard/locations')->with('fail', 'Location in use!!!');
                // return error to user here
            }
        }
    }
}
