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
        // authorize action
        $this->authorize('viewAny', Category::class);

        // get data
        $category_list = Category::where('user_id', Auth::id())->get();
    
        return view('category.index', ['category_list' => $category_list]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // authorize action
        $this->authorize('create', Category::class);

        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // authorize action
        $this->authorize('create', Category::class);

        // validate data
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required']
        );

        // store category
        $_category = new Category();
        $_category->user_id = Auth::id();
        $_category->name = $request->name;
        $_category->description = $request->description;
        $_category->default = false;
        $_category->save();

        return redirect()->route('categories.index')->with('alert.success', 'Category has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // authorize action
        $this->authorize('view', $category);

        return view('category.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // authorize action
        $this->authorize('update', $category);

        return view('category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // authorize action
        $this->authorize('update', $category);

        // validate data
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required']
        );

        // store changes
        $_category = Category::findOrFail($category->id);
        $_category->name = $request->name;
        $_category->description = $request->description;
        $_category->save();

        return redirect()->route('categories.index')->with('alert.success', 'Category changes has been saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // authorize action
        $this->authorize('delete', $category);

        $_category = Category::findOrFail($category->id);
        
        // unable to delete default category
        if($_category->default == true)
            return redirect()->route('categories.index')->with('alert.info', 'Unable to delete default category');
        
        $_category->delete();

        return redirect()->route('categories.index')->with('alert.success', 'Category has been deleted');
    }
}
