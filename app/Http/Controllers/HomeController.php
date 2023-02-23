<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Category;
use App\Models\Todo;
use App\Models\Share;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // get needed data
        $data['task_list'] = Todo::where('user_id', Auth::id())->where('finished', false)->get();
        $data['category_list'] = Category::where('user_id', Auth::id())->get();
        $data['share_list'] = Share::where('owner_id', Auth::id())->orWhere('user_id', Auth::id())->get();

        return view('home', $data);
    }
}
