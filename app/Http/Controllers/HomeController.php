<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
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
        if(Auth::user()->type=='admin'){
            return redirect(route('admin.cashboard'));
        }else{
            
            return redirect(route('user.cashboard'));
        }
    }
    public function userDashboard()
    {
        $referredUsers=User::where('refered_user_id',Auth::id())->get();
        return view('home',compact('referredUsers'));
    }
 
}
