<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users=User::where('type','user')->get()->count();
        return view('admin/dashboard',compact('users'));
    }



}
