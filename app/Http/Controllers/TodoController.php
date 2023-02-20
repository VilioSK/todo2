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
        $category_list = Category::where('user_id', Auth::id())->get();

        return view('todo.add', ['category_list' => $category_list]);
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

        $todo = new Todo();
        $todo->user_id = Auth::id();
        $todo->category_id = $request->category_id;
        $todo->name = $request->name;
        $todo->description = $request->description;
        $todo->finished = false;
        $todo->save();

        return redirect()->route('todos.index')->with('alert.success', 'Task has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        $todo_show = Todo::withTrashed()
                        ->where('user_id', Auth::id())
                        ->where('id', $todo->id)
                        ->first();
        if($todo_show == NULL)
            return redirect()->route('todos.index')->with('alert.error','Unable to find task');

        return view('todo.show', ['todo' => $todo_show]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        return view('todo.edit', ['todo' => $todo]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required']
        );

        $todo_update = Todo::where('user_id', Auth::id())
                        ->where('id', $todo->id)
                        ->first();
        if($todo_update == NULL)
            return redirect()->route('todos.index')->with('alert.error','Unable to find task item');

        $todo_update->name = $request->name;
        $todo_update->description = $request->description;
        $todo_update->save();

        return redirect()->route('todos.index')->with('alert.success','Task has been changed');
    }

    /**
     * Finish item
     */
    public function finish(Request $request, Todo $todo)
    {
        $todo_finish = Todo::where('user_id', Auth::id())
                        ->where('id', $todo->id)
                        ->first();
        if($todo_finish == NULL)
            return redirect()->route('todos.index')->with('alert.error','Unable to find task item');

        $todo->finished = true;
        $todo->save();

        return redirect()->route('todos.index')->with('alert.success','Task has been restored');
    }

    /**
     * Activate item
     */
    public function activate(Request $request, Todo $todo)
    {
        $todo_finish = Todo::where('user_id', Auth::id())
                        ->where('id', $todo->id)
                        ->first();
        if($todo_finish == NULL)
            return redirect()->route('todos.index')->with('alert.error','Unable to find task item');

        $todo->finished = false;
        $todo->save();

        return redirect()->route('todos.index')->with('alert.success','Task has been activated');
    }    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo_delete = Todo::where('user_id', Auth::id())
                        ->where('id', $todo->id)
                        ->first();
        if($todo_delete == NULL)
            return redirect()->route('todos.index')->with('alert.error','Unable to find task item');
        $todo_delete->delete();

        return redirect()->route('todos.index')->with('alert.success','Task has been deleted');
    }

    /**
     * Undo deleted item
     */
    public function restore($id)
    {
        $todo_restore = Todo::withTrashed()
                        ->where('user_id', Auth::id())
                        ->where('id', $id)
                        ->restore();
        if($todo_restore == NULL)
            return redirect()->route('todos.index')->with('alert.error','Unable to find task item');
                                    
        return redirect()->route('todos.index')->with('alert.success','Task has been restored');
    }

}
