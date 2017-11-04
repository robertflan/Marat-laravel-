<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Company;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('company')->get();

        return view('dashboard.crud.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();

        return view('dashboard.crud.category.create',  compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category;
        $category->company_id = $request->company;
        $category->name = $request->name;
        $category->short_name = $request->short_name;
        $category->is_popular = $request->popular;
        $category->description = $request->description;
        if($request->image) {
            $category->image = $request->image->storeAs('images', str_random(10).'.'.$request->image->extension(), 'public');
        }

        $category->slug = $request->slug;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->save();

        return redirect('/dashboard/categories')->with('message', 'Successfully created category!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('dashboard.crud.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $companies = Company::all();

        return view('dashboard.crud.category.edit', compact('category', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->company_id = $request->company;
        $category->name = $request->name;
        $category->short_name = $request->short_name;
        $category->is_popular = $request->popular;
        $category->description = $request->description;
        if($request->image) {
            $category->image = $request->image->storeAs('images', str_random(10).'.'.$request->image->extension(), 'public');
        }

        $category->slug = $request->slug;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->save();

        return redirect('/dashboard/categories')->with('message', 'Successfully updated category!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect('/dashboard/categories')->with('message', 'Category deleted!');
    }
}
