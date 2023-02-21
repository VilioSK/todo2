<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;

use App\Models\Category;
use App\Models\Todo;
use App\Models\User;

class TodoController extends Controller
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
        $this->authorize('viewAny', Todo::class);

        // get data
        $todo_data['active'] = Todo::where('user_id', Auth::id())->where('finished', 0)->get();
        $todo_data['finished'] = Todo::where('user_id', Auth::id())->where('finished', 1)->get();
        $todo_data['deleted'] = Todo::onlyTrashed()->where('user_id', Auth::id())->get();

        return view('todo.index', ['todo_data' => $todo_data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // authorize action
        $this->authorize('create', Todo::class);

        // get needed data
        $category_list = Category::where('user_id', Auth::id())->get();

        return view('todo.add', ['category_list' => $category_list]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // authorize action
        $this->authorize('create', Todo::class);
        
        // validate input data
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required']
        );

        // save changes
        $_todo = new Todo();
        $_todo->user_id = Auth::id();
        $_todo->category_id = $request->category_id;
        $_todo->name = $request->name;
        $_todo->description = $request->description;
        $_todo->finished = false;
        $_todo->save();

        return redirect()->route('todos.index')->with('alert.success', 'Task has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        // authorize action
        $this->authorize('view', $todo);

        return view('todo.show', ['todo' => $todo]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        // authorize action
        $this->authorize('update', $todo);

        return view('todo.edit', ['todo' => $todo]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        // authorize action
        $this->authorize('update', $todo);

        // validate input data
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required']
        );

        // save changes
        $_todo = Todo::findOrFail($todo->id);
        $_todo->name = $request->name;
        $_todo->description = $request->description;
        $_todo->save();

        return redirect()->route('todos.index')->with('alert.success','Task has been changed');
    }

    /**
     * Finish item
     */
    public function finish(Request $request, Todo $todo)
    {
        // authorize action
        $this->authorize('update', $todo);

        // save changes
        $_todo = Todo::findOrFail($todo->id);
        $_todo->finished = true;
        $_todo->save();

        return redirect()->route('todos.index')->with('alert.success','Task has been restored');
    }

    /**
     * Activate item
     */
    public function activate(Request $request, Todo $todo)
    {
        // authorize action
        $this->authorize('update', $todo);        

        // save changes
        $_todo = Todo::findOrFail($todo->id);
        $_todo->finished = false;
        $_todo->save();

        return redirect()->route('todos.index')->with('alert.success','Task has been activated');
    }    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        // authorize action
        $this->authorize('delete', $todo);

        // delete item
        $todo->delete();

        return redirect()->route('todos.index')->with('alert.success','Task has been deleted');
    }

    /**
     * Undo deleted item
     */
    public function restore($id)
    {
        // authorize action
        //$this->authorize('restore', $category);

        $todo_restore = Todo::withTrashed()
                        ->where('user_id', Auth::id())
                        ->where('id', $id)
                        ->restore();
        if($todo_restore == NULL)
            return redirect()->route('todos.index')->with('alert.error','Unable to find task item');
                                    
        return redirect()->route('todos.index')->with('alert.success','Task has been restored');
    }

}
