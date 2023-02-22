<?php

namespace App\Http\Controllers;

use App\Models\Share;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Category;
use App\Models\Todo;
use App\Models\User;

class ShareController extends Controller
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
        $this->authorize('viewAny', Share::class);

        // get data
        $share_data = Share::where('owner_id', Auth::id())->get();
        /*
        $share_data = DB::table('shares')
            ->join('users', 'shares.user_id', '=' ,'users.id')
            ->join('todos', 'shares.todo_id', '=' ,'todos.id')
            ->where('todos.user_id', Auth::id())
            ->get();
        */
    
        //dd($share_data);
        return view('share.index', ['share_data' => $share_data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // authorize action
        $this->authorize('create', Share::class);

        // get data
        $task_data = Todo::where('user_id', Auth::id())->get();
        $user_data = User::where('id','!=', Auth::id())->get();

        return view('share.create', ['task_data' => $task_data, 'user_data' => $user_data]);
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
            'user_id' => 'required',
            'todo_id' => 'required']
        );

        // store category
        $_share = new Share();
        $_share->owner_id = Auth::id();
        $_share->user_id = $request->user_id;
        $_share->todo_id = $request->todo_id;
        $_share->save();

        return redirect()->route('shares.index')->with('alert.success', 'Task has been shared');
    }

    /**
     * Display the specified resource.
     */
    public function show(Share $share)
    {
        // authorize action
        $this->authorize('view', $share);

        return view('share.show', ['share' => $share]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Share $share)
    {
        // authorize action
        $this->authorize('update', $share);

        // get data
        $task_data = Todo::where('user_id', Auth::id())->get();
        $user_data = User::where('id','!=', Auth::id())->get();

        return view('share.edit', ['share'=> $share, 'task_data' => $task_data, 'user_data' => $user_data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Share $share)
    {
        // authorize action
        $this->authorize('update', $share);

        // validate data
        $this->validate($request, [
            'user_id' => 'required',
            'todo_id' => 'required'
        ]);

        // store changes
        $_share = Share::findOrFail($share->id);
        $_share->user_id = $request->user_id;
        $_share->todo_id = $request->todo_id;
        $_share->save();

        return redirect()->route('shares.index')->with('alert.success', 'Share changes has been saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Share $share)
    {
        // authorize action
        $this->authorize('delete', $share);

        $_share = Share::findOrFail($share->id);    
        $_share->delete();

        return redirect()->route('shares.index')->with('alert.success', 'Share has been deleted');
    }
}
