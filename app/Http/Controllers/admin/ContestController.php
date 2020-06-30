<?php

namespace App\Http\Controllers\admin;

use App\Contest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    public function list(){
        
        $contests=Contest::all();
        return view('admin/contests/list',compact('contests'));
    }
}
