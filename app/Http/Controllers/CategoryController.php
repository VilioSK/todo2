<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category_list = Category::where('user_id', Auth::id())->get();
    
        return view('category.index', ['category_list' => $category_list]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required']
        );

        $category = new Category();
        $category->user_id = Auth::id();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return redirect()->route('categories.index')->with('alert.success', 'Category has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('category.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required']
        );

        $category_update = Category::findOrFail($category->id);
        $category_update->name = $request->name;
        $category_update->description = $request->description;
        $category_update->save();

        return redirect()->route('categories.index')->with('alert.success', 'Category changes has been saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category_delete = Category::findOrFail($category->id);
        $category_delete->delete();

        return redirect()->route('categories.index')->with('alert.success', 'Category has been deleted');
    }
}
