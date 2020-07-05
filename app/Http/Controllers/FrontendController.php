<?php

namespace App\Http\Controllers;

use Auth;
use App\Category;
use App\Contest;
use App\ContestParticipant;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function contests(){
        $categories=Category::all();
        if(isset($_GET['subCategory']) && isset($_GET['category'])){
            $contests=Contest::where('sub_category',$_GET['subCategory'])->where('status','open')->orderBy('id','DESC')->paginate(12);
        }else if(isset($_GET['category']) && !isset($_GET['subCategory'])){
            $contests=Contest::where('category',$_GET['category'])->where('status','open')->orderBy('id','DESC')->paginate(12);
        }else{
            $contests=Contest::orderBy('id','DESC')->paginate(12);
        }

        return view('contests/index',compact('contests','categories'));
    }
    public function viewContest($id)
    {
        if(Auth::check()){
            $isParticipated=ContestParticipant::where('contest_id',$id)->where('user_id',Auth::id())->first();
        }else{
            $isParticipated='';
        }
        $contest=Contest::where('id',$id)->where('status','open')->firstOrFail();
        $participants=ContestParticipant::where('contest_id',$id)->get();
        return view('contests/show',compact('contest','participants','isParticipated'));
    }
}
