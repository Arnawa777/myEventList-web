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
            'title' => "Dashboard Location",
            'locations' => Location::latest()->paginate(5),
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
        $validatedData = $request->validate([
            'regency' => 'required|min:3|max:100|unique:locations,regency',
            'sub_regency' => 'required|min:3|max:100|unique:locations,sub_regency',
        ]);

        Location::create($validatedData);
        return redirect('dashboard/locations')->with('success', 'New Location has been added!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $validatedData = $request->validate([
            'regency' => 'required|min:3|max:100|unique:locations,regency',
            'sub_distric' => 'required|min:3|max:100|unique:locations,sub_distric',
        ]);

        Location::where($id)
                ->update($validatedData);

        return redirect('dashboard/locations')->with('success', 'Location has been update!!!');
    }

    public function destroy(Location $location)
    {
        try {
            Location::destroy($location->id); 
            return redirect('dashboard/locations')->with('success', 'Location has been delete!!!');
           } 
       catch (\Illuminate\Database\QueryException $e) {
       
               if($e->getCode() == "23000"){ //23000 is sql code for integrity constraint violation
                    return redirect('dashboard/locations')->with('fail', 'Location in use!!!');
                   // return error to user here
               }
           }
    }
}
