<?php

namespace App\Http\Controllers;

use App\Contest;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        if(isset($_GET['subCategory']) && isset($_GET['category'])){
            $contests=Contest::where('sub_category',$_GET['subCategory'])->orderBy('id','DESC')->paginate(12);
        }else if(isset($_GET['category']) && !isset($_GET['subCategory'])){
            $contests=Contest::where('category',$_GET['category'])->orderBy('id','DESC')->paginate(12);
        }else{
            $contests=Contest::orderBy('id','DESC')->paginate(12);
        }

        return view('welcome',compact('contests'));
    }
}
