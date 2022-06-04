<?php

namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\Child;
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
        $services = Service::latest()->get();
        $children = Child::where('userid',Auth::id())->get();
        $childrens = Child::latest()->get();
        return view('dashboard',compact('services','children', 'users', 'childrens'));
    }

    public  function guest()
    {
        return view('welcome');
    }

}
