<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('welcome');
    }
    public function indexT()
    {
        if(\Auth::user()->isTeacher == 0) {
            return view('studenthome');
        }
        return view('teacherhome');
    }
    public function indexS()
    {
        if(\Auth::user()->isTeacher == 1) {
            return view('teacherhome');
        }
        return view('studenthome');
    }
}
