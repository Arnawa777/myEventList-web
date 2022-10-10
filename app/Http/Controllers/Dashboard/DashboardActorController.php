<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Actor;
use App\Models\Person;
use App\Models\Character;

class DashboardActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('dashboard.actors.index', [
            "title" => "Dashboard - Daftar Aktor",
            'actors' => Actor::orderBy('updated_at', 'desc')->orderBy('created_at', 'desc')->filter(request(['search']))->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.actors.create', [
            "title" => "Dashboard - Buat Aktor",
            'people' => Person::orderBy('name', 'asc')->get(),
            'characters' => Character::orderBy('name', 'asc')->get(),
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
            return redirect('dashboard/actors');
        }
        if ($request->action == 'create') {
            $validatedData = $request->validate(
                [
                    'character_id' => 'required|unique:actors,character_id,NULL,id,person_id,' . $request->person_id,
                    'person_id' => 'required',
                ],
                [
                    'character_id.unique' => 'Aktor sudah ada!!!',
                ]
            );

            Actor::create($validatedData);

            return redirect('/dashboard/actors')->with('success', 'Aktor baru telah ditambahkan!!!');
        }
    }

    public function edit(Actor $actor)
    {
        return view('dashboard.actors.edit', [
            "title" => "Dashboard - Ubah Aktor",
            'people' => Person::orderBy('name', 'asc')->get(),
            'characters' => Character::orderBy('name', 'asc')->get(),
            'actor' => $actor
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
            return redirect('dashboard/actors');
        }
        if ($request->action == 'update') {
            $validatedData = $request->validate(
                [
                    'character_id' => 'required|unique:actors,character_id,' . $id . ',id,person_id,' . $request->person_id,
                    'person_id' => 'required',
                ],
                [
                    'character_id.unique' => 'Aktor sudah ada!!!',
                ]
            );

            Actor::where('id', $id)
                ->update($validatedData);

            return redirect('/dashboard/actors')->with('success', 'Aktor berhasil diperbarui!!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Actor::destroy($id);

        return redirect('/dashboard/actors')->with('success', 'Aktor berhasil dihapus!!');
    }
}
