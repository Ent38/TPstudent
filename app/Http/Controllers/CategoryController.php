<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use constPath;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        Gate::authorize('view_category');

        $categories = Category::get();

        return view('josue.backend.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all()->pluck('name', 'id');

        return view('josue.backend.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        //
        Gate::authorize('add_categories');

        $category = Category::create($request->validated());
        $category->image = uploadOrUpdateFile($request, $category->image, constPath::CategoryImage);
        $category->save();
        $status = 'category Created Successfully';

        return redirect()->route('categories.index')->with([
            'status' => $status,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        Gate::authorize('view_category');
        $categories = Category::all();

        return view('josue.backend.categories.show', ['category' => $category], compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        return view('josue.backend.categories.edit', compact('category') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
 
        Gate::authorize('edit_category');

        $category->update($request->all());
        $category->image = uploadOrUpdateFile($request, $category->image, constPath::CategoryImage);
        $category->save();
        $status = 'category Updated Successfully';

        return redirect()->route('categories.index',)->with([
            'status' => $status,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::table('categories')->where('id', $id)->delete();

        $status = 'The category was deleted successfully.';

        return redirect()->route('categories.index')->with([
            'status' => $status,
        ]);
        //
    }
}
