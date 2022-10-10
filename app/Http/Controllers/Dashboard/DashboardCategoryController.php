<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use \Cviebrock\EloquentSluggable\Services\SlugService;


class DashboardCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.categories.index', [
            'title' => "Dashboard - Daftar Kategori",
            'categories' => Category::orderBy('updated_at', 'desc')->orderBy('created_at', 'desc')->filter(request(['search']))->paginate(5)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create', [
            'title' => "Dashboard - Buat Kategori",
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
            return redirect('dashboard/categories');
        }
        if ($request->action == 'create') {
            $validatedData = $request->validate([
                'name' => 'required|min:3|max:25|unique:categories,name',
            ]);
            $validatedData['slug'] = SlugService::createSlug(Category::class, 'slug', $request->name);

            Category::create($validatedData);
            return redirect('dashboard/categories')->with('success', 'Kategori baru telah ditambahkan!!!');
        }
    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', [
            'title' => "Dashboard - Ubah Kategori",
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if ($request->action == 'cancel') {
            return redirect('dashboard/categories');
        }
        if ($request->action == 'update') {
            $validatedData = $request->validate([
                'name' => 'required|min:3|max:25|unique:categories,name,' . $category->id,
            ]);

            $validatedData['slug'] = SlugService::createSlug(Category::class, 'slug', $request->name);

            Category::where('id', $category->id)
                ->update($validatedData);

            return redirect('dashboard/categories')->with('success', 'Kategori berhasil diperbarui!!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // if ($category->events()->exists()
        // || $category->employee()->exists())
        try {
            Category::destroy($category->id);
            return redirect('dashboard/categories')->with('success', 'Kategori berhasil dihapus!!!');
        } catch (\Illuminate\Database\QueryException $e) {

            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                return redirect('dashboard/categories')->with('fail', 'Gagal.. Kategori sedang digunakan!!!');
                // return error to user here
            }
        }
    }
}
