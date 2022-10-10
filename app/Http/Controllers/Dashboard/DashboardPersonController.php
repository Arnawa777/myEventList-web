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
            'title' => 'Dashboard - Daftar Orang',
            'people' => Person::orderBy('updated_at', 'desc')->orderBy('created_at', 'desc')->filter(request(['search']))->paginate(5)->withQueryString(),
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
            'title' => 'Dashboard - Buat Orang',
        ]);
    }

    public function store(Request $request)
    {
        if ($request->action == 'cancel') {
            return redirect('dashboard/people');
        }
        if ($request->action == 'create') {
            $rules = [
                'name' => 'required|unique:people|min:3|max:50',
                'birthday' => 'nullable',
                'biography' => 'nullable',
                'picture' => 'nullable|image|file|max:1024',
            ];

            $validatedData = $request->validate($rules);

            if (($request->file('picture'))) {
                // memberikan nama pada file yang diupload
                $filename = time() . '-' . $request->picture->getClientOriginalName() . '.' .  $request->picture->getClientOriginalExtension();
                $request->picture->storeAs('person-picture', $filename, 'public');

                $validatedData['picture'] = $filename;
            }

            $validatedData['slug'] = SlugService::createSlug(Person::class, 'slug', $request->name);

            Person::create($validatedData);

            return redirect('/dashboard/people')->with('success', 'Orang baru telah ditambahkan!!!');
        }
    }

    public function show(Person $person)
    {
        return view('dashboard.people.show', [
            'title' => "Dashboard - Detail $person->name",
            'person' => $person,
            'actors' => $person->actor_event,
            'staff' => $person->staff,
            'eventList' => $person->actor_event->unique('event_id'),
        ]);
    }

    public function edit(Person $person)
    {
        return view('dashboard.people.edit', [
            'title' => 'Dashboard - Ubah Orang',
            'person' => $person,
        ]);
    }

    public function update(Request $request, Person $person)
    {
        if ($request->action == 'remove') {
            if ($request->oldPicture) {
                $file = public_path('/storage/person-picture/' . $person->picture);

                if (file_exists($file)) {
                    unlink($file);
                }
            }

            Person::where('id', $person->id)
                ->update(['picture' => null]);

            return redirect()->back();
        }

        if ($request->action == 'cancel') {
            return redirect('dashboard/people');
        }

        if ($request->action == 'update') {
            $rules = [
                'name' => 'required|min:3|max:50|unique:people,name,' . $person->id,
                'birthday' => 'nullable',
                'biography' => 'nullable',
                'picture' => 'nullable|image|file|max:1024',
            ];

            $validatedData = $request->validate($rules);

            if ($request->file('picture')) {
                if ($request->oldPicture) {
                    $file = public_path('/storage/person-picture/' . $request->oldPicture);

                    if (file_exists($file)) {
                        unlink($file);
                    }
                }

                // memberikan nama pada file yang diupload
                $filename = time() . '-' . $request->picture->getClientOriginalName() . '.' .  $request->picture->getClientOriginalExtension();
                $request->picture->storeAs('person-picture', $filename, 'public');

                $validatedData['picture'] = $filename;
            }

            $validatedData['slug'] = SlugService::createSlug(Person::class, 'slug', $request->name);

            Person::where('id', $person->id)
                ->update($validatedData);

            return redirect('/dashboard/people')->with('success', 'Orang berhasil diperbarui!!!');
        }
    }

    public function destroy(Person $person)
    {
        if (!empty($person->picture)) {
            $file = public_path('/storage/person-picture/' . $person->picture);

            if (file_exists($file)) {
                unlink($file);
            }
        }

        Person::destroy($person->id);

        return redirect('/dashboard/people')->with('success', 'Orang berhasil dihapus!!!');
    }
}
