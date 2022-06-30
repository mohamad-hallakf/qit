<?php

namespace App\Http\Controllers;
use App\Models\Test;
use App\Models\Questions;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Events\notify;
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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::latest()->get();
        $questions = Questions::latest()->get();
         $tests = Test::latest()->get();
        return view('dashboard',compact('questions', 'users', 'tests'));
    }

    public  function guest()
    {
        return view('welcome');
    }

}
