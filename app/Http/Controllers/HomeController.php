<?php

namespace App\Http\Controllers;

use App\Contest;
use App\ContestParticipant;
use App\SubCategory;
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
            return redirect(route('admin.dashboard'));
        }else{
            
            return redirect(route('user.dashboard'));
        }
    }
    public function userDashboard()
    {
        $referredUsers=User::where('refered_user_id',Auth::id())->get();
        $participatedContests=ContestParticipant::where('user_id',Auth::id())->pluck('contest_id');
        if(isset($_GET['joined'])){
            $contests=Contest::where('user_id',Auth::id())->where('status','open')->WhereIn('id',$participatedContests)->orderBy('id','DESC')->paginate(12);
        }else{
            $contests=Contest::where('user_id',Auth::id())->where('status','open')->orderBy('id','DESC')->paginate(12);
        }
        return view('home',compact('referredUsers','contests','participatedContests'));
    }

    public function fetchSubCategory(Request $request){
        $subCategories = SubCategory::where("category_id",$request->catID)->pluck("name","id");
        return json_encode($subCategories);
      }
 
}
