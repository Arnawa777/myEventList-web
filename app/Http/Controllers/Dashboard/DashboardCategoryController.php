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
            'title' => "Dashboard - List Category",
            'categories' => Category::latest()->filter(request(['search']))->paginate(5)->withQueryString(),
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
            'title' => "Dashboard - Create Category",
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
            return redirect('dashboard/categories')->with('success', 'New Category has been added!!!');
        }
    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', [
            'title' => "Dashboard - Edit Category",
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

            return redirect('dashboard/categories')->with('success', 'Category has been update!!!');
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
            return redirect('dashboard/categories')->with('success', 'Category has been delete!!!');
        } catch (\Illuminate\Database\QueryException $e) {

            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                return redirect('dashboard/categories')->with('fail', 'Category in use!!!');
                // return error to user here
            }
        }
    }
}
