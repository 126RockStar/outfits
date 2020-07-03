<?php

namespace App\Http\Controllers;

use App\Category;
use App\Contest;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function contests(){
        $categories=Category::all();
        if(isset($_GET['subCategory']) && isset($_GET['category'])){
            $contests=Contest::where('sub_category',$_GET['subCategory'])->orderBy('id','DESC')->paginate(12);
        }else if(isset($_GET['category']) && !isset($_GET['subCategory'])){
            $contests=Contest::where('category',$_GET['category'])->orderBy('id','DESC')->paginate(12);
        }else{
            $contests=Contest::orderBy('id','DESC')->paginate(12);
        }

        return view('contests/index',compact('contests','categories'));
    }
    public function viewContest($id)
    {
        $contest=Contest::where('id',$id)->firstOrFail();
        return view('contests/show',compact('contest'));
    }
}
