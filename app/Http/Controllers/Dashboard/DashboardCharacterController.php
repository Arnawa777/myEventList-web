<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Character;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardCharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Character::selectRaw('characters.*')
            ->groupby('role')
            ->orderby('role', 'asc')
            ->get();

        return view('dashboard.characters.index', [
            "title" => "Dashboard - List Character",
            'characters' => Character::latest()->filter(request(['search', 'role']))->paginate(5)->withQueryString(),
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.characters.create', [
            "title" => "Dashboard - Create Character",
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
            return redirect('dashboard/characters');
        }
        if ($request->action == 'create') {
            $rules = [
                'name' => 'required|unique:characters|min:3|max:50',
                'role' => 'required',
                'description' => 'nullable',
                'picture' => 'image|file|max:1024',
            ];

            $validatedData = $request->validate($rules);

            if (($request->file('picture'))) {
                // memberikan nama pada file yang diupload
                $filename = time() . '-' . $request->picture->getClientOriginalName() . '.' .  $request->picture->getClientOriginalExtension();
                $request->picture->storeAs('character-picture', $filename, 'public');

                $validatedData['picture'] = $filename;
            }

            $validatedData['slug'] = SlugService::createSlug(Character::class, 'slug', $request->name);

            Character::create($validatedData);

            return redirect('/dashboard/characters')->with('success', 'New Character has been added!!!');
        }
    }

    public function show(Character $character)
    {
        return view('dashboard.characters.show', [
            "title" => "Dashboard - Show $character->name",
            'chara' => $character,
            'actors' => $character->actor,
            'eventList' => $character->actor_event->unique('event_id'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Character $character)
    {
        return view('dashboard.characters.edit', [
            'title' => "Dashboard - Edit Character",
            'chara' => $character,
        ]);
    }

    public function update(Request $request, Character $character)
    {
        if ($request->action == 'remove') {
            if ($request->oldPicture) {
                $file = public_path('/storage/character-picture/' . $character->picture);

                if (file_exists($file)) {
                    unlink($file);
                }
            }

            Character::where('id', $character->id)
                ->update(['picture' => null]);

            return redirect()->back();
        }

        if ($request->action == 'cancel') {
            return redirect('dashboard/characters');
        }

        if ($request->action == 'update') {
            $rules = [
                'name' => 'required|min:3|max:50|unique:characters,name,' . $character->id,
                'role' => 'required',
                'description' => 'nullable',
                'picture' => 'nullable|image|file|max:1024',
            ];

            $validatedData = $request->validate($rules);

            if ($request->file('picture')) {
                if (($request->oldPicture)) {
                    $file = public_path('/storage/character-picture/' . $request->oldPicture);

                    if (file_exists($file)) {
                        unlink($file);
                    }
                }

                // memberikan nama pada file yang diupload
                $filename = time() . '-' . $request->picture->getClientOriginalName() . '.' .  $request->picture->getClientOriginalExtension();
                $request->picture->storeAs('character-picture', $filename, 'public');

                $validatedData['picture'] = $filename;
            }

            $validatedData['slug'] = SlugService::createSlug(Character::class, 'slug', $request->name);


            Character::where('id', $character->id)
                ->update($validatedData);

            return redirect('/dashboard/characters')->with('success', 'Character has been updated!!!');
        }
    }

    public function destroy(Character $chara)
    {
        if ($chara->picture) {
            if ($chara->picture) {
                $file = public_path('/storage/character-picture/' . $chara->picture);

                if (file_exists($file)) {
                    unlink($file);
                }
            }
        }

        Character::destroy($chara->id);

        return redirect('/dashboard/characters')->with('success', 'Character has been deleted!!!');
    }
}
